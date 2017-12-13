<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 04.12.17
 * Time: 23:11
 */
namespace Controller;
/**
 * MySQLController - importowanie clasy controli BD
 * Resource - importowanie klasy pojedynćzego objektu typu Resource
 */
use function PHPSTORM_META\type;

include_once __DIR__."/MySQLController.php";
include_once __DIR__."/../Class/Resource.php";


/**
 * Class ResourceController
 * @package Controller
 * this class contain method to
 * controll "resource" value in
 * Data Base:
 * |---Konstuktor pobiera dane z MySQLController-a
 * |   oraz twoży na tej podstawie tablice objektów
 * |   typu Resource;
 */
class ResourceController
{

    private $ResourceList = array();
    static private $instance = null;
    private $__dataBase__controller;
    private $ResourceListForCurrentUser = array();


    //funkcja tworzy konstruktora, gdy go nie ma
    public static function getInstance(){
        if(empty(self::$instance))
            self::$instance = new self();
        return self::$instance;
    }

    public function updateProductUnit(string $nameOfResource, int $newProductiveUnit, string $IMG){
        $this->__dataBase__controller->__Admin__ResourcesUpdate($nameOfResource, $newProductiveUnit, $IMG);
    }

    public function deleteResource($name){
        $id = $this->searchID($name);
        if($id != null)
            $this->__dataBase__controller->__Admin__ResourcesRemove($id);
    }



    private function __construct()
    {
        $this->__dataBase__controller = MySQLController::getInstance();
        $this->set($this->__dataBase__controller->__Admin__ResourcesQuery());
    }
    private function set($sql_resources){
        unset($this->ResourceList);
        if (!is_null($sql_resources)) {
            foreach ($sql_resources as $rsr) {
                $this->ResourceList[] = new Resource(
                    $rsr["idResources"],
                    $rsr["Resource"],
                    $rsr["ProductionUnit"],
                    $rsr["FactoryName"],
                    $rsr["IMG"],
                    $rsr["IMGFac"]
                );
            }
        }else{
            echo "W domu dzialalo!";
        }
        return null;
    }
    public function add($Resource, $ProductionUnit, $FactoryName, $IMG, $IMGFac){
        $this->__dataBase__controller->__Admin__ResourcesAdd($Resource, $ProductionUnit, $FactoryName, $IMG, $IMGFac);
        $this->set($this->__dataBase__controller->__Admin__ResourcesQuery());
    }
    public function removeByID($idResource){
        $this->__dataBase__controller->__Admin__ResourcesRemoveByID($idResource);
        $this->set($this->__dataBase__controller->__Admin__ResourcesQuery());
    }
    public function removeByResourceName($Resource){
        $this->__dataBase__controller->__Admin__ResourcesRemoveByName($Resource);
        $this->set($this->__dataBase__controller->__Admin__ResourcesQuery());
    }
    public function update($Resource, $ProductionUnit, $FactoryName, $IMG, $IMGFac){
        $this->__dataBase__controller->__Admin__ResourcesUpdate($Resource, $ProductionUnit, $FactoryName, $IMG, $IMGFac);
        $this->set($this->__dataBase__controller->__Admin__ResourcesQuery());
    }
    public function remove_ALL(){
        $this->set($this->__dataBase__controller->__Admin__ResourcesQuery());
    }
    public function returnArray(){
        return $this->ResourceList;
    }
    private function searchID($name){
        foreach ($this->ResourceList as &$item){
            if ($item->getResourceName() == $name) return $item->getId();
        }
        return null;
    }

    private function setUserResourceArray($idUser=-1){
        unset($this->ResourceListForCurrentUser);
        $list = ($idUser <= 0)?
            $this->__dataBase__controller->__User__UserResource($_SESSION["idUser"]):
            $this->__dataBase__controller->__User__UserResource($idUser);
        foreach ($list as $value){
            $temp = $this->searchByIDAndReturnObject($value["idResource"]);
            if(!is_null($temp)) $this->ResourceListForCurrentUser[] = $temp;
        }
    }

    public function returnArrayForCurrentUserResource($idUser){
        $this->setUserResourceArray($idUser);
        if(empty($this->ResourceListForCurrentUser)){ return null; } else{
        return $this->ResourceListForCurrentUser;}
    }

    public function searchByID($idres){
        foreach ($this->ResourceList as &$item){
            if ($item->getIdResources() == $idres) return $item->getResourceName();
        }
        return null;
    }

    public function searchByIDAndReturnObject($idres){
        foreach ($this->ResourceList as $item){
            if ($item->getIdResources() == $idres) return $item;
        }
        return null;
    }

}