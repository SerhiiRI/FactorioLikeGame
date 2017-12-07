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
            $this->pdo = new \PDO("mysql:host=localhost;dbname=game", $login, $passwd);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
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
     * @param $type - type of user login {1 - admin | 2 - gracz}
     *
     * @return $idUzytkownika of new user, or -1 if Insertion was failed;
     *
     */
    public function regestration($login, $password, $type = 2, $idLevel = 0, $idScore = 0)
    {
        $prepare = $this->pdo->prepare("SELECT * FROM `User` WHERE Email=:e_mail ");
        $prepare->bindParam(":e_mail", $login);
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        $idUzytkownika = -1;
        if ($prepare->rowCount() <= 0) {
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
        } else {
            $fetchOBJ = $prepare->fetch();
            return $fetchOBJ["idUser"];
        }
        $prepare->closeCursor();
        return $idUzytkownika;
    }

    public function validateUser($login, $password)
    {
        $prepare = $this->pdo->prepare("SELECT * FROM `User` WHERE Email=:email AND Passwd=:passwd");
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

    public function __User__UserMapQuery()
    {
        $prepare = $this->pdo->prepare("SELECT * FROM `UserMap`");
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        $returnSet = $prepare->fetchAll();
        return ($prepare->rowCount() > 0) ? $prepare->fetchAll() : null;
    }

    public function __User__UserMapAdd($idUser, $idFactory)
    {
        $findCountFactory = $this->pdo->prepare("SELECT * FROM `UserMap` WHERE idFactory=:idfac");
        $findCountFactory->bindParam(":idfac", $idFactory);
        $findCountFactory->setFetchMode(PDO::FETCH_ASSOC);
        $findCountFactory->execute();
        $updateMap = 0;
        $iloscFabryk = $findCountFactory->rowCount();
        if ($iloscFabryk = 0) {
            $countFactory = 1;
            $prepare = $this->pdo->prepare("INSERT INTO `UserMap`(`idUserMap`, `idUser`, `idFactory`, `CountFactory`) VALUES (NULL, :idUser, :idFactory, :CountFactory)");
            $prepare->bindParam(":idUser", $idUser);
            $prepare->bindParam(":idFactory", $idFactory);
            $prepare->bindParam(":CountFactory", $countFactory);
            $prepare->execute();
            $id_New_Added_Question = $this->pdo->lastInsertId();
            $prepare->closeCursor();
            return $id_New_Added_Question;
        } elseif ($iloscFabryk > 0) {
            $iloscFabryk += 2;
            $row = $findCountFactory->fetch();
            $updateMap = $row["idUserMap"];
            $prepare = $this->pdo->prepare("UPDATE `UserMap` SET CountFactory=:countt WHERE idFactory=:idfactory");
            $prepare->bindParam(":countt", $iloscFabryk);
            $prepare->bindParam(":idFactory", $idFactory);
            $prepare->execute();
            $prepare->closeCursor();
            return $updateMap;
        }
        return null;
    }

    //?   public function __User__UserMapUpdate(user_){}
    public function __User__UserMapRemove($idFactory)
    {
        $findCountFactory = $this->pdo->prepare("SELECT * FROM `UserMap` WHERE idFactory=:idfac");
        $findCountFactory->bindParam(":idfac", $idFactory);
        $findCountFactory->setFetchMode(PDO::FETCH_ASSOC);
        $findCountFactory->execute();
        $iloscFabryk = $findCountFactory->rowCount();
        if ($iloscFabryk = 1) {

            $countFactory = 1;
            $prepare = $this->pdo->prepare("DELETE FROM `UserMap` WHERE idFactory=:idFactory");
            $prepare->bindParam(":idFactory", $idFactory);
            $prepare->execute();
            $id_New_Added_Question = $this->pdo->lastInsertId();
            $prepare->closeCursor();

        } elseif ($iloscFabryk > 1) {
            $row = $findCountFactory->fetch();
            $updateMap = $row["idUserMap"];
            $prepare = $this->pdo->prepare("UPDATE `UserMap` SET CountFactory=:countt WHERE idFactory=:idfactory");
            $prepare->bindParam(":countt", $iloscFabryk);
            $prepare->bindParam(":idFactory", $idFactory);
            $prepare->execute();
            $prepare->closeCursor();
        }
        return null;
    }

    public function __User__UserScoreAdd($idTask)
    {
        $prepare = $this->pdo->prepare("SELECT * FROM `Score` WHERE idTask=:task");
        $prepare->bindParam(":task", $idTask);
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        if ($prepare->rowCount() == 0) {
            $prepare = $this->pdo->prepare("INSERT INTO `Score` VALUES (NULL , :task, FALSE)");
            $prepare->bindParam(":task", $idTask);
            $prepare->execute();
            $insertedScore = $this->pdo->lastInsertId();
            $prepare->closeCursor();
            return $insertedScore;
        }
        return null;
    }

    public function __User__UserScoreChangeStatus($idTask)
    {
        $prepare = $this->pdo->prepare("SELECT * FROM `Score` WHERE idTask=:task");
        $prepare->bindParam(":task", $idTask);
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        if ($prepare->rowCount() != 0) {
            $prepare = $this->pdo->prepare("UPDATE `Score` SET `FinishedTask`=TRUE WHERE `idTask`=:task");
            $prepare->bindParam(":task", $idTask);
            $prepare->execute();
            $insertedScore = $this->pdo->lastInsertId();
            $prepare->closeCursor();
            return $insertedScore;
        }
        return null;
    }

    public function __User__UserScoreRemove($idTask)
    {
        $prepare = $this->pdo->prepare("SELECT * FROM `Score` WHERE idTask=:task");
        $prepare->bindParam(":task", $idTask);
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        if ($prepare->rowCount() != 0) {
            $prepare = $this->pdo->prepare("DELETE FROM `Score` WHERE `idTask`=:task");
            $prepare->bindParam(":task", $idTask);
            $prepare->execute();
            $insertedScore = $this->pdo->lastInsertId();
            $prepare->closeCursor();
            return $insertedScore;
        }
        return null;
    }

    public function __User__FactoryInstanceAdd($idResource, $idFactory, $UpgradeLVL, $idUser)
    {
        $prepare = $this->pdo->prepare("SELECT * FROM `FactoryInstance` WHERE `idResource`=:resource AND `idFactory`=:factory AND `Upgrade`=:up AND `idUser`=:usr");
        $prepare->bindParam(":resource", $idResource);
        $prepare->bindParam(":factory", $idFactory);
        $prepare->bindParam(":up", $UpgradeLVL);
        $prepare->bindParam(":usr", $idUser);
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        $prepare->closeCursor();
        if ($prepare->rowCount() == 0) {
            $prepare = $this->pdo->prepare(
                "INSERT INTO `FactoryInstance`(`idFactoryInstance`, `idResource`, `idFactory`, `Upgrade`, `idUser`)" .
                " VALUES (NULL,:resource,:factory,:up,:usr)");
            $prepare->bindParam(":resource", $idResource);
            $prepare->bindParam(":factory", $idFactory);
            $prepare->bindParam(":up", $UpgradeLVL);
            $prepare->bindParam(":usr", $idUser);
            $prepare->execute();
            $insertedScore = $this->pdo->lastInsertId();
            $prepare->closeCursor();
            return $insertedScore;
        } else {
            $prepare = $this->pdo->prepare("SELECT * FROM `FactoryInstance` WHERE `idResource`=:resource AND `idFactory`=:factory AND `Upgrade`=:up AND `idUser`=:usr");
            $prepare->bindParam(":resource", $idResource);
            $prepare->bindParam(":factory", $idFactory);
            $prepare->bindParam(":up", $UpgradeLVL);
            $prepare->bindParam(":usr", $idUser);
            $prepare->setFetchMode(PDO::FETCH_ASSOC);
            $prepare->execute();
            $linia = $prepare->fetch();
            $prepare->closeCursor();
            return $linia["idFactoryInstance"];
        }
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

    public function __User__FactoryInstanceRemove(int $idInstance)
    {
        $prepare = $this->pdo->prepare("DELETE FROM `FactoryInstance` WHERE idFactory=:idFactory");
        $prepare->bindParam(":idInstance", $idInstance);
        $prepare->execute();
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

    public function __User__FactoryQuery()
    {
        return $this->__Admin__FactoryQuery();
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
        $prepare->bindParam(":email", $login);
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        if ($prepare->rowCount() > 0) {
            $assocc = $prepare->fetchAll();
            return $assocc;
        }
        return null;
    }

    public function __Admin__UserAdd(string $login, string $password, $type = 2, $idLevel = 0, $idScore = 0)
    {
        return $this->regestration($login, $password, $type, $idLevel, $idScore);
    }

    public function __Admin__UserUpdate($EmailToChange, $PasswordToChange)
    {
        $prepare = $this->pdo->prepare("UPDATE `User` SET `Passwd` = ? WHERE `Email`=?");
        $prepare->bindParam(1, $PasswordToChange);
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

    public function __Admin__QuestionAdd($idTask, $Question, array $Answer)
    {

        /**
         * Inset into DB Question, without answer;
         */
        $prepare = $this->pdo->prepare("INSERT INTO `Question` VALUES (NULL , :question, :idtask) ");
        $prepare->bindParam(":question", $Question);
        $prepare->bindParam(":idtask", $idTask);
        $prepare->execute();
        $id_New_Added_Question = $this->pdo->lastInsertId();
        $prepare->closeCursor();

        /**
         * inset into DB answer to the define question;
         */
        $prepare = $this->pdo->prepare("INSERT INTO `Answer` VALUES (NULL, :idquestion, :answer, :isright)");
        foreach ($Answer as $oneAnswer) {
            $prepare->bindParam(":idquestion", $id_New_Added_Question);
            $toPoprawnaOdpowiedz = stripos($oneAnswer, "$") != False ? true : false;
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

    public function __Admin__QuestionRemoveById($idQuestion)
    {
        $prepare = $this->pdo->prepare("DELETE FROM `Question` WHERE idQuestion=:idQuestion");
        $prepare->bindParam(":idQuestion", $idQuestion);
        $prepare->execute();
        $prepare->closeCursor();
        return null;
    }

    public function __Admin__QuestionRemoveByQuestion($Question)
    {
        $prepare = $this->pdo->prepare("DELETE FROM `Question` WHERE `Question`=\":question\"");
        $prepare->bindParam(":question", $Question);
        $prepare->execute();
        $prepare->closeCursor();
        return null;
    }

    public function __Admin__QuestionQuery()
    {
        $prepare = $this->pdo->prepare("SELECT * FROM `Question`");
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        $prepare->closeCursor();
        if ($prepare->rowCount() > 0) {
            $assoc = $prepare->fetchAll();
            return $assoc;
        }
        return null;
    }

    public function __Admin__QuestionUpdate($idQuestion, $text)
    {
        $sprawdzenia = $this->pdo->prepare("SELECT * FROM `Question` WHERE idQuestion=\":id\"");
        $sprawdzenia->bindParam(":id", $idQuestion);
        $sprawdzenia->setFetchMode(PDO::FETCH_ASSOC);
        $sprawdzenia->execute();
        $sprawdzenia->closeCursor();
        if ($sprawdzenia->rowCount() > 0) {
            $prepare = $this->pdo->prepare(" UPDATE `Question` SET `Question`=\":text\" WHERE `idQuestion`=\":id\"");
            $prepare->bindParam(":id", $idQuestion);
            $prepare->bindParam(":text", $text);
            $prepare->execute();
            $prepare->closeCursor();
        }
        return null;
    }

    public function __Admin__AnswerUpdate($idAnswer, $idQuestion, $text, $right)
    {
        $sprawdzenia = $this->pdo->prepare("SELECT * FROM `Answers` WHERE `idQuestion`=\":id\"");
        $sprawdzenia->bindParam(":id", $idQuestion);
        $sprawdzenia->setFetchMode(PDO::FETCH_ASSOC);
        $sprawdzenia->execute();
        $sprawdzenia->closeCursor();
        if (($sprawdzenia->rowCount() > 0) && $right == true) {
            $prepare = $this->pdo->prepare(" UPDATE `Answers` SET `Right`=FALSE WHERE `idQuestion`=\":id\"");
            $prepare->bindParam(":id", $idQuestion);
            $prepare->execute();
            $prepare->closeCursor();
            $prepare = $this->pdo->prepare("UPDATE `Answers` SET `Answer`=`:text`,`Right`=FALSE WHERE `idAnswers`=\":id\"");
            $prepare->bindParam(":id", $idAnswer);
            $prepare->bindParam(":text", $text);
            $prepare->execute();
            $prepare->closeCursor();
        } elseif (($sprawdzenia->rowCount() > 0) && $right == false) {
            $prepare = $this->pdo->prepare("UPDATE `Answers` SET `Answer`=`:text`,`Right`=FALSE WHERE `idAnswers`=\":id\"");
            $prepare->bindParam(":id", $idAnswer);
            $prepare->bindParam(":text", $text);
            $prepare->execute();
            $prepare->closeCursor();
        }
        return null;
    }

    public function __Admin__AnswerAdd($idQuestion, $text, $right)
    {
        $sprawdzenia = $this->pdo->prepare("SELECT * FROM `Answers` WHERE `idQuestion`=\":id\" AND `Answer`=\":text\"");
        $sprawdzenia->bindParam(":id", $idQuestion);
        $sprawdzenia->setFetchMode(PDO::FETCH_ASSOC);
        $sprawdzenia->execute();
        $sprawdzenia->closeCursor();
        if (($sprawdzenia->rowCount() == 0) && $right == true) {
            $prepare = $this->pdo->prepare(" UPDATE `Answers` SET `Right`=FALSE WHERE `idQuestion`=\":id\"");
            $prepare->bindParam(":id", $idQuestion);
            $prepare->execute();
            $prepare->closeCursor();
            $prepare = $this->pdo->prepare(" INSERT INTO `Answers` VALUES (NULL,:id,\":text\",TRUE)");
            $prepare->bindParam(":id", $idQuestion);
            $prepare->bindParam(":text", $text);
            $prepare->execute();
            $prepare->closeCursor();
        } elseif (($sprawdzenia->rowCount() == 0) && $right == false) {
            $prepare = $this->pdo->prepare(" INSERT INTO `Answers` VALUES (NULL,:id,\":text\",FALSE)");
            $prepare->bindParam(":id", $idQuestion);
            $prepare->bindParam(":text", $text);
            $prepare->execute();
            $prepare->closeCursor();
        }
        return null;
    }

    public function __Admin__AnswerQuery($idQuestion)
    {
        $prepare = $this->pdo->prepare("SELECT * FROM `Answers` WHERE `idQuestion`=\":id\"");
        $prepare->bindParam(":id", $idQuestion);
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        $prepare->closeCursor();
        if ($prepare->rowCount() > 0) {
            $assoc = $prepare->fetchAll();
            return $assoc;
        }
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

    public function __Admin__TaskAdd($Task, $idResource, $LevelTo, $ResourceTo)
    {
        $prepare = $this->pdo->prepare("INSERT INTO `Task` VALUES (NULL , :idResources, :Task, :LevelTo, :ResourceTo)");
        $prepare->bindParam(":idResources", $idResource);
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

    public function __Admin__TaskUpdate($idTask, $Task, $idResource, $LevelTo, $ResourceTo)
    {
        $prepare = $this->pdo->prepare("UPDATE `Task` SET `idResources`=:idresource, `Task`=:task, `LevelTo`=:levelTo, `ResourceTo`=:resourceTo WHERE `idTask`=:idtask");
        $prepare->bindParam(":idtask", $idTask);
        $prepare->bindParam(":idresources", $idResource);
        $prepare->bindParam(":task", $Task);
        $prepare->bindParam(":levelTo", $LevelTo);
        $prepare->bindParam(":resourceTo", $ResourceTo);
        $prepare->execute();
        return null;
    }

    public function __Admin__ResourcesAdd($Resource, $ProductionUnit, string $IMG)
    {
        $sprawdzenia = $this->pdo->prepare("SELECT * FROM `Resources` WHERE Resource=\":Res\"");
        $sprawdzenia->bindParam(":Res", $Resource);
        $sprawdzenia->setFetchMode(PDO::FETCH_ASSOC);
        $sprawdzenia->execute();
        $sprawdzenia->closeCursor();
        if ($sprawdzenia->rowCount() <= 0) {
            $prepare = $this->pdo->prepare("INSERT INTO `Resources` VALUES (NULL , :Resource, :ProductionUnit, \":IMG\") ");
            $prepare->bindParam(":Resource", $Resource);
            $prepare->bindParam(":ProductionUnit", $ProductionUnit);
            $prepare->bindParam(":IMG", $IMG);
            $prepare->execute();
            $id_New_Added_Resource = $this->pdo->lastInsertId();
            $prepare->closeCursor();
            return $id_New_Added_Resource;
        } else {
            $fetchOBJ = $sprawdzenia->fetch();
            return $fetchOBJ["idResources"];
        }
    }

    public function __Admin__ResourcesRemove($idResource)
    {
        $prepare = $this->pdo->prepare("DELETE FROM `Resources` WHERE idResource=:idresource");
        $prepare->bindParam(":idresource", $idResource);
        $prepare->execute();
        $prepare->closeCursor();
        return null;
    }

    public function __Admin__ResourcesUpdate($Resource, $ProductionUnit, $IMG)
    {
        /**         * Update Resource productUnit;
         */
        $sprawdzenia = $this->pdo->prepare("SELECT * FROM `Resources` WHERE Resource=\":Res\"");
        $sprawdzenia->bindParam(":Res", $Resource);
        $sprawdzenia->setFetchMode(PDO::FETCH_ASSOC);
        $sprawdzenia->execute();
        $sprawdzenia->closeCursor();
        if ($sprawdzenia->rowCount() > 0) {
            $prepare = $this->pdo->prepare(" UPDATE `Resources` SET `ProductionUnit`=:unit, `IMG`=\":img\" WHERE `Resource`=\":rsr\"");
            $prepare->bindParam(":rsr", $Resource);
            $prepare->bindParam(":img", $IMG);
            $prepare->bindParam(":unit", $ProductionUnit);
            $prepare->execute();
            $prepare->closeCursor();
        }
        return null;
    }

    public function __Admin__ResourcesQuery()
    {
        $prepare = $this->pdo->prepare("SELECT * FROM `Resource` ");
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        $prepare->execute();
        $prepare->closeCursor();
        if ($prepare->rowCount() > 0) {
            $assoc = $prepare->fetchAll();
            return $assoc;
        }
        return null;
    }


}
