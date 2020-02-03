<?php
/**
 * 단계별 프로세스
 * 알고리즘 구현
 */
class Template extends Auth
{
    protected function securityCheck()
    {
        // 프로세스를 재정의 합니다.
        echo "보완을 체크합니다.\n";
        return true;
    }

    protected function authentication($id, $password)
    {
        // 프로세스를 재정의 합니다.
        echo "아이디, 비빌번호를 확인합니다.\n";
        return true;
    }

    protected function authorization()
    {
        // 프로세스를 재정의 합니다.
        echo "인증 권한을 읽어옵니다.\n";
        return "admin";
    }

    protected function connection()
    {
        // 프로세스를 재정의 합니다.
        echo "연결 성공!\n";
        return true;
    }
}