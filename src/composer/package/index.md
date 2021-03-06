---
layout: php
title: "PHP composer"
breadcrumb:
- composer
---

# 05. 패키지
---

컴포저로 배포되는 PHP 라이브러리를 패키지라고 말합니다. 컴포저로 설치가 가능한 패키지들의 목록과 배포는 패키지스트 사이트에서 관리됩니다.

<br>

## 05.1 패키지 vs 라이브러리
---
라이브러리라는 말은 프로그래밍 세계에서 오랫동안 사용하던 용어 입니다. 라이브러리는 다른 프로그램과 결합, 포함되어 재사용 가능한 코드를 말합니다.

패키지와 라이브러리는 매우 유사합니다. 거의 동일한 의미라고 말할 수 있습니다. 다른 언어에서는 모듈이라는 표현도 사용을 합니다. 

패키지를 다른 말로 표현하면 꾸러미라고 할 수 있습니다. 최신 트랜드의 언어에서는 코드 패키지를 네임스페이스와 결합한 기술을 의미하기도 합니다.

패키지는 라이브러리를 배포하는 메커니즘이 됩니다.

<br>

## 05.1 배포사이트
이전에는 여러 곳으로 분포되어 있는 라이브러리를 설치하기 배포 저장소들의 목록을 직접 관리를 하여야 했습니다.

하지만 라이브러리 패키지를 자동으로 설치하고 관리해주는 컴포저의 등장으로 더 이상 배포사이트를 찾지 않아도 됩니다. 

<br>

### 05.1.1 패키지스트
---
컴포저는 패키지의 정보를 어디에서 가지고 올까요? PHP 생태에게서도 패키지를 관리하고 배포하는 사이트가 있습니다.

페키지스트는 PHP관련 다양한 응용패키지들이 등록되고 관리되는 대표적인 사이트 입니다. packagist.org 사이트에 접속하시면 됩니다. 

 

컴포저와 페키지스트 사이트는 Private Packagist라는 곳에서 운영되는 사이트 입니다. Private Packagist는 공개된 페키지 배포 사이트 외에 유료 개인/비즈니스 패키지 배포 사이트를 제공하기도 합니다.

<br>

### 05.1.2 그외 사이트
---
패키지스트와 유사한 다른 배포 사이트들도 있습니다. 개인 블로그 웹사이트 제작툴로 유명한 워드프레스의 경우 독립적으로 http://wpackagist.org 를 사용하고 있습니다. 이 저장소는 워드프레스 테마와 플러그인들을 전용으로 저장하고 배포하고 있습니다.

 
<br>

## 05.2 패키지 검색
---
패키지를 설치하기 위해서는 원하는 라이브러리 패키지를 검색하는 것이 우선적입니다.

<br>

### 05.2.1 페키지스트 검색
---
패키지를 관리 배포하는 패키지스트 사이트에서 원하는 패키지들의 목록을 검색할 수 있습니다.

사이트에 접속을 하면 큰이미지로 페키지를 검색할 수 있는 입력창을 보실 수 있습니다.
 
<br>

### 05.2.2 콘솔 검색
---
컴포저 콘솔창을 통하여 페키지를 검색하고 설치를 할 수 있습니다.

```
C:\Users\infoh>composer search "jiny"
jetfueltw/jinyangpay-php gaotong payment gateway php package
jiny/hello composer package make test
jiny/routes jinyPHP routes process
jiny/core jiny framwork core
…
```

<br>

## 05.3 미러사이트
---
패키지스트(packagist.org)의 서버는 유럽에 위치하고 있습니다.  
한국에서 유럽의 서버까지 접속하여 패키지를 다운로드 하는 것은 느릴 수 있습니다.

이를 보완하기 위해서 몇 개의 미러 사이트를 이용할 수도 있습니다.

일본의 미러사이트인 packgist.jp 도 있습니다.


### 05.3.1 저장소 변경방법

```
composer config -g repositories.packagist composer http://packagist.jp
```


### 05.3.2 설정해제
```
composer config -g --unset repositories.packagist
```


