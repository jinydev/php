---
layout: php
title: "웹 프레임워크 및 라라벨 소개"
keyword: "php framework, web framework, laravel, symfony, mvc, inversion of control"
description: "PHP 웹 애플리케이션 프레임워크 단원의 학습 대문 페이지로, 프레임워크 핵심 개념, MVC 패턴, 종류 및 라라벨 프레임워크 상세 학습 로드맵을 제시합니다."
breadcrumb:
- packages
- "framework"
---

# 웹 프레임워크 (Web Framework)
---
현대의 웹 애플리케이션 개발 규모가 방대해짐에 따라 데이터베이스 연결 제어, URL 라우팅 매핑, 사용자 세션 처리, 입력값 보안 필터링 등 웹 시스템 구동을 위한 공통 인프라 기능을 매번 바닥부터 코딩하는 것은 극도로 비효율적입니다. 

**웹 프레임워크(Web Framework)**는 이러한 반복적이고 필수적인 공통 인프라 설계를 검증된 표준 구조(Skeleton)로 사전에 제공하여, 개발자가 오직 비즈니스 핵심 가치를 창출하는 비즈니스 로직(Business Logic) 구현에만 온전히 전념할 수 있도록 지원하는 소프트웨어 플랫폼입니다.

본 단원에서는 모던 웹 애플리케이션 아키텍처의 이론적 기반이 되는 제어의 역전(IoC) 개념부터 MVC 디자인 패턴, PHP 생태계 내 다양한 프레임워크 종류의 아키텍처 비교, 그리고 전 세계 백엔드 시장에서 사실상 표준(de facto standard)으로 활약하고 있는 **라라벨(Laravel)**을 단계별로 깊이 있게 학습합니다.

<br>

## 📂 웹 프레임워크 학습 목차
---

### 1. [프레임워크란 무엇인가?](about.html)
* 외부 라이브러리(Library)와 프레임워크(Framework)의 아키텍처적 경계를 뚜렷하게 나눕니다.
* 주도권이 역전되는 **제어의 역전(IoC, Inversion of Control)** 개념과 **"헐리우드 원칙 (Hollywood Principle)"**의 동작 매커니즘, 그리고 설정보다 규약을 중시하는 **CoC(Convention over Configuration)** 철학을 명확히 알아봅니다.

### 2. [MVC 디자인 패턴](mvc.html)
* 코드의 스파게티화를 방지하는 핵심 설계 원리인 **MVC(Model-View-Controller)** 패턴을 다룹니다.
* 데이터 연산을 은닉하는 **모델(Model)**, 프레젠테이션을 전담하는 **뷰(View)**, 중재자인 **컨트롤러(Controller)**의 명확한 역할 분담과 실제 HTTP Request 수신부터 Response 송신에 이르는 **8단계 생애주기(Lifecycle)** 모델을 규명합니다.

### 3. [PHP 프레임워크 종류 및 분류](types.html)
* PHP 생태계를 지탱해 온 프레임워크들을 탑재 범위에 따라 **풀스택 프레임워크**와 **마이크로 프레임워크**로 분류하여 특징을 해부합니다.
* 개발의 편의성을 고도로 올린 **Laravel**, 기업용 표준의 정수인 **Symfony**, 극한의 가벼움을 지닌 **CodeIgniter**, 고성능 포털용 **Yii**, 경량 API 특화 **Slim**의 실제 코드 예시와 라우팅 스타일을 상호 대조 비교합니다.

### 4. [라라벨 (Laravel) 상세 학습](laravel.html)
* 모던 백엔드 개발 생산성의 최정상에 위치한 라라벨의 핵심 아키텍처 기술을 상세하게 다룹니다.
* 데이터베이스 연동을 자동화하는 **Eloquent ORM(Active Record)**, 템플릿 상속을 아름답게 처리하는 **Blade 템플릿 엔진**, 명령줄 자동화 도구 **Artisan CLI** 및 데이터베이스 버전 관리를 위한 **Migration/Factory/Seeder**의 시너지 메커니즘, 프레임워크 구동의 핵심인 **Service Container & Service Provider** 아키텍처를 해설합니다.
