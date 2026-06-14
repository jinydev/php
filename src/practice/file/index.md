---
layout: php
title: "파일 입출력 및 JSON 관리"
keyword: "file_get_contents, file_put_contents, json_encode, json_decode, file storage"
description: "PHP를 활용한 서버 디스크 파일 읽기 및 쓰기 기법과 데이터 영속화를 위한 JSON 파일 인코딩/디코딩 제어 기법을 학습합니다."
breadcrumb:
- practice
- file
---

# 2. 파일 입출력 및 JSON 관리
---
웹 서버는 데이터베이스 외에도 환경 설정값 저장, 에러 로그 기록, API 통신 이력 보관 등 다양한 이유로 **서버의 로컬 디스크 파일 시스템에 직접 접근하여 파일을 읽고 써야** 하는 요구사항을 맞이합니다.

이 문서에서는 PHP의 초간결 파일 헬퍼 함수들과 이를 실무적인 데이터 구조로 보관하기 위한 핵심 규격인 **JSON(JavaScript Object Notation)** 데이터 포맷의 매핑 관리 기법을 학습합니다.

<br>

## 2.1 기초 파일 입출력 (File I/O)
PHP는 저레벨 파일 핸들러(`fopen`, `fwrite`, `fclose`) 없이도, 단 한 줄의 코드로 파일을 읽고 쓸 수 있는 고도의 헬퍼 함수들을 내장하고 있습니다.

### 2.1.1 file_put_contents() (파일 쓰기)
* **기능**: 파일 경로에 지정된 텍스트 문자열 데이터를 저장합니다. 파일이 존재하지 않으면 신규 생성하고, 이미 존재하면 덮어씁니다(Overwrite).
* **이어 쓰기**: 기존 파일 내용 뒤에 덧붙여 쓰고 싶다면 `FILE_APPEND` 옵션 플래그를 추가합니다.

```php
<?php
declare(strict_types=1);

$filePath = "log.txt";
$logData = "[" . date('Y-m-d H:i:s') . "] 사용자가 로그인 시도를 완료했습니다.\n";

// 파일 쓰기 수행 (성공 시 쓴 바이트 수를 반환하며, 폴더가 없으면 에러가 납니다)
$bytesWritten = file_put_contents($filePath, $logData, FILE_APPEND);

echo "성공적으로 {$bytesWritten} 바이트가 로그 파일에 저장되었습니다.<br>";
?>
```

### 2.1.2 file_get_contents() (파일 읽기)
* **기능**: 지정된 경로의 파일 내용을 통째로 로드하여 단일 문자열 변수로 반환합니다.

```php
<?php
declare(strict_types=1);

$filePath = "log.txt";

if (file_exists($filePath)) {
    // 전체 파일 텍스트 읽어오기
    $content = file_get_contents($filePath);
    
    // 줄바꿈(\n) 문자를 브라우저 개행(<br>)으로 변환해 화면 출력
    echo nl2br(htmlspecialchars($content));
} else {
    echo "읽어올 로그 파일이 존재하지 않습니다.<br>";
}
?>
```

<br>

## 2.2 JSON 데이터 제어 (Encoding & Decoding)
서버 디스크에 일반 텍스트가 아닌 PHP 배열(Array)이나 구조화된 객체(Object)를 파일 그대로 저장했다가 복원하고 싶을 때 가장 널리 사용되는 교환 표준 규격이 **JSON**입니다.

```text
  PHP 연관 배열(Array) ───────── json_encode() ────────>  JSON 문자열 (텍스트)
                                                       (디스크 파일 저장 가능)
  
  PHP 연관 배열(Array) <──────── json_decode() <────────  JSON 문자열 (텍스트)
```

* **`json_encode()`**: PHP 변수(배열/객체 등)를 JSON 표준 문자열 텍스트로 직렬화(Serialization)합니다.
* **`json_decode()`**: JSON 표준 문자열 텍스트를 파싱하여 원래의 PHP 객체나 연관 배열로 복원(Deserialization)합니다.

### 예제: json_handling.php
```php
<?php
declare(strict_types=1);

// 1. PHP 연관 배열 선언
$member = [
    "name" => "홍길동",
    "email" => "gildong@example.com",
    "skills" => ["PHP", "MySQL", "Jekyll"],
    "is_active" => true
];

// 2. PHP 배열 -> JSON 문자열 변환
// JSON_UNESCAPED_UNICODE: 한글 깨짐 방지 옵션
// JSON_PRETTY_PRINT: 들여쓰기가 가미되어 사람이 보기 편한 포맷으로 정렬
$jsonString = json_encode($member, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

echo "<h3>컴파일 완료된 JSON 텍스트:</h3>";
echo "<pre>" . htmlspecialchars($jsonString) . "</pre>";

// 3. JSON 문자열 -> PHP 배열 복원
// json_decode의 두 번째 매개변수를 true로 지정하면 PHP stdClass 객체가 아닌 연관 배열(Associative Array)로 복원됩니다.
$recoveredArray = json_decode($jsonString, true);

echo "복원된 이름: " . $recoveredArray['name'] . "<br>";
echo "보유 기술 1순위: " . $recoveredArray['skills'][0] . "<br>";
?>
```

---

## 2.3 파일과 JSON을 결합한 데이터 누적 관리 실습
파일 입출력과 JSON 제어를 접목하여, 데이터베이스 없이도 로컬 파일 저장소에 회원 방명록 데이터를 영속적으로 읽고 누적 추가하는 소형 게시판 백엔드 모듈 실습입니다.

### 예제: guestbook.php
```php
<?php
declare(strict_types=1);

$storageFile = "guestbook.json";
$guestBookData = [];

// 1. 기존 파일이 있으면 로드 및 배열 복원
if (file_exists($storageFile)) {
    $rawJson = file_get_contents($storageFile);
    // 디코딩하여 기존 방명록 리스트 확보
    $guestBookData = json_decode($rawJson, true) ?? [];
}

// 2. 신규 사용자의 방명록 내용 생성 (예시 입력값)
$newEntry = [
    "writer" => "장보고",
    "message" => "해상 무역의 거점 청해진에서 방문 도장을 찍고 갑니다.",
    "created_at" => date('Y-m-d H:i:s')
];

// 3. 기존 방명록 배열의 처음에 신규 데이터 추가
array_unshift($guestBookData, $newEntry);

// 4. 누적 업데이트된 전체 배열을 JSON으로 인코딩하여 디스크 파일에 최종 덮어쓰기
$newJson = json_encode($guestBookData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
file_put_contents($storageFile, $newJson);

echo "<h3>현재 방명록 목록 (총 " . count($guestBookData) . "개)</h3><hr>";
foreach ($guestBookData as $post) {
    echo "작성자: <strong>" . htmlspecialchars($post['writer']) . "</strong><br>";
    echo "내용: " . htmlspecialchars($post['message']) . "<br>";
    echo "시간: " . $post['created_at'] . "<br><hr>";
}
?>
```
