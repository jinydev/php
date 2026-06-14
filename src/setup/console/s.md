---
layout: php
title: PHP CLI 서버 시작 (-S) 및 구문 강조 (-s) 옵션 완전 안내
description: "PHP CLI 환경에서 대소문자 구분에 따라 전혀 다르게 동작하는 로컬 내장 웹 서버 가동 옵션(-S)과 HTML 소스 구문 강조 옵션(-s)의 작동 원리 및 실무 예제를 상세히 배웁니다."
keyword: "php -S, php 내장 서버, php local web server, php -s, php 구문 강조, php syntax highlight, php local test, php 개발서버"
breadcrumb:
- setup
- console
- option
- s
---

# PHP 서버 시작 (`-S`) 및 구문 강조 (`-s`) 옵션
---
PHP CLI 엔진은 동일한 알파벳 문자라 하더라도 **대소문자 구분(Case-Sensitive)**에 따라 성격이 완전히 달라지는 두 개의 대표적인 유틸리티 옵션 **`-S`**와 **`-s`**를 가지고 있습니다.

- **대문자 `-S`**: 아파치나 Nginx 없이 로컬 컴퓨터에서 즉시 웹 애플리케이션을 구동해 주는 **내장 웹 서버(Built-in Web Server)**를 가동합니다.
- **소문자 `-s`**: 스크립트 파일을 분석하여 컬러 코딩이 매핑된 **HTML 문법 강조 소스코드**를 화면에 렌더링 출력합니다.

이 장에서는 두 유틸리티 옵션의 구체적인 활용 지침을 상세히 정리합니다.

<br>

### 1. [대문자] 로컬 개발용 내장 웹 서버 가동 (`-S`)
---
과거에는 가벼운 PHP 코드를 웹브라우저 상에서 한 번 출력해 보기 위해서도 복잡한 Apache 가상 호스트와 PHP-FPM 포트를 잡아야 했습니다. PHP 5.4.0 버전부터 이 허들을 극복하기 위해 경량 단독 가동 웹 서버 엔진을 탑재하여 배포하고 있습니다.

```console
# 1. 로컬호스트 8000번 포트로 내장 서버 실행
php -S localhost:8000
```
명령어를 치면 다음과 같이 대기 로그가 작동하며 즉시 8000 포트가 활성화됩니다.
```console
[Sun Jun 14 17:15:00 2026] PHP 8.3.x Development Server (http://localhost:8000) started
```
이제 크롬 등 브라우저 창을 열고 `http://localhost:8000/`을 기입하면 현재 명령어를 실행한 폴더 내의 `index.php` 파일을 수신해 동적 가동됩니다.

#### 1) 도큐먼트 루트(Document Root) 별도 지정 (`-t`)
실행 폴더가 아닌, 특정 하위 폴더(예: `public/` 등)를 웹서버의 기본 최상위 루트 디렉터리로 억지로 고정하여 구동해야 할 때 **`-t`** 옵션을 결합합니다.
```bash
php -S localhost:8000 -t public/
```

#### 2) 외부 접속 허용 바인딩 (`0.0.0.0`)
루프백 전용 주소(`localhost` 또는 `127.0.0.1`)로 켜면 내 컴퓨터를 제외한 외부 단말기(예: 모바일 테스팅 폰)나 가상 환경에서 접속할 수 없습니다. 전체 네트워크 카드를 오픈하여 바인딩 시 아래와 같이 입력합니다.
```bash
php -S 0.0.0.0:8000
```

#### 3) 라우터 스크립트(Router Script) 연동
모던 MVC 프레임워크처럼 모든 웹 접근을 하나의 파일(`index.php`)로 집중시켜 라우팅 처리를 하고 싶다면, 마지막 파라미터로 처리 파일을 명시합니다.
```bash
php -S localhost:8000 router.php
```
- **작동 규칙**: `router.php` 내에서 연산한 결과가 **`false`**를 리턴하면 내장 서버가 클라이언트가 요청한 본래 정적 파일(이미지, CSS 등)을 그대로 전송해 주고, 특정 비즈니스 코드가 리턴되면 해당 결과를 그대로 소화하여 출력합니다.

> [!CAUTION]
> **내장 서버의 성능 한계 (상용 도입 절대 불가)**
> PHP 내장 웹 서버는 가볍게 개발 상태를 테스트하기 위해 설계된 **단일 스레드(Single-threaded) 프로세스**입니다. 다중 동시 접속 요소를 소화하지 못하고 동시 요청이 오면 한 명이 끝날 때까지 대기 상태에 머물게 됩니다. 성능 가속화 장치가 전혀 없으므로 **실제 운영 서버(Production)에서는 절대로 구동하지 말고 Apache나 Nginx를 구성하여 결합**하십시오.

<br>

### 2. [소문자] HTML 구문 강조 소스 변환 (`-s`)
---
`-s` 옵션은 특정 PHP 파일의 예약어, 문자열, 함수, 주석 등을 구분하고, 각각 브라우저가 읽을 수 있는 색상 스타일이 내장된 HTML 태그 코드(`<span style="color: ...">`) 구조로 컴파일해 터미널에 덤프해 줍니다.

```console
php -s [분석할_파일명.php]
```

#### 변환 처리 과정 실습
아래와 같은 간단한 `test.php` 파일이 존재한다고 가정합니다.
```php
<?php
// 문자열 출력
echo "PHP Test";
?>
```

이 파일에 `-s` 옵션을 적용해 봅니다.
```console
$ php -s test.php
<code><span style="color: #000000">
<span style="color: #0000BB">&lt;?php<br /></span><span style="color: #FF8000">//&nbsp;문자열&nbsp;출력<br /></span><span style="color: #007700">echo&nbsp;</span><span style="color: #DD0000">"PHP&nbsp;Test"</span><span style="color: #007700">;<br /></span><span style="color: #0000BB">?&gt;</span>
</span>
</span>
</code>
```
이 텍스트 출력을 그대로 카피하여 `.html` 파일로 생성해 브라우저로 열면, 마치 코드 편집기 화면처럼 PHP 코드 블록이 구문 성격별로 깔끔하게 하이라이팅되어 출력되는 것을 볼 수 있습니다.

#### 구문 강조 컬러 설정 (php.ini)
강조되는 폰트의 스타일 색상은 `php.ini`의 `[Highlight]` 지시문 영역을 편집해 원하는 테마로 자유롭게 변경할 수 있습니다.
```ini
; php.ini 하이라이팅 기본 색상 정보
highlight.string  = #DD0000  ; 문자열 색상 (기본 적색)
highlight.comment = #FF8000  ; 주석 색상 (기본 주황색)
highlight.keyword = #007700  ; 예약어 키워드 색상 (기본 초록색)
highlight.default = #0000BB  ; 기본 일반 코드 변수 색상 (기본 청색)
highlight.html    = #000000  ; 외부 HTML 텍스트 영역 색상 (기본 흑색)
```
