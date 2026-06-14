---
layout: php
title: Docker 기반 컨테이너 배포 및 롤링 업데이트 가이드
description: "로컬 개발 환경에서 빌드된 도커 이미지를 중앙 레지스트리를 통해 안전하게 배포하고, 무중단으로 신규 버전을 컨테이너망에 적용하는 실무적인 도커 배포 방식을 배웁니다."
keyword: "도커 배포, docker deploy, docker registry 배포, php 도커 배포, 무중단 롤링 업데이트, dockerfile 멀티스테이지"
breadcrumb:
- setup
- deploy
- docker
---

# Docker 기반 컨테이너 배포 및 무중단 업데이트
---
소프트웨어를 단순히 파일 파일셋이나 소스 코드로 전송해 배포할 경우, 로컬 환경에서 잘 돌아가던 코드가 서버 환경의 특정 OS 라이브러리 미설치나 설정 불일치로 인하여 가동이 되지 않는 **"내 컴퓨터에서는 잘 되었는데(It works on my machine)"** 문제가 매우 흔히 발생합니다.

**Docker(도커) 기반 배포**는 PHP 소스코드뿐 아니라 작동 OS, 컴파일러, 웹서버 설정, 익스텐션 패키지까지 통째로 규격화된 단일 파일 포맷인 **도커 이미지(Docker Image)**로 패키징하여 배포하므로, 모든 개발 및 상용 서버에서 100% 동일한 실행 무결성을 확보할 수 있습니다.

<br>

### 1. 도커 컨테이너 빌드 및 운영 배포 흐름
---
아래 다이어그램은 로컬 개발 환경에서 팩킹된 도커 이미지가 가상 이미지 저장소(Registry)로 업로드된 뒤, 실서버 호스트가 이를 풀(Pull)하여 신규 컨테이너로 무중단 스위칭(Rolling Update)하는 절차를 나타냅니다.

![도커 컨테이너 배포 아키텍처](./img/docker_deploy_flow.svg)

<br>

### 2. 가볍고 안전한 경량 이미지 제작: Multi-Stage Build
---
상용 운영 환경(Production)의 도커 이미지에 불필요한 의존성 패키지나 소스코드 패키징용 도구(Composer 등)가 그대로 보존되면 이미지 용량이 커질 뿐 아니라 보안 취약점 경로가 늘어납니다. 

이를 방어하기 위해 **멀티 스테이지 빌드(Multi-Stage Build)** 기법을 사용하여 최소한의 런타임 결과물만 실서버로 보냅니다.

#### 🔗 배포용 멀티스테이지 Dockerfile 예시
```dockerfile
# ==========================================
# 1단계: 빌드 스테이지 (의존성 패키징 및 압축)
# ==========================================
FROM composer:2.6 AS builder
WORKDIR /app
COPY composer.json composer.lock ./
# 프로덕션 의존성만 설치 및 오토로더 압축 최적화
RUN composer install --no-dev --ignore-platform-reqs --no-interaction --no-scripts --prefer-dist

# ==========================================
# 2단계: 런타임 스테이지 (실제 배포용 경량 이미지)
# ==========================================
FROM php:8.3-fpm-alpine
WORKDIR /var/www/html

# FPM 실행에 필수적인 보안 라이브러리 및 PHP core 익스텐션 설치
RUN docker-php-ext-install pdo_mysql

# 1단계 빌더에서 다운받아 생성된 최적화 vendor 폴더만 골라 복사
COPY --from=builder /app/vendor ./vendor
# 실물 소스파일 이전
COPY ./src .

# 배포 보안 수칙: 웹서버의 실행 권한(www-data) 격리 부여
RUN chown -R www-data:www-data /var/www/html

EXPOSE 9000
CMD ["php-fpm"]
```

<br>

### 3. 이미지 저장소(Registry)를 거치는 정석 배포 공정
---
실서버로 직접 파일을 전송하는 대신, 빌드된 이미지를 검증하고 중앙 보관하는 이미지 레지스트리(Docker Hub, AWS ECR 등)에 수납하여 배포 라이프사이클을 매니징합니다.

```bash
# 1. 로컬에서 배포용 태그를 식별하여 빌드
docker build -t username/myapp:v1.0.0 .

# 2. 이미지 중앙 저장소로 Push
docker push username/myapp:v1.0.0

# 3. 운영 서버에 SSH 원격 접속 후, 이미지를 Pull하여 다운로드
ssh -i key.pem ubuntu@server_ip "docker pull username/myapp:v1.0.0"
```

<br>

### 4. 무중단 롤링 업데이트 (Rolling Update) 배포 기법
---
이미지 다운로드가 완료되면 실서버에서 가동 중인 컨테이너 인프라 세트를 무중단으로 교체 구동합니다.

#### 1) Docker Compose 기반 컨테이너 포트 스위칭
가장 간단한 구성은 이전 컨테이너를 가동 중인 상태에서 신규 이미지 컨테이너를 다른 포트로 올린 뒤 웹서버 프록시 타겟만 스위칭해 다운타임을 0초로 만듭니다.
```bash
# 새 이미지로 신규 컨테이너 가동 (임시 포트로 실행)
docker run -d --name myapp-v2 -p 8082:9000 username/myapp:v2.0.0

# Nginx 설정을 스위칭하여 포트 8082로 바라보게 reload한 뒤, 이전 컨테이너(myapp-v1) 소멸 처리
docker stop myapp-v1 && docker rm myapp-v1
```

#### 2) 컨테이너 오케스트레이션(AWS ECS / Kubernetes) 활용
클라우드 프로덕션 서비스망에서는 ECS나 쿠버네티스의 내장 배포 엔진을 이용합니다.
- **롤링 업데이트(Rolling Update)**: 점진적으로 신규 이미지 컨테이너 개수를 늘리고 기존 컨테이너를 순차적으로 줄여나가 배포 중에도 항상 정해진 가용 컨테이너 대수가 서비스를 지키도록 강제하여 무중단 배포를 달성합니다.
- **초고속 롤백**: 만약 v2.0.0에서 오류 검지가 되는 즉시 로드밸런서가 트래픽을 차단하고, 레지스트리에 보존되어 있던 `v1.0.0` 안정본 컨테이너로 원복 스위칭하여 배포 안정성을 극대화합니다.
