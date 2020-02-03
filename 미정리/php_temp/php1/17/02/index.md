---
layout: default
title: PHP BOOK
subtitle: numphp

tree: /php
---

## 17.2 예외
<hr>
예외라는 말은 프로그램 실행 도중 예상치 않은동작이나 불확실한 처리로 발생할 수 있는 부분을 예상하여 오류까지도 같이 처리를 하는 코딩 방법입니다. `try{} catch {}`의 문법과 별도의 예외 처리를 위한클래스 등이 존재합니다.  

예외 처리는PHP스크립트가 실행하면서 오류가 발생했을 때 처리할 수 있는 로직을 만들어 넣을 수 있는 기술입니다. 예외 처리 개념은 PHP 5.x 이전에는 도입되지 않았습니다.  

오류의 경우는 프로그램의 문제가 발생하면 오류를통보하고 프로그램이 중단됩니다. 하지만, 예외는 갑작스러운오류 발생 시 스크립트를 그냥 종료하는 것이 아니라 별도의 처리 루틴을 통해 안전하게 프로그램을 마칠 수 있도록 합니다.  

### 17.2.1 Exception 클래스
<hr>
PHP는 예외 처리를 위해서 특별한 Exception클래스를 제공합니다. 예외 처리 클래스는 예외 발생 시 심각한 오류를 안전한 경로로 우회하여처리할 수 있도록 도와줍니다.  

예외 처리 클래스 Exception도 new 키워드를 통해 인스턴스를 생성하여 사용할수 있습니다. Exception 클래스는 오류 코드와 메시지를 전달하고 값을 처리할 수 있는 추가 메서드를지원합니다.

예제 파일 exception-01.php

결과

예외 코드= 444

예외 메시지= 예외 클래스 오류 발생

예외Exception 클래스 구조와 인터페이스는 다음과 같습니다.

 
```
Exception {

/* Properties */

protected string [$message](http://php.net/manual/en/class.exception.php#exception.props.message) ;

protected int [$code](http://php.net/manual/en/class.exception.php#exception.props.code) ;

protected string [$file](http://php.net/manual/en/class.exception.php#exception.props.file) ;

protected int [$line](http://php.net/manual/en/class.exception.php#exception.props.line) ;
```
 
```
/* Methods */

public [__construct](http://php.net/manual/en/exception.construct.php) ([string $message ="" [, int $code =0 [, [Throwable](http://php.net/manual/en/class.throwable.php) $previous =NULL ]]] )

final public string [getMessage](http://php.net/manual/en/exception.getmessage.php) (void )

final public Throwable [getPrevious](http://php.net/manual/en/exception.getprevious.php) (void )

final public mixed [getCode](http://php.net/manual/en/exception.getcode.php) (void )

final public string [getFile](http://php.net/manual/en/exception.getfile.php) (void )

final public int [getLine](http://php.net/manual/en/exception.getline.php) (void )

final public array [getTrace](http://php.net/manual/en/exception.gettrace.php) (void )

final public string [getTraceAsString](http://php.net/manual/en/exception.gettraceasstring.php) (void )

public string [__toString](http://php.net/manual/en/exception.tostring.php) (void )

final private void [__clone](http://php.net/manual/en/exception.clone.php) (void )

}
```
 

예외 처리가 발생하면 PHP 엔진은 Exception 클래스로 예외를 발생한 부분을 처리하게됩니다.
PHP 7.x에서는 Exception 클래스는 throwable 인터페이스를 따릅니다.

```
Throwable {

/* Methods */

abstract public string [getMessage](http://php.net/manual/en/throwable.getmessage.php) (void )

abstract public int [getCode](http://php.net/manual/en/throwable.getcode.php) (void )

abstract public string [getFile](http://php.net/manual/en/throwable.getfile.php) (void )

abstract public int [getLine](http://php.net/manual/en/throwable.getline.php) (void )

abstract public array [getTrace](http://php.net/manual/en/throwable.gettrace.php) (void )

abstract public string [getTraceAsString](http://php.net/manual/en/throwable.gettraceasstring.php) (void )

abstract public Throwable [getPrevious](http://php.net/manual/en/throwable.getprevious.php) (void )

abstract public string [__toString](http://php.net/manual/en/throwable.tostring.php) (void )

}
```
 

### 17.2.2 throw
<hr>
throw 키워드를 이용하여 사용자가 직접 예외를 발생할 수 있습니다. 예외가 발생하면 PHP는 코드 실행을 중지됩니다.

throw 키워드는 Exception과 관련 서브 클래스에서만 사용이 가능한 키워드입니다. 

* Exception
* ErrorException

예제 파일 exception-02.php

결과

[Sun May 1416:21:35 2017] ::1:55806 [500]: /jinyphp/exception-02.php - Uncaught Exception:강제적 예외 발생in C:\php-7.1.4-Win32-VC14-x86\jinyphp\exception-02.php:2

Stack trace:

\#0 {main}

thrown inC:\php-7.1.4-Win32-VC14-x86\jinyphp\exception-02.php on line 2

 

위의 예제는 예외 발생 처리 예입니다. throw 명령으로사용자가직접예외를발생할수있습니다.

