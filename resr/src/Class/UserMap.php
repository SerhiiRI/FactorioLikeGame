<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 07.12.17
 * Time: 2:50
 */

namespace Controller;


class UserMap
{
    private $idUserMap;
    private $idUser;
    private $idFactory;
    private $CountFactory;

    public function __construct($idUserMap, $idUser, $idFactory, $CountFactory)
    {
        $this->idUserMap = $idUserMap;
        $this->idUser = $idUser;
        $this->idFactory = $idFactory;
        $this->CountFactory = $CountFactory;
    }

    public function getidUserMap(){
        return $this->idUserMap;
    }
    public function getidUser(){
        return $this->idUser;
    }
    public function getidFactory(){
        return $this->idFactory;
    }
    public function getCountFactory(){
        return $this->CountFactory;
    }
}