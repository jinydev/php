---
layout: php
title: "도메인 접속 및 웹 서버 실행"
description: "PHP 웹 애플리케이션을 인터넷상에서 서비스하기 위해 필요한 도메인 주소의 동작 원리와 웹 서버(아파치 등) 환경 설정 기초에 대해 알아봅니다."
keyword: "php 도메인 접속, php 웹 서버 실행, DNS 동작 원리, 도메인 주소 매핑"
breadcrumb:
- syntax
- code
- execute
- domain
---

# 도메인 접속
---

<div style="text-align: center; margin: 30px 0;">
  <img src="img/domain_concept_cartoon.png" alt="Domain Connection Concept Cartoon" style="max-width: 60%; height: auto; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);" />
  <p style="font-size: 13px; color: #64748b; margin-top: 8px;">그림: 브라우저에 입력된 도메인(Domain) 주소를 DNS 서버(Domain Name System)가 IP 주소로 번역하여 웹 서버에 도달하는 매핑 원리</p>
</div>

PHP를 웹 서버를 통해 실행하기 위해서는 실행 주소가 필요합니다. 만일 PHP를 실행하는 접속 서버가 도메인 주소가 있는 경우 아래와 같이 서버의 도메인과 스크립트 파일 경로를 적으면 됩니다.  

실행 접속 )
{% raw %}
```
http:// 도메인 / 스크립트파일.php
```
{% endraw %}

도메인을 접속하기 위해서는 사전에 유효한 도메인을 보유하고 있어야 합니다. 도메인은 도메인 전문 회사를 통해 1년 단위로 구입할 수 있습니다. 또한 구입한 도메인을 웹 서버(아파치)에서 서비스 가능하도록 환경 설정되어 있어야 합니다.  

보다 자세한 도메인 및 웹 서버 구축에 대해서는 관련 서적을 참고하기 바랍니다.  

## Quiz
---
퀴즈를 통하여 학습한 내용을 다시한번 생각해 봅니다.
<br>