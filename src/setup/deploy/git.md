---
layout: php
title: Git 소스 제어를 활용한 코드 이력 배포 및 롤백 가이드
description: "Git 버전 관리 시스템과 GitHub Actions를 연동하여 실서버 무중단 배포 환경을 자동화하고, 장애 발생 시 1초 만에 안정 버전으로 되돌리는 롤백(Rollback) 메커니즘을 배웁니다."
keyword: "git 배포, git 롤백, github actions php, git hook 배포, php 무중단 배포, 심볼릭 링크 배포"
breadcrumb:
- setup
- deploy
- git
---

# Git 기반 버전 제어 배포 및 신속 롤백
---
현대적인 웹 서비스 개발에서는 코드의 무작위 업로드를 금기시합니다. 대신 소스코드 버전 제어 시스템인 **Git**을 중심축으로 두고 배포를 지휘합니다. 

Git 기반 배포 방식을 수립하면 모든 배포 기록이 특정 커밋 ID(Commit Hash) 단위로 기록되며, 비상 장애 상황 발생 시 복잡한 파일 재업로드 공정 없이 **단 한 줄의 명령만으로 1초 만에 이전 안정 상태로 시스템 전체를 롤백(Rollback)**할 수 있습니다.

<br>

### 1. Git 기반 CI/CD 배포 및 롤백 흐름
---
아래 다이어그램은 로컬 개발 PC에서 Push된 코드가 원격 리포지토리 및 CI/CD 빌드를 거쳐 실서버의 신규 배포(Releases) 디렉터리로 적재되고, 웹 루트가 심볼릭 링크(Symbolic Link) 변경을 통해 무중단으로 스위칭되는 구조와 롤백의 관계를 나타냅니다.

![Git 배포 및 롤백 흐름도](./img/git_deploy_flow.svg)

<br>

### 2. 가벼운 배포 환경 구축: Git Hooks (`post-receive`)
---
CI/CD 툴을 사용하지 않는 소규모 VPS 환경의 경우, 서버 내부에 베어(Bare) 저장소를 개설하고 커밋이 감지되었을 때 작동할 후처리 스크립트 파일인 **`post-receive`** 파일을 작성하여 배포를 자동화할 수 있습니다.

#### 🔗 서버 측 Bare 저장소 생성 및 Hook 파일 작성
```bash
# 1. 서버 원격지에 빈 Git Bare 저장소 개설
mkdir -p /var/git/myapp.git
cd /var/git/myapp.git
git init --bare

# 2. 훅 스크립트 작성 (hooks/post-receive)
cat << 'EOF' > hooks/post-receive
#!/bin/bash
# 배포 대상 실물 웹 디렉터리 경로 설정
TARGET="/var/www/html"
GIT_DIR="/var/git/myapp.git"

echo "=== 시작: 서버 디렉터리로 실시간 파일 추출 ==="
git --work-tree=$TARGET --git-dir=$GIT_DIR checkout -f
echo "=== 완료: 배포 추출 성공! ==="
EOF

# 3. 훅 실행 권한 부여
chmod +x hooks/post-receive
```
개발자는 로컬 PC에서 원격 주소를 `git remote add production username@ip:/var/git/myapp.git`와 같이 서버 Bare 저장소로 잡고 `git push production main`을 날리기만 하면 코드가 서버에 자동으로 추출 배치됩니다.

<br>

### 3. 상용 인프라 배포 자동화: GitHub Actions
---
전문적인 상용 배포에서는 GitHub에 소스를 push하면 내부 스케줄링 머신이 동작하여 린트 검증(Linting), 단위 테스트(PHPUnit)를 돌린 뒤 배포 성공 파일 세트만을 운영 서버로 밀어주는 CI/CD 프로세스를 구현합니다.

#### 🔗 GitHub Actions 설정 구성 예시 (`.github/workflows/deploy.yml`)
```yaml
name: Deploy PHP App to Production

on:
  push:
    branches: [ main ] # 메인 브랜치에 코드가 push될 때만 트리거

jobs:
  build-and-deploy:
    runs-on: ubuntu-latest
    steps:
    - name: 1. 소스 코드 가져오기
      uses: actions/checkout@v3

    - name: 2. PHP 구문 에러 사전 린트(Lint) 검증
      run: |
        find src/ -name "*.php" -print0 | xargs -0 -n 1 -P 4 php -l

    - name: 3. Composer 의존성 패키지 복원
      run: composer install --no-dev --optimize-autoloader

    - name: 4. SSH 원격 접속 및 보안 파일 이송 (Rsync)
      uses: easingthemes/ssh-deploy@main
      env:
        SSH_PRIVATE_KEY: ${ { secrets.SERVER_SSH_KEY } }
        ARGS: "-rlgoDzvO --delete"
        SOURCE: "src/"
        REMOTE_HOST: ${ { secrets.SERVER_IP } }
        REMOTE_USER: "ubuntu"
        TARGET: "/var/www/html"
```

<br>

### 4. 실전! 무중단 배포 및 즉각 롤백 전략
---

#### 1) 배포 버전 하드웨어 롤백
배포 완료 직후 치명적인 화이트스크린(WSD) 오류나 데이터베이스 커넥션 풀 에러가 났을 때, 이전 안정 버전의 Commit ID 해시값을 활용해 시스템 전체 소스를 초고속으로 복원할 수 있습니다.
```bash
# 운영서버의 웹 디렉터리에서 이전의 정상 작동했던 특정 커밋 시점으로 소스 강제 원복
git reset --hard v1.0.4

# 만약 현재 브랜치 전체를 뒤집고 싶다면, 로컬 복원 후 강제 push
git push origin main --force
```

#### 2) 심볼릭 링크(Symbolic Link) 스위칭 배포
`git reset` 방식도 수 밀리초 동안 파일 쓰기 락(Lock)이 걸려 웹사이트 로딩 지연이 발생할 수 있습니다. 이를 방지하기 위해 배포 디렉터리를 버전별로 완전히 독립하여 업로드해 둔 뒤, 완벽히 전송이 완료된 시점에 리눅스의 **심볼릭 링크** 조작 명령을 사용하여 타겟 경로만 즉시 전환시키는 **무중단 배포** 방식을 활용합니다.

```bash
# 1. 새 폴더에 최신 코드 업로드 및 라이브러리 빌드 (사용자는 이전 버전 폴더를 바라보고 있어 다운타임 없음)
mkdir -p /var/www/releases/v2.0
cp -r ./new-code/* /var/www/releases/v2.0/

# 2. 업로드가 정상 종료되면 심볼릭 링크를 새 경로로 1ms 만에 스위칭
ln -sfn /var/www/releases/v2.0 /var/www/html

# 3. 만약 v2.0에 즉시 오류가 확인되면, 단 1줄의 명령으로 v1.0으로 즉시 롤백 스위칭
ln -sfn /var/www/releases/v1.0 /var/www/html
```

<br>

---

다음 단계에서는 코드 자체뿐 아니라 OS 환경설정, 컴파일러 라이브러리 의존성까지 하나의 가상 이미지로 묶어 배포 및 스위칭을 규격화하는 **Docker 기반 컨테이너 배포 방식**을 배웁니다.

- **다음 학습**: [Docker 기반 컨테이너 배포 및 롤링 업데이트](docker.md)
