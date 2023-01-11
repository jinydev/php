---
layout: php
breadcrumb:
- setup
- linux
---

# LAMP
`LAPM`은 Linux + apache + php + mysql 의 약자 입니다.
LAPM은 리눅스 환경에서 APM 환경을 구축하는 것을 말합니다.

<br>

## 리눅스용 bitnami 설치
윈도우용과 마찬가지로 리눅스에서도 쉽게 apm 환경을 구축할 수 있도록 bitnami 패키지를 제공합니다. 
bitnami 패키지는 `wget` 명령을 통하여 다운로드 받을 수 있습니다.
또는 직접 내려 받은 경우 filezila와 같은 ftp 프로그램을 통하여 전송후, 설치를 할 수 도 있습니다.  

다음과 같이 명령을 입력받으면 최신 php 8.0이 탑제된 파일을 다운로드 받을 수 있습니다.

```
$ wget https://bitnami.com/redirect/to/1385974/bitnami-lampstack-8.0.3-0-linux-x64-installer.run
```

## 설치
다운로드 받은 bitnami lapm을 설치합니다. 

설치받은 파일을 실행이 가능하도록 권환을 변경합니다.

```
$ chmod 700 bitnami-lampstack-8.0.3-0-linux-x64-installer.run
```

다운로드 파일을 root 또는 계정모드에서 실행이 가능합니다.
root 계정으로 실행되는 경우 설치는 `/opt/[lapm-버젼]`으로 설치됩니다. 

```
# chmod 755 /opt
```

사용자 계정인 경우 홈 디렉터리에 설치가 됩니다.
따라서, root 권환으로 설치할때는 `/opt`의 퍼미션을 같이 변경해 주어야 합니다.

설치를 진행합니다.
```
# ./bitnami-lampstack-8.0.3-0-linux-x64-installer.run
```

진행화면
```
```

## 비트나미 스트립트
비트나미는 `ctlscript.sh` 파일을 제공합니다. 비트나미 LAPM으로 설치된 mysql과 apache의 상태를 확인할 수 있습니다.

```
#/opt/lampstack***/ctlscript.sh status
```

모두 시작/종료/재시작

```
#/opt/lampstack***/ctlscript.sh start
#/opt/lampstack***/ctlscript.sh stop
#/opt/lampstack***/ctlscript.sh restart
```

아파치만 재시작할 경우

```
# /opt/bitnami/ctlscript.sh restart apache
```

## 환경설정

```
lamp~/apache2/cont/httpd.conf
lamp~/php/etc/php.ini
lamp~/mysql/my.cnf
```

