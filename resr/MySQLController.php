<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 23.10.17
 * Time: 0:38
 */

namespace Controller;

/**
 * Class MySQLController
 * @package Controller
 * <p></p>
 */
class MySQLController
{
    /**
     *
     * @var $instance is instance of MySQLController class, creation as a Singleton.
     */
    static private $instance = null;

    /**
     *
     * <p>
     * Variables used for connection to MySQL Data Base,
     * </p>
     * @var login
     * @var passwd
     * @var dataBaseName
     * @var host
     * @var DB is instance of MySQLi class to using data.
     */
    private $login;
    private $passwd;
    private $dataBaseName;
    private $host;
    private $DB;

    /**
     * @return is|MySQLController
     * <p>Creation instance of main Class</p>
     */
    public static function getInstance()
    {
        if(empty(self::$instance))
            self::$instance = new self($login = 'root', $passwd = '', $dataBaseName = 'game', $host = 'localhost');
        return self::$instance;
    }

    private function __construct($login = 'root', $passwd = '', $dataBaseName = 'game', $host = 'localhost')
    {
        $this->login = $login;
        $this->passwd = $passwd;
        $this->dataBaseName = $dataBaseName;
        $this->host = $host;
        $this->connectToDataBase($login , $passwd,  $dataBaseName, $host);
    }

    private function __clone(){}

    public function connectToDataBase($login , $passwd,  $dataBaseName, $host){
        $this->DB = new mysqli($host, $login, $passwd, $dataBaseName);
        if ($this->DB->connect_errno){
            return false;
        }
        return true;
    }

    public function disconnectDataBase(){
        $this->DB->close();
    }

    public function returnQuery(string $query){
        //TODO: create a query Controller method
    }
}
