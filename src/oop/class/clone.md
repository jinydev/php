---
layout: php
title: "PHP"
keyword: "jinyphp, php"
breadcrumb:
- "oop"
- "class"
- "clone"
---

# 객체 복사
---
new 키워드는 새로운 객체를 생성합니다. new 키워드는 초기화된 객체를 생성합니다.  
만일 클래스 값의 초기화 같은 것이 필요하다면 그냥 new 키워드를 이용하여 객체를 생성하면 됩니다.

하지만 지금 사용 중인 객체를 복제하여 사용하려고 하면 `clone` 키워드를 사용해야 합니다. 

|문법|
```php
$obj2 = clone $obj;
```
 
clone 키워드는 현재의 객체의 상태를 포함하여 객체를 복사합니다.

예제 파일 class-03.php
```php
<?php
	class JinyClass
	{
		public $message;

		public function showMessage(){
			return $this->message;
		}

	}

	$obj = new JinyClass;
	$obj->message = "testing clone";
	echo $obj->showMessage() . "<br>";

	$obj2 = clone $obj;
	echo $obj2->showMessage() . "<br>";

?>
```

결과
```
testing clone
testing clone
```

위의 예는 객체 복사에 대한 실험입니다. 첫 번째 객체 $obj는 처음에 생성된 객체변수입니다.  
생성된 객체에 메시지 내용을 설정한 다음에 화면 출력합니다.

$obj2는 $obj를 복사한 객체입니다. 현재 $obj객체의 설정값을 포함하여 새로운 객체변수에 복제가 됩니다.  
복제된 $obj2를 통해 메시지를 출력하면 복제하기 전의 $obj 의 프로퍼티 값이 출력되는 것을 볼 수 있습니다.

복제는 이전 객체에 어떠한 프로퍼티 값이 설정이 되어 있다면 이 설정값까지 모두 복제를 합니다.  

<br>

## `clone with` 표현식을 통한 프로퍼티 수정 복제 — [PHP 8.5+]
---
최신 PHP 애플리케이션 개발에서는 상태가 변하지 않는 불변 객체(Immutable Object)나 읽기 전용 클래스(Readonly Class)를 사용하는 디자인 패턴이 널리 쓰입니다. 이러한 객체의 상태를 일부만 변경하고 싶을 때는 기존 객체를 복사(clone)하면서 특정 속성 값만 갱신하는 이른바 **"With-er" 메서드 패턴**을 흔히 구현해야 했습니다.

**PHP 8.5부터는 복제와 속성 값 수정을 한 번에 직관적으로 처리할 수 있는 `clone with` 표현식이 전격 도입**되었습니다. 복제 구문 뒤에 `with { 프로퍼티: 값 }` 형태의 코드 블록을 작성하여 복사와 동시에 특정 프로퍼티 값을 변경할 수 있습니다.

예제:
{% raw %}
```php
<?php
    readonly class UserProfile {
        public function __construct(
            public string $name,
            public string $role
        ) {}
    }

    $admin = new UserProfile(name: "이순신", role: "Admin");

    // $admin 객체를 복제하면서, role 프로퍼티만 'Manager'로 안전하게 수정합니다.
    // 기존 객체인 $admin의 상태는 훼손되지 않고 보존됩니다.
    $manager = clone $admin with { role: "Manager" };

    echo "원본 역할: {$admin->role}<br>";    // 출력: 원본 역할: Admin
    echo "복제 역할: {$manager->role}<br>";  // 출력: 복제 역할: Manager
?>
```
{% endraw %}

`clone with` 표현식을 사용하면 다음과 같은 장점이 있습니다:
1. **불변성(Immutability) 유지**: 원본 객체를 손상시키지 않고 새로운 상태의 객체 사본을 안전하게 생성할 수 있습니다.
2. **보일러플레이트 제거**: 개별 프로퍼티를 변경하기 위해 수동으로 여러 개의 `withX()` 메서드를 작성하거나 런타임에 리플렉션(Reflection)을 사용할 필요가 없습니다.

<br>
