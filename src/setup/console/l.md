---
layout: php
title: PHP CLI 문법 검사 옵션 (-l) 활용 가이드
description: "PHP CLI의 -l(Lint) 옵션을 사용하여 소스코드 구동 없이 문법적 에러(Syntax Error)를 고속 검사하고, CI/CD 배포 파이프라인 및 Git Hook에 이식하는 법을 다룹니다."
keyword: "php -l, php lint, php 문법 검사, php syntax check, php cli 검증, php ci cd lint"
breadcrumb:
- setup
- console
- option
- l
---

# PHP 문법 검사 옵션 (`-l`)
---
PHP **`-l`** 옵션은 **'Lint(린트)'**의 머리글자에서 따온 옵션으로, 해당 PHP 파일을 실제로 **실행하지 않고 오직 문법적 오류(Syntax Error)가 존재하는지 여부만 해석**하여 판별해 줍니다. 

잘못된 코드를 서버에 올려 웹 애플리케이션 전체가 화이트스크린(먹통)이 되거나 작동이 중단되는 런타임 사고를 예방하기 위한 1차 방어선 역할을 수행합니다.

<br>

### 1. 사용법 및 결과 식별
---
검증하고 싶은 스크립트 파일명 앞에 `-l` 플래그를 할당하여 명령을 처리합니다.

```console
php -l [검사할_파일명.php]
```

#### 1) 문법에 이상이 없는 경우 (정상)
```console
$ php -l index.php
No syntax errors detected in index.php
```
에러가 감지되지 않으면 `No syntax errors detected` 메시지와 함께 종료 코드 `0`을 반환합니다.

#### 2) 오타나 기호 누락 등 문법 오류가 있는 경우
```console
$ php -l index.php
Parse error: syntax error, unexpected identifier "echo", expecting ";" or "," in index.php on line 5
Errors parsing index.php
```
문법 위반 사항이 감지되면 컴파일 에러 원인(`Parse error`) 및 잘못된 기호, 그리고 에러가 발생한 **정확한 코드 행수(Line Number)**를 가르쳐주며 비정상 종료 코드(주로 `255`)를 던집니다.

<br>

### 2. 중요: 린트(Lint)의 한계점 인지
---
`-l` 문법 검사는 파싱 단계에서 소스코드의 구문적 구조 규칙만 확인합니다. 따라서 다음과 같은 **실행 시점의 논리적 오류(Runtime Error)는 탐지할 수 없음**을 반드시 인지해야 합니다.

- 정의되지 않은 함수 호출 (`Call to undefined function`)
- 선언되지 않은 클래스 인스턴스화
- 0으로 나누기 연산 오류 (`Division by zero`)
- 데이터베이스 비밀번호 오입력 등 환경 연결 문제

이러한 로직 결함은 PHPUnit을 통한 단위 테스트나 정적 분석 도구(PHPStan, Psalm)를 추가 동원하여 보정해야 합니다.

<br>

### 3. 실무: 전역 다중 파일 일괄 린트 검사
---
리눅스/macOS 셸 환경에서 특정 디렉터리 하위의 모든 PHP 소스 코드를 스캔하여 오타가 난 파일들만 추출해 내는 파이프라인 응용식입니다.

```bash
# 하위 폴더 전체에서 .php 파일을 찾아 개별 문법 검사를 실행하되, 에러가 난 파일 목록만 추려냄
find . -name "*.php" -exec php -l {} \; | grep -v "No syntax errors"
```

<br>

### 4. Git Pre-Commit Hook 자동화 연동
---
개발자가 코드를 커밋(`git commit`)하기 직전에 오타를 감지해 아예 커밋 처리를 반려하도록 만들어 실수 배포를 원천 차단하는 로컬 환경설정 방식입니다.

프로젝트 폴더의 `.git/hooks/pre-commit` 실행 스크립트 파일 내부에 아래 쉘 코드를 삽입합니다.

```bash
#!/bin/sh
# 커밋 대기 상태(Staged)인 PHP 파일만 필터링하여 루프 스캔
for file in $(git diff --cached --name-only --diff-filter=ACMR | grep -E '\.php$')
do
    # 개별 린트 수행
    php -l "$file" > /dev/null 2>&1
    if [ $? -ne 0 ]; then
        echo "❌ [Lint Error] $file 파일에 문법 오류가 존재합니다. 커밋이 거부되었습니다."
        exit 1
    fi
done
exit 0
```
이 설정을 추가해 두면, 문법적으로 깨진 PHP 코드는 깃 커밋 자체가 막혀 협업 브랜치가 오염되는 상황을 완벽하게 방지해 줍니다.