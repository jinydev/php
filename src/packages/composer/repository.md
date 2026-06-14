---
layout: php
title: "PHP composer"
breadcrumb:
- packages
- composer
---

# 커스텀 저장소 구성 (Custom Repositories)
---
기본적으로 컴포저는 패키지 설치 시 세계 공식 중앙 저장소인 Packagist.org를 조회하여 관련 패키지를 찾아 다운로드합니다. 

그러나 사내 보안용 비공개(Private) 라이브러리를 공유해야 하거나, 로컬 컴퓨터에서 여러 개의 패키지를 실시간 연동해 개발해야 할 때는 공식 저장소에 올리지 않고 직접 별개의 저장소 위치를 지정해 가져와야 합니다. 컴포저는 이를 위해 `composer.json` 내부에 **`"repositories"`** 필드를 추가 설정하여 다양한 원격/로컬 주소를 바라보는 기능을 제공합니다.

이 장에서는 대표적인 커스텀 저장소 종류인 **VCS 저장소**, **로컬 Path 저장소**, 그리고 사설 저장소 구축 도구인 **Satis**의 개념을 학습합니다.

<br>

## 1. VCS 저장소 (Version Control System)
---
VCS 저장소 방식은 Packagist에 패키지를 제출하지 않고, **공개 또는 비공개로 개설된 외부 Git, SVN, Mercurial 저장소 주소로부터 소스를 다이렉트로 내려받는 기법**입니다.

### 1.1 VCS 저장소 적용 방법
주로 기업 내부에서 사설 깃허브(GitHub Enterprise)나 GitLab 환경에서 프라이빗 라이브러리를 임포트할 때 필수적입니다. 메인 프로젝트의 `composer.json` 파일에 아래와 같이 정의합니다.
```json
{
    "name": "mycompany/my-app",
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/mycompany/private-package.git"
        }
    ],
    "require": {
        "mycompany/private-package": "^1.0"
    }
}
```
* **작업 매커니즘**: 컴포저는 `"require"`에 기재된 `mycompany/private-package` 패키지를 다운로드하기 위해 공식 패키지스트를 조회하기 전, 상단의 `"repositories"` 목록에 선언된 VCS 원격 주소를 우선적으로 방문하여 소스를 복제해 옵니다.
* **비공개 SSH/OAuth 연동**: 저장소가 비공개(Private) 상태인 경우, 컴포저는 설치 프로세스 중에 사용자의 Git SSH 키 혹은 GitHub Personal Access Token을 검증하여 안전하게 접근합니다.

<br>

## 2. 로컬 Path 저장소 (로컬 패키지 연동 개발)
---
여러 패키지를 동시에 병렬 개발할 때, 수정 사항을 원격 Git 저장소에 매번 `push`하고 `update`하여 테스트하는 과정은 극도로 비효율적입니다. 

Path 저장소 방식은 **로컬 컴퓨터 내의 특정 디렉터리를 가상의 저장소 주소로 맵에 등록하여 설치하는 최적의 개발 지원 기법**입니다.

```json
{
    "name": "myproject/main-app",
    "repositories": [
        {
            "type": "path",
            "url": "packages/jiny/hello",
            "options": {
                "symlink": true
            }
        }
    ],
    "require": {
        "jiny/hello": "*@dev"
    }
}
```

### 2.1 동작 기법과 옵션 해설
* **`"url"`**: 내 컴퓨터 내부의 상대 경로 또는 절대 경로를 가리킵니다.
* **`"symlink": true`**: 이 옵션을 지정하면 컴포저는 로컬 원본 디렉터리 소스 파일을 복사하여 복제본을 집어넣는 대신, `vendor/jiny/hello` 디렉터리가 로컬 원본 디렉터리(`packages/jiny/hello`)를 가리키도록 **심볼릭 링크(Symlink)**를 걸어 연결합니다.
  * 덕분에 개발자가 `packages/jiny/hello/src/` 내부 파일을 직접 에디터로 수정하면, `vendor/` 내의 파일도 즉시 변경되므로 번거로운 업그레이드 명령어 없이 실시간 소스코드 테스트가 가능하여 효율성이 극대화됩니다.
* **`*@dev`**: 로컬에 존재하는 최신 개발 본점 코드를 즉각 수용하도록 버전 제약을 느슨히 지정해 둡니다.

<br>

## 3. 사설 패키지 배포 서버 구축 (Satis)
---
회사 내에서 관리하는 사설 패키지가 수십 개가 되면 메인 프로젝트마다 매번 `composer.json`에 수십 줄에 걸친 VCS 리포지토리 목록을 일일이 적어 넣는 작업은 관리 지옥으로 변질됩니다.

이때 활용할 수 있는 오픈소스 솔루션이 컴포저 개발 진영에서 공식 배포하는 **Satis(새티스)**입니다.

```text
               +--------------------------------------+
               |          [ 사내 로컬 환경 ]          |
               |                                      |
[사설 깃랩] ===+===> [Satis 서버 (사설 Packagist)] ===+===> [개별 프로젝트]
(Private GitLab)      (패키지 메타데이터 정적 빌드)            (composer.json)
               +--------------------------------------+
```

### 3.1 Satis의 특징과 이점
1. **정적 메타데이터 생성**: Satis는 사내 사설 깃랩(GitLab)이나 깃허브 내의 지정된 모든 저장소 정보를 전수 정적 수집하여, 공식 Packagist와 동일한 역할을 하는 가벼운 JSON 메타데이터 웹페이지를 생성해 줍니다.
2. **간소화된 설정**: 각 프로젝트 개발자들은 사내 망에 구축된 단 하나의 Satis 허브 주소만 `composer.json`에 명시하면 복잡한 개별 저장소 주소 지정 없이 모든 사내 패키지를 편안하게 관리할 수 있습니다.
   ```json
   "repositories": [
       {
           "type": "composer",
           "url": "http://satis.mycompany.internal"
       }
   ]
   ```
3. **캐싱 및 속도 향상**: 외부 패키지 원본 압축 아카이브를 자체 보관(Caching)할 수도 있어, 사내 네트워크 대역폭 절약 및 고속 빌드를 달성할 수 있습니다.
