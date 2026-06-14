---
layout: php
title: "PHP composer"
breadcrumb:
- packages
- composer
---

# 패키지 배포 (Publishing to Packagist)
---
로컬에서 개발한 패키지를 전 세계 PHP 개발자들이 자유롭게 내려받아 사용할 수 있도록 배포하려면 패키지 중앙 저장소인 **패키지스트(Packagist.org)**에 패키지를 등록해야 합니다.

패키지스트는 소스파일 자체를 지니지 않고 GitHub 등 외부 형상관리 서비스 저장소를 감시하며 배포 중개 역할만 수행하므로, 먼저 **Git 버전 관리**를 구성하고 **GitHub 공개 저장소**에 소스를 올린 뒤, 최종적으로 **Packagist**에 주소를 연계하는 과정을 수행해야 합니다.

이 장에서는 단계별 배포 요령과 GitHub 최신 Webhook을 활용한 배포 자동화 설정을 학습합니다.

<br>

## 1. 패키지 로컬 Git 초기화 및 커밋
---
배포할 패키지 디렉터리로 이동하여 Git 저장소를 만들고 코드를 커밋합니다.
```bash
$ cd packages/jiny/hello
$ git init
```

프로젝트에 속한 파일들을 스테이징 영역에 추가하고 로컬 커밋을 수행합니다.
```bash
$ git add .
$ git commit -m "First release version 0.0.1"
```

<br>

## 2. GitHub 원격 저장소 연동 및 푸시
---
1. 본인의 GitHub 계정에 로그인한 뒤, `hello` (혹은 임의의 패키지명) 이름으로 새로운 **Public(공개)** 저장소를 생성합니다. (패키지스트가 정보를 긁어가야 하므로 반드시 공개형 저장소여야 합니다.)
2. 생성된 원격 저장소 URL 주소를 로컬 Git에 origin으로 연동합니다.
   ```bash
   $ git remote add origin https://github.com/jinyphp/hello.git
   ```
3. 마스터 브랜치 코드를 원격 저장소에 업로드합니다.
   ```bash
   $ git push -u origin master
   ```

### 2.1 릴리스 버전 태깅 (Tagging)
컴포저는 Git의 **태그(Tag)**를 기반으로 패키지 버전을 인식합니다. SemVer 표기에 맞춰 버전 태그를 매기고 깃허브에 푸시합니다.
```bash
# 로컬 태그 작성
$ git tag -a 0.0.1 -m "Version 0.0.1 release"

# 태그를 원격 GitHub 저장소에 푸시
$ git push origin --tags
```
* 위 푸시를 마치면 GitHub 저장소의 `Releases` 또는 `Tags` 탭에 `0.0.1` 릴리스 버전이 공식 등재됩니다.

<br>

## 3. Packagist 등록 제출
---
1. **[Packagist.org](https://packagist.org)** 웹사이트에 접속해 우측 상단 `Submit` 메뉴를 선택합니다. (계정이 없다면 GitHub 계정을 연동해 1초 만에 회원 가입할 수 있습니다.)
2. **Repository URL** 입력창에 깃허브 저장소 주소(예: `https://github.com/jinyphp/hello.git`)를 기입하고 `Check` 버튼을 누릅니다.
3. 중복된 벤더명이 없다면 등록 적합 여부가 확인되고 `Submit` 버튼이 활성화됩니다. 최종 버튼을 선택하면 배포가 즉각 개시됩니다.

<br>

## 4. GitHub Webhook 연동 (배포 자동화)
---
기본 배포 단계만 완료하면, 패키지 소스를 수정하고 깃허브에 푸시할 때마다 패키지스트 사이트에 매번 직접 접속해 `Update` 단추를 손으로 눌러야 갱신이 일어납니다. 이 번거로움을 해결하기 위해 GitHub와 Webhook을 연동하여 푸시가 일어날 때마다 패키지스트에 실시간 갱신 시그널을 주도록 설정해야 합니다.

> [!IMPORTANT]
> **중요 공지 (GitHub Services 폐기)**:
> 과거 깃허브에서 지원했던 `Integrations & Services` 메뉴 내의 Packagist 전용 연동 앱 기능은 **2019년에 공식 폐지**되었습니다. 따라서 오래된 문서에 적힌 구식 서비스 추가법을 따르지 말고, 아래의 **현대적인 GitHub Webhooks 설정법**을 직접 입력하여 설정해야 합니다.

#### [단계 1] Packagist API 토큰 확보
1. Packagist.org 우측 상단 자신의 프로필명을 누르고 `Profile`로 진입합니다.
2. 프로필 정보 란 중간의 **`Show API Token`** 버튼을 눌러 난수로 된 API 토큰을 안전하게 복사해 둡니다.

#### [단계 2] GitHub Webhooks 설정 추가
1. GitHub의 패키지 저장소 페이지로 이동해 상단 메뉴 중 **`Settings`**에 들어갑니다.
2. 좌측 사이드바에서 **`Webhooks`** 메뉴를 선택하고 우측의 **`Add webhook`** 버튼을 누릅니다.
3. 설정을 다음과 같이 채워 넣습니다.
   * **Payload URL**: 아래 형식의 주소를 정밀히 조합해 입력합니다.
     `https://packagist.org/api/github?username=본인의_패키지스트_아이디`
   * **Content type**: `application/json`으로 변경합니다.
   * **Secret**: 단계 1에서 복사해 둔 **Packagist API 토큰**을 그대로 붙여넣습니다.
   * **Which events...**: 기본 설정인 `Just the push event.` 상태를 유지합니다.
4. 하단의 **`Add webhook`** 녹색 버튼을 누르면 연동이 끝납니다. 이제 깃허브에 코드를 푸시하거나 태그를 매겨 전송하면 패키지스트의 내 패키지 버전이 5초 이내에 자동 갱신됩니다.

<br>

## 5. 배포 완료된 패키지 실서버 설치 검증
---
모든 처리가 완료되었으면 패키지가 정상 동작하는지 테스트해 봅니다.
1. 이전에 작업했던 로컬 수동 오토로드 임시 설정(`"Jiny\\Hello\\": "packages/jiny/hello/src"`)을 루트 `composer.json`에서 깔끔히 제거하고 `composer dumpautoload`를 해 줍니다. (이제 로컬 수동 로드 환경이 해제되어 인스턴스 생성 시 에러가 터지는 상태가 됩니다.)
2. 공식 패키지 내려받기 명령을 실행합니다.
   ```bash
   $ composer require jiny/hello
   ```
3. 설치가 원활히 완료되면 `vendor/jiny/hello` 경로가 자동으로 형성되고, 인터넷에서 내려받은 소스코드로 오토로더가 작동하여 로직이 이상 없이 복구 가동되는 것을 확인할 수 있습니다.
