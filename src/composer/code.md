---
layout: php
title: "PHP composer"
breadcrumb:
- composer
---

# 코딩하기
---
이번 장에서는 실제적인 페키지를 검색하여 설치하는 과정을 실습해 보도록 합니다.  
또한 설치한 패키지를 코드로 옴겨서 실행하는 과정도 함께 실습을 해보도록 합니다.

<br>

## 09.1 패키지 설치
---
앞에서 검색한 컴포저 패키지를 추가로 설치해 보도록 하겠습니다.

```
composer require illuminate/support
```

illuminate/support 페키지는 배열과 관련된 핼퍼들을 포함하고 있습니다.

컴포저의 페키지 라이브러리는 github와 연계되어 동작을 합니다.  
컴포저는 페키지리스트와 연계하여 깃허브에서 다운로드 받아 자동설치하게 됩니다.

인터넷을 통하여 설치가 되기 때문에 다소 시간이 걸릴 수 있습니다.  
페지지가 설치가 되면, composer.lock 파일과 vender 폴더가 하나더 추가로 생성이 됩니다.

그리고 composer.json 파일에는 추가한 패키지 정보가 자동으로 갱신이 됩니다.  
다시한번 변경된 composer.json 파일을 확인해 보도록 합니다.

```json
{
    "name": "jinyphp/jiny",
    "authors": [
        {
            "name": "HojinLee",
            "email": "infohojin@naver.com"
        }
    ],
    "require": {
        "illuminate/support": "^5.6"
    }
}
```

또 하나 같이 생성되는 vender 폴더에는 패키지들이 다운로드 되어 설치합니다.

<br>

## 09.2 코드 작성
---
설치한 컴포저 패키지를 실습적용해 보도록 합니다.

아무리 많은 페키지를 설치하였다고 해도 vendor/autoload.php 파일을 한번만 읽어와도 됩니다.

컴포저로 설치한 패키지를 사용하기 위해서는 컴포저 오토로드를 require로 읽어와야 합니다. 오토로드 파일은 컴포저 패키지 설치시 자동으로 같이 파일이 생성 됩니다.

```php
<?php

echo "Composer Study<br>";
require "vendor/autoload.php";

$arr = array(
    'admin' => array(
        'first_name' => 'hojin',
        'last_name' => 'lee'
    )   
);

echo $arr['admin']['first_name'];
echo "<br>";

$first_name = array_get($arr, 'admin.first_name');
echo $first_name;
```

<br>

## 09.3 페키지 제거
---
설치한 컴포저 페키지를 cli 명령어를 통하여 제거할 수 있습니다.

```
$ composer remove illuminate/support
```


