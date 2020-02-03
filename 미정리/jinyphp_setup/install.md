---
layout: default
title: 지니프레임웍
subtitle: installation

tree: /setup
---

## 지니인스톨러
---

지니PHP는 라라벨 인스톨러와 유사한 별도의 전용 설치 프로그램을 제공합니다. 설치 프로그램은 컴포저를 통하여 글로벌로 설치하시면 실행 위치에 상관 없이 새로운 프로젝트를 생성할 수 있습니다.

다음과 같이 콘솔창에서 입력을 합니다:

```php
$ composer global require jinyphp/installer
```

컴포저 명령어를 실행할때, 설치된 컴포저의 환경 path가 같이 설정이 되어 있어야 합니다. 만일 설정이 되어 있지 않으면 설치된 경로까지 같이 입력을 해주어야 합니다.

명령을 실행하면 다음과 같이 설치가 진행이 됩니다.
```php
Changed current directory to C:/Users/infoh/AppData/Roaming/Composer
Using version ^0.0.1 for jinyphp/installer
./composer.json has been updated
Loading composer repositories with package information
Updating dependencies (including require-dev)
Package operations: 1 install, 0 updates, 0 removals
  - Installing jinyphp/installer (0.0.1): Downloading (100%)
Writing lock file
Generating autoload files
```

컴포저를 통하여 글로벌 설치를 하게 되면 `C:/Users/사용자/AppData/Roaming/Composer` 경로에 파일들이 설치가 됩니다.
정상적으로 인스톨러가 설치가 된 후에는 어디에서든지 새로운 `jinyphp` 프로젝트를 생성할 수 있습니다.

<br>

## 프로젝트 생성
---

인스톨러를 사용하면 여러개의 새로운 지니 프로젝트를 생성할 수 있습니다.

```php
jiny new 프로젝트명
```

위와 같이 명령을 입력하게 되면 새로운 `프로젝트 폴더`를 생성하게 됩니다. 생성후 자동으로 깃허브를 통하여 지니프레임워크의 소스를 다운로드하게 됩니다.
다운로드가 완료되면 설치프로그램에 의해서 `composer install`명령도 자동 수행됩니다. 별도의 명령어 실행없이도 추가 의존성 패키지를 같이 설치할 수 있습니다.

<br>







