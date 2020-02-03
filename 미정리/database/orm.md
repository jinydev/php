---
layout: post
permalink: /database/orm/
---

# ORM
ORM을 관계형 메퍼(object relation mapper) 라고도 합니다.

다양한 오픈소스 ORM 라이브러리들이 존재합니다.
* 독트린
* 프로펠
* 리드빈PHP

ORM은 객체를 이용하여 코드를 작성을 합니다.

## 엔티티 클래스
엔티티(entity) 클래스란 데이터베이스의 테이블의 레코드와 직접 매칭되는 클래스를 말합니다.

```php
class EntityAuthor
{
    public $id;
    public $name;
    public $email;
    public $password;
}
```

따라서, DB 테이블의 컬럼이 추가될때는 엔티티 클래스의 새로운 프로퍼티 변수도 같이 추가를 해주어야 합니다.

최신의 ORM 라이브러리는 이러한 테이블과 클래스의 매칭의 구조를 자도으로 처리할 수 있는 별도의 도구들을 제공하고 있습니다.
이를 위해서 테이블로 클래스를 생성하거나, 클래스를 이용하여 테이블 스키마를 생성할 수 있습니다.


보통 엔티티 클래스는 데이터베이스 테이블 마다 만들어 사용을 합니다.