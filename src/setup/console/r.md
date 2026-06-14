---
layout: php
title: PHP CLI 코드 직접 실행 옵션 (-r) 활용 가이드
description: "PHP CLI의 -r 옵션을 사용하여 별도 파일 생성이나 script 태그 기입 없이 터미널에서 직접 인라인 코드를 실행하고, 셸 파이프라인 연계 방안을 학습합니다."
keyword: "php -r, php 코드 직접 실행, php inline code run, php command line run, php 터미널 실행, php shell pipe"
breadcrumb:
- setup
- console
- option
- r
---

# PHP 명령행 직접 실행 옵션 (`-r`)
---
PHP **`-r`** 옵션은 **'Run Code'**의 앞글자에서 유래한 옵션으로, 디스크에 테스트용 임시 `.php` 소스파일을 저장할 필요 없이 **터미널 입력줄에 인라인(Inline)으로 작성한 PHP 코드를 그 자리에서 즉시 컴파일하여 실행**하도록 지시합니다.

또한, 이 모드에서는 PHP 코드의 식별 부호인 **`<?php ... ?>` 태그를 적지 않고** 순수 내부 프로그래밍 언어식으로만 코드를 채워 실행해야 정상 동작합니다.

<br>

### 1. 기본 사용 규칙 및 쿼테이션(Quoting) 규칙
---
```console
php -r "[실행할_인라인_코드]"
```

#### 1) 단순 출력 테스트
```console
$ php -r "echo 'Hello Command Line!';"
Hello Command Line!
```
- **중요 주의사항**: 터미널 셸(Shell)은 큰따옴표(`"`)와 작은따옴표(`'`)를 특수 기호로 치환하는 자체 파싱 규칙이 있습니다. 충돌을 피하기 위해 **가장 바깥쪽을 큰따옴표(`"`)로 두르고, PHP 코드 내부의 문자열 인자는 작은따옴표(`'`)로 감싸는 것**이 윈도우/리눅스 공통 표준입니다.

#### 2) 여러 문장 이어서 실행 (Chain)
세미콜론(`;`)을 사용해 여러 라인의 명령문을 일렬로 이어서 설계하여 복잡한 로직을 수행할 수 있습니다.
```console
$ php -r "$a = 10; $b = 20; echo '합계: ' . ($a + $b);"
합계: 30
```

<br>

### 3. 실무 응용: 터미널 계산기 및 파이프라인 통신
---

#### 1) 경량 계산기로 사용
복잡한 수학 계산이나 문자열 포맷팅 함수를 즉각 실행해 볼 수 있습니다.
```console
$ php -r "echo MD5('secret-password');"
5f4dcc3b5aa765d61d8327deb882cf99

$ php -r "echo sqrt(144) + pow(2, 5);"
44
```

#### 2) 리눅스 셸 파이프라인(`|`) 및 표준 입력(`STDIN`) 연동
이 기능이 가장 빛을 발하는 순간은 다른 셸 명령어로 획득한 출력 문자열 데이터를 파이프(`|`)로 전달받아 PHP 함수로 정교하게 필터 가공하여 가공 출력을 다시 반환하는 필터링 유틸리티 작성 시점입니다.

```console
# 에코 문자열을 파이프라인으로 받아 소문자로 변환하여 반환
$ echo "PHP AGENTS" | php -r "echo strtolower(file_get_contents('php://stdin'));"
php agents
```
- **`php://stdin`**: 리눅스 표준 입력을 가리키는 스트림으로, 파이프 뒤에 `file_get_contents('php://stdin')` 지시어를 써주면 앞서 실행된 프로세스의 연산 텍스트를 실시간 수신하여 PHP 변수에 담고 내장 라이브러리로 제어할 수 있어 유틸리티 스크립트 작성 효율이 월등히 향상됩니다.