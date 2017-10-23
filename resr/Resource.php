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
 */
class Resource
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

}