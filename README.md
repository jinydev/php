# 프로젝트 초기화 가이드 (README.md)

## 💡 프로젝트 개요
이 리포지토리는 지킬로(Jekyll) 기반으로 구축되는 모던 PHP 프로그래밍 온라인 강좌 사이트입니다. 사용자들은 PHP 기초부터 객체지향, 패키지 관리(Composer) 및 설계 디자인 패턴까지 모던 PHP 개발자의 역량을 단계별 로드맵에 따라 습득하게 됩니다.  
실제 빌드되어 서비스되는 사이트는 **[php.jiny.dev](https://php.jiny.dev)** 입니다.

## 🛠️ 환경 설정 및 구축 방법
1.  **Prerequisites:**
    *   Ruby (Jekyll 사용을 위해 필요)
    *   Ruby Gems (Bundler)
    *   PHP (테스트 및 코드 예제 실행을 위해 필요)
    *   Node.js (Bootstrap 등 의존성 관리를 위해 필요)
2.  **Local Setup:**
    *   `gem install bundler`
    *   `bundle install`
    *   `npm install`
    *   `bundle exec jekyll serve`
3.  **Site Build:**
    *   `bundle exec jekyll build`  
    *빌드된 결과물은 `docs/` 디렉토리에 저장되며, GitHub Pages를 통해 [php.jiny.dev](https://php.jiny.dev)로 배포됩니다.*
4.  **Content Structure:**
    *   `src/`: 소스 코드가 위치하는 디렉토리
    *   `src/_layouts/`: 페이지 레이아웃 템플릿 (bootstrap, default, docs, welcome, php 등)
    *   `src/_includes/`: 재사용 가능한 레이아웃 및 컴포넌트 (네비게이션, 브레드크럼, 페이지네이션 등)
    *   `src/assets/`: 이미지, CSS, JS 등의 정적 파일
    *   `src/_data/`: 카테고리별 커리큘럼 및 메뉴 정의 파일 (navigation.yml, basic.yml, setup.yml 등)

## 👤 기여자 가이드라인
*   모든 콘텐츠는 교육적 정확성을 최우선으로 합니다.
*   기초부터 시작해 절차적 함수, OOP, 그리고 디자인 패턴 및 프레임워크로 심화되는 논리적 연결성을 준수합니다.
*   코드 예제는 모던 PHP 문법을 준수하며, 적절한 주석과 실행 결과를 포함해야 합니다.