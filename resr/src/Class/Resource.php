<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 23.10.17
 * Time: 0:40
 */

namespace Controller;

/**
 * Class Resource
 * @package Controller
 * @method __view__Generate is
 * @method __view__Change method
 * @method __view__ReturnParamert return
 */
class Resource
{
    private $idResources;
    private $Resource;
    private $ProductiveUnit;
    private $FactoryName;
    private $IMG;
    private $IMGFac;

    public function __construct($idResources, $Resource, $ProductiveUnit, $FactoryName, $IMG, $IMGFac)
    {
        $this->idResources = $idResources;
        $this->Resource = $Resource;
        $this->FactoryName = $FactoryName;
        $this->IMG = $IMG;
        $this->IMGFac = $IMGFac;
        $this->ProductiveUnit = $ProductiveUnit;
    }

    public function getIdResources(){
        return $this->idResources;
    }
    public function getResourceName(){
        return $this->Resource;
    }
    public function getFactoryName(){
        return $this->FactoryName;
    }
    public function getProductiveUnit(){
        return $this->ProductiveUnit;
    }
    public function getIMG(){
        return $this->IMG;
    }
    public function getIMGFactory(){
        return $this->IMGFac;
    }

}