---
layout: php
breadcrumb:
- setup
- env
- ini
- error
---

# 오류 화면 출력
---
다음 php.ini 내용은 오류 화면 출력을 관리하는 설정입니다.  

```ini
;   Default Value: On
;   Development Value: On
;   Production Value: Off
```

Default Value: On 주석을 해제하면 PHP에서 오류가 발생되었을 때 메시지를 화면에 출력합니다. 테스트 중일 때는 쉽게 디버깅을 위해서 켜는 것이 편하겠지만 실제 서비스할 때는 끄는 것이 좋습니다.  

<br>