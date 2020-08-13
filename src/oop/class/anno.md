---
layout: php
title: "PHP"
keyword: "jinyphp, php"
---

# 익명 클래스

클래스를 선언할 때는 클래스명이 있어야 합니다. 함수에서 도 익명 함수가 있듯이 클래스에서도 클래스명을 생략한 익명 클래스를 사용할 수 있습니다.

익명 함수 기능은 PHP 7.x으로 업그레이드되면서 새롭게 추가된 기능입니다.

예제 파일 class-11.php
<?php
    // 인터페이스를 설정
    interface Logger
    {
        public function log(string $msg);
    }

    class Application
    {
        private $logger;

        // 반환 타입은 logger입니다.
        public function getLogger(): Logger
        {
            return $this->logger;
        }

    	// 인자값으로 클래스를 입력을 받습니다.
    	public function setLogger(Logger $logger)
        {
        	$this->logger = $logger;
    	}
    }

    $app = new Application;

    // 인자값을 익명의 클래스로 만들어서 전달합니다.
    $app->setLogger(
        new class implements Logger {
    		public function log(string $msg)
            {
        	   echo $msg;
    		}
	   }
    );

    var_dump($app->getLogger());

?>

결과
object(class@anonymous)#2 (0) { } 

위의 예제는 php.net에서 php7.x 새로운 익명 함수에 대한 간단한 설명 예제를 발췌했습니다. Application이라는 클래스는 한 개의 프로퍼티 변수와 두 개의 메서드 함수를 가지고 있습니다.

그중 setLogger() 메서드 함수는 매개변수 인자로 Logger 클래스 객체 타입의 변수를 전달받습니다. 기존의 경우 클래스 객체변수를 전달하기 위해서는 new를 통해서 Logger 클래스를 인스턴스화하여 객체변수를 생성 후에 매개변수로 사용해야 했습니다.

매번 일회성의 객체변수를 생성하는 것은 불필요할 수 있습니다. 이런 경우 익명 클래스를 통해 매개변수 입력 부분에 직접 클래스를 선언하여 전달합니다.

new class implements Logger {
    	public function log(string $msg) {
            	echo $msg;
    	}
}

매개변수로 전달되는 객체변수를 위와 같이 클래스명이 생략된 형태로 객체 선언으로 대체할 수 있습니다.

