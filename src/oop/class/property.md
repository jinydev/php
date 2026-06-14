---
layout: php
title: "PHP"
keyword: "jinyphp, php"
breadcrumb:
- "oop"
- "class"
- "property"
---

# 프로퍼티 (Properties)
---
**프로퍼티(Property)**는 클래스 내부에 선언되어 객체의 상태(State) 데이터를 저장하는 변수를 지칭하는 객체지향 프로그래밍 용어입니다. 일반 전역/지역 변수와 구분하기 위해 멤버 변수 또는 속성이라고도 부릅니다.

PHP 버전이 거듭되면서 동적 타입의 불안정성을 해소하기 위해 프로퍼티 관련 기능들이 대대적으로 보강되었습니다. 각 기능별 지원 버전과 규칙을 상세히 학습합니다.

<br>

## 1. 기본적인 프로퍼티 선언과 접근 제어
---
프로퍼티는 클래스 내부의 메서드 바깥 영역에 선언합니다. 변수명 앞에 접근 제어자(`public`, `protected`, `private`)를 지정하여 가시성을 결정합니다. 만약 생략 시 기본값은 `public`으로 설정됩니다.

```php
class User {
    public $username = "Guest";  // 외부에서 접근 및 수정 가능
    protected $email;             // 본인 및 상속 클래스 내부에서만 접근 가능
    private $password;           // 본인 클래스 내부에서만 접근 가능
}
```

* **접근**: 인스턴스화된 객체변수 뒤에 화살표 연산자(`->`)를 붙여 프로퍼티에 접근합니다. 단, 프로퍼티 이름 앞에 `$` 기호는 붙이지 않습니다. (`$user->username`)

<br>

## 2. 타입이 정의된 프로퍼티 (Typed Properties) — [PHP 7.4+]
---
PHP 7.4 이전에는 프로퍼티 선언 시 타입을 명시할 수 없었기에 엉뚱한 타입의 데이터가 바인딩되는 런타임 오류가 빈번히 발생했습니다. 

**PHP 7.4부터는** 프로퍼티 선언부 앞에 원하는 타입을 지정할 수 있게 되어 강력한 정적 타이핑 효과를 제공합니다.

```php
class Product {
    public int $id;              // 정수만 허용
    public string $name;         // 문자열만 허용
    public ?float $price = null; // float 또는 null 허용 (Nullable)
    public array $tags = [];     // 배열만 허용
}

$prod = new Product();
$prod->id = 100;
// $prod->name = [1, 2, 3]; // ❌ TypeError 발생! (배열은 string 프로퍼티에 대입 불가능)
```

<br>

## 3. 읽기 전용 프로퍼티 (Readonly Properties) — [PHP 8.1+]
---
객체 내부 상태를 생성 시점 이후에 절대 변경할 수 없도록 강제하는 불변성(Immutability) 처리가 설계상 자주 요구됩니다. 

**PHP 8.1부터는** 프로퍼티 선언 시 앞에 `readonly` 지시어를 덧붙일 수 있습니다. 읽기 전용으로 선언된 프로퍼티는 **단 한 번만 초기화(대입) 가능하며, 이후 수정하려 할 때 런타임 오류를 유발**합니다.

```php
class Book {
    // 타입 선언이 반드시 동반되어야 readonly를 지정할 수 있습니다.
    public readonly string $isbn;

    public function __construct(string $isbn) {
        $this->isbn = $isbn; // 1단계: 생성자 등을 통해 최초 1회 초기화 허용
    }
}

$book = new Book("978-3-16-148410-0");
echo $book->isbn; // 읽기 가능
// $book->isbn = "new-isbn-value"; // ❌ 에러! Fatal error: Cannot modify readonly property Book::$isbn
```

<br>

## 4. 읽기 전용 클래스 (Readonly Classes) — [PHP 8.2+]
---
클래스에 속한 모든 멤버 속성들이 전부 불변이어야 하는 DTO(Data Transfer Object) 등의 설계 패턴이 있습니다. 매번 속성마다 `readonly`를 적는 것은 번거롭습니다.

**PHP 8.2부터는** 클래스 선언 키워드인 class 앞에 `readonly`를 한 번만 선언하여 클래스 전체를 읽기 전용으로 강제할 수 있습니다.

