<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 04.12.17
 * Time: 23:11
 */
namespace Controller;

class ResourceController
{
    private $ResourceList =  array();
    static private $instance = null;
    private $something;

    public static function getInstance(){
        if(empty(self::$instance))
            self::$instance = new self();
    }

    private function __construct()
    {
        $this->something = MySQLController::getInstance();
        $this->setResourceList($this->something->__Admin__QuestionQuery());
    }

    private function setResourceList(array $sql_resources){
        foreach ($sql_resources as &$rsr) {
            $this->ResourceList[] = new Resource($rsr["idResources"], $rsr["Resource"], $rsr["ProductionUnit"]);
        }
        return null;
    }

    public function safeAllChanges(){
        foreach($this->ResourceList as &$item) $this->something->__Admin__ResourcesUpdate($item->getResource(), $item->getProctionUnit());
    }

}