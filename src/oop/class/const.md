---
layout: php
title: "PHP"
keyword: "jinyphp, php"
breadcrumb:
- "oop"
- "class"
- "const"
---

# 클래스 상수 (Class Constants)
---
**클래스 상수(Class Constant)**는 객체 인스턴스마다 할당되지 않고, 클래스 범위 자체에 단 하나만 정의되어 변하지 않는 고정 값을 보관하는 용도로 사용됩니다. 

PHP 버전이 진화하면서 상수의 접근 제어(가시성) 및 타입 안전성을 강제할 수 있는 강력한 기능들이 차례로 내장되었습니다. 각 상세 규칙과 지원 버전을 배웁니다.

<br>

## 1. 클래스 상수 정의와 참조 방식
---
클래스 내부에 `const` 키워드를 사용하여 상수를 정의합니다. 일반 변수와 달리 앞에 `$` 기호가 없으며 관례상 대문자로 명명합니다. 

인스턴스 생성(`new`) 없이도 클래스 이름 뒤에 범위 정의 연산자(이중 콜론, `::`)를 붙여 직접 접근 가능합니다.

```php
class Language {
    const ENGLISH = "en";
    const KOREAN = "ko";
}

// 1. 클래스 외부에서 호출 (인스턴스 생성 없이 직접 참조)
echo Language::KOREAN; // "ko" 출력

// 2. 클래스 내부 메서드 안에서 호출 (self 키워드 사용)
class LanguageHelper {
    const DEFAULT_LANG = 'ko';

    public function getDefault(): string {
        return self::DEFAULT_LANG;
    }
}
```

<br>

## 2. 클래스 상수 접근 제어 (Constant Visibility) — [PHP 7.1+]
---
PHP 7.0 이전의 클래스 상수는 무조건 `public` 지시어로 선언된 것으로 간주하여 외부에서 제한 없이 누구나 읽을 수 있었습니다.

**PHP 7.1부터는** 상수의 선언부 앞에 `public`, `protected`, `private` 접근 제어자를 부착하여 상수의 참조 유효 범위를 엄격히 차단할 수 있게 되었습니다.

```php
class Database {
    // 외부 전체 오픈
    public const PORT = 3306;
    
    // 이 클래스 본인 및 상속(자식) 클래스 메서드 내부에서만 사용
    protected const DRIVER = 'mysql';
    
    // 이 클래스 본인의 메서드 내부에서만 비밀스럽게 사용
    private const PASSWORD = 'super-secret-password';
}

echo Database::PORT; // 3306 (허용)
// echo Database::PASSWORD; // ❌ 에러! Fatal error: Cannot access private const Database::PASSWORD
```

<br>

## 3. 타입이 정의된 클래스 상수 (Typed Class Constants) — [PHP 8.3+]
---
상수의 값이 상속 관계나 코드 갱신 과정에서 엉뚱한 성격의 데이터 타입으로 변경되어 예기치 못한 타입 에러를 일으키는 현상을 방어하기 위해 **PHP 8.3부터는 클래스 상수의 데이터 타입을 명시적으로 지정(Typed Constants)**할 수 있습니다.

```php
class Application {
    // 상수 이름 앞에 데이터 타입을 명시합니다.
    public const string VERSION = "2.1.0";
    protected const int MAX_CONNECTIONS = 50;
    private const float PI = 3.14159;
}

class CustomApp extends Application {
    // ❌ 에러! 부모 클래스 Application에서 int로 정의한 상수를 자식 클래스에서 string으로 오버라이딩 시도함
    // public const string MAX_CONNECTIONS = "unlimited"; 
}
```

상수 타입의 특징:
1. 부모 클래스에서 지정한 상수의 타입을 자식 클래스가 맘대로 변경할 수 없어 타입 일관성이 보장됩니다.
2. 지정된 타입과 런타임에 대입된 실제 값의 타입이 불일치하는 경우 컴파일 오류(`TypeError`)가 즉각 발생하여 코드 신뢰성을 크게 제고합니다.

<br><br>
