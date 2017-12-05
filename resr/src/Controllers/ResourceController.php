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
include_once(dirname(__FILE__)."../Class/Resource.php");


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
    }

    public function updateProductUnit(string $nameOfResource, int $newProductiveUnit){
        $this->__dataBase__controller->__Admin__ResourcesUpdate($nameOfResource, $newProductiveUnit);
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
        $this->setResourceList($this->__dataBase__controller->__Admin__QuestionQuery());

    }
    private function setResourceList(array $sql_resources){
        /*
         *
         * Metoda twożę pola ResourceList,
         * wypelniająć ją objektami typu
         * Resource;
         *
         */
        foreach ($sql_resources as &$rsr) {
            $this->ResourceList[] = new Resource($rsr["idResources"], $rsr["Resource"], $rsr["ProductionUnit"]);
        }
        return null;
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