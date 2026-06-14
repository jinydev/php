---
layout: php
title: PHP CLI 대화형 실행 모드 (-a) 완벽 가이드
description: "PHP CLI의 대화식 셸(Interactive Shell)인 -a 옵션을 켜서 REPL 환경을 구성하고, 코드 테스트 및 세션 변수 메모리 유지 활용법을 학습합니다."
keyword: "php -a, php interactive shell, php repl, 대화형 쉘, php 대화식 실행, php 터미널 입력, readline"
breadcrumb:
- setup
- console
- option
- a
---

# PHP 대화식 실행 옵션 (`-a`)
---
PHP **`-a`** 옵션은 별도의 `.php` 소스코드 파일을 디스크에 생성하여 저장하고 실행하는 번거로움 없이, 터미널 환경에서 한 행씩 코드를 즉석 기입하고 결과를 즉각 반환받는 **대화형 셸(Interactive Shell)** 모드를 실행합니다.

프로그래밍 업계에서는 이러한 피드백 구동 환경을 **REPL(Read-Eval-Print Loop)**이라고 지칭하며, 간단한 내장 함수 작동 여부 테스트, 문자열 가공 수식 검증, 알고리즘 실험 등에 매우 요긴합니다.

<br>

### 1. 대화형 쉘 실행 방법 및 기초 문답
---
터미널 창에 `php -a`를 입력하면 아래와 같이 `Interactive shell` 모드로 진입하며 프롬프트 심볼이 `php >`로 변환됩니다.

```console
$ php -a
Interactive shell

php > echo "Hello REPL!";
Hello REPL!
php >
```

- **코드 입력 규칙**: 실행할 구문 끝에는 실제 소스코드와 마찬가지로 세미콜론(`;`)을 반드시 명시해 주어야 문장의 끝으로 인지하고 인터프리터가 작동을 개시합니다.
- **세션 웰컴 화면 이탈 (종료)**: 대화형 셸 환경에서 빠져나오려면 프롬프트에 **`exit`** 또는 **`quit`**을 입력하고 엔터를 누르거나, 키보드의 **`Ctrl + D`** 단축키를 입력합니다.

<br>

### 2. 세션 메모리 지속성 (Stateful Session)
---
대화식 셸의 가장 매력적인 점은 한 번 선언한 변수나 클래스, 함수가 셸 터미널 세션이 유지되는 동안 메모리에 계속 유지된다는 점입니다.

```console
$ php -a
Interactive shell

php > $name = "Antigravity";
php > $greeting = "Hello " . $name;
php > echo $greeting;
Hello Antigravity
php >
```
위 예제와 같이 `$name`에 저장한 값은 다음 줄에서도 그대로 소환하여 복합 수식으로 결합하거나 조건문으로 매칭해 연산할 수 있습니다.

<br>

### 3. 복수 행 제어 및 제어 구문 활용
---
단일 출력문뿐만 아니라, `if` 조건문이나 `foreach` 반복문, 사용자 정의 함수 설계 등의 멀티라인(Multi-line) 코드 블록도 문제없이 해석됩니다.

```console
php > function sum($a, $b) {
php { return $a + $b;
php { }
php > echo sum(10, 20);
30
php >
```
- 중괄호(`{`)를 열어 문장이 완전히 닫히지 않았음을 감지하면 프롬프트 마크가 `php {`로 바뀌며 내부 블록을 지속 적재합니다. 닫는 중괄호(`}`)가 접수되면 정상 종결 처리됩니다.

<br>

### 4. Readline 확장 모듈 필수 조건 안내
---
대화식 셸이 제 기능을 하여 키보드 윗 화살표(`↑`)로 직전 명령 내역(History)을 조회하고 탭(`Tab`) 키로 함수명을 자동 완성하려면, PHP 엔진 컴파일 시 GNU **Readline** (또는 libedit) 라이브러리가 기본 포함 활성화되어 있어야 합니다.

- **지원 여부 확인**: 터미널에 `php -m`을 입력하여 로드 모듈 목록 중 `readline`이 들어있는지 확인해 봅니다.
- macOS Homebrew 및 대부분의 우분투/Rocky Linux 공식 패키지는 기본 탑재 상태로 배포되지만, 초경량 도커 이미지(Alpine-slim 등)에서는 패키지가 누락되어 `-a` 옵션 실행 시 단순 텍스트 입력창 수준으로만 허용될 수 있으니 사양을 확인하는 것이 좋습니다.