---
layout: post
permalink: /database/pdo/
---

최근 프레임워크를 보면 기존의 `mysqli`보다 `pdo`를 더 많이 이용하는 추세이다.

PDO는 `PHP data objects`의 약자 입니다. PDO가 탄생하게 된 배경은 공통된 데이터베이스를 접근 하기 위해서 임.



최신의 php 코드들은 db의 테이더를 객체 클래스 형태로 접근을 하여 사용을 하는 추세이다.


pdo는 `PDO::fetch_*` 상수중의 하나의 결과를 통과 해야 한다.

모든 상수를 통과를 해야 한다면, fetchAll 함수를 사용할 수 있다.


PDO::FETCH_ASSOC: 열 이름으로 인덱스된 배열을 반환한다. 이전 예제에서 보자면 여러분은 id값을 가져올 때 $row['id']를 사용해야한다.

PDO::FETCH_NUM: 열 숫자로 인덱스된 배열을 반환한다. 이전 예제에서 보자면 첫번째 열이기 때문에 $row[0]을 사용하여 id를 얻을 수 있다.

PDO::FETCH_OBJ: 여러분의 결과에서 반환되는 열 이름에 해당하는 프로퍼티 이름으로 익명 객체를 반환한다. 예를 들어 $row->id는 id 열 값을 가지고 있다.

PDO::FETCH_CLASS: 요청된 클래스에서 명명된 프로퍼티에 결과 값 열을 매핑한 요청 클래스의 인스턴스를 반환한다. 만약 fetch_style이 PDO::FETCH_CLASSTYPE (예: PDO::FETCH_CLASS | PDO::FETCH_CLASSTYPE) 을 포함하면 클래스 이름은 첫번째 열 값에서 결정된다. 기억할지 모르지만 우리는 가장 간단한 폼 형태로 PDO가 사용자 정의 클래스로 열 이름을 매핑할 수 있다고 지적했다. 이 상수는 해당 작업을 수행할 때 사용하는 것이다.



`$statement->query()`는 쿼리를 준비하고,이를 실행하여 결과를 반환하는 작업을 일괄적으로 실행을 합니다.


# 파라미터
PDO는 명령된 파라미터와 명령되지 않은 파라미터 방식으로 사용을 할 수 있습니다.


## 명령되지 않은
`?`를 이용하여 명령되지 않은 파라미터를 사용합니다.


## fetchColumn
하나의 컬럼값만을 읽어 옵니다.






참고
https://pamooochim.blogspot.com/2016/01/pdo-php.html

