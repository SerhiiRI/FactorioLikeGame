<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 03.11.17
 * Time: 12:25
 */

namespace Controller;


/**
 * @method __view__Generate is
 * @method __view__Change method
 * @method __view__ReturnParamert return
 */
class Map implements GraficView
{
    private $factoryCollecion = array();
    public function __construct()
    {
        $this->factoryCollecion = new Factory(
            "resource exploration",
            0,
            "./img/kopalnia.jpg",
            new Resource("woda", 10),
            1);
    }

    public function __view__Generate()
    {
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