<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 11.12.17
 * Time: 23:08
 */

namespace Controller;
include_once __DIR__."/MySQLController.php";
include_once __DIR__."/../Class/FactoryInstance.php";

class FactoryInstanceController
{
    private $FactoryInstanceList = array();
    static private $instance = null;
    private $__dataBase__controller;

    public static function getInstance(){
        if(empty(self::$instance))
            self::$instance = new self();
        return self::$instance;
    }

    private function __construct()
    {
        $this->__dataBase__controller = MySQLController::getInstance();
        $this->set($this->__dataBase__controller->__User__FactoryInstanceQuery($_SESSION['idUser']));
    }

    private function set($sql_question){
        unset($this->FactoryInstanceList);
        if(!is_null($sql_question)) {
            foreach ($sql_question as &$item) {
                $this->FactoryInstanceList[] = new FactoryInstance(
                    $item["idFactoryInstance"],
                    $item["idResource"],
                    $item["Upgrade"],
                    $item["idUser"]
                );
            }
        }else{
            echo "w domu dzialo";
        }
    }
    public function add($idResource, $upgradeLevel, $idUser){
        $this->__dataBase__controller->__User__FactoryInstanceAdd($idResource, $upgradeLevel, $idUser);
        $this->set($this->__dataBase__controller->__User__FactoryInstanceQuery($_SESSION['idUser']));
    }
    public function removeByID($idInstance){
        $this->__dataBase__controller->__User__FactoryInstanceRemoveByID($idInstance);
        $this->set($this->__dataBase__controller->__User__FactoryInstanceQuery($_SESSION['idUser']));
    }
    public function removeByParam($idResource, $upgradeLevel, $idUser){
        $this->__dataBase__controller->__User__FactoryInstanceRemove($idResource, $upgradeLevel, $idUser);
        $this->set($this->__dataBase__controller->__User__FactoryInstanceQuery($_SESSION['idUser']));
    }
    public function upgrade($idInstance){
        $this->__dataBase__controller->__User__FactoryInstanceUpdate($idInstance);
        $this->set($this->__dataBase__controller->__User__FactoryInstanceQuery($_SESSION['idUser']));
    }
    public function queryALL(){
        if($_SESSION["UserType"]=="1"){
            $this->__dataBase__controller->__Admin__FactoryInstanceQuery();
        }
    }
    public function returnArray(){
        return $this->FactoryInstanceList;
    }
}