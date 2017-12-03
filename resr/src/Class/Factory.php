<?php

/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 23.10.17
 * Time: 0:37
 */

namespace Controller;

/**
 * Class Factory
 * @package Controller
 * @method __view__Generate is
 * @method __view__Change method
 * @method __view__ReturnParamert return
 */
class Factory implements GraficView
{
    /**
     * <p>This type of variables used to graphic view in HTML/CSS</p>
     * @var IMG is a path to image in /resr/img/;
     * @var Type is a data of type factory;
     * @var inMapLocation is a Index of view-position;
     */
    private $IMG;
    private $Type;
    private $inMapLocation;

    /**
     * @var resourceType is a instance of /Controller/Resource class for define Type of factory;
     * @var upgradeLevel is a int value, which have calculate user resource-oriented score;
     * @var resourceScore is a calculate value for adding to main user statistic;
     */

    private $resourceType;
    private $upgradeLevel;
    private $resourceScore;

    /**
     * Factory constructor.
     * @param string $typeOfFactory
     * @param string $indexLocationOnWebPage
     * @param string $IMG
     * @param Resource $resourceType
     * @param int $upgradeLevel
     */
    public function __construct($typeOfFactory = "kopalnia",
                                $indexLocationOnWebPage = "",
                                $IMG = '/resr/img',
                                Resource $resourceType,
                                $upgradeLevel = 0)
    {
        $this->IMG = $IMG;
        $this->Type = $typeOfFactory;
        $this->inMapLocation = $indexLocationOnWebPage;
        $this->resourceType = $resourceType;
        $this->upgradeLevel = $upgradeLevel;
        $this->upgrade();
    }

    /**
     * <p>Function calculate resource mining by Factory</p>
     */
    public function upgrade(){
        $this->upgradeLevel += 1;
        $this->resourceScore = $this->upgradeLevel * $this->resourceType->getResourceValue();
    }

    private function __view__PramReturn(){
        return array($this->Type, $this->inMapLocation, $this->IMG);
    }

    private function __view__ParamLocation($Location){
        $this->inMapLocation = $Location;
    }

    private function __view__ParamIMG($Location){
        $this->inMapLocation = $Location;
    }

    public function __view__Generate()
    {
        // TODO: Implement __view__Generate() method.
    }

    public function __view__Change(array $param)
    {
        // TODO: Implement __view__Change() method.
    }

    public function __view__ReturnParametr()
    {
        // TODO: Implement __view__ReturnParametr() method.
    }
}