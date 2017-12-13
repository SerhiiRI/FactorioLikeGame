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

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


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
//        echo "LIST ";print_r($_SESSION["idUser"]);echo "!";
        $this->set($this->__dataBase__controller->__User__FactoryInstanceQuery($_SESSION["idUser"]));
    }

    private function set($sql_question){
        if(!is_null($sql_question)) {
        unset($this->FactoryInstanceList);
            foreach ($sql_question as &$item) {
                $this->FactoryInstanceList[] = new FactoryInstance(
                    $item["idFactoryInstance"],
                    $item["idResource"],
                    $item["Upgrade"],
                    $item["idUser"]
                );
            }

        }else{
//            echo "w domu dzialo";
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
    public function returnArray()
    {

        if(!empty($this->FactoryInstanceList)) {
            return $this->FactoryInstanceList;
        }else echo "FactoryInstanceList jest pusty :'(";

//        print_r($this->FactoryInstanceList);
//        foreach ($this->FactoryInstanceList as $item){
//            echo "<pre>";
//            print_r($item);
//            echo "</pre>";
//        }
    }
    public function returnFactoryIDbyParametr($idResource, $upgradeLevel, $idUser){
        if(!empty($this->FactoryInstanceList)) {
            foreach ($this->FactoryInstanceList as $item) {
                if (($item->getidResource() == $idResource) && ($item->getidUser() == $idUser) && ($item->getUpgrade() == $upgradeLevel)){
                    return $item->getidFactoryInstance();
                }
            }
        }else return null;
    }
    public function returnFactoryByID($id){
        if(!empty($this->FactoryInstanceList)) {
            foreach ($this->FactoryInstanceList as $item) {
                if ($item->getidFactoryInstance()==$id){
                    return $item;
                }
            }
        }else return null;
    }
}