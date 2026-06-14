---
layout: php
title: "패키지 관리 개요"
keyword: "php packages, composer, autoloading, framework, laravel"
description: "PHP 언어에서 라이브러리 및 외부 패키지를 연동하여 모듈러하게 애플리케이션을 개발하는 기법과 생태계를 학습합니다."
breadcrumb:
- "packages"
---

<jiny-book-mark>패키지 관리</jiny-book-mark>

# 패키지 관리 (Packages Management)
---
현대적인 PHP 애플리케이션 개발은 모든 기능을 바닥부터 직접 짜는 것이 아니라, 신뢰할 수 있고 전 세계 개발자들에 의해 검증된 오픈소스 외부 패키지들을 연결하여 필요한 비즈니스 로직을 신속하고 조각 조각 결합해 나가는 형태로 진화하였습니다.

본 단원에서는 PHP 라이브러리 및 패키지 관리의 표준인 **오토로딩(Autoloading)**의 원리와 도구인 **컴포저(Composer)**의 활용법, 그리고 이를 응용한 현대적인 **웹 프레임워크(Web Framework)**의 구조를 학습합니다.

<br>

## 상세 학습 주제
---

### 1. [오토로딩 (Autoloading)](./autoload)
과거에는 외부 코드를 끌어다 쓰기 위해 파일마다 일일이 `include` 또는 `require`를 선언해야만 했습니다. 오토로딩은 클래스가 호출되는 시점에 필요한 클래스 파일을 자동으로 해석해 메모리에 적재해 주는 원리이자 모던 PHP 프로그래밍의 가장 기본 축입니다.

### 2. [컴포저 (Composer)](./composer)
컴포저는 PHP의 의존성 관리 도구(Dependency Manager)로, 외부 패키지와 라이브러리를 지정된 버전 규격에 맞게 프로젝트 내부로 손쉽게 내려받고, 이들을 관리 및 배포할 수 있는 표준 규격의 도구입니다.

### 3. [웹 프레임워크 (Frameworks)](./framework)
패키지들이 결합하여 하나의 거대한 서비스 인프라 규칙을 형성한 것이 바로 프레임워크입니다. 전 세계 1위 프레임워크인 **라라벨(Laravel)**을 비롯한 PHP 프레임워크 생태계의 구성과 특성을 다룹니다.

### 4. [지니PHP (jinyPHP)](./jinyphp)
PHP의 유연한 패키지 및 뷰 헬퍼 기법을 기반으로 간결하게 구성된 flat-file 형태의 마이크로 빌더이자 자체 마이크로 웹 프레임워크의 동작을 분석합니다.
