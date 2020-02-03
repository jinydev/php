---
layout: default
title: Template Method
subtitle: "patterns"

tree: /php
---

### 템플릿 메소드 패턴
---

대부분의 처리작업들은 한스탭, 한스탭 동작을 구분할 수 있습니다. 인간은 이를 무의식적으로 자연스럽게 동작을 하지만, 컴퓨터는 그렇지 안습니다.
하나 하나의 동작을 지정하고, 행동을 시켜야 합니다.

템플릿 메소드 패턴은 이러한 동작들을 구분하고, 구분된 동작을 실행시킵니다. 각각의 개별 동작들은 상속받은 하위 클래스에서 처리를 하도록 합니다.



템플릿 매소드 패턴은 알고리즘과 같은 동작을 적용할때 사용하면 유용한 디자인 패턴입니다. 

템플릿 메소드 패턴은 알고리즘 뼈대를 정의하는 것과 같습니다. 템플릿 패턴을 적용하면 기존의 알고리즘의 구조를 변경하지 않고도, 서브클래스를 통하여 처리를 동작을 재정의할 수 있습니다.

여기서 템플릿이란 형틀을 가진 기능들을 말합니다. 이러한 형틀을 통하여 약간의 추가부분을 설정하여 기능을 구현할 수 있습니다.

기능의 구조를 메소드에 정의를 미리 해놓은 상태에서, 하위 클래스에서 기능의 구조를 변경없이 재정의 하여 사용하는 패턴을 말합니다.

<br>
### 분류
---
템플릿 메소드 패턴은 GOF의 행위 패턴으로 분류 됩니다.

### 기본실습
---

기본 코드를 통하여 템플릿 메소드 패턴의 동작방법에 대해서 좀더 자세히 알아 보도록 하겠습니다.

템플릿 매소드 패턴을 적용하기 위해서는 동작 알고리즘이 단계별로 구분이 될 수 있어야 합니다. 이렇게 단계별로 구분된 동작을 프로세스 메소드 형태로 정의합니다.

다음은 적용되는 알고리즘의 템플릿 정의 입니다.

template/01/template.php
```php
<?php
/**
 * 템플릿 매소드 추상화 클래스
 */
abstract class Auth
{
    // 하위 클래스가 재정의를 해야되기 때문에 
    // private 대신에 protected으로 설정을 합니다.
    abstract protected function securityCheck();
    abstract protected function authentication($id, $password);
    abstract protected function authorization();
    abstract protected function connection();

    // 템플릿 메소드
    public function requestConnection($str)
    {
        // 프로세스롤 실행합니다.
        echo "프로세스를 시작합니다.\n";
   
        $this->securityCheck($str); // 보완작업, 디코딩

        $id = "abcd";
        $password = "1234";
        $this->authentication($id, $password); // 인증과정

        $permit = $this->authorization(); // 인증
        switch($permit) {
            case 'admin':
                break;
            case 'manager':
                break;    
            case 'user':
                break;    
        }

        return $this->connection();
    
    }
}
```
위와 같이 구현을 하려고 하는 기능은 여러 단계로 나누어 동작을 할 수 있습니다. 각각의 프로세스를 만들어 메소드 형태로 구현을 할 수 있습니다.

알고리즘에 대한 추상클래스를 상속받아 각각의 정의된 알고리즘 메소드의 내용을 구션합니다.

템플릿 메소드의 추상클래스는 프로세스에 대한 메소드 선언과, 이를 호출하여 처리하는 구현로직이 같이 포함되어 있습니다. 이전에 나누어 놓은 각각의 단계 프로세스 메소드를 하나씩 호출하여 적용을 합니다.


template/01/object.php
```php
<?php
/**
 * 단계별 프로세스
 * 알고리즘 구현
 */
class Template extends Auth
{
    protected function securityCheck()
    {
        // 프로세스를 재정의 합니다.
        echo "보완을 체크합니다.\n";
        return true;
    }

    protected function authentication($id, $password)
    {
        // 프로세스를 재정의 합니다.
        echo "아이디, 비빌번호를 확인합니다.\n";
        return true;
    }

    protected function authorization()
    {
        // 프로세스를 재정의 합니다.
        echo "인증 권한을 읽어옵니다.\n";
        return "admin";
    }

    protected function connection()
    {
        // 프로세스를 재정의 합니다.
        echo "연결 성공!\n";
        return true;
    }
}
```

템플릿 메소드는 공통적인 처리는 우선적으로 구현해 놓은 상태에서 세부적인 것들은 하위 클래스에서 이를 정의 합니다. 즉, 하위 클래스를 통하여 확장 제어가 가능합니다.

구현하려고 하는 기능이 변경이 자주 있을 때 템플릿 메소드 패턴을 적용합니다.

```php
<?php
    include "template.php";
    include "object.php";

    $obj = new Template;
    $obj->requestConnection("jiny");
```

생성한 템플릿 메소드패턴을 적용한 것을 출력해 보면 다음과 같습니다.

화면출력
```php
$ php index.php
프로세스를 시작합니다.
보완을 체크합니다.
아이디, 비빌번호를 확인합니다.
인증 권한을 읽어옵니다.
연결 성공!
```
 
<br>

### 실습2
---
https://www.youtube.com/watch?v=rTmTeyluww0


### 정리
---
템플릿 메소드 패턴은 공통적인 프로세들을 묽어 주어 처리하는 패턴입니다.

즉, 일정한 프로세스가 유사한 기능들을 템플릿 메소드 패턴을 통하여 처리하는 방법입니다.

템플릿 매소드 패턴은 코드를 재사용하는 방법을 설명합니다. 템플릿 매서드는 부모 클래스에서 하위 클래스의 명령을 호출하는 방법입니다.

템플릿 메소드 패턴은 추상클래스를 이용한 패턴에서 공통적으로 발견이 됩니다.


템플릿 메소드는 상속을 통하여 알고리즘의 일부를 변경을 할 때 사용을 하지만, 스트레이지 패턴은 알고리즘 전체를 위임하여 사용하는 패턴입니다.


