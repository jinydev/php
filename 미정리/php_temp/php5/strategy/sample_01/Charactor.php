<?php
/**
 * 객체를 딜리게이트 처리하여 호출합니다.
 */
class Charactor
{
    // 추상적인 접근점
    private $_delegate;

    // 무기 교환 패턴
    public function setWeapon(Weapon $weapon)
    {
        echo "무기를 교환합니다.\n";
        $this->_delegate = $weapon;
    }

    public function attact()
    {
        if ($this->_delegate == NULL) {
            // 무기가 선택되지 않은 경우
            echo "맨손 공격합니다.\n";
        } else {
            // 델리게이트
            $this->_delegate->attact();
        }        
    }
}