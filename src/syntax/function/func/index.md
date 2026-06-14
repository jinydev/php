---
layout: php
title: "함수의 개념과 구조"
keyword: "php, function, 함수"
description: "PHP 함수의 기본적인 개념과 입력, 처리, 출력으로 구성되는 블랙박스 아키텍처 구조를 이해하고 사용법을 학습합니다."
breadcrumb:
- syntax
- "function"
- "func"
---

# 함수의 개념과 구조
---
프로그램이 고도화되고 비즈니스 로직이 복잡해질수록 코드의 크기가 거대해지고 중복 코드가 수없이 증가하게 됩니다. 이를 해결하기 위해 서로 연관된 소스 코드들을 하나의 독립된 단위로 그룹화하여 재사용할 수 있도록 설계하는 기법이 바로 **함수(Function)**입니다.

<br>

## 1. 함수란 무엇인가?
---
함수는 특정 작업을 수행하도록 설계된 독립적인 코드 블록입니다. 실생활의 **자판기(Vending Machine)**나 **블랙박스(Black Box)**에 빗대어 이해하면 매우 쉽습니다.

<div style="text-align: center; margin: 30px 0;">
  <img src="img/function_vending_machine.png" alt="Function Vending Machine Illustration" style="max-width: 60%; height: auto; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);" />
  <p style="font-size: 13px; color: #64748b; margin-top: 8px;">그림: 자판기로 배우는 입력(Input) ➔ 처리(Process) ➔ 출력(Output) 개념</p>
</div>

- 동전(입력 데이터)을 넣으면
- 자판기 내부에서 가공 및 선택 처리(로직 처리)를 하여
- 음료수(결과 반환값)를 내보냅니다.

이러한 함수 기법을 사용하면 코드의 **재사용성**이 비약적으로 향상되며, 동일한 수정 사항이 발생했을 때 함수 내부의 로직만 고치면 되기 때문에 **유지보수성**과 **가독성**이 극대화됩니다.

<br>

## 2. 함수의 핵심 아키텍처
---
함수는 기본적으로 입력, 처리, 출력의 3단계로 이루어지며, 외부의 스크립트 실행 스코프와 완전히 격리된 고유의 **지역 스코프(Local Scope)**를 가지고 동작합니다.

<div style="text-align: center; margin: 30px 0;">
  <img src="img/function_concept.svg" alt="Key Components of a Function Diagram" style="max-width: 100%; height: auto; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);" />
  <p style="font-size: 13px; color: #64748b; margin-top: 8px;">그림: 함수의 입력(인자), 처리(블랙박스 로직), 출력(반환값) 구조</p>
</div>

1. **입력 인자 (Input / Parameter)**: 함수가 정상 작동하기 위해 외부로부터 수혈받는 변수 또는 데이터 값입니다.
2. **함수 몸체 (Process / Body)**: 중괄호 `{}` 안에 기술되는 실행 구문들로, 함수 고유의 격리된 스택 영역 내에서 계산을 처리합니다.
3. **결과 반환 (Output / Return)**: 처리가 완료된 결과값을 호출처로 다시 전달해 주며, 이때 함수 실행은 완전 종료됩니다.

<br>

## 3. 함수의 정의(Declare)와 호출(Call)
---
함수를 사용하기 위해서는 먼저 `function` 키워드를 사용해 함수를 정의해 두어야 하며, 정의된 함수는 프로그램이 호출하기 전에는 동작하지 않습니다.

### 1) 함수 정의 (Definition)
{% raw %}
```php
function addNumbers(int $a, int $b): int {
    $sum = $a + $b;
    return $sum; 
}
```
{% endraw %}

### 2) 함수 호출 (Call)
정의된 함수명 뒤에 소괄호 `()`와 필요한 실행 인자들을 넣어 호출하며, 반환된 데이터를 다른 변수에 저장해 사용합니다.
{% raw %}
```php
$result = addNumbers(10, 20);
echo "결과: " . $result; // 출력: 결과: 30
```
{% endraw %}

<br>

## 4. 내장 함수와 사용자 정의 함수
---
- **내장 함수 (Built-in Functions)**: PHP 엔진이 기본적으로 메모리에 탑재하여 제공하는 표준 API 함수들입니다. (예: `strlen()`, `array_sum()`, `intval()` 등)
- **사용자 정의 함수 (User-defined Functions)**: 표준 내장 기능 외에 개발자가 비즈니스 요구에 맞게 정의하여 등록하는 맞춤형 함수입니다. 

> [!WARNING]
> PHP에서는 동일한 이름의 함수를 중복해서 정의할 수 없습니다. 이미 존재하는 내장 함수명이나 이미 선언된 다른 함수명과 충돌하게 되면 즉각 치명적인 실행 오류가 발생하므로 함수명을 지을 때 주의해야 합니다.

<br><br>