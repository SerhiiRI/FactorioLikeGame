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
include_once(dirname(__FILE__)."/MySQLController.php");
include_once(dirname(__FILE__)."/../Class/Resource.php");


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


    //funkcja tworzy konstruktora, gdy go nie ma
    public static function getInstance(){
        if(empty(self::$instance))
            self::$instance = new self();
        return self::$instance;
    }

    public function updateProductUnit(string $nameOfResource, int $newProductiveUnit, string $IMG){
        $this->__dataBase__controller->__Admin__ResourcesUpdate($nameOfResource, $newProductiveUnit, $IMG);
    }

    //Usuwa sórowca o podanej nazwie;
    public function deleteResource($name){
        $id = $this->searchID($name);
        if($id != null)
            $this->__dataBase__controller->__Admin__ResourcesRemove($id);
    }

    //Zwraca Tablice objektów Resource;
    public function getResourceList(){
        if (!empty($this->ResourceList)) return $this->ResourceList;
        return null;
    }

//=============================================================//

    private function __construct()
    {
        //Constructor klasy;
        //pobierania danych z MySQLController-a
        $this->__dataBase__controller = MySQLController::getInstance();

        //Wypelnienia tablicy objektami Resource
        $this->set($this->__dataBase__controller->__Admin__ResourcesQuery());

    }
    private function set(array $sql_resources){
        /*
         *
         * Metoda twożę pola ResourceList,
         * wypelniająć ją objektami typu
         * Resource;
         *
         */
        unset($this->ResourceList);
        foreach ($sql_resources as &$rsr) {
            //$idResources, $Resource, $ProductiveUnit, $FactoryName, $IMG, $IMGFac
            $this->ResourceList[] = new Resource($rsr["idResources"], $rsr["Resource"], $rsr["ProductiveUnit"], $rsr["FactoryName"], $rsr["IMG"], $rsr["IMGFac"]);
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
    public function update($Resource, $ProductionUnit, $IMG, $IMGFac){
        $this->__dataBase__controller->__Admin__ResourcesUpdate($Resource, $ProductionUnit, $IMG, $IMGFac);
        $this->set($this->__dataBase__controller->__Admin__ResourcesQuery());
    }
    public function remove_ALL(){

        $this->set($this->__dataBase__controller->__Admin__ResourcesQuery());
    }

    private function searchID($name){
        /**
         *
         * wyszukiwania id, o nazwie sórowca;
         *
         */
        foreach ($this->ResourceList as &$item){
            if ($item->getResourceName() == $name) return $item->getId();
        }
        return null;
    }

}