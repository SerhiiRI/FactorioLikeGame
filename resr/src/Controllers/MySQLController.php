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
        try { // przekazujemy dla interfejsa PDO ustanawia dla zdefiniowanego zdarzenia
//            $this->pdo = new PDO("mysql:host=192.168.1.5;dbname=game", $login, $passwd);
            $this->pdo = new PDO("mysql:host=127.0.0.1;dbname=game", $login, $passwd);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    private function __clone()
    {
    }

    public function disconnectDataBase()
    {
        $this->pdo = null;
    }

    /**
     * @param $login - it regestration e-mail address
     * @param $password - its password to acount e-mail
     * @param int $type - type of user login {1 - admin | 2 - gracz}
     *
     * @param int $idLevel
     * @param int $idScore
     * @param string $IMG
     * @return int|string $idUzytkownika of new user, or -1 if Insertion was failed;
     *
     */
    public function regestration($login, $password, $llogin="0000-00-00", $type = 2, $idLevel = 0, $idScore = 0, $IMG = "defoult_user.svg")
    {
        $prepare = $this->pdo->prepare("SELECT * FROM `User` WHERE LOWER(Email) = LOWER(:e_mail)");
        $prepare->bindParam(":e_mail", $login);
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        $idUzytkownika = -1;
        if ($prepare->rowCount() <= 0) {
            $rejestracja = $this->pdo->prepare(" INSERT INTO User VALUES (NULL , :email, sha1(:pass), :dat,  :type, :score, :userlevel, :image) ");
            $rejestracja->bindParam(":email", $login);
            $rejestracja->bindParam(":pass", $password);
            $rejestracja->bindParam(":dat", $password);
            $rejestracja->bindParam(":type", $type);
            $rejestracja->bindParam(":score", $idScore);
            $rejestracja->bindParam(":userlevel", $idLevel);
            $rejestracja->bindParam(":image", $IMG);
            $rejestracja->setFetchMode(PDO::FETCH_ASSOC);
            $rejestracja->execute();
            //$idUzytkownika = $this->pdo->lastInsertId();
            $idUzytkownika = 1;
            $rejestracja->closeCursor();
        } else {
            $fetchOBJ = $prepare->fetch();
            return $fetchOBJ["idUser"];
        }
        $prepare->closeCursor();
        return $idUzytkownika;
    }

    public function validateUser($login, $password)
    {
        $prepare = $this->pdo->prepare("SELECT * FROM `User` WHERE Email=:email AND Passwd=sha1(:passwd)");
        $prepare->bindParam(":email", $login);
        $prepare->bindParam(":passwd", $password);
        $prepare->execute();
        if ($prepare->rowCount() > 0) {
            $prepare->setFetchMode(\PDO::FETCH_ASSOC);
            return $prepare->fetch();
        }
        return -1;
    }

    public function __User__UserNextLevel($EmailToChange)
    {
        $prepare = $this->pdo->prepare("UPDATE `User` SET `Level` = `Level` + 1 WHERE `Email`=:email");
        $prepare->bindParam(":email", $EmailToChange);
        $prepare->execute();
        $prepare->closeCursor();
    }

    public function __User__UpdateLastLogined($login, $LastLogined){
    $prepare = $this->pdo->prepare("UPDATE `User` SET `LastLogined`=:llg WHERE `Email`=:email");
        $prepare->bindParam(":email", $login);
        $prepare->bindParam(":llg", $LastLogined);
        $prepare->execute();
        $prepare->closeCursor();
    }

    public function __User__UserMapQuery($idUser)
    {
        $prepare = $this->pdo->prepare("SELECT * FROM `UserMap` WHERE `idUser`=:iduser");
        $prepare->bindParam(":iduser", $idUser);
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        if ($prepare->rowCount() > 0) {
            $assocc = $prepare->fetchAll();
            return $assocc;
        }
        $prepare->closeCursor();
        return null;
    }
    public function __Admin__UserMapQuery()
    {
        $prepare = $this->pdo->prepare("SELECT * FROM `UserMap`");
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        if ($prepare->rowCount() > 0) {
            $assocc = $prepare->fetchAll();
            return $assocc;
        }
        $prepare->closeCursor();
        return null;
    }

        public function __User__UserMapAdd($idUser, $idFactory)
    {
        $findCountFactory = $this->pdo->prepare("SELECT * FROM `UserMap` WHERE `idFactory`=:idfac AND `idUser`=:usr");
        $findCountFactory->bindParam(":idfac", $idFactory);
        $findCountFactory->bindParam(":usr", $idUser);
        $findCountFactory->setFetchMode(PDO::FETCH_ASSOC);
        $findCountFactory->execute();
        $iloscFabryk = $findCountFactory->rowCount();
        if ($iloscFabryk == 0) {
            $prepare = $this->pdo->prepare("INSERT INTO `UserMap`(`idUserMap`, `idUser`, `idFactory`, `CountFactory`) VALUES (NULL, :idUser, :idFactory, 1)");
            $prepare->bindParam(":idUser", $idUser);
            $prepare->bindParam(":idFactory", $idFactory);
            $prepare->execute();
            $id_New_Added_Question = $this->pdo->lastInsertId();
            $prepare->closeCursor();
        } elseif ($iloscFabryk > 0) {
            $row = $findCountFactory->fetch();
            $updateMap = $row["idUserMap"];
            $prepare = $this->pdo->prepare("UPDATE `UserMap` SET `CountFactory`=`CountFactory` + 1 WHERE `idFactory`=:idfactory");
            $prepare->bindParam(":idfactory", $idFactory);
            $prepare->execute();
            $prepare->closeCursor();
        }
        return null;
    }

    //?   public function __User__UserMapUpdate(user_){}
    public function __User__UserMapRemove($idUser, $idFactory)
    {
        $findCountFactory = $this->pdo->prepare("SELECT * FROM `UserMap` WHERE `idFactory`=:idfac AND `idUser`=:usr");
        $findCountFactory->bindParam(":idfac", $idFactory);
        $findCountFactory->bindParam(":usr", $idUser);
        $findCountFactory->setFetchMode(PDO::FETCH_ASSOC);
        $findCountFactory->execute();
        $row = $findCountFactory->fetchAll();
        $iloscFabryk = $row[0]["CountFactory"];
        if ($iloscFabryk == 1) {
            $prepare = $this->pdo->prepare("DELETE FROM `UserMap` WHERE `idFactory`=:idfac AND `idUser`=:usr");
            $prepare->bindParam(":idfac", $idFactory);
            $prepare->bindParam(":usr", $idUser);

            $prepare->execute();
            $prepare->closeCursor();
        } elseif ($iloscFabryk > 1) {
            $prepare = $this->pdo->prepare("UPDATE `UserMap` SET `CountFactory`=`CountFactory` - 1 WHERE `idFactory`=:idfactory AND `idUser`=:usr");
            $prepare->bindParam(":usr", $idUser);
            $prepare->bindParam(":idfactory", $idFactory);
            $prepare->execute();
            $prepare->closeCursor();
        }
        return null;
    }
    public function __User__UserMapRemoveAll($idUser, $idFactory)
    {
        $prepare = $this->pdo->prepare("DELETE FROM `UserMap` WHERE `idUser`=:usr");
        $prepare->bindParam(":idUser", $idUser);
        $prepare->bindParam(":idFactory", $idFactory);
        $prepare->execute();
        $prepare->closeCursor();
        return null;
    }


    public function __User__UserScoreAdd($idTask, $idUser)
    {
        $prepare = $this->pdo->prepare("SELECT * FROM `Score` WHERE `idTask`=:task AND `idUser`=:usser");
        $prepare->bindParam(":task", $idTask);
        $prepare->bindParam(":usser", $idUser);
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        if ($prepare->rowCount() == 0) {
            $prepare = $this->pdo->prepare("INSERT INTO `Score` VALUES (NULL ,:usser, :task, FALSE)");
            $prepare->bindParam(":task", $idTask);
            $prepare->bindParam(":usser", $idUser);
            $prepare->execute();
            $insertedScore = $this->pdo->lastInsertId();
            $prepare->closeCursor();
            return $insertedScore;
        }
        return null;
    }

    public function __User__UserScoreQueryById($idUser){
        $prepare = $this->pdo->prepare("SELECT * FROM `Score` WHERE `idUser`=:id");
        $prepare->bindParam(":id", $idUser);
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        return ($prepare->rowCount() > 0) ? $prepare->fetchAll() : null;
    }
    public function __User__UserScoreQuery(){
        $prepare = $this->pdo->prepare("SELECT * FROM `Score`");
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        return ($prepare->rowCount() > 0) ? $prepare->fetchAll() : null;
    }

    public function __test__UserAndTask(){
        $prepare = $this->pdo->prepare("SELECT `Email` as `mail`, `LevelTo` as `task`, `Level` as `user`, `Task` as `mes` FROM `Score`, `User`, `Task` WHERE Score.idUser=User.idUser AND Task.idTask=Score.idTask");
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        return ($prepare->rowCount() > 0) ? $prepare->fetchAll() : null;
    }

    public function __User__UserScoreChangeStatus($idTask, $idUser)
    {
        $prepare = $this->pdo->prepare("SELECT * FROM `Score` WHERE `idTask`=:task AND `idUser`=:usser");
        $prepare->bindParam(":task", $idTask);
        $prepare->bindParam(":usser", $idUser);
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        if ($prepare->rowCount() != 0) {
            $prepare = $this->pdo->prepare("UPDATE `Score` SET `FinishedTask`=TRUE WHERE `idTask`=:task AND `idUser`=:usser");
            $prepare->bindParam(":task", $idTask);
            $prepare->bindParam(":usser", $idUser);
            $prepare->execute();
            $prepare->closeCursor();
            return 1;
        }
        return null;
    }
    public function __User__UserResource($idUser){
        $prepare = $this->pdo->prepare("SELECT `idResources` FROM `Score`, `Task` WHERE".
            " `Score`.idTask=`Task`.idTask AND `Score`.idUser=:usser AND `Score`.FinishedTask=True");
        $prepare->bindParam(":usser", $idUser);
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        return $prepare->fetchAll();
    }

    public function __User__TaskList($idUser){
        $prepare = $this->pdo->prepare("SELECT `Task`.idTask as `idTask`, `idResources`, `Task`, `LevelTo`, `ResourceTo` FROM `Score`, `Task` WHERE `Task`.idTask=`Score`.idTask AND `Score`.idUser=:usser");
        $prepare->bindParam(":usser", $idUser);
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        return $prepare->fetchAll();
    }
    public function __User__UserScoreRemove($idTask, $idUser)
    {
        $prepare = $this->pdo->prepare("SELECT * FROM `Score` WHERE `idTask`=:task AND `idUser`=:usser");
        $prepare->bindParam(":task", $idTask);
        $prepare->bindParam(":usser", $idUser);
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        if ($prepare->rowCount() != 0) {
            $prepare = $this->pdo->prepare("DELETE FROM `Score` WHERE `idTask`=:task AND `idUser`=:usser");
            $prepare->bindParam(":task", $idTask);
            $prepare->bindParam(":usser", $idUser);
            $prepare->execute();
            $insertedScore = $this->pdo->lastInsertId();
            $prepare->closeCursor();
            return $insertedScore;
        }
        return null;
    }




    public function __User__FactoryInstanceAdd($idResource, $upgradeLevel, $idUser)
    {
        $prepare = $this->pdo->prepare("SELECT * FROM `FactoryInstance` WHERE `idResource`=:resource AND `Upgrade`=:up AND `idUser`=:usr");
        $prepare->bindParam(":resource", $idResource);
        $prepare->bindParam(":up", $upgradeLevel);
        $prepare->bindParam(":usr", $idUser);
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        if ($prepare->rowCount() == 0) {
            $prepare = $this->pdo->prepare(
                "INSERT INTO `FactoryInstance`(`idFactoryInstance`, `idResource`, `Upgrade`, `idUser`)" .
                " VALUES (NULL,:resource,:up,:usr)");
            $prepare->bindParam(":resource", $idResource);
            $prepare->bindParam(":up", $upgradeLevel);
            $prepare->bindParam(":usr", $idUser);
            $prepare->execute();
            $insertedScore = $this->pdo->lastInsertId();
            $prepare->closeCursor();
            return $insertedScore;
        }
        $prepare->closeCursor();
        return null;
    }

    public function __User__FactoryInstanceUpdate($idInstance)
    {
        $prepare = $this->pdo->prepare("UPDATE `FactoryInstance` SET `Upgrade` = `Upgrade` + 1 WHERE `idFactoryInstance`=:idInstance");
        $prepare->bindParam(":idInstance", $idInstance);
        $prepare->execute();
        $prepare->closeCursor();
        return null;
    }
    public function __User__FactoryInstanceUpdateAndCreateNew($idResource, $upgradeLevel, $idUser)
    {
        $prepare = $this->pdo->prepare("SELECT * FROM `FactoryInstance` WHERE `idResource`=:resource AND `Upgrade`=:up AND `idUser`=:usr");
        $prepare->bindParam(":resource", $idResource);
        $prepare->bindParam(":up", $upgradeLevel);
        $prepare->bindParam(":usr", $idUser);
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();

        $prepare = $this->pdo->prepare("INSERT INTO `FactoryInstance`(`idFactoryInstance`, `idResource`, `Upgrade`, `idUser`)" .
            " VALUES (NULL,:resource,:up,:usr)");
        $prepare->bindParam(":resource", $idResource);
        $prepare->bindParam(":up", $upgradeLevel);
        $prepare->bindParam(":usr", $idUser);
        $prepare->execute();
        $prepare->closeCursor();
        return null;
    }

    public function __User__FactoryInstanceRemoveByID(int $idInstance)
    {
        $prepare = $this->pdo->prepare("DELETE FROM `FactoryInstance` WHERE `idFactoryInstance`=:idInsance");
        $prepare->bindParam(":idInsance", $idInstance);
        $prepare->execute();
        $prepare->closeCursor();
        return null;
    }

    public function __User__FactoryInstanceRemoveByParam($idResource, $upgradeLevel, $idUser)
    {
        $prepare = $this->pdo->prepare("DELETE FROM `FactoryInstance`  WHERE `idResource`=:resource AND `Upgrade`=:up AND `idUser`=:usr");
        $prepare->bindParam(":resource", $idResource);
        $prepare->bindParam(":up", $upgradeLevel);
        $prepare->bindParam(":usr", $idUser);
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        $prepare->closeCursor();
        return null;
    }

    public function __Admin__FactoryInstanceQuery(){
        $prepare = $this->pdo->prepare("SELECT * FROM `FactoryInstance`");
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        if ($prepare->rowCount() > 0) {
            $assocc = $prepare->fetchAll();
            return $assocc;
        }
        $prepare->closeCursor();
        return null;
    }
    public function __User__FactoryInstanceQuery($idUser){
        $prepare = $this->pdo->prepare("SELECT * FROM `FactoryInstance` WHERE `idUser`=:id");
        $prepare->bindParam(":id", $idUser);
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        if ($prepare->rowCount() > 0) {
            $assocc = $prepare->fetchAll();
            return $assocc;
        }
        $prepare->closeCursor();
        return null;
    }


    public function __User__QuestionQuery()
    {
        return $this->__Admin__UserQuery();
    }

    public function __User__TaskQuery()
    {
        return $this->__Admin__TaskQuery();
    }

    public function __User__ResourcesQuery()
    {
        return $this->__Admin__ResourcesQuery();
    }


//====================================================================================================================//
//====================================================================================================================//


    public function __Admin__UserQuery()
    {
        $prepare = $this->pdo->prepare("SELECT * FROM `User`");
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        if ($prepare->rowCount() > 0) {
            $assocc = $prepare->fetchAll();
            return $assocc;
        }
        $prepare->closeCursor();
        return null;
    }

    public function __Admin__UserAdd(string $login, string $password, $type = 2, $idLevel = 0, $idScore = 0)
    {
        return $this->regestration($login, $password, $type, $idLevel, $idScore);
    }

    public function __Admin__UserUpdate($EmailToChange, $IMG)
    {
        $prepare = $this->pdo->prepare("UPDATE `User` SET `IMG` = ? WHERE `Email`=?");
        $prepare->bindParam(1, $IMG);
        $prepare->bindParam(2, $EmailToChange);
        $prepare->execute();
        $prepare->closeCursor();
    }


    public function __Admin__UserRemove($login)
    {
        try {
            $prepare = $this->pdo->prepare("DELETE FROM `User` WHERE Email=?");
            $prepare->bindParam(1, $login);
            $prepare->execute();
            $prepare->closeCursor();
        } catch (Exception $e) {
            echo "<div style='background: red; font-size: 20px; font-family: monospace; color: #FFFFFF; margin: 30px; padding: 40px;'>";
            echo $e->getMessage();
            echo $e->getFile();
            echo $e->getLine();
            echo "</div>";
        }
    }

    public function __Admin__QuestionAdd($idTask, $Question, $AnswerTrue, $AnswerFalse1, $AnswerFalse2, $AnswerFalse3)
    {
        $prepare = $this->pdo->prepare("INSERT INTO `Question` VALUES (NULL , :idtask, :question) ");
        $prepare->bindParam(":question", $Question);
        $prepare->bindParam(":idtask", $idTask);
        $prepare->execute();
        $id_New_Added_Question = $this->pdo->lastInsertId();

        /* to jest statycznie dadajace gowno. Nie jest twoj styl, no przedstaw, ze musiales to napisac. */
        $prepare = $this->pdo->prepare("INSERT INTO `Answers` VALUES (NULL, :idquestion, :answers, :isright)");
        $toPoprawnaOdpowiedz = true;
        $Answer = $AnswerTrue;
        $prepare->bindParam(":idquestion", $id_New_Added_Question);
        $prepare->bindParam(":isright", $toPoprawnaOdpowiedz);
        $prepare->bindParam(":answers", $Answer);
        $prepare->execute();
        $toPoprawnaOdpowiedz = false;
        $Answer = $AnswerFalse1;
        $prepare->execute();
        $Answer = $AnswerFalse2;
        $prepare->execute();
        $Answer = $AnswerFalse3;
        $prepare->execute();

        $prepare->closeCursor();
        return true;
    }

    public function __Admin__QuestionRemoveById($idQuestion)
    {
        $prepare = $this->pdo->prepare("DELETE FROM `Question` WHERE `idQuestion`=:idQuestion");
        $prepare->bindParam(":idQuestion", $idQuestion);
        $prepare->execute();
        $prepare->closeCursor();
        return null;
    }


    public function __Admin__QuestionQuery()
    {
        $prepare = $this->pdo->prepare("SELECT * FROM `Question`");
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        if ($prepare->rowCount() > 0) {
            $assoc = $prepare->fetchAll();
            return $assoc;
        }
        $prepare->closeCursor();
        return null;
    }
/*
    public function __Admin__QuestionUpdate($idTask, $Question, $AnswerTrue, $AnswerFalse1, $AnswerFalse2, $AnswerFalse3)
    {
        $sprawdzenia = $this->pdo->prepare("SELECT * FROM `Question` WHERE `idQuestion`=:id");
        $sprawdzenia->bindParam(":id", $idQuestion);
        $sprawdzenia->setFetchMode(PDO::FETCH_ASSOC);
        $sprawdzenia->execute();
        if ($sprawdzenia->rowCount() > 0) {
            $prepare = $this->pdo->prepare(" UPDATE `Question` SET `Question`=:txt WHERE `idQuestion`=:id");
            $prepare->bindParam(":id", $idQuestion);
            $prepare->bindParam(":txt", $text);
            $prepare->execute();
            $prepare->closeCursor();
        }
        $sprawdzenia->closeCursor();
        return null;
    }

    public function __Admin__AnswerUpdate($idAnswer, $idQuestion, $text, $right)
    {
        $sprawdzenia = $this->pdo->prepare("SELECT * FROM `Answers` WHERE `idQuestion`=:id");
        $sprawdzenia->bindParam(":id", $idQuestion);
        $sprawdzenia->setFetchMode(PDO::FETCH_ASSOC);
        $sprawdzenia->execute();
        $sprawdzenia->closeCursor();
        if (($sprawdzenia->rowCount() > 0) && $right == true) {
            $prepare = $this->pdo->prepare(" UPDATE `Answers` SET `Right`=FALSE WHERE `idQuestion`=:id");
            $prepare->bindParam(":id", $idQuestion);
            $prepare->execute();
            $prepare->closeCursor();
            $prepare = $this->pdo->prepare("UPDATE `Answers` SET `Answer`=:text,`Right`=FALSE WHERE `idAnswers`=:id");
            $prepare->bindParam(":id", $idAnswer);
            $prepare->bindParam(":text", $text);
            $prepare->execute();
            $prepare->closeCursor();
        } elseif (($sprawdzenia->rowCount() > 0) && $right == false) {
            $prepare = $this->pdo->prepare("UPDATE `Answers` SET `Answer`=:text,`Right`=FALSE WHERE `idAnswers`=:id");
            $prepare->bindParam(":id", $idAnswer);
            $prepare->bindParam(":text", $text);
            $prepare->execute();
            $prepare->closeCursor();
        }
        return null;
    }
*/
    public function __Admin__AnswerQuery($idQuestion)
    {
        $prepare = $this->pdo->prepare("SELECT * FROM `Answers` WHERE `idQuestion`=:id");
        $prepare->bindParam(":id", $idQuestion);
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        if ($prepare->rowCount() > 0) {
            $assoc = $prepare->fetchAll();
            return $assoc;
        }
        $prepare->closeCursor();
        return null;
    }

    public function __Admin__TaskQuery()
    {
        $prepare = $this->pdo->prepare("SELECT * FROM `Task` ORDER BY `LevelTo` ASC");
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        if ($prepare->rowCount() > 0) {
            $assoc = $prepare->fetchAll();
            return $assoc;
        }
        $prepare->closeCursor();
        return null;
    }

    public function __Admin__TaskQueryByLevel($neededLevel)
    {
        $prepare = $this->pdo->prepare("SELECT * FROM `Task` WHERE `LevelTo`=:lvl ORDER BY `LevelTo` ASC");
        $prepare->bindParam(":lvl", $neededLevel);
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        if ($prepare->rowCount() > 0) {
            $assoc = $prepare->fetchAll();
            return $assoc;
        }
        $prepare->closeCursor();
        return null;
    }

    public function __System__GetMaxLevel()
    {
        $prepare = $this->pdo->prepare("SELECT MAX(`LevelTo`) as `LevelTo` FROM `Task` ");
        $prepare->bindParam(":lvl", $neededLevel);
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        if ($prepare->rowCount() > 0) {
            $assoc = $prepare->fetchAll();
            return $assoc;
        }
        $prepare->closeCursor();
        return null;
    }

    public function __Admin__TaskAdd($Task, $idResource, $LevelTo, $ResourceTo)
    {
        $prepare = $this->pdo->prepare("INSERT INTO `Task` VALUES (NULL , :iddresources, :Task, :LevelTo, :ResourceTo)");
        $prepare->bindParam(":iddresources", $idResource);
        $prepare->bindParam(":Task", $Task);
        $prepare->bindParam(":LevelTo", $LevelTo);
        $prepare->bindParam(":ResourceTo", $ResourceTo);
        $prepare->execute();
        $id_New_Added_Task = $this->pdo->lastInsertId();
        $prepare->closeCursor();
        return $id_New_Added_Task;
    }


    public function __Admin__TaskRemove($idTask)
    {
        $prepare = $this->pdo->prepare("DELETE FROM `Task` WHERE idTask=:idts");
        $prepare->bindParam(":idts", $idTask);
        $prepare->execute();
        $prepare->closeCursor();
        return null;
    }
    public function __Admin__TaskRemoveAll(){
        $prepare = $this->pdo->prepare("DELETE FROM `Task`");
        $prepare->execute();
        $prepare->closeCursor();
        return "suka bliat";
    }
    public function __Admin__UserRemoveAll(){
        $prepare = $this->pdo->prepare("DELETE FROM `User`");
        $prepare->execute();
        $prepare->closeCursor();
        return "suka bliat";
    }
    public function __Admin__QuestionRemoveAll(){
        $prepare = $this->pdo->prepare("DELETE FROM `Question`");
        $prepare->execute();
        $prepare->closeCursor();
        return "suka bliat";
    }
    public function __Admin__FactoryInstanceRemoveAll(){
        $prepare = $this->pdo->prepare("DELETE FROM `FactoryInstance`");
        $prepare->execute();
        $prepare->closeCursor();
        return "suka bliat";
    }
    public function __Admin__ResourceRemoveAll(){
        $prepare = $this->pdo->prepare("DELETE FROM `Resource`");
        $prepare->execute();
        $prepare->closeCursor();
        return "suka bliat";
    }
    public function __Admin__UserMapRemoveAll(){
        $prepare = $this->pdo->prepare("DELETE FROM `UserMap`");
        $prepare->execute();
        $prepare->closeCursor();
        return "suka bliat";
    }

    public function __Admin__TaskUpdate($idTask, $Task, $idResource, $LevelTo, $ResourceTo)
    {
        $prepare = $this->pdo->prepare("UPDATE `task` SET `idResources`=:idres, `Task`=:tsk, `LevelTo`=:lvlto, `ResourceTo`=:rsrto WHERE `idTask`=:idtsk");
        $prepare->bindParam(":idtsk", $idTask);
        $prepare->bindParam(":idres", $idResource);
        $prepare->bindParam(":tsk", $Task);
        $prepare->bindParam(":lvlto", $LevelTo);
        $prepare->bindParam(":rsrto", $ResourceTo);
        $prepare->execute();
        $prepare->closeCursor();
        return null;
    }

    public function __Admin__ResourcesAdd($Resource, $ProductionUnit, $FactoryName,  string $IMG, string $IMGFac)
    {
        $sprawdzenia = $this->pdo->prepare("SELECT * FROM `Resources` WHERE Resource=:Res");
        $sprawdzenia->bindParam(":Res", $Resource);
        $sprawdzenia->setFetchMode(PDO::FETCH_ASSOC);
        $sprawdzenia->execute();
        $sprawdzenia->closeCursor();
        if ($sprawdzenia->rowCount() <= 0) {
            $prepare = $this->pdo->prepare("INSERT INTO `Resources` VALUES (NULL , :Resource, :ProductionUnit, :FactoryName, :IMG, :IMGFac) ");
            $prepare->bindParam(":Resource", $Resource);
            $prepare->bindParam(":ProductionUnit", $ProductionUnit);
            $prepare->bindParam(":IMG", $IMG);
            $prepare->bindParam(":FactoryName", $FactoryName);
            $prepare->bindParam(":IMGFac", $IMGFac);
            $prepare->execute();
            $id_New_Added_Resource = $this->pdo->lastInsertId();
            $prepare->closeCursor();
            return $id_New_Added_Resource;
        } else {
            $fetchOBJ = $sprawdzenia->fetch();
            return $fetchOBJ["idResources"];
        }
    }

    public function __Admin__ResourcesRemoveByID($idResource)
    {
        $prepare = $this->pdo->prepare("DELETE FROM `Resources` WHERE `idResources`=:idresource");
        $prepare->bindParam(":idresource", $idResource);
        $prepare->execute();
        $prepare->closeCursor();
        return null;
    }
    public function __Admin__ResourcesRemoveByName($Resource)
    {
        $prepare = $this->pdo->prepare("DELETE FROM `Resources` WHERE `Resource`=:idresource");
        $prepare->bindParam(":idresource", $Resource);
        $prepare->execute();
        $prepare->closeCursor();
        return null;
    }
    public function __Admin__ResourcesRemoveALL()
    {
        $prepare = $this->pdo->prepare("DELETE FROM `Resources`");
        $prepare->execute();
        $prepare->closeCursor();
        return null;
    }

    public function __Admin__ResourcesUpdate($Resource, $ProductionUnit, $FactoryName, $IMG, $IMGFac)
    {
        /**
         * Update Resource productUnit;
         */
        $sprawdzenia = $this->pdo->prepare("SELECT * FROM `Resources` WHERE `Resource`=:Res");
        $sprawdzenia->bindParam(":Res", $Resource);
        $sprawdzenia->setFetchMode(PDO::FETCH_ASSOC);
        $sprawdzenia->execute();
        $sprawdzenia->closeCursor();
        if ($sprawdzenia->rowCount() > 0) {
            $prepare = $this->pdo->prepare(" UPDATE `Resources` SET `ProductionUnit`=:unit, `FactoryName`=:facName,  `IMG`=:img, `IMGFac`=:imgfac WHERE `Resource`=:rsr");
            $prepare->bindParam(":rsr", $Resource);
            $prepare->bindParam(":img", $IMG);
            $prepare->bindParam(":facName", $FactoryName);
            $prepare->bindParam(":imgfac", $IMGFac);
            $prepare->bindParam(":unit", $ProductionUnit);
            $prepare->execute();
            $prepare->closeCursor();
        }
        return null;
    }

    public function __Admin__ResourcesQuery()
    {
        $prepare = $this->pdo->prepare("SELECT * FROM `Resources`");
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        if ($prepare->rowCount() > 0) {
            $assoc = $prepare->fetchAll();
            return $assoc;
        }
        $prepare->closeCursor();
        return null;
    }


}
