---
layout: php
title: Apache 웹 서버와 PHP 연동 및 환경 구성 가이드
description: "Apache HTTP Server와 PHP의 두 가지 연동 방식(mod_php 모듈 vs PHP-FPM FastCGI) 설정법, 다중 도메인을 위한 VirtualHost, 그리고 .htaccess URL 리라이트(Rewrite) 규칙을 상세 해설합니다."
keyword: "아파치 php 연동, apache php-fpm, mod_php 설정, VirtualHost php, htaccess rewrite, apache php.ini"
breadcrumb:
- setup
- server
- apache
---

# Apache 웹 서버와 PHP 연동 및 환경 구성
---
**Apache HTTP Server**는 웹 초창기부터 PHP와 호환되며 수많은 인터넷 생태계를 일구어낸 유서 깊고 신뢰성 높은 오픈소스 웹 서버 소프트웨어입니다. 

Apache는 매우 다양한 연동 모듈 and 디렉터리 수준의 분산 설정 파일인 `.htaccess`를 지원하여 유연한 서버 환경 구성이 가능합니다. 이 가이드에서는 Apache와 PHP 엔진을 연동하는 핵심 아키텍처와 상세 설정 요령을 학습합니다.

<br>

### 1. Apache + PHP 연동의 두 가지 방식
---

#### 1) mod_php (프로세스 내장형 모듈 방식 - 고전적)
Apache 프로세스(`httpd`) 자체에 PHP 해석기 엔진(`mod_php.so` 또는 `php7_module`)을 플러그인 형태로 직접 탑재하여 구동하는 전통적인 연동 모델입니다.
- **설정 예시 (`httpd.conf`)**:
  ```apache
  # 아파치 설정 내에 PHP 해석 모듈 직접 로드
  LoadModule php_module modules/libphp.so
  
  # .php 확장자를 가진 요청이 오면 PHP 모듈로 넘겨 처리하도록 바인딩
  AddType application/x-httpd-php .php
  ```
- **특징**: 별도 게이트웨이 데몬 프로세스를 띄울 필요가 없어 구성을 단순화할 수 있는 장점이 있습니다. 그러나 Apache의 다중 프로세스 모듈(MPM) 중 구식인 **Prefork** MPM에서만 안정적으로 작동하므로, 동시 접속자 처리 성능이 다소 떨어지고 정적 콘텐츠 조회 시에도 불필요한 PHP 메모리를 중복 낭비하는 치명적 단점이 있습니다.

#### 2) mod_proxy_fcgi + PHP-FPM (격리형 FastCGI 방식 - 모던 권장사양)
Apache 웹 서버 프로세스와 PHP 구동 엔진을 완전히 별도 독립된 데몬 프로세스로 쪼개어 가동시키고, 중간 통로를 **FastCGI 프록시** 인터페이스로 중계 연결하는 현대 표준 방식입니다. 아파치의 고성능 멀티스레드 비동기 처리 모듈인 **Event MPM**의 진가를 100% 이끌어 낼 수 있습니다.
- **설정 예시 (`httpd.conf` 또는 VirtualHost)**:
  ```apache
  # proxy 및 proxy_fcgi 모듈 로드 확인 필수 (a2enmod proxy_fcgi)
  <FilesMatch \.php$>
      # Unix Socket 파이프라인으로 PHP-FPM 프로세스 풀과 연결
      SetHandler "proxy:unix:/var/run/php/php8.3-fpm.sock|fcgi://localhost"
  </FilesMatch>
  ```

<br>

### 2. 가상 호스트 (VirtualHost) 다중 도메인 구성
---
단일 리눅스/윈도우 서버 내에서 여러 개의 다른 도메인(예: `siteA.com`, `siteB.net`)을 호스팅하고, 각 사이트마다 다른 디렉터리와 고유의 PHP-FPM 소켓 설정을 매칭하여 완벽히 독립된 가상 호스트 환경을 생성할 수 있습니다.

```apache
# 1. 사이트 A 구성 (80 포트)
<VirtualHost *:80>
    ServerAdmin webmaster@siteA.com
    ServerName siteA.com
    ServerAlias www.siteA.com
    DocumentRoot /var/www/siteA/public

    # 사이트 A 전용 PHP-FPM 소켓 연동
    <FilesMatch \.php$>
        SetHandler "proxy:unix:/var/run/php/php8.3-fpm-siteA.sock|fcgi://localhost"
    </FilesMatch>

    <Directory /var/www/siteA/public>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/siteA_error.log
    CustomLog ${APACHE_LOG_DIR}/siteA_access.log combined
</VirtualHost>
```

<br>

### 3. URL 리라이트(Rewrite) 엔진 및 `.htaccess` 활용
---
아파치의 가장 편리한 유틸리티 기능 중 하나는 각 프로젝트의 하위 루트 디렉터리에 **`.htaccess`** 설정 파일을 심어두면, 메인 서버 설정을 건드리지 않고도 동적 페이지 경로를 아름답게 꾸미는 **Clean URL (Pretty URL)** 라우팅 처리가 가능하다는 점입니다.

이를 사용하기 위해서는 우선 메인 아파치 설정에서 **`AllowOverride All`** 정책이 개방되어 있어야 하고, `mod_rewrite` 모듈이 활성화되어 있어야 합니다.

#### 예시: 프레임워크 표준 `.htaccess` 라우터 규격 (Laravel/Symfomy 등)
```apache
# 1. Rewrite 엔진 활성화
RewriteEngine On

# 2. 클라이언트 요청의 대상이 실제 존재하는 파일이나 디렉터리가 아닐 때만 룰 적용
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f

# 3. 모든 URL 요청 경로를 index.php의 질의 매개변수로 포장하여 한 군데로 집중 전달 (Front Controller Pattern)
RewriteRule ^ index.php [L]
```

#### 예시: 민감한 설정 파일 외부 유출 차단 보안 블록
`.env`, `.git` 폴더 등 외부로 유출되어서는 안 되는 파일 시스템 접근 요청을 원천 봉쇄(Forbidden)하는 차단 룰도 `.htaccess`를 통해 정밀 통제할 수 있습니다.
```apache
# .env 파일로 직접 들어오는 웹상의 접근을 차단
<Files .env>
    Order allow,deny
    Deny from all
</Files>
```
