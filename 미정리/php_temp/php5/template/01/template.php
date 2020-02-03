<?php
/**
 * 템플릿 매소드 추상화 클래스
 */
abstract class Auth
{
    // 하위 클래스가 재정의를 해야되기 때문에 
    // private 대신에 protected으로 설정을 합니다.
    abstract protected function securityCheck();
    abstract protected function authentication($id, $password);
    abstract protected function authorization();
    abstract protected function connection();

    // 템플릿 메소드
    public function requestConnection($str)
    {
        // 프로세스롤 실행합니다.
        echo "프로세스를 시작합니다.\n";
   
        $this->securityCheck($str); // 보완작업, 디코딩

        $id = "abcd";
        $password = "1234";
        $this->authentication($id, $password); // 인증과정

        $permit = $this->authorization(); // 인증
        switch($permit) {
            case 'admin':
                break;
            case 'manager':
                break;    
            case 'user':
                break;    
        }

        return $this->connection();
    
    }
}