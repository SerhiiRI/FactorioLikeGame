<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 07.12.17
 * Time: 3:55
 */

namespace Controller;
include_once __DIR__."/../Class/UserMap.php";
use \Controller\UserMap;

class MapController
{
    static private $instance = null;
    private $UserMapList = array();
    private $__dataBase__controller;

    public static function getInstance(){
        if(empty(self::$instance))
            self::$instance = new self();
        return self::$instance;
    }

    private function __construct()
    {
        $_SESSION["idUser"] = "5";
        $this->__dataBase__controller = MySQLController::getInstance();
        $this->set($this->__dataBase__controller->__User__UserMapQuery($_SESSION["idUser"]));

    }
    private function set($sql_question){
        unset($this->UserMapList);
        if(!is_null($sql_question)) {
            foreach ($sql_question as $item) {
                $this->UserMapList[] = new UserMap(
                    $item["idUserMap"],
                    $item["idUser"],
                    $item["idFactory"],
                    $item["CountFactory"]
                );
            }
        }else{
            echo "NULL";
        }

    }

    public function add($idFactory){
        $this->set($this->__dataBase__controller->__User__UserMapAdd($_SESSION["idUser"], $idFactory));
        $this->set($this->__dataBase__controller->__User__UserMapQuery($_SESSION["idUser"]));

    }
    public function remove($idFactory){
        $this->set($this->__dataBase__controller->__User__UserMapRemove($_SESSION["idUser"], $idFactory));
        $this->set($this->__dataBase__controller->__User__UserMapQuery($_SESSION["idUser"]));
    }
    public function removeAll($idFactory){
        $this->set($this->__dataBase__controller->__User__UserMapRemoveAll($_SESSION["idUser"], $idFactory));
        $this->set($this->__dataBase__controller->__User__UserMapQuery($_SESSION["idUser"]));
    }
    public function queryALL(){
        if($_SESSION["UserType"]=="1"){
            $this->__dataBase__controller->__Admin__UserMapQuery();
        }
    }

    public function returnArray(){
        return (!empty($this->UserMapList))? $this->UserMapList : null;
    }

    public function returnArrayByID($id){
        try {
            foreach ($this->UserMapList as $item) {
                if ($item->getidUser() == $id) {
                    return $this->UserMapList;
                }
            }
            return null;
        }catch (\Exception $ex){

        }
    }
}