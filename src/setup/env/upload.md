---
layout: php
breadcrumb:
- setup
- env
- ini
- upload
---

# 파일 업로드
---
PHP는 HTML FORM 요소를 통해 파일 업로드가 가능합니다.  

<br>

## 허용
PHP form 태그를 사용하여 서버로 바이너리 파일을 전송 가능하게 하는 설정입니다. 
이를 가능하게 하기 위해서는 php.ini에서 `file_uploads` 속성을 `On`으로 해주어야 합니다.

```ini
file_uploads = On
```

<br>

## 파일 최대 크기
---
업로드 가능한 최대 파일의 크기를 설정합니다.  

```ini
upload_max_filesize = 40M
```

<br>

## 업로드 파일 갯수
---
파일 업로드 전송 시 최대 선택할 수 있는 개수를 설정합니다. 

```ini
max_file_uploads = 20
```
