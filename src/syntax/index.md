---
layout: php
title: "PHP 기본문법"
keyword: "php, grammar, web"
description: "웹 애플리케이션 서버 개발을 위한 PHP 언어의 기본 문법 로드맵을 학습합니다."
breadcrumb:
- syntax
---

# PHP 기본문법
---
웹 애플리케이션 개발의 든든한 기초가 되는 **PHP 기본 문법** 단원입니다. 코드 작성 표준부터 연산, 흐름 제어, 그리고 유효 범위까지 PHP 프로그래밍의 기초 개념을 단계별로 확실하게 다집니다.

<br>

## 1. 코드 작성 및 표준 (Code Writing & Standards)
---
PHP 코드를 올바르게 삽입하기 위한 구문 스타일과 협업을 위한 글로벌 권장 코딩 규격인 PSR에 대해 알아봅니다.

| 상세 단원 | 설명 |
| :--- | :--- |
| 🏷️ **[PHP 태그](./tag)** | PHP 코드를 선언하기 위한 시작/종료 태그(`<?php`, `?>`)와 [HTML 혼합 사용하기](./tag/html), [독립 실행 태그](./tag/standard)의 사용법을 학습합니다. |
| 🏗️ **[코드 구조 및 실행](./code)** | PHP의 가장 기본적인 [인터프리터 작동](./code/interpreter), 코드 구분의 기준이 되는 [세미콜론](./code/semicolon), 코드에 설명글을 다는 [주석문](./code/comment), 화면에 값을 출력하는 [echo/print](./code/output), [콘솔 및 웹 실행 환경](./code/execute) 및 [버전 정보 확인](./code/phpinfo) 방법을 배웁니다. |
| 📐 **[코드 스타일 PSR](./psr)** | PHP 개발 그룹이 권장하는 코딩 표준 규약인 [PSR-1](./psr/psr1), [PSR-2](./psr/psr2), 그리고 오토로딩의 표준인 [PSR-4](/composer/psr4)의 명명 가이드라인을 이해합니다. |

<br>

## 2. 자료구조 및 연산 (Data Structure & Operations)
---
동적 메모리를 보관하기 위한 변수와 고정 설정 값을 유지하기 위한 상수의 선언 방식 및 기본적인 연산 메커니즘을 학습합니다.

| 상세 단원 | 설명 |
| :--- | :--- |
| 🔒 **[상수 (Constants)](./const)** | 프로그램 시작부터 끝까지 변경 불가능한 고정 데이터의 정의 방식인 [define 함수](./const/define), [const 키워드](./const/const)의 차이점 및 [타입 지정](./const/type), [상수 유효성 체크](./const/defined), [내장/마법 상수](./const/reserved)를 활용해 봅니다. |
| 📦 **[변수 (Variables)](./variable)** | 프로그램 실행 중 상태를 메모리에 임시로 기록하기 위한 변수의 [명명 규칙](./variable/name), [메모리 적재 원리](./variable/memory), [선언 및 데이터 형식](./variable/declare), [스칼라 기본 타입](./variable/scalar), 주소를 가리키는 [가변변수](./variable/ref), 메모리 해제를 위한 [unset](./variable/unset), 그리고 [자동 전역변수](./variable/global)의 역할을 탐구합니다. |
| 🧮 **[연산자 (Operators)](./operator)** | 데이터 연산을 위한 [산술 계산](./operator/arithmetic), 변수 대입 및 참조 대입([assignment](./operator/assignment)), 값의 크기와 동치성을 비교하는 [비교 연산](./operator/compare), 흐름 판별을 위한 [논리 연산](./operator/logic), [문자열 결합](./operator/stringop), [배열 연산](./operator/arrayop) 및 [삼항/널 병합 연산](./operator/coalescing)을 공부합니다. |

<br>

## 3. 흐름 제어 (Control Flow)
---
순차적으로 동작하는 절차지향적 코드를 조건과 반복 동작에 따라 제어 및 분기하는 방법을 다룹니다.

| 상세 단원 | 설명 |
| :--- | :--- |
| 🔀 **[조건 제어문](./condition)** | 특정 조건에 따라 코드를 실행하는 [if문](./condition/if), [else/elseif 분기](./condition/else), [switch 다중 분기](./condition/switch) 및 엄격한 비교와 표현식 반환이 내장된 최신 [match 표현식](./condition/match), 그리고 한 줄로 분기하는 [삼항 연산자](./condition/ternary)를 다룹니다. |
| 🔄 **[반복 제어문](./loop)** | 정해진 횟수를 순회하는 [for문](./loop/for), 조건이 맞을 때까지 반복하는 [while/do-while](./loop/while), 배열 요소를 안전하게 꺼내 쓰는 [foreach](./loop/foreach), 반복 루프를 탈출/건너뛰는 [break/continue](./loop/continue) 및 [다중 반복 제어](./loop/multi)를 이해합니다. |

<br>

## 4. 실행 문맥과 유효 범위 (Execution Context & Scope)
---
외부 파일의 코드를 불러오는 방법과 변수가 유지되고 참조될 수 있는 유효 영역인 스코프를 학습합니다.

| 상세 단원 | 설명 |
| :--- | :--- |
| 📂 **[전처리기 (Preprocessor)](./preprocess)** | 외부 스크립트 파일을 현재 코드에 병합하는 [include](./preprocess/include), 파일 누락 시 실행을 강제 차단하는 [require](./preprocess/require)의 특징과 안전한 [파일 절대/상대 경로](./preprocess/path) 지정 방법을 학습합니다. |
| 🌐 **[유효범위 (Scope)](./scope)** | 변수의 생명주기와 접근 권한을 제한하는 [전역 범위(Global)](./scope/global), [지역 범위(Local)](./scope/local), 값을 유지하는 [정적 범위(Static)](./scope/static), 실행 환경에 무관하게 항상 접근 가능한 [슈퍼 전역 변수](./scope/super), 그리고 [서버 환경 정보 조회](./scope/server)의 원리를 배웁니다. |
| 🚨 **[오류 처리 (Error Handling)](./error)** | 프로그램 실행 중 에러 수준을 설정하는 [error_reporting](./error#오류), 로그 기록을 남기는 [error_log](./error#오류출력), 디버깅을 위해 코드 실행 스택을 파악하는 [역추적(Backtrace)](./error#역추적), 사용자 정의 [오류 핸들러 설정](./error#오류-핸들) 방법을 배웁니다. |

<br><br>
