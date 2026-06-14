---
layout: php
title: AWS 클라우드 환경의 PHP 인프라 구축 가이드
description: "Amazon Web Services(AWS) 상에서 EC2 인스턴스를 프로비저닝하고, 보안 그룹(Security Group) 설정, Managed RDS MySQL 데이터베이스 격리 설계 및 PHP DB 접속 연동을 완성하는 3-Tier 아키텍처를 해설합니다."
keyword: "AWS php, aws ec2 php setup, RDS mysql 연동, aws 보안그룹 설정, php rds 연결, 클라우드 php 환경"
breadcrumb:
- setup
- server
- aws
---

# AWS 클라우드 환경의 PHP 인프라 구축 가이드
---
퍼블릭 클라우드인 **AWS(Amazon Web Services)** 환경에 PHP 웹 서비스를 런칭할 때는 단순히 단일 서버 내에 모든 패키지를 우겨넣는 모놀리식 방식을 지양해야 합니다. 

컴퓨팅 엔진(EC2)과 데이터베이스 레이어(RDS)를 프라이빗 가상 네트워크(VPC)망 상에서 명확히 분리하고 보안그룹(Security Group) 제어 장벽을 조율하는 것이 표준 **3-Tier 고가용성 클라우드 아키텍처**의 정석입니다.

이 가이드에서는 AWS 클라우드 환경에서 EC2 인스턴스 기동부터 보안망 구성, Managed RDS 연동까지 이르는 인프라 구축 단계를 상세히 배웁니다.

<br>

### 1. AWS 3-Tier 클라우드 연동 아키텍처 개요
---
클라이언트는 80/443 포트로 EC2 인스턴스에만 직접 접속할 수 있고, 중요 데이터가 적재된 RDS 데이터베이스 서버는 프라이빗 도메인으로 격리되어 오직 EC2 컴퓨터에서만 접근이 가능하도록 통제하는 것이 핵심 보안 모델입니다.

- **EC2 (Web Server & Web Application)**: Public 서브넷에 위치하며 사용자 브라우저 요청(HTTP/HTTPS)을 대기합니다.
- **RDS (Database Engine)**: Private 서브넷에 격리 배포되며, 외부 인터넷 대역(`0.0.0.0/0`)의 침투 시도를 원천 차단합니다.

<br>

### 2. 단계별 AWS 인프라 구성 절차
---

#### 단계 1: EC2(Elastic Compute Cloud) 가상 인스턴스 생성
1. AWS 관리 콘솔에 로그인하고 **EC2 대시보드**로 진입합니다.
2. **[인스턴스 시작]** 단추를 클릭합니다.
3. **OS 이미지 선택**: 안정성이 보장된 **Ubuntu Server 24.04 LTS** 혹은 AWS 공식 빌드 최적화 머신인 **Amazon Linux 2023 (AL2023)**을 선별합니다.
4. **인스턴스 유형**: 소형 웹 테스트용으로 프리티어 제공 규격인 `t3.micro` 혹은 `t2.micro`를 체크합니다.
5. **키 페어(Key Pair)**: EC2 쉘 터미널에 SSH 암호화 원격 접속하기 위한 개인키 파일(`.pem`)을 새로 발급받아 안전한 호스트 PC 경로에 저장해 둡니다.

#### 단계 2: EC2 방화벽 설정 (보안 그룹)
사용자 웹 접속 및 개발자 관리 제어를 위해 인바운드(Inbound) 수신 규칙을 명시적으로 개방합니다.
- **SSH (22번 포트)**: 보안상 전 세계 개방을 금지하고, 개발자의 **내 IP(My IP)**로부터만 접속을 허용합니다.
- **HTTP (80번 포트)**: 웹 브라우저 서비스를 위해 전 세계 대역(`0.0.0.0/0`) 개방.
- **HTTPS (443번 포트)**: SSL 보안 웹 연결을 위해 전 세계 대역(`0.0.0.0/0`) 개방.

#### 단계 3: AWS Managed RDS(Relational Database Service) 생성
데이터베이스는 EC2 내부 로컬 디스크에 탑재하지 않고 고가용성 및 스냅샷 백업이 관리되는 RDS 데이터베이스 인스턴스를 별개로 생성합니다.
1. **RDS 대시보드**로 이동해 **[데이터베이스 생성]**을 클릭합니다.
2. **엔진 옵션**: **MySQL** 또는 **MariaDB**를 선택합니다.
3. **템플릿**: 프리티어 혹은 개발용 사양을 체크합니다.
4. **마스터 사용자 설정**: 데이터베이스 계정명(`root` 또는 `admin`)과 강력한 마스터 비밀번호를 기입합니다.
5. **연결 설정**: 외부 연결을 제한하기 위해 **퍼블릭 액세스 가능성(Public Accessibility)** 옵션을 반드시 **"아니요(No)"**로 체크하여 외부 노출을 영구 차단합니다.

#### 단계 4: RDS 전용 보안 그룹 통제 (가장 중요)
RDS의 데이터베이스 방화벽 수신 규칙은 다음과 같이 극도로 타이트하게 설정해야 합니다.
- **인바운드 규칙**: **MySQL/Aurora (3306 포트)** 선택.
- **소스**: IP 주소 대신 **[단계 2]에서 생성한 EC2 인스턴스의 보안 그룹 ID(sg-xxxxxxxx)**를 소스로 입력합니다.
- **의의**: 이렇게 엮어두면, 전 세계 그 어떤 장치나 해커도 RDS의 3306 포트에 접근할 수 없으며, 오직 지정된 내 EC2 웹서버 서버의 네트워크 트래픽만 통과할 수 있게 됩니다.

<br>

### 3. EC2 서버 터미널 접속 및 PHP 패키지 연동
---
인프라 셋업이 끝나면 로컬 PC 터미널에서 EC2에 SSH 접속을 한 뒤 DB 드라이버 패키지를 이식하여 서비스를 매핑합니다.

```bash
# 1. 로컬에서 EC2 인스턴스로 원격 접속 (키 페어 권한을 400으로 좁혀둔 후 실행)
chmod 400 my-key.pem
ssh -i "my-key.pem" ubuntu@ec2-xxx-xxx-xxx-xxx.compute-1.amazonaws.com

# 2. EC2 내부에서 PHP 패키지 및 PDO MySQL 데이터베이스 모듈 탑재
sudo apt update
sudo apt install -y php8.3 php8.3-cli php8.3-fpm php8.3-mysql

# 3. 데이터베이스 드라이버 연결 상태 검증
php -m | grep mysql # pdo_mysql 모듈이 로드되었는지 확인
```

<br>

### 4. PHP 데이터베이스 연결 정보 설정 기법
---
PHP 소스코드에서 데이터베이스 접속 정보를 설정할 때, 절대 호스트 주소를 `localhost`나 `127.0.0.1`로 적으면 안 됩니다. RDS 대시보드의 **연드포인트(Endpoint)**로 발급된 긴 문자열 DNS 도메인 주소를 타겟팅해야 합니다.

```php
<?php
// PHP PDO 데이터베이스 원격 RDS 연결 예시
$host = 'myapp-db.crwxxxxxxxxx.us-east-1.rds.amazonaws.com'; // AWS RDS 엔드포인트 DNS 주소
$db   = 'myapp_db';
$user = 'admin';
$pass = 'rds_secure_password_here';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
     echo "AWS RDS 클라우드 DB 연결 성공!";
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
```
이 접속 정보를 `.env` 환경 변수 파일에 기재하여 보안 격리를 완료하고, EC2 웹서버에서 작동시키는 것이 AWS 인프라 배포의 기본 토대입니다.
