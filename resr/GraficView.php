<?php
/**
 * Created by PhpStorm.
 * User: Aleks
 * Date: 23.10.17
 * Time: 14:37
 */

namespace Controller;

/**
 * Interface GraficView
 * @package Controller
 * Interface add to class graphical representation, using method;
 * all of methods in this Interface used start prefix: __view__<method>;
 * @method __view__Generate is constructor to HTML/CSS representation of class;
 * @method __view__Change method to change view;
 * @method __view__ReturnParamert return parametry.
 */
interface GraficView
{
    public function __view__Generate();
    public function __view__Change(array $param);
    public function __view__ReturnParametr();
}