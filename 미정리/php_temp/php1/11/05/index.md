---
layout: default
title: PHP BOOK
subtitle: numphp

tree: /php
---

## 11.5 require

PHP에서는 include와 비슷한require 전처리 명령어를 지원합니다. require 명령어를제공하는 이유는 좀 더 유연한 소스 결합과 엄격한 소스 결합을 서로 구분하기 위함입니다.

### 11.5.1 Require 특징

PHP는 왜 include와 비슷한 require를 지원하는 것일까요? include와 require의 차이점은 삽입하고자 하는 **파일의존재 여부에 따른 처리 방법**입니다. 

명령 키워드의 의미만으로도 특징을 유추해 볼수 있습니다. 만일 삽입할 PHP 스크립트 파일이 없는 경우include 처럼 경고(E_WARNING)를 출력하는 대신에require 명령어는 소스의 치명적 오류(E_COMPILE_ERROR)를출력한 후에 스크립트를 즉시 중단합니다.

|문법|

따라서 약간 동적 스타일로 삽입하는 include 대신에 프로그램에서 반드시 삽입 처리가 이루어져야 하는 필수 기능은 require를 사용하는 것을 권장합니다.  

예제 파일 include_lib.php

예제 파일 require-01.php

결과
15

위의 예제는 분리된 2개의소스를 require 명령으로 결합하는 예입니다. 만일결합하고자하는require 소스 파일이 없으면 실행을 중단하고 오류를 발생할 것입니다.

### 11.5.2 require_once

require도 중복으로 동일한 파일을 선언 시 두 번require하는 것을 방지 하기 위해서 include_once와 유사한 require_once라는 명령도 같이 제공합니다.  

|문법|

require-01.php파일은include_lib.php 파일을 삽입하여 실행 함수를 호출합니다.

예제 파일 require-02.php

결과
15

위의 예는 require_one를이용한 예입니다. require_once명령어는 두 번 삽입하는 실수를 방지할 수 있습니다. 중복하여 사용하는 경우 두 번째 require_once는 무시하게됩니다.  

 
