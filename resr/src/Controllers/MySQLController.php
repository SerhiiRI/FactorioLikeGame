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


    public function __User__UserMapAdd($idUser, $idFactory){
        $findCountFactory = $this->pdo->prepare("SELECT * FROM `UserMap` WHERE idFactory=:idfac");
        $findCountFactory->bindParam(":idfac", $idFactory);
        $findCountFactory->setFetchMode(PDO::FETCH_ASSOC);
        $findCountFactory->execute();
        $updateMap =0;
        $iloscFabryk=$findCountFactory->rowCount();
        if($iloscFabryk = 0){
            $countFactory = 1;
            $prepare = $this->pdo->prepare("INSERT INTO `UserMap`(`idUserMap`, `idUser`, `idFactory`, `CountFactory`) 
VALUES (NULL, :idUser, :idFactory, :CountFactory)");
            $prepare->bindParam(":idUser",$idUser );
            $prepare->bindParam(":idFactory", $idFactory);
            $prepare->bindParam(":CountFactory", $countFactory);
            $prepare->execute();
            $id_New_Added_Question = $this->pdo->lastInsertId();
            $prepare->closeCursor();
            return $id_New_Added_Question;
        }elseif ($iloscFabryk > 0){
            $iloscFabryk +=1;
            $row = $findCountFactory->fetch();
            $updateMap = $row["idUserMap"];
            $prepare = $this->pdo->prepare("UPDATE `UserMap` SET CountFactory=:countt WHERE idFactory=:idfactory");
            $prepare->bindParam(":countt",$iloscFabryk );
            $prepare->bindParam(":idFactory", $idFactory);
            $prepare->execute();
            $prepare->closeCursor();
            return $updateMap;
        }

    }
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
     * @return array|null
     */
    public function __Admin__QuestionQuery(){
        $prepare = $this->pdo->prepare("SELECT `Question.Question` as `Question`, `Answers.Answer` as `Answer` FROM `Question `, `Answer` WHERE `Question.idQuestion = Answer.idQuestion`");
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        $prepare->closeCursor();
        if($prepare->rowCount()>0){
            $assoc = $prepare->fetchAll();
            return $assoc;
        }
        return null;
    }
    /**
     * @param $idElement
     * @param $Question
     * @param array $Answer
     * @return bool
     */
    public function __Admin__QuestionAdd($idElement, $Question, array $Answer){

        /**
         * Inset into DB Question, without answer;
         */
        $prepare = $this->pdo->prepare("INSERT INTO `Question` VALUES (NULL , :question, :idresource) ");
        $prepare->bindParam(":question", $Question);
        $prepare->bindParam(":idresource", $idElement);
        $prepare->execute();
        $id_New_Added_Question = $this->pdo->lastInsertId();
        $prepare->closeCursor();

        /**
         * inset into DB answer to the define question;
         */
        $prepare = $this->pdo->prepare("INSERT INTO `Answer` VALUES (NULL, :idquestion, :answer, :isright)");
        foreach ($Answer as $oneAnswer) {
                $prepare->bindParam(":idquestion", $id_New_Added_Question);
                $toPoprawnaOdpowiedz = true;
                $toPoprawnaOdpowiedz = stripos($oneAnswer, "$")!=False ? true : false;
                $prepare->bindParam(":isright", $toPoprawnaOdpowiedz);
                $prepare->bindParam(":answer", $oneAnswer);
                $prepare->execute();
        }
        $prepare->closeCursor();

        /**
         * jeżeli w odpowidzi będzie znależony znaczek "$" - znaczy, że odpowiedz jest poprawna;
         * TODO: pod koniec sprawdzenia zrobić obcianania znaka dolara:
         *
         * $oneAnswer = preg_replace('/[^\p{L}\p{N}\s]/u', '$', $oneAnswer);
         */
        return true;
    }
    /**
     * @param $idQuestion
     * @return null
     */
    public function __Admin__QuestionRemove($idQuestion){
        $prepare = $this->pdo->prepare("DELETE FROM `Query` WHERE idQuestion=:idQuestion" );
        $prepare->bindParam(":idQuestion", $idQuestion);
        $prepare->execute();
        $prepare->closeCursor();
        return null;
    }

    public function __Admin__FactoryQuery(){
        $prepare = $this->pdo->prepare("SELECT * FROM `Factory`");
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        $prepare->closeCursor();
        if($prepare->rowCount()>0){
            $assoc = $prepare->fetchAll();
            return $assoc;
        }
        return null;
    }

    /**
     * @param $typeOfFactory
     * @param $imagePATH
     * @return string - added index
     */
    public function __Admin__FactoryAdd($typeOfFactory, $imagePATH){
        /**
         * Inset into DB Factory(Type of factory, path to image)
         */
        $prepare = $this->pdo->prepare("INSERT INTO `Factory` VALUES (NULL , :type, :image) ");
        $prepare->bindParam(":type", $typeOfFactory);
        $prepare->bindParam(":image", $imagePATH);
        $prepare->execute();
        $id_New_Added_Factory = $this->pdo->lastInsertId();
        $prepare->closeCursor();
        return $id_New_Added_Factory;
    }
    public function __Admin__FactoryRemove(){
        //TODO:
    }

    public function __Admin__TaskQuery(){
        $prepare = $this->pdo->prepare("SELECT * FROM `Task`");
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        if($prepare->rowCount()>0){
            $assoc = $prepare->fetchAll();
            return $assoc;
        }
        $prepare->closeCursor();
        return null;
    }
    public function __Admin__TaskAdd($Task, $idResource, $LevelTo, $ResourceTo){
        /**
         * Inset into DB Factory(task,
         * id resources, needed level
         * to open, needed level of
         * summary resources)
         */
        $prepare = $this->pdo->prepare("INSERT INTO `Factory` VALUES (NULL , :idResources, :Task, :LevelTo, :ResourceTo)");
        $prepare->bindParam(":idResources", $idResource);
        $prepare->bindParam(":Task", $Task);
        $prepare->bindParam(":LevelTo", $LevelTo);
        $prepare->bindParam(":ResourceTo", $ResourceTo);
        $prepare->execute();
        $id_New_Added_Task = $this->pdo->lastInsertId();
        $prepare->closeCursor();
        return $id_New_Added_Task;
    }
    public function __Admin__TaskRemove($idTask){
        $prepare = $this->pdo->prepare("DELETE FROM `Task` WHERE idTask=:idts" );
        $prepare->bindParam(":idts", $idTask);
        $prepare->execute();
        $prepare->closeCursor();
        return null;
    }

    public function __Admin__ResourcesQuery(){
        $prepare = $this->pdo->prepare("SELECT * FROM `Resource` ");
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        $prepare->closeCursor();
        if($prepare->rowCount()>0){
            $assoc = $prepare->fetchAll();
            return $assoc;
        }
        return null;
    }

    /**
     * @param $Resource - nazwa surowca
     * @param $ProductionUnit - punkty wyrobienia
     * @return string (id before
     * inserted object, or now inserted
     * object) or null
     */
    public function __Admin__ResourcesAdd($Resource, $ProductionUnit)
    {
        /**
         * Inset into DB Resource as( Resource name, and value of production to factory);
         */
        $sprawdzenia = $this->pdo->prepare("SELECT * FROM `Resources` WHERE Resource=:Res");
        $sprawdzenia->bindParam(":Res", $Resource);
        $sprawdzenia->setFetchMode(PDO::FETCH_ASSOC);
        $sprawdzenia->execute();
        $sprawdzenia->closeCursor();
        if($sprawdzenia->rowCount()<=0){
            $prepare = $this->pdo->prepare("INSERT INTO `Resources` VALUES (NULL , :Resource, :ProductionUnit) ");
            $prepare->bindParam(":Resource", $Resource);
            $prepare->bindParam(":ProductionUnit", $ProductionUnit);
            $prepare->execute();
            $id_New_Added_Resource = $this->pdo->lastInsertId();
            $prepare->closeCursor();
            return $id_New_Added_Resource;
        }else {
            $fetchOBJ = $sprawdzenia->fetch();
            return $fetchOBJ["idResources"];
        }
    }
    public function __Admin__ResourcesRemove($idResource){
        $prepare = $this->pdo->prepare("DELETE FROM `Resources` WHERE idResource=:idresource");
        $prepare->bindParam(":idresource", $idResource);
        $prepare->execute();
        $prepare->closeCursor();
        return null;
    }

//    public function __Admin__UserMapQuery(){}
//    public function __Admin__UserMapAdd(){}
//    public function __Admin__UserMapUpdate(){}
//    public function __Admin__UserMapRemove(){}



}
