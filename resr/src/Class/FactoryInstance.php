<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 07.12.17
 * Time: 2:46
 */

namespace Controller;


class FactoryInstance
{

    private $idFactoryInstance;
    private $idResource;
    private $Upgrade;
    private $idUser;

    public function __construct($idFactoryInstance, $idResource, $Upgrade, $idUser)
    {
        $this->idFactoryInstance = $idFactoryInstance;
        $this->idResource = $idResource;
        $this->Upgrade = $Upgrade;
        $this->idUser = $idUser;
    }


    public function getidFactoryInstance(){
        return $this->idFactoryInstance;
    }
    public function getidResource(){
        return $this->idResource;
    }
    public function getUpgrade(){
        return $this->Upgrade;
    }
    public function getidUser(){
        return $this->idUser;
    }
}