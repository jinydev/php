---
layout: php
title: "PHP 응용 프로그래밍"
breadcrumb:
- app
- board
---

# 계시판 만들기
---
계시판은 웹프로그래밍에 있어서 다양한 기능을 학습하기 위한 좋은 예제 입니다.

## 리스트 만들기

신규 생성버튼
템플릿에서 새로운 데이터를 삽입할 수 있는 링크버튼을 삽입합니다.

```html
<button id="board_new">New</button>
```

id값으로 board_new로 설정하게 되면, 자동으로 생성된 자바스크립트 함수를 통하여 url 이동을 할 수 있습니다.

```javascript
var board_new = document.getElementById('board_new');
if (board_new) {
    board_new.onclick = function () {
        location.href = '/board3/new';
    }
}
```

