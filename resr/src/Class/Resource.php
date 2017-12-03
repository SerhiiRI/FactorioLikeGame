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
    private $ResourceType;
    private $ResourceValue;

    public function __construct($type = "", $value = "")
    {
        $this->ResourceType = $type;
        $this->ResourceValue = $value;
    }

    public function getResourceType()
    {
        return $this->ResourceType;
    }

    public function getResourceValue()
    {
        return $this->ResourceValue;
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

    public function __call($name, $arguments)
    {
        // TODO: Implement @method __view__Generate is
        // TODO: Implement @method __view__Change method
        // TODO: Implement @method __view__ReturnParamert return
    }
}