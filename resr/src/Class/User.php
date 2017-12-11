<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 07.12.17
 * Time: 2:27
 */

namespace Controller;


class User
{
    private $idUser;
    private $idScore;
    private $Email;
    private $Passwd;
    private $LastLogined;
    private $Type;
    private $Level;
    private $IMG;

    public function __construct($idUser, $idScore, $Email, $Passwd, $LastLogined, $Type, $Level, $IMG)
    {
        $this->idUser = $idUser;
        $this->idScore = $idScore;
        $this->Email = $Email;
        $this->Passwd = $Passwd;
        $this->LastLogined = $LastLogined;
        $this->Type = $Type;
        $this->Level = $Level;
        $this->IMG = $IMG;
    }

    public function getidUser(){
        return $this->idUser;
    }
    public function getidScore(){
        return $this->idScore;
    }
    public function getEmail(){
        return $this->Email;
     }
    public function getPasswd(){
        return $this->Passwd;
    }
    public function getLastLogined(){
        return $this->LastLogined;
    }
    public function getType(){
        return $this->Type;
    }
    public function getLevel(){
        return $this->Level;
    }
    public function getIMG(){
        return $this->IMG;
    }

}