### 17.2.3Exception 상속

예외 처리 Exception클래스를 상속받아 새로운 에외 처리 클래스를 직접 만들어서 사용할 수도 있습니다. 새로운예외 처리는 클래스는 기존의 exception 함수를 상속받아서 생성을 합니다.

|문법|

예제 파일 exception-03.php

결과

Exception을 상속합니다.

예외 코드= 444

예외 메시지= 예외 클래스 오류 발생

 

위의 예제는 예외 처리 클래스 상속에 대한 예입니다. 기존exception 예외 클래스를 상속받아 새로운 예외 처리 클래스를 만들어서 사용할 수 있습니다.

 
### 17.2.4 예외 포착

개발자는 예외 처리에 대해서 수동적인 방어보다는 능동적인 방어가 필요합니다. 적극적으로 예외가 발생될 것을 예측하여 프로그램 코드를 작성해야합니다.

PHP 언어는 예외를 포착할 수 있는 try ~catch 명령 키워드를 제공합니다. try~catch는C++이나 Java 등에서 일찌감치 예외 처리를 위해 사용하던 문법입니다. PHP 5.x 이후부터는 이와 비슷한 스타일로 예외 처리 문장을 만들 수 있습니다.

프로그램이 동작할 때 예외가 발생할 가능성이있다고 하면 try {} catch {} 명령으로 예외 발생을 대비하는 것이 좋습니다.

try~catch는 2개의영역으로 나누어져 있습니다.

|문법|

try { } 부분

try 본문 안에는 예외가 발생될 가능성이 높은 코드를 작성하는 영역입니다. 특별한코드가 이니라 정상적으로 수행하고자 하는 코드를 작성합니다. 만일 이 코드들이 예외를 발생할 여지가있는 경우 try{} 로 코드를 감싸서 실행하는 것입니다. 

오류 예외가 발생되지 않으면 큰 문제나 의미없이 코드가 실행될 것입니다. 만일 try 안에 있는 코드에예외가 발생하면 코드 실행을 중단하게 됩니다. 그리고 catch 부분의코드를 수행합니다.

catch {} 부분

catch (클래스명 $변수명) { }은 try{} 본문에 예외가 포착되었을 때 처리되는 내용들입니다.

 

예외가 발생할 때 Excetion 클래스를 통해 예외 상태나 메시지를 받아올 수 있습니다. Exception클래스는 예외를 처리할 수 있는 다양한 프로퍼티와 메서드를 가지고 있습니다.****

 

|문법|

 

예외 발생 시 Exception 클래스로 생성된 인스턴스를 받습니다. 생성된 인스턴스로Exception 메서드를 실행할 수 있습니다.

예제 파일 exception-04.php

결과

예외 처리 발생: 강제적 예외 발생

위의 예제는try~catch 동작에 대한 예입니다. try {}본문안에서강제적으로throw 명령을 통해 개발자가 직접 예외를 발생합니다. 예외가발생되면catch{} 안의 내용이 실행됩니다. catch실행시예외처리클래스exception 객체를 동시에 생성하여 catch 내부로전달합니다.

 

catch 내에서는 exception클래스로생성된객체를접근하여메시지및상태를체크할수있습니다.

 
### 17.2.5 다중 catch

만일 예외 처리의 유형이 다양한 경우 catch를 연결하여 사용 가능합니다.

 

|문법|

 

catch는 위의 표현처럼 계속 체인 형태로 연결하여 사용할 수 있습니다.

예제 파일 exception-05.php

결과

PDO 오류

 

위의 예제는 다수의 catch 처리를위한실험입니다. 예외가 발생되면 예외 상태에 따라서 상항별로 catch 로분기하여처리됩니다.

 
### 17.2.6 finally

finally { } 부분은 PHP 5.5에서 도입된기능으로 try 부분이나 catch부분 처리가 끝나고 처리할 내용을 추가로 정의할 수 있습니다.finally {}는 독립적으로 사용을 할 수 없고 반드시 try ~ catch문 뒤에소속되어 사용 가능합니다. 즉, 종속된 기능 명령어 입니다.

사용 문법

예제 파일 exception-06.php

결과

예외 처리 발생: 강제적 예외 발생

finally 연산 종료

 

위의 예제는 final 에대한예입니다. 예외가 발생하면 catch 부분을수행합니다. 그리고 catch 부분을처리후에 finally {} 부분을 실행합니다.

### 17.2.7 전역 예외 처리

try~catch로 처리하지 못한 예외가 있을 수도 있습니다. 이런 경우 전역 예외 처리를 통해 예상치 못한 예외도 포착할 수 있습니다.

 
|관련함수|

set_exception_handler();내장 함수를 통하여 전역 예외 처리를 등록할 수 있습니다.


|관련함수|

restore_exception_handler();내장 함수는 설정한 전역 처리기를 복원합니다.


예제파일 exception-07.php

결과)

전역 예외 처리 포착

예외 메시지= 강제적 예외 발생 

위의 예제는 전역 예외 처리에 대한 예입니다. set_exception_handler() 함수를통해적역예외처리함수를등록합니다.