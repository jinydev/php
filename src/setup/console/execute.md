---
layout: php
title: PHP 콘솔 실행 및 입출력 제어 실습 가이드
description: "터미널 명령행에서 PHP 소스 파일을 직접 실행하고, 표준 입출력 리다이렉션 기법 및 리눅스 크론탭(crontab) 스케줄러 연동 방안을 상세히 학습합니다."
keyword: "php 콘솔 실행, php 실행 명령어, php hello.php, php 백그라운드 구동, crontab php, 입출력 리다이렉션"
breadcrumb:
- setup
- console
---

# PHP 콘솔(CLI) 실행 및 실습
---
PHP 스크립트 파일을 터미널에서 구동하는 기본 문법은 매우 단순하지만, 리눅스 표준 입출력 파이프와 연동하거나 크론탭(Crontab) 등의 스케줄러에 연동할 때 몇 가지 실무 규칙을 준수해야 정상적으로 자동 배치가 동작합니다.

이 문서에서는 기본 실행 절차부터 입출력 리다이렉션, 자동화 적용 방법까지 상세히 살펴봅니다.

<br>

### 1. 기본 실행 방법
---
작성한 PHP 코드는 터미널 창에서 `php` 명령어 뒤에 파일명을 적어서 즉시 컴파일 실행할 수 있습니다.

```console
php [실행할_스크립트_파일명]
```

#### 간단한 실습 진행하기
1. vscode나 좋아하는 에디터를 활용하여 작업 폴더에 `hello.php` 파일을 생성합니다.
2. 아래와 같이 텍스트 출력 코드를 삽입하고 저장합니다.
   ```php
   <?php
   echo "Hello World PHP CLI!" . PHP_EOL;
   ```
   > **`PHP_EOL`**: 운영체제별 줄바꿈 문자(Windows: `\r\n`, Linux/macOS: `\n`)를 자동으로 매칭해 주는 예약 상수입니다. CLI 콘솔 출력에서는 가시성을 위해 줄바꿈을 지정해 주는 것이 정석입니다.
3. 터미널에서 해당 폴더로 이동해 명령어를 수행합니다.
   ```console
   $ php hello.php
   Hello World PHP CLI!
   ```

<br>

### 2. 표준 입출력 제어 및 리다이렉션 (I/O Redirection)
---
CLI 실행은 터미널 화면에 에코를 뿌려주는 것 외에, 연산 결과를 파일로 저장하거나 오류만 별도로 분리해 저장하는 표준 입출력 스트림을 활용하기에 최적화되어 있습니다.

```bash
# 1. 실행 결과를 터미널 화면에 띄우지 않고 output.log 파일에 누적 저장 (표준 출력 덮어쓰기)
php hello.php > output.log

# 2. 기존 파일의 데이터 하단에 실행 결과 추가 누적 (Append)
php hello.php >> output.log

# 3. 표준 에러(stderr, descriptor 2)만 별도로 error.log 파일에 기록
php hello.php 2> error.log

# 4. 출력 결과와 에러 메시지를 모두 로그 파일 하나로 리다이렉트
php hello.php > cron.log 2>&1
```

<br>

### 3. 실무: 리눅스 크론탭(Crontab)을 통한 배치 자동화
---
특정 시간마다 결제 마감 처리, 뉴스 크롤링, 캐시 갱신 등 정기적인 스케줄 연산을 수행해야 할 경우, 리눅스의 시간 스케줄러인 **crontab**에 PHP CLI 명령을 등록합니다.

```bash
# 크론 설정 편집 모드 켜기
crontab -e
```

에디터 창이 열리면 다음과 같이 스케줄 조건과 실행 명령을 기입합니다.
```text
# 매 분마다(1분 주기로) cron.php를 자동 실행하고 모든 메시지를 로그에 누적 기록
* * * * * /usr/bin/php /var/www/html/cron.php >> /var/log/php_cron.log 2>&1
```

> [!IMPORTANT]
> **크론탭 등록 시의 2대 필수 수칙**
> 1. **PHP 실행 바이너리의 절대 경로 지정**: 크론 데몬 환경은 로그인 셸과 다른 제한된 PATH 환경 변수를 사용하므로 단축어인 `php`를 인식하지 못합니다. 반드시 `which php`로 확인한 절대 물리 경로(`/usr/bin/php` 또는 `/usr/local/bin/php` 등)를 지정해 주어야 합니다.
> 2. **스크립트 파일의 절대 경로 지정**: 상대 경로(`./cron.php`) 지정 시 크론이 실행되는 시점의 작업 위치가 달라 파일을 읽지 못하는 치명적인 에러가 발생합니다. 반드시 절대 경로(`/var/www/html/cron.php`)를 지정하십시오.
