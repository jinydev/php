---
layout: default
title: Mediator
subtitle: "patterns"

tree: /php
---

### 메디에이터 패턴
---
Mediator의 사전적의미를 찾아 보면 "중재인, 조정관, 중재기관"라는 뜻이 있습니다.

메이에이터 패턴은 복잡한 여러 객체간의 상호 관계를 중재하여 하나의 객체로 정의를 하는 패턴입니다. 즉 M:N의 관계를 가지고 있는 복잡하고, 서로 의존적인 객체 관계를 느슨한 1:1의 관계로 변경할 수 있습니다.

메이에이터 패턴을 사용하게 되면 여러 클래스들이 서로 직접적으로 호출하여 복잡한 관계를 가지고 있을 때 이를 느슨한 결합이 됩니다.

미디에이터 패턴은 객체간의 간계를 구현하는 방법입니다. 객체간에 복잡한 관계로 묽여 있을 때 패턴을 통하여 간단하게 관계를 재구성하는 하는 방법입니다. M:n 관계를 1:1 관계로 정의 합니다.

Mediator를 번역하면 중재라 라는 의미 입니다. 각각의 객체의 인터페이스를 만들어 중재하게 됩니다.


<br>

### 기본실습
---

mediator/01/Mediator.php
```php
<?php

abstract class Mediator
{
    // 중재를 해야될 객체의 목록을 가지고 있습니다.
    // Colleague가 적용된.
    protected $_list = [];

    public function addColleague($colleague)
    {
        if ($colleague) {
            array_push($this->_list, $colleague);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function listMembers()
    {
        return $this->_list;
    }

    abstract function mediate($data, $user);
    

}
```

mediator/01/ChatServer.php
```php
<?php

class ChatServer extends Mediator
{
    public function __construct()
    {
        echo __CLASS__." 객체가 생성이 되었습니다.<br>";
        echo ">>>채팅 서버가 생성이 되었습니다.<br>";
    }

    public function mediate($data, $user)
    {
        echo $user."로 부터 서버 메시지를 받았습니다 = <b>".$data."</b><br>";
  
        foreach ($this->_list as $obj) {
            //echo "<pre>==";
            //print_r($obj);
            //echo "</pre>";
            echo ">>>메시지를 유저(". $obj->userName() .")들에게 전달합니다.<br>";
            $obj->handle($data);
        }
        
        
    }
}
```

mediator/01/Colleague.php
```php
<?php

abstract class Colleague
{
    // 자신이 속해있는 중재자(mediator)를 저장합니다.
    protected $_mediator;

    protected $_name;

    public function join($mediator)
    {
        echo $this->_name."님이 채팅서버에 접속하셨습니다. <br>";
        // 자신이 속해 있는 메이에이터를 저장합니다.
        $this->_mediator = $mediator;

        // 메디에이터에 자신을 등록합니다.
        // 성공 여부를 반환합니다.
        return $mediator->addColleague($this);
    }

    public function sendMsg($data)
    {
        // 메이에이트 채팅서버에 접속되어 있는 경우
        // 서버로 메시지를 전송합니다.
        if ($this->_mediator != NULL) {
            $this->_mediator->mediate($data, $this->_name);
        }
        
    }

    public function userName()
    {
        return $this->_name;
    }

    abstract function handle($data);

}
```

mediator/01/ChatUser.php
```php
<?php

class ChatUser extends Colleague
{
    

    public function __construct($name)
    {
        echo __CLASS__." 객체가 생성이 되었습니다.<br>";
        echo "... $name 유저가 생성이 되었습니다.<br>";

        $this->_name = $name;
    }

    public function handle($data)
    {
        echo ">>>...메세지 = ".$data."<br>";
    }
}
```

mediator/01/index.php
```php
<?php

require "Mediator.php";
require "colleague.php";

require "ChatServer.php";
require "ChatUser.php";

echo "중재자(mediator) 패턴에 대해서 학습을 합니다.<br>";

$mediator = new ChatServer;

$user1 = new ChatUser("james");
$user2 = new ChatUser("jiny");
$user3 = new ChatUser("eric");

echo "=== 중재자 채팅서버 결합===<br>";
$user1->join($mediator);
$user2->join($mediator);
$user3->join($mediator);
//echo "<pre>";
//print_r( $mediator->listMembers() );
//echo "</pre>";
echo "<br>";

// 중재자로 데이터를 전송합니다.
$user1->sendMsg("안녕하세요, 저는 james 입니다.");
echo "<br>";

$user2->sendMsg("안녕하세요, 저는 jiny 입니다.");
echo "<br>";

$user3->sendMsg("안녕하세요, 저는 eric 입니다.");
```


결과화면
```php
중재자(mediator) 패턴에 대해서 학습을 합니다.
ChatServer 객체가 생성이 되었습니다.
>>>채팅 서버가 생성이 되었습니다.
ChatUser 객체가 생성이 되었습니다.
... james 유저가 생성이 되었습니다.
ChatUser 객체가 생성이 되었습니다.
... jiny 유저가 생성이 되었습니다.
ChatUser 객체가 생성이 되었습니다.
... eric 유저가 생성이 되었습니다.
=== 중재자 채팅서버 결합===
james님이 채팅서버에 접속하셨습니다. 
jiny님이 채팅서버에 접속하셨습니다. 
eric님이 채팅서버에 접속하셨습니다. 

james로 부터 서버 메시지를 받았습니다 = 안녕하세요, 저는 james 입니다.
>>>메시지를 유저(james)들에게 전달합니다.
>>>...메세지 = 안녕하세요, 저는 james 입니다.
>>>메시지를 유저(jiny)들에게 전달합니다.
>>>...메세지 = 안녕하세요, 저는 james 입니다.
>>>메시지를 유저(eric)들에게 전달합니다.
>>>...메세지 = 안녕하세요, 저는 james 입니다.

jiny로 부터 서버 메시지를 받았습니다 = 안녕하세요, 저는 jiny 입니다.
>>>메시지를 유저(james)들에게 전달합니다.
>>>...메세지 = 안녕하세요, 저는 jiny 입니다.
>>>메시지를 유저(jiny)들에게 전달합니다.
>>>...메세지 = 안녕하세요, 저는 jiny 입니다.
>>>메시지를 유저(eric)들에게 전달합니다.
>>>...메세지 = 안녕하세요, 저는 jiny 입니다.

eric로 부터 서버 메시지를 받았습니다 = 안녕하세요, 저는 eric 입니다.
>>>메시지를 유저(james)들에게 전달합니다.
>>>...메세지 = 안녕하세요, 저는 eric 입니다.
>>>메시지를 유저(jiny)들에게 전달합니다.
>>>...메세지 = 안녕하세요, 저는 eric 입니다.
>>>메시지를 유저(eric)들에게 전달합니다.
>>>...메세지 = 안녕하세요, 저는 eric 입니다.
```

<br>

### 정리
---

여러 객체들의 복잡한 상호 의존성을 느슨하게 결합합니다. 이를 통하여 간단하게, 객체의 재사용을 쉽게 만들 수 있습니다.

미디어에터 패턴은 여러 객체간의 기능을 분산합니다.

유사한 패턴으로 파사드 패턴을 살펴봅니다. 파사드 패턴의 경우 더 편리한 인터페이스를 제공하는 추상화 작업입니다. 파사드는 단방향 통신이라면, 메이에이터는 양방향 통신을 의미합니다.

