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
class Resource implements GraficView
{
    private $idResources;
    private $Resource;
    private $ProductiveUnit;
    private $IMG;

    public function __construct($idResources, $Resource, $ProductiveUnit, $IMG)
    {
        $this->idResources = $idResources;
        $this->Resource = $Resource;
        $this->IMG = $IMG;
        $this->ProductiveUnit = $ProductiveUnit;
    }

    /**
     * Getery
     */
    public function getIdResources(){
        return $this->idResources;
    }
    public function getResourceName(){
        return $this->Resource;
    }
    public function getProductiveUnit(){
        return $this->ProductiveUnit;
    }
    public function getIMG(){
        return $this->IMG;
    }
    /**
     * Setery
     */
    public function setIdResources($toChange){
        $this->idResources = $toChange;
    }
    public function setResourceName($toChange){
        $this->Resource = $toChange;
    }
    public function setProductiveUnit($toChange){
        $this->ProductiveUnit = $toChange;
    }
    public function setIMG($img){
        $this->IMG = $img;
    }

    public function __view__Generate()
    {
        $str = <<<VIEW
        <tr>
            <td>
                {$this->Resource}        
            </td>
            <td>
                {$this->ProductiveUnit}
            </td>
            <td>
                {$this->IMG}
            </td>
        </tr>
VIEW;
        return $str;
    }

    public function __view__Change(array $param)
    {
        // TODO: Implement __view__Change() method.
    }

    public function __view__ReturnParametr()
    {
        // TODO: Implement __view__ReturnParametr() method.
    }

    public function __call($name, $arguments)
    {
        // TODO: Implement @method __view__Generate is
        // TODO: Implement @method __view__Change method
        // TODO: Implement @method __view__ReturnParamert return
    }
}