```php
// PHP 8.2+ 읽기 전용 클래스 선언
readonly class UserDto {
    // 내부의 모든 프로퍼티는 자동으로 readonly 속성이 부여됩니다.
    public function __construct(
        public string $name,
        public int $age
    ) {}
}

$dto = new UserDto("jiny", 20);
// $dto->name = "other"; // ❌ 에러! 모든 프로퍼티 수정 시도 차단됨
// $dto->newVar = "dynamic"; // ❌ 에러! 동적 속성 추가도 차단됨
```

읽기 전용 클래스의 규칙:
1. 읽기 전용 클래스 내부의 모든 프로퍼티는 암묵적으로 `readonly`가 되며, 타입이 정의되지 않은 프로퍼티는 선언할 수 없습니다.
2. 읽기 전용 클래스 객체는 실시간으로 새로운 가변 프로퍼티를 추가(`$dto->dynamic_prop = 123`)하는 동작이 원천 차단됩니다.

<br>

## 5. 프로퍼티 훅 (Property Hooks) — [PHP 8.4+]
---
객체지향 설계에서 프로퍼티의 값을 읽거나 쓸 때 추가적인 연산이나 가공(예: 이름의 첫 글자를 대문자로 변환, 데이터 쓰기 전 유효성 검사 등)을 수행하기 위해 전통적으로 Getter와 Setter 메서드를 별도로 구현해야 했습니다. 이로 인해 보일러플레이트 코드가 크게 증가했습니다.

**PHP 8.4부터는** 프로퍼티 내부에 직접 읽기(get)와 쓰기(set) 동작을 가로채서 처리하는 **프로퍼티 훅(Property Hooks)**이 도입되었습니다.

```php
class User {
    // 프로퍼티 선언 내부에 get/set 훅을 정의합니다.
    public string $name {
        // 값을 읽을 때 실행되는 get 훅
        get => ucfirst($this->name);
        
        // 값을 쓸 때 실행되는 set 훅 ($value는 외부에서 대입한 입력값을 의미함)
        set (string $value) {
            if (strlen($value) < 2) {
                throw new InvalidArgumentException("이름은 최소 2글자 이상이어야 합니다.");
            }
            $this->name = trim($value);
        }
    }
}

$user = new User();
$user->name = "  hojin  "; // set 훅 작동: 공백 제거 후 "hojin" 저장
echo $user->name; // get 훅 작동: 첫 글자 대문자화하여 "Hojin" 출력
```

* **get/set 훅 종류**:
  * **get 훅**: 프로퍼티 값을 반환할 때 작동하며, `=>` 단축 표현식 또는 `{ return ... }` 블록을 사용할 수 있습니다.
  * **set 훅**: 프로퍼티에 값을 대입할 때 작동하며, 입력값을 가공하거나 유효성 검사(Validation)를 거쳐 백킹 변수에 저장합니다.

<br>

## 6. 비대칭 가시성 (Asymmetric Visibility) — [PHP 8.4+]
---
보통 프로퍼티의 값을 외부에서 읽을 수는 있게 하고(read-only-like), 값을 수정하는 권한은 클래스 내부나 상속 계층 내부로 제한(write-private)하고 싶을 때가 많습니다. 이를 위해서는 과거에 프로퍼티를 `private`으로 감추고 `public` Getter 메서드를 제공해왔습니다.

**PHP 8.4부터는** 읽기 가시성과 쓰기 가시성을 다르게 설정할 수 있는 **비대칭 가시성(Asymmetric Visibility)**이 도입되었습니다.

```php
class Customer {
    // 읽기(기본 가시성)는 public이고, 쓰기(set)는 private으로 설정합니다.
    public private(set) string $id;
    
    // 읽기는 public이고, 쓰기는 protected(상속 허용)로 설정합니다.
    public protected(set) string $name;

    public function __construct(string $id, string $name) {
        $this->id = $id;     // 클래스 내부이므로 쓰기(set) 가능
        $this->name = $name; // 클래스 내부이므로 쓰기(set) 가능
    }
}

$customer = new Customer("C100", "홍길동");
echo $customer->id; // 🟢 public 읽기이므로 정상 작동!
// $customer->id = "C200"; // ❌ 에러! Fatal error: Cannot modify private(set) property Customer::$id
```

<br><br>
