---
layout: php
title: "cURL 네트워크 연동 및 크롤링"
keyword: "php curl, curl_init, curl_setopt, curl_exec, web crawler, scraping"
description: "PHP cURL 모듈을 사용한 외부 웹 API 서버와의 연동 방법 및 정규식을 활용한 기초 웹 크롤링 작동 원리를 이해하고 구현합니다."
breadcrumb:
- practice
- curl
---

# 3. cURL 네트워크 연동 및 크롤링
---
백엔드 웹 시스템을 구축하다 보면 우리 서버의 데이터베이스뿐만 아니라 외부 결제 PG사 API 호출, 소셜 로그인 토큰 검증, 타사 날씨/환율 데이터 연동 등 **외부 인터넷 서버에 HTTP 요청을 보내 정보를 획득해야 하는** 경우가 무척 많습니다. 

이 문서에서는 PHP의 고성능 네트워크 전송 엔진인 **cURL(Client URL Library)** 모듈의 제어법과 획득한 외부 리소스를 파싱하여 필요한 정보만 추출하는 **기초 크롤링(Crawling / Scraping)** 아키텍처를 학습합니다.

<br>

## 3.1 cURL 모듈 구동 메커니즘
cURL은 다양한 프로토콜(HTTP, HTTPS, FTP 등)로 서버 간에 파일과 데이터를 전송할 수 있는 강력한 네트워크 연동 도구입니다.

```text
  [ 우리 PHP 서버 (cURL) ]                      [ 외부 API 서버 ]
            │                                           │
            │ ───────── (1) HTTP Request ─────────────> │
            │ <──────── (2) HTTP Response (HTML/JSON) ─ │
            ▼
    [ 데이터 파싱/크롤링 ]
```

### 3.1.1 cURL의 4단계 실행 라이프사이클
1. **`curl_init()`**: cURL 세션을 초기화하고 연결 핸들러를 획득합니다.
2. **`curl_setopt()`**: 전송할 URL, 전송 방식(GET/POST), 헤더 옵션, 응답 값 반환 여부 등 상세 동작 옵션을 셋팅합니다.
3. **`curl_exec()`**: 실제 외부 네트워크 접속을 시도하고 응답 원본 데이터를 받아옵니다.
4. **`curl_close()`**: 사용이 끝난 cURL 세션을 닫아 통신 포트 및 소켓 리소스를 반환합니다.

### 3.1.2 외부 JSON API 서버 호출 실무 예제
```php
<?php
declare(strict_types=1);

// 1. 통신할 외부 가상 API 서버 경로 정의
$targetUrl = "https://jsonplaceholder.typicode.com/posts/1";

// 2. cURL 세션 초기화
$ch = curl_init();

// 3. 접속 상세 조건 설정 (curl_setopt)
curl_setopt($ch, CURLOPT_URL, $targetUrl); // 접속 타깃 URL 주소
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // curl_exec 결과로 문자열 원본을 반환받도록 설정 (false 시 즉시 브라우저 화면에 에코 출력되어 버림)
curl_setopt($ch, CURLOPT_TIMEOUT, 10); // 최대 네트워크 대기 지연시간을 10초로 강제 차단 (API 다운 시 우리 서버까지 멈춰버리는 현상 방지)
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // HTTPS 인증서 로컬 검증 일시 해제 (로컬 테스트 개발 환경용)

// 4. 실행 및 응답 수신
$response = curl_exec($ch);

// 5. 네트워크 에러 핸들링
if (curl_errno($ch)) {
    $errorMsg = curl_error($ch);
    echo "네트워크 연동 실패: " . $errorMsg;
} else {
    // 성공 시 수신 데이터 가공
    $data = json_decode($response, true);
    echo "<h3>외부 API 연동 성공!</h3>";
    echo "글 번호: " . $data['id'] . "<br>";
    echo "제목: " . htmlspecialchars($data['title']) . "<br>";
}

// 6. 세션 종료 및 메모리 반환
curl_close($ch);
?>
```

<br>

