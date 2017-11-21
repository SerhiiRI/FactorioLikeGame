<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 21.11.17
 * Time: 0:41
 */

class InGameSQLException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public
    function __toString()
    {
        $errorMessage="<div style='background: red; font-size: 20px; font-family: monospace; color: #FFFFFF; margin: 30px; padding: 40px;'>";
        $errorMessage= $errorMessage."<p> Class of error - ".__CLASS__ . ": [{$this->code}];<br> Message - {$this->message}; <br> On line - {$this->line} \n</p>";
        $errorMessage=$errorMessage."</div>";
    }

}