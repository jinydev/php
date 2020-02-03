---
layout: default
title: Composite
subtitle: "patterns"

tree: /php
---

### 컴포짓 패턴
---

컴퍼짓 패턴은 트리구조와 같은 구조를 구현시 적용하는 디자인 패턴입니다. 디자인 패턴중에서 이해하기 가장 쉬운 패턴중의 하나 입니다.

컴포짓 패턴은 크개 인터페이스와 같은 역할을 하는 컴포넌트(component), 그리고 이를 구현 또는 상속을 받은 내용물(Leaf), Leaf를 담고 있는 Composite 3가지가 기본 구성이 됩니다.
컴포짓 패턴은 계층 구조로 파일탐색, 조직도 등 하나의 구조안에 또다른 구조를 가지고 있는 모델들을 설계할 때 많이 사용을 합니다. 

트리구조를 커포짓 패턴을 통하여 구현하게 되면, 하나의 트리를 추가하거나, 이동, 삭제하여 전체적인 트리구조를 유지하는데 매우 유용합니다. 이는 트리구조의 재귀적인 특징을 컴포짓 패턴이 잘 응용하는 것이라 볼 수 있습니다.


### 특징
---
컴포짓 패턴은 계층구조로 객체간의 상하 관계를 가지게 됩니다. 즉, 상속관계인 is-a relationshio을 처리해야 합니다.

### 분류
---
컴포짓 패턴은 GOF의 구조적 패턴으로 분류 됩니다.

### 목적
---
여러 객체로 이루어진 구조를 다시 포함하는 구조의 객체를 생성할때 컴포짓 패턴은 유용합니다. 


<br>
### 적용사례1 파일
---
컴퓨터 파일 시스템에서는 폴더와 파일이 존재합니다. 그중에 폴더는 특수한 파일 형태로 취급을 합니다. 폴더는 파일들의 목록을 담고 있는 리스트 구조의 파일로 처리합니다.


### 기본실습1
---
컴퍼짓 패턴은 파일 시스템의 트리 구조를 예로 설명을 많이 합니다.

먼저 컴퍼넌트를 먼저 생성합니다. 컴포넌트는 마치 인터페이스 처럼 느껴질 수도 있습니다.

컴포넌트는 `Abstract` 형식으로 생성을 합니다. 추상화 클래스로 생성을 하는 이유는 컴퍼넌트가 값을 가지고 있어야 하기 때문입니다.

composite/01/Component.php
```php
<?php
/**
 * 추상화로 생성합니다.
 */
abstract class Component
{
    /**
     * 이름을 저장합니다.
     */
    private $name;

    /**
     * 이름에 대한 getter 입니다.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * 이름에 대한 setter 입니다.
     */
    public function setName($name)
    {
        $this->name = $name;
    }

}
```

컴포넌트에는 이름 외에 다양한 필요 값을 추가로 넣을 수도 있습니다. 

두번재 구성요소인 `leaf`를 생성합니다. leaf는 파일시스템에서 파일과 같은 역할이라고 생각하시면 됩니다.
leaf는 앞에서 미리 생성한 추상화 클래스인 컴포넌트를 적용받습니다.

composite/01/Leaf.php
```php
<?php
/**
 * 컴포넌트 추상화를 적용
 */
class Leaf extends Component
{
    private $data;

    public function __construct($name)
    {
        //echo __CLASS__."가 생성이 되었습니다.<br>";
        $this->setName($name);
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }
}
```

세번째 구성요소인 컴포짓을 생성합니다. 컴포짓은 파일 시스템에서 폴더와 같은 의미입니다.

composite/01/composite.php
```php
<?php

class Composite extends Component
{
    /**
     * 리스트를 담고 있는 배열
     */
    public $children = [];

    public function __construct($name)
    {
        //echo __CLASS__."가 생성이 되었습니다.<br>";
        $this->setName($name);
    }

    /**
     * 요소를 추가합니다.
     */
    public function addNode(component $folder)
    {
        $name = $folder->getName();
        $this->children[$name] = $folder;
    }

    /**
     * 요소를 제거합니다.
     */
    public function removeNode($component)
    {
        $name = $component->getName();
        unset($this->children[$name]);
    }

    /**
     * 노드 확인
     */
    public function isNode($component)
    {
        return $this->children;
    }

}
```

객체의 트리구조를 구성할때 개별객체(Leaf)와 복합객체(composite)가 생성되고 노드에서는 이 두객체를 동일하게 사용을 합니다. 
여기서 동일하게 사용을 한다는 트리구조를 생성시 leaf 노드와 branch 노드를 구별하는 것은 복잡합니다. 또한, 이러한 구분처리를 하기 위해서 다양한 오류 코드가 발생될 확율 또한 많습니다. 이렇게 두객체를 구별하지 않고 동일하게 처리함으로서 향후 발생될 수 있는 문제점을 컴포짓 패턴에서는 해결할 수 있습니다.

컴포짓 패턴은 다은 객체를 가지고 있기 때문에 객체간에 `has-a`관계를 가지게 됩니다.

개별객체(leaf)와 복합객체(composite)는 동일한 component를 상속받게 됩니다. 

컴포짓 패턴의 3가지 요소의 클래스를 생성을 하였습니다. 이렇게 생성된 구성요를 가지고 트리를 생성해 보도록 합니다.

composite/01/index.php
```php
<?php

include "Component.php";
include "Composite.php";
include "Leaf.php";

echo "Composite Pattern \n";

// 폴더
$root = new Composite("root");
    $home = new Composite("home");
        $hojin = new Composite("hojin");
        $jiny = new Composite("jiny");
    $users = new Composite("user");
    $temp = new Composite("temp");

// 파일
$img1 = new Leaf("img1");
$img2 = new Leaf("img2");
$img3 = new Leaf("img3");
$img4 = new Leaf("img4");

// 
// 상단에 서브 컴포넌트(폴더)를 추가합니다.
$root->addNode($home);
$root->addNode($users);
    // 서브폴더를 추가
    $users->addNode($hojin);
        // 파일(leaf)추가
        $hojin->addNode($img1);
        $hojin->addNode($img2);
        $hojin->addNode($img3);
        $hojin->addNode($img4);
    $users->addNode($jiny);
$root->addNode($temp);

function tree($component) {

    $arr = $component->children;
    foreach ($arr as $key => $value) {
      
        if ($value instanceof Composite) {
            echo "Folder = ". $key;
            if($value->isNode($value)) {
                echo "\n";
                // 재귀호출 탐색
                tree($value);
                
            } else {
                echo " ...노드 없음";
                echo "\n";
            }            

        } else if ($value instanceof Leaf) {
            echo "File = ". $key. " \n";
            
        } else {
            echo "?? \n";
        } 
   
    }

    
}

// 컴포짓 노트 트리를 출력합니다.
tree($root);
```

먼저 필요한 Composite와 Leaf를 생성합니다. 그리고 이를 통하여 컴포짓 tree를 생성합니다. 이렇게 생성한 컴포짓 트리를 재귀함수로 출력해 보겠습니다.
아래와 같이 생성한 컴포짓 트리가 만들어 진것을 보실 수가 있습니다.

실행화면
```php
$ php index.php
Composite Pattern
Folder = home ...노드 없음
Folder = user
Folder = hojin
File = img1
File = img2
File = img3
File = img4
Folder = jiny ...노드 없음
Folder = temp ...노드 없음
```

컴포짓 패턴을 응용하면 중간 노트를 선택하여 삭제를 할 수도 있을 습니다.
composite/01/index.php 에서 다음과 같이 수정을 해봅니다.
```php
// 노드를 하나 제거해 봅니다.
echo "\n remove node \n";
$users->removeNode($hojin);
tree($root);
```

삭제한 `$hojin`노드가 제거된 트리 출력을 보실 수 있습니다.

실행화면
```php
$ php index.php
Composite Pattern

remove node
Folder = home ...노드 없음
Folder = user
Folder = jiny ...노드 없음
Folder = temp ...노드 없음
```

### 적용사례2 그래픽
---
컴퓨터 그래픽을 처리하면서, 비트맵으로 메모리에 직업 도형을 그리는 것은 비트값을 변경하는 것으로 쉽게 처리를 할 수 있습니다. 하지만, 도형을 백터 객체로 생성을 하고 일부 도형이 중첩 되거나 겹쳐 있을때에 이를 인지하고 처리하는 것은 쉽지 않습니다.

객체를 이용한 도형 그리기는 하나의 객체도형이 또 다른 객체 도형을 포함하여 가지고 있을 수도 있습니다.


### 적용사례3 쇼핑몰
---
쇼핑몰의 상품중에는 단일상품도 존재하지만, 세트 상품도 존재합니다. 세트 상품은 다른 세트상품의 일부분이 될 수도 있습니다. 이러한 복합적인 계층을 가지는 주문의 경우에도 컴포짓 패턴을 응용하여 처리할 수 있습니다.

### 적용사례4 이메일발송
---
우리는 이메일을 발송시 1명, 또는 여러명을 대상으로 메일을 발송합니다. 만일 우리가 여러 그룹으로 묽여저 있는 회원을 대상으로 메일을 보낸다고 생각해 봅시다. 이는 하나의 그룹이 또하나의 그룹으로 묽여저 있는 트리구조와 비슷합니다.

그룹메일을 작성하고 보낼 경우에도 컴포짓 패턴은 매우 융용합니다.


<br>

### 정리
---
컴포짓 패턴은 GOF패턴에서 정의한 구조적 디자인 패턴중의 하나 입니다. 또한 분할 디자인 패턴(partitioning design pattern)의 하나입니다. 컴포짓 패턴을 이용하게 되면 객체의 상하위 체계를 파악할 수 있습니다.

컴포짓 패턴은 트리구조를 만드는 디자인 패턴입니다. 대표적으로 파일시스템을 예를 들어 설명을 많이 하지만, 실제적인 프로젝트 내에서 트리모양을 가지는 구성요소들은 많이 있습니다. 
사이트의 메뉴구조, 쇼핑몰의 카테고리, 계시판, 회원구조등. 커포짓 패턴을 이용하여 다양한 트리구조에 적용해 볼 수도 있을 듯 합니다.

트리 구조 외에도 여러개의 도형을 가지고 있는 그룹을 컴퍼짓 패턴으로 구현이 가능합니다. 만일 그룹으로 묽여 있는 도형의 크기를 수정한다고 생각해 봅니다. 그럼 각각의 모든 도형들은 상위 명령에 따라서 각각의 작업들을 다시 해야 합니다. 상위의 매소드를 호출하는 해당 메소드는 자신의 자식들의 메소들을 재호출함으로서 처리 동작을 위임 할 수 있습니다.

컴포짓 패턴은 일대일:다대일 을 처리하는 데도 매우 유용합니다. 하나의 객체를 호출함으로써, 서브로 가지고 있는 자식들의 객체 메소드를 호출할 수 있습니다.