## 3.2 기초 웹 크롤링 및 데이터 스크래핑
**웹 크롤링(Web Crawling) 혹은 스크래핑(Scraping)**은 외부 웹 사이트가 노출하고 있는 HTML 페이지 원본을 cURL 등으로 가져온 뒤, 프로그램 코드로 분석하여 필요한 **핵심 정보만 자동 추출 및 데이터베이스화하는** 기술입니다.

### 3.2.1 정규식을 활용한 데이터 파싱
획득한 방대한 HTML 텍스트 원본에서 우리가 원하는 데이터(예: 언론사 헤드라인 제목, 환율 시세 등)만 조준해 가공하기 위해 PHP의 정규식 매칭 함수인 **`preg_match()`** 또는 **`preg_match_all()`**을 실무적으로 사용합니다.

### 예제: 가상의 뉴스 헤드라인 크롤러 실습
외부 포털 뉴스 목차라고 가정한 모의 HTML 소스 코드에서 뉴스 제목과 링크 주소만 깨끗하게 긁어와 추출하는 크롤러 시뮬레이션입니다.

```php
<?php
declare(strict_types=1);

// 1. 크롤링 타깃 페이지 경로 설정 
// (실무에서는 실제 뉴스 사이트의 URL을 기재하여 cURL로 가져옵니다)
// $htmlContent = curl_exec($ch); // cURL 실행으로 원본 HTML 획득

// [시뮬레이션을 위한 임의의 뉴스 포털 HTML 문자열 예시]
$htmlContent = '
<div class="news-container">
    <ul class="news-list">
        <li><a href="https://news.jiny.dev/read/101" class="link">코스피 3,000 돌파, 사상 최고치 경신</a></li>
        <li><a href="https://news.jiny.dev/read/102" class="link">PHP 8.3 정식 발표, 향상된 JIT 성능 분석</a></li>
        <li><a href="https://news.jiny.dev/read/103" class="link">모던 백엔드 프레임워크와 아키텍처 동향</a></li>
    </ul>
</div>
';

// 2. 추출 대상 정보를 타깃하는 정규식 패턴 설계
// <a href="링크" class="link">제목</a> 패턴을 획득하도록 패턴화
$pattern = '/<a href="([^"]+)" class="link">([^<]+)<\/a>/';

// 3. 정규식 다건 매칭 실행
// $matches[1]에 링크 주소 배열이 매핑되고, $matches[2]에 매칭된 뉴스 제목 텍스트 배열이 들어갑니다.
preg_match_all($pattern, $htmlContent, $matches);

echo "<h3>실시간 뉴스 크롤링 결과 리스트</h3><hr>";
if (!empty($matches[0])) {
    $newsList = [];
    
    // 데이터 구조 가공 및 매핑
    for ($i = 0; $i < count($matches[0]); $i++) {
        $newsList[] = [
            'url'   => $matches[1][$i],
            'title' => $matches[2][$i]
        ];
    }
    
    // 최종 추출 정보 출력
    foreach ($newsList as $index => $news) {
        $num = $index + 1;
        echo "<strong>{$num}. 뉴스 제목</strong>: " . htmlspecialchars($news['title']) . "<br>";
        echo " - 기사 경로: <a href='{$news['url']}' target='_blank'>{$news['url']}</a><br><br>";
    }
} else {
    echo "정규식 매칭에 실패했거나 HTML 구조가 변경되었습니다.<br>";
}
?>
```

> [!CAUTION]
> **웹 크롤러 개발 시 주의 의무**
> 1. **무단 크롤링의 법적 리스크**: 타사 웹 서버에 단시간 내에 수천 번 이상의 cURL 요청을 과도하게 날리면 시스템 마비 유발(DDoS 공격 오인)로 IP 차단을 당하거나 정보보호법 및 영업방해법에 의해 민형사상 기소를 당할 수 있습니다.
> 2. **robots.txt 준수**: 크롤링 대상 사이트 루트의 `https://target.com/robots.txt`에 기재된 로봇 배제 규약(Allow/Disallow 지시어)을 엄격하게 읽어 확인한 후 코드를 구동해야 합니다.
