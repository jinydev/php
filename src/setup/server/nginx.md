---
layout: php
title: Nginx 웹 서버와 PHP-FPM 연동 및 최적화 가이드
description: "Nginx 웹 서버와 PHP-FPM을 FastCGI 프로토콜(UNIX 소켓 및 TCP 포트)로 연동하는 상세 설정, try_files 리라이트 구성 및 cgi.fix_pathinfo 보안 최적화 방안을 다룹니다."
keyword: "nginx php 연동, nginx php-fpm, fastcgi_pass 설정, nginx virtualhost, nginx rewrite rule, nginx php 502 error, cgi.fix_pathinfo"
breadcrumb:
- setup
- server
- nginx
---

# Nginx 웹 서버와 PHP-FPM 연동 및 최적화
---
**Nginx(엔진엑스)**는 Apache와 달리 요청당 스레드를 생성하지 않고 싱글 스레드 이벤트 루프(Event-driven architecture) 구조로 수만 개의 동시 접속을 비동기 처리하여 메모리 점유율을 매우 낮게 유지하는 경량 고성능 웹 서버입니다.

Nginx는 Apache처럼 서버 프로세스 내에 PHP 엔진을 플러그인 모듈형으로 적재하는 기능(`mod_php` 같은 구문)을 원천적으로 지원하지 않습니다. 정적 콘텐츠는 스스로 초고속 처리하고, 동적 `.php` 연산은 무조건 **PHP-FPM** 데몬으로 **FastCGI 프로토콜**을 타고 토스하는 **프로세스 격리 결합(LEMP Stack)** 구조를 채택하고 있습니다.

이 가이드에서는 Nginx와 PHP-FPM의 정교한 연동 구성 및 실무 보안 최적화 요령을 배웁니다.

<br>

### 1. FastCGI 통신 모델 선택: UNIX Socket vs TCP Port
---
Nginx에서 백엔드 PHP-FPM으로 가공 데이터를 보낼 때, 두 서비스 간의 연동 경로는 크게 두 가지 통로 옵션이 있습니다.

```nginx
# 설정 옵션 예시 (Nginx 가상 호스트 내부)
fastcgi_pass [통로_경로];
```

#### 1) UNIX Domain Socket 방식 (파일 통신)
동일한 컴퓨터 하드웨어 내부에서 Nginx와 PHP-FPM이 함께 구동될 때 사용하는 경로입니다. 데이터가 TCP 네트워크 스택과 루프백 카드 오버헤드를 타지 않고 메모리 상의 파일 파이프라인(`.sock`)을 통해 직결되므로 처리 속도가 빠릅니다.
- **연동 지시문**: `fastcgi_pass unix:/run/php/php8.3-fpm.sock;`
- **추천 대상**: 단일 서버 내에 웹 서버와 WAS(PHP)가 원박스로 함께 배포된 구조.

#### 2) TCP Socket 방식 (네트워크 통신)
로컬 루프백 IP 포트 혹은 별도의 독립된 다른 컴퓨터 서버로 패킷 통신을 실행하는 경로입니다.
- **연동 지시문**: `fastcgi_pass 127.0.0.1:9000;`
- **추천 대상**: 트래픽 증가에 따라 Nginx가 위치한 프론트 웹 서버와 PHP 실행용 애플리케이션 서버를 각각 물리적으로 멀리 떨어진 별개의 장비로 격리/분산 설계하고자 할 때.

<br>

### 2. 고성능 Nginx Server Block 가상 호스트 모범 서안
---
Nginx 가상 호스트 설정 파일에 등록하여 사용하는 핵심 서비스 블록의 실무 권장 서안입니다.

```nginx
server {
    listen 80;
    server_name mydomain.com www.mydomain.com;
    
    # 1. 웹 루트 디렉터리 및 기본 인덱스 탐색 파일 설정
    root /var/www/myproject/public;
    index index.php index.html index.htm;
    
    charset utf-8;

    # 2. 정적 및 Clean URL 라우팅 처리 (Apache의 .htaccess 대체 지시문)
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # 3. 중요: .php 확장자 동적 해석기 연동 블록
    location ~ \.php$ {
        # 임의의 스크립트 실행 공격을 막기 위해 실물 파일 존재 여부 선행 검증 (보안)
        try_files $uri =404;
        
        # FastCGI 기본 환경 설정 매핑 템플릿 포함
        include fastcgi_params;
        
        # PHP-FPM 연동 소켓 지정
        fastcgi_pass unix:/run/php/php8.3-fpm.sock;
        
        # 실행할 PHP 스크립트 물리 경로 파라미터 전달
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        
        # 버퍼 크기 튜닝으로 502 Bad Gateway 및 대용량 응답 에러 완화
        fastcgi_buffer_size 128k;
        fastcgi_buffers 4 256k;
        fastcgi_busy_buffers_size 256k;
    }

    # 4. 민감한 시스템 설정 파일 외부 브라우저 직접 조회 차단
    location ~ /\.(ht|git|env) {
        deny all;
    }
}
```

<br>

### 3. 중요: Apache의 `.htaccess` 부재 대처법
---
Nginx는 각 폴더에 들어있는 `.htaccess` 파일을 읽는 기능이 없습니다. 분산 설정 탐색에 따른 디스크 I/O 오버헤드와 파일 탈취 보안 취약점을 완전히 해소하기 위해서입니다.

따라서 라우팅 재정의 룰은 반드시 위 모범 서안의 **`try_files $uri $uri/ /index.php?$query_string;`** 지시문처럼 **메인 Nginx 가상 서버 블록 내부**에 직접 전역 코드로 선언하여 처리해야 합니다.

<br>

### 4. cgi.fix_pathinfo 보안 취약점 대처 요령
---
과거 PHP 환경에서는 URL 경로에 임의의 이미지 주소(예: `/upload/avatar.jpg/test.php`)를 입력하면 PHP가 실제 존재하지 않는 뒷단의 `test.php`를 가상 인지하여 앞단의 `avatar.jpg` 이미지 파일 내부에 숨겨진 악성 PHP 웹셸 코드를 실행하는 치명적인 위협이 존재했습니다.

이를 원천적으로 예방하기 위해 아래의 **이중 방어막 보안 코딩**을 수립해야 합니다.

1. **`php.ini` 전역 설정 방어**:
   ```ini
   # 정확한 물리 경로의 파일만 실행하도록 강제
   cgi.fix_pathinfo = 0
   ```
2. **Nginx 설정 레벨 방어**: FastCGI 블록 바로 직전에 파일 실재 유무를 교차 판독하는 지시문을 걸어 차단시킵니다.
   ```nginx
   location ~ \.php$ {
       # 요청 파일이 디스크에 실제 없으면 즉시 HTTP 404 반환
       try_files $uri =404;
       ...
   }
   ```
이 방어 구문들을 추가함으로써, 외부 위협 인자가 인젝션 파일 수정을 우회하여 악용하는 시도를 리눅스 인프라 단에서 차단시킬 수 있게 됩니다.
