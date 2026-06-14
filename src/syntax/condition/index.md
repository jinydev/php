---
layout: php
title: "PHP 조건 제어문 (if, switch, match) 구조 가이드"
description: "프로그램의 논리적 실행 경로를 제어하기 위한 조건제어문(if-else, switch)과 PHP 8.0의 최신 match 표현식의 동작 차이, 타입 비교(느슨한/엄격한) 규칙 및 선택 기준을 배웁니다."
keyword: "php 조건문, php 제어문, if else 문, switch 문, php match, 엄격한 비교, 3항 연산자"
breadcrumb:
- syntax
- condition
---

# PHP 조건 제어문 구조 가이드
---
프로그램 소스코드는 기본적으로 위에서 아래 방향으로 한 줄씩 순차적으로 실행(Sequence)됩니다. 하지만 현실의 로직은 특정 조건의 만족 여부에 따라 실행 코드가 달라지거나 일부 구문을 건너뛰어야 하는 상황이 빈번하게 발생합니다.

이처럼 조건의 판정 결과(참/거짓)에 따라 프로그램의 연산 실행 흐름을 분기(Branching)하는 기능을 **조건 제어문** 또는 **조건문**이라고 부릅니다. 

<br>

### 1. 조건 제어 메커니즘 3대 문법 비교
---
아래 다이어그램은 조건 판정을 처리하는 `if-else`문, 다중 상수 매핑을 하는 `switch`문, 그리고 PHP 8.0 이상 버전에서 제공하는 엄격한 단일 매칭 표현식인 `match`의 기능 차이를 도식화한 비교 구조입니다.

![PHP 조건문 비교](/syntax/img/control_flow_comparison.svg)

<br>

### 2. 참(True)과 거짓(False)의 판정 기준
---
조건문은 조건식의 평가 결과가 **참(Truthy)**인지 **거짓(Falsy)**인지에 따라 동작을 처리합니다. PHP는 공식 명세([PHP Manual - Booleans](https://www.php.net/manual/en/language.types.boolean.php))에 따라 아래의 특수 값들을 모두 **거짓(False)**으로 취급하므로 코딩 시 주의해야 합니다.
- 불리언 타입 값: `false`
- 정수 숫자: `0` 및 `-0`
- 실수 숫자: `0.0` 및 `-0.0`
- 빈 문자열: `""` 및 `"0"` (주의: 문자열 형태의 0도 거짓으로 처리됨)
- 빈 배열: `[]` (원소가 없는 상태)
- 특수 타입: `null`

그 외의 모든 값(원소가 채워진 배열, 일반 양수/음수, 글자가 입력된 문자열 등)은 조건식 내에서 전부 **참(True)**으로 자동 형변환되어 해석됩니다.

<br>

### 3. 대표적인 조건문 종류 및 선택 기준
---

#### 1) [if - elseif - else 문](if)
- **주요 용도**: 범위 연산(예: `$score >= 90`), 복잡한 논리 연산자 결합(&&, ||) 등 임의의 불리언 값 판정에 유용합니다.
- **동작 특징**:
  ```php
  if ($score >= 90) {
      echo "A 학점";
  } elseif ($score >= 80) {
      echo "B 학점";
  } else {
      echo "C 학점";
  }
  ```

#### 2) [switch 문](switch)
- **주요 용도**: 하나의 변수에 대응하는 여러 개의 고정 상수 분기 처리에 유리합니다.
- **주의점**: switch문은 내부적으로 **느슨한 비교(`==`)**를 통해 매칭을 탐색합니다. 따라서 정수 `0`과 문자열 `"0"` 혹은 빈 문자열 `""`을 구분하지 못할 위험이 있습니다.
- 또한 `case` 블록 마다 **`break;`** 지시어를 기술하지 않으면 하위의 case 구문들이 강제로 함께 실행(Fallthrough)되는 특징이 있습니다.
  ```php
  switch ($role) {
      case 'admin':
          grantAdminAccess();
          break; // break 누락 시 아래 manager 권한도 실행됨
      case 'manager':
          grantManagerAccess();
          break;
      default:
          grantUserAccess();
  }
  ```

#### 3) [match 표현식 (PHP 8.0+)](match)
- **주요 용도**: 단일 매칭 대상의 엄격한 비교와 즉각적인 결과값 변수 할당 처리에 유수합니다.
- **동작 특징**:
  - 내부적으로 **엄격한 비교(`===`)**를 수행하여 데이터 형식(Type)까지 일치해야만 매칭을 실행하므로 안전합니다.
  - 별도의 `break` 지시문이 필요 없으며, 매칭 결과를 식(Expression)으로 취급하여 바로 변수에 담을 수 있어 코드가 극적으로 간결해집니다.
  ```php
  $result = match ($status_code) {
      200, 201 => 'Success',
      400 => 'Bad Request',
      404 => 'Not Found',
      default => 'Unknown Error',
  };
  ```

<br>

---
다음 장에서는 제어 조건문 판정의 근간이 되는 논리값(Boolean) 참과 거짓의 구체적인 타입 캐스팅 원리와 공식 사용법을 배웁니다.

- **다음 학습**: [참(True)과 거짓(False) 타입 캐스팅의 이해](bool)