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
final class MySQLController
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
     *
     * @var login login to mysql
     * @var passwd mysql password
     * @var PDO is instance of MySQLi class to using data.
     *
     */

    private $login;
    private $passwd;
    private $pdo;

    /**
     * @return is|MySQLController
     * <p>Creation instance of main Class</p>
     */
    public static function getInstance()
    {
        if (empty(self::$instance))
            self::$instance = new self($login = 'root', $passwd = '', $dataBaseName = 'game', $host = 'localhost');
        return self::$instance;
    }

    private function __construct($login = 'root', $passwd = '')
    {
        $this->login = $login;
        $this->passwd = $passwd;
        try
        { // przekazujemy dla interfejsa PDO ustanawia dla zdefiniowanego zdarzenia
            $this->pdo = new \PDO("mysql:host=localhost;dbname=game", $login, $passwd);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); }
        catch(PDOException $e)
        {
            echo "Error: ".$e->getMessage();
        }
    }

    private function __clone()
    {
    }

    public function disconnectDataBase()
    {
        $this->pdo=null;
    }


    public function validateUser($login, $password) {
        $prepare = $this->pdo->prepare("SELECT * FORM `User` WHERE Email=:e_mail AND Passwd=:password");
        $prepare->bindParam(":e_mail", trim($login));
        $prepare->bindParam(":password", trim($password));
        print "user login = |".trim($login)."|";
        $prepare->execute();
        if($prepare->rowCount()>0) {
            $prepare->setFetchMode(\PDO::FETCH_OBJ);
            return $prepare->fetch()->idUser();
        }
        return -1;
    }



    public function login(string $login, string $password){
            $idUser = $this->validateUser($login, $password);
            if($idUser>0) {
                ControllSession::addSesionVariable("userIdentificator", $idUser);
                return true;
            }
            else{
                return false;
            }
    }

    public function regestration(){

    }

}
