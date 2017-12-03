<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 23.10.17
 * Time: 0:38
 */
namespace Controller;
use PDO;
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
            self::$instance = new self('root', '');
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


    /**
     * @param $login - it regestration e-mail address
     * @param $password - its password to acount e-mail
     * @param $type - type of user login {1 - admin | 2 - gracz}
     *
     * @return $idUzytkownika of new user, or -1 if Insertion was failed;
     *
     */
    public function regestration($login, $password, $type=2, $idLevel=0, $idScore=0){
        $prepare = $this->pdo->prepare("SELECT * FROM `User` WHERE Email=:e_mail ");
        $prepare->bindParam(":e_mail", $login);
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        $idUzytkownika=-1;
        if($prepare->rowCount()<=0){
            $rejestracja = $this->pdo->prepare(" INSERT INTO User VALUES (NULL , :email, :pass, :type, :score, :userlevel) ");
            $rejestracja->bindParam(":email", $login);
            $rejestracja->bindParam(":pass", $password);
            $rejestracja->bindParam(":type", $type);
            $rejestracja->bindParam(":score", $idScore);
            $rejestracja->bindParam(":userlevel", $idLevel);
            $rejestracja->setFetchMode(PDO::FETCH_ASSOC);
            $rejestracja->execute();
            $idUzytkownika = $this->pdo->lastInsertId();
            $rejestracja->closeCursor();
        }
        else {
            $fetchOBJ = $prepare->fetch();
            return $fetchOBJ["idUser"];
        }
        $prepare->closeCursor();
        return $idUzytkownika;
    }
    public function validateUser($login, $password) {
        $prepare = $this->pdo->prepare("SELECT * FROM `User` WHERE Email=:email AND Passwd=:passwd");
        $prepare->bindParam(":email", $login);
        $prepare->bindParam(":passwd", $password);
        $prepare->execute();
        if($prepare->rowCount()>0) {
            $prepare->setFetchMode(\PDO::FETCH_ASSOC);
            return $prepare->fetch();
        }
        return -1;
    }


    public function __User__UserMapAdd(){}
    public function __User__UserMapUpdate(){}
    public function __User__UserMapRemove(){
        //TODO:
    }

    public function __User__UserScoreAdd(){}
    public function __User__UserScoreUpdate(){}
    public function __User__UserScoreRemove(){
        //TODO:
    }

    public function __User__FactoryInstanceAdd(){}
    public function __User__FactoryInstanceUpdate(){}
    public function __User__FactoryInstanceRemove(){
        //TODO:
    }

    public function __User__QuestionQuery(){}
    public function __User__TaskQuery(){}
    public function __User__FactoryQuery(){}
    public function __User__ResourcesQuery(){}

//====================================================================================================================//
//====================================================================================================================//

    /**
     * następne metody twożą interfejs do wykorzystawania poszczególnych funkcyj
     * przez użytkowanika ADMIN!
     * @return array FETCH_ASSOC or NUll
     */
    public function __Admin__UserQuery(){
        $prepare = $this->pdo->prepare("SELECT * FROM `User`");
        $prepare->bindParam(":email", $login);
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        if($prepare->rowCount()>0){
            $assocc = $prepare->fetchAll();
            return $assocc;
        }
        return null;
    }
    public function __Admin__UserAdd($login, $password, $type=2, $idLevel=0, $idScore=0){
        return $this->regestration($login, $password, $type, $idLevel, $idScore);
    }
    public function __Admin__UserUpdate($EmailToChange, $PasswordToChange){
            $prepare = $this->pdo->prepare("UPDATE `User` SET `Passwd` = ? WHERE `Email`=?");
            $prepare->bindParam(1,$PasswordToChange);
            $prepare->bindParam(2,$EmailToChange);
        /*
        $prepare->bindParam(2,$idScoreToChange);
            $prepare->bindParam(3,$levelToChange);
            */
            $prepare->execute();
            $prepare->closeCursor();

    }
    public function __Admin__UserRemove($login){
        try {
            $prepare = $this->pdo->prepare("DELETE FROM `User` WHERE Email=?");
            $prepare->bindParam(1, $login);
            $prepare->execute();
            $prepare->closeCursor();
        }catch(Exception $e){
            echo "<div style='background: red; font-size: 20px; font-family: monospace; color: #FFFFFF; margin: 30px; padding: 40px;'>";
            echo $e->getMessage();
            echo $e->getFile();
            echo $e->getLine();
            echo "</div>";
        }
    }

    /**
     * @param $idElement
     * @param $Question
     * @param array $Answer
     * @return bool
     */
    public function __Admin__QuestionQuery(){}
    public function __Admin__QuestionAdd($idElement, $Question, array $Answer){
        $prepare = $this->pdo->prepare("INSERT INTO `Question` VALUES (NULL , :question, :idresource) ");
        $prepare->bindParam(":question", $Question);
        $prepare->bindParam(":idresource", $idElement);
        $prepare->execute();
        $id_New_Added_Question = $this->pdo->lastInsertId();
        $prepare->closeCursor();
        $prepare = $this->pdo->prepare("INSERT INTO `Answer` VALUES (NULL, :idquestion, :answer, :isright)");
        foreach ($Answer as $oneAnswer) {
        $prepare->bindParam(":idquestion", $id_New_Added_Question);
        if(stripos($oneAnswer, "$")!=False){ $prepare->bindParam(":isright", $right); }
        else{ $prepare->bindParam(":isright", $right); }
        }
            /**
             * jeżeli w odpowidzi będzie znależony znaczek "$" - znaczy, że odpowiedz jest poprawna;
             * TODO: pod koniec sprawdzenia zrobić obcianania znaka dolara:
             *
             *      $oneAnswer = preg_replace('/[^\p{L}\p{N}\s]/u', '$', $oneAnswer);
             */
        $prepare->bindParam(":answer", $oneAnswer);
        return true;
    }
    public function __Admin__QuestionUpdate(){
        //TODO:
    }
    public function __Admin__QuestionRemove(){
        //TODO:
    }

    public function __Admin__FactoryQuery(){}
    public function __Admin__FactoryAdd(){}
    public function __Admin__FactoryUpdate(){}
    public function __Admin__FactoryRemove(){
        //TODO:
    }

    public function __Admin__TaskQuery(){}
    public function __Admin__TaskAdd(){}
    public function __Admin__TaskUpdate(){}
    public function __Admin__TaskRemove(){
        //TODO:
    }

    public function __Admin__ResourcesQuery(){}
    public function __Admin__ResourcesAdd(){}
    public function __Admin__ResourcesUpdate(){}
    public function __Admin__ResourcesRemove(){
        //TODO:
    }

    public function __Admin__UserMapQuery(){}
    public function __Admin__UserMapAdd(){}
    public function __Admin__UserMapUpdate(){}
    public function __Admin__UserMapRemove(){
        //TODO:
    }



}
