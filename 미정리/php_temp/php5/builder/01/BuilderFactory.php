<?php
class BuilderFactory
{
    // 정사진에 해당하는 설계도 객체를 담을 프로퍼티를 선언합니다.
    private $_blueprint;

    public function __construct()
    {
        echo "Direct 에 해당하는 ". __CLASS__ ."객체를 생성하였습니다.<br>";
    }

    // 청사진
    public function bluePrint(BluePrint $blueprint)
    {
        // 빌드할 객체의 인스턴스를 저장합니다.
        echo "빌드 인스턴스를 저장합니다=". get_class($blueprint). "<br>";
        $this->_blueprint = $blueprint;

        return $this;
    }

    public function build()
    {
        echo "컴퓨터를 빌드합니다.<br>";
        $this->_blueprint->setCpu();
        $this->_blueprint->setRam();
        $this->_blueprint->setStorage();
        
        echo "<br>";

        return $this;
    }

    public function getInstance(){
        return $this->_blueprint->getComputer();
    }
}