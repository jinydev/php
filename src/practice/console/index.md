---
layout: php
title: "콘솔(CLI) 프로그래밍"
keyword: "php CLI, console programming, $argv, $argc, php://stdin, input stream"
description: "PHP를 활용한 CLI 콘솔 프로그래밍 방법, 실행 매개변수($argv, $argc) 처리 및 파일 스트림 기반 사용자 인터랙티브 입력 처리 기법을 학습합니다."
breadcrumb:
- practice
- console
---

# 1. 콘솔(CLI) 프로그래밍
---
PHP는 주로 웹 브라우저 요청을 받아 HTML을 렌더링하는 데 사용되지만, 터미널 환경에서 백그라운드로 작동하는 배치(Batch) 스크립트나 명령줄 도구를 만드는 데도 널리 쓰입니다. 이를 **CLI(Command Line Interface) 프로그래밍**이라고 합니다.

이 문서에서는 PHP를 터미널 창에서 단독 구동할 때 필요한 명령줄 매개변수 파싱 원리와 사용자 인터랙티브 입력 스트림을 다루는 방법을 학습합니다.

<br>

## 1.1 CLI 실행 및 매개변수 ($argv, $argc)
터미널에서 PHP 스크립트를 실행할 때, 명령 뒤에 임의의 텍스트(옵션, 파라미터)를 실어 보낼 수 있습니다. PHP는 이 정보들을 전역 변수인 `$argv` 배열과 `$argc` 변수에 자동 보관합니다.

* **`$argv` (Argument Vector)**: 입력한 실행 인자(Argument)들을 담은 배열입니다. 첫 번째 인자 `$argv[0]`은 항상 실행한 PHP 스크립트 파일의 물리 경로가 담깁니다.
* **`$argc` (Argument Count)**: 스크립트명을 포함하여 전달된 인자들의 총 개수(정수형)입니다.

### 예제: argv_test.php
```php
<?php
// 터미널 실행법: $ php argv_test.php gildong 25
declare(strict_types=1);

echo "전달된 총 인자 개수: " . $argc . "\n";

// 전체 인자 배열 순회 출력
foreach ($argv as $index => $arg) {
    echo "[$index] : $arg\n";
}

// 특정 인자 추출 활용
if ($argc < 3) {
    echo "사용법: php argv_test.php [이름] [나이]\n";
    exit(1); // 오류 상태코드로 프로그램 강제 종료
}

$name = $argv[1];
$age  = (int)$argv[2];

echo "안녕하세요, {$name} 님! 당신은 내년에 " . ($age + 1) . "살이 됩니다.\n";
?>
```

---

## 1.2 사용자 입력 파일 스트림 (php://stdin)
터미널 실행 도중 사용자로부터 즉석에서 데이터 입력을 받아 대화형(Interactive)으로 응답을 처리하고 싶다면, PHP의 입력 가상 파일 스트림인 **`php://stdin`**을 활용해야 합니다.

`fopen()` 함수를 사용해 이 스트림을 읽기 전용 파일처럼 오픈한 뒤, `fgets()` 또는 `fread()`를 사용해 클라이언트의 키보드 타자 데이터를 입력받습니다.

### 예제: interactive_input.php
```php
<?php
declare(strict_types=1);

// 1. 표준 입력(STDIN) 스트림 열기
$stdin = fopen('php://stdin', 'r');

echo "==============================\n";
echo "    PHP 회원가입 대화 창\n";
echo "==============================\n";

echo "사용할 회원 ID를 입력하고 엔터를 치세요: ";
// fgets()는 엔터 키(\n)를 칠 때까지 한 줄을 통째로 입력받습니다.
$userId = fgets($stdin);

// 입력값 끝의 줄바꿈 문자(\n 또는 \r\n)를 깔끔하게 잘라냅니다.
$userId = trim($userId);

echo "가입할 이메일을 입력하세요: ";
$email = trim(fgets($stdin));

echo "\n--- [가입 정보 확인] ---\n";
echo "아이디: {$userId}\n";
echo "이메일: {$email}\n";

// 2. 사용이 끝난 파일 스트림을 닫아 메모리 해제
fclose($stdin);
echo "감사합니다. 가입 정보가 무사히 접수되었습니다.\n";
?>
```

---

## 1.3 fscanf()를 활용한 포맷팅 입력
만약 사용자가 입력한 값에서 특정한 패턴의 자료 구조(예: 나이를 입력할 때 정수형만 걸러내어 읽기)를 정밀하게 파싱하고 싶다면, C언어의 scanf와 유사하게 작동하는 **`fscanf()`** 함수를 유용하게 쓸 수 있습니다.

```php
<?php
declare(strict_types=1);

$stdin = fopen('php://stdin', 'r');

echo "태어난 년도를 4자리 정수로 입력해주세요: ";
// fscanf는 입력값을 지정된 형식 문자(예: %d 정수형, %s 문자열)로 걸러 변수에 매핑합니다.
fscanf($stdin, "%d\n", $birthYear); 

$currentYear = (int)date('Y');
$age = $currentYear - $birthYear + 1;

fclose($stdin);

echo "당신의 한국 나이는 {$age}세 입니다.\n";
?>
```
