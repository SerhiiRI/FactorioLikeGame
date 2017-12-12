<?php
if (isset($_POST["edytuj_user"])) {

    if ($_POST["input_name"] != "" && $_POST["input_passwd"] != "" && $_POST["input_grafika"] != "" ) {

        include_once __DIR__ . "/../git-repo/resr/src/Controllers/MySQLController.php";
        $__update = \Controller\MySQLController::getInstance();

//echo "POST<br/>";
//echo "Grafika: ".$_POST["input_grafika"]."<br/>";
//echo "User: ".$_POST['input_name']."<br/>";
//echo "Pass: ".$_POST['input_passwd']."<br/>";
        $__update->__Admin__UserUpdate($_POST['input_name'], $_POST['input_passwd'], $_POST["input_grafika"]);
        $_SESSION["ActionInfo"] = "Edytowano użytkownika: " . $_POST["input_name"];
    }
}//FINISH

if (isset($_POST["del_user"])) {

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/MySQLController.php";
    $__update = \Controller\MySQLController::getInstance();

//echo "POST<br/>";
//echo "Grafika: ".$_POST["input_grafika"]."<br/>";
//echo "User: ".$_POST['input_name']."<br/>";
//echo "Pass: ".$_POST['input_passwd']."<br/>";
    $__update->__Admin__UserRemove($_POST['input_name']);
    $_SESSION["ActionInfo"] = "Usunięto użytkownika: " . $_POST["input_name"];
}//FINISH


if (isset($_POST["add_task"])) {

    if ($_POST["input_res_task"] != "" && $_POST["input_task"] != "" && $_POST["input_lvl_task"] != "" && $_POST["input_needed_task"] != "") {
        include_once __DIR__ . "/../git-repo/resr/src/Controllers/TaskController.php";
        $__TaskControler = \Controller\TaskController::getInstance();

//echo "POST<br/>";
//        echo "Zaznaczone: " . $_POST["input_res_task"] . "<br/>";
//        echo "Task: " . $_POST['input_task'] . "<br/>";
//        echo "LVL: " . $_POST['input_lvl_task'] . "<br/>";
//        echo "Need: " . $_POST['input_needed_task'] . "<br/>";

        $__TaskControler->add($_POST["input_res_task"], $_POST["input_task"], $_POST["input_lvl_task"], $_POST["input_needed_task"]);
        $_SESSION["ActionInfo"] = "Dodano nowe zadanie: " . $_POST["input_task"];
    }
}//FINISH

if (isset($_POST["edytuj_task"])) {

    if ($_POST["input_res_task"] != "" && $_POST["input_task"] != "" && $_POST["input_lvl_task"] != "" && $_POST["input_needed_task"] != "") {

        include_once __DIR__ . "/../git-repo/resr/src/Controllers/TaskController.php";
        $__TaskControler = \Controller\TaskController::getInstance();

//echo "POST<br/>";
//    echo "idOfTask: " . $_POST["idOfTask"] . "<br/>";
//    echo "Zaznaczone: " . $_POST["input_res_task"] . "<br/>";
//    echo "Task: " . $_POST['input_task'] . "<br/>";
//    echo "LVL: " . $_POST['input_lvl_task'] . "<br/>";
//    echo "Need: " . $_POST['input_needed_task'] . "<br/>";
        $__TaskControler->add($_POST["input_res_task"], $_POST["input_task"], $_POST["input_lvl_task"], $_POST["input_needed_task"]);
        $__TaskControler->remove($_POST["idOfTask"]);
        $_SESSION["ActionInfo"] = "Edytowano zadanie: " . $_POST["input_task"];
    }
}//FINISH

if (isset($_POST["del_task"])) {

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/TaskController.php";
    $__TaskControler = \Controller\TaskController::getInstance();

    $__TaskControler->remove($_POST["idOfTask"]);
    echo "Usunięto: " . $_POST['idOfTask'];
    $_SESSION["ActionInfo"] = "Usunięto zadanie: " . $_POST["idOfTask"];
}//FINISH


if (isset($_POST["add_fabryka"])) {

    if ($_POST['input_surowiec'] != "" && $_POST['input_wydobycie'] != "" && $_POST["input_fabryka"] != "") {
        include_once __DIR__ . "/../git-repo/resr/src/Controllers/ResourceController.php";
        $__ResControl = \Controller\ResourceController::getInstance();

        echo "POST<br/>";
        echo "Grafika: " . $_POST["input_grafika"] . "<br/>";
        echo "Name: " . $_POST["input_fabryka"] . "<br/>";
        echo "Surowiec: " . $_POST['input_surowiec'] . "<br/>";
        echo "Wydobycie: " . $_POST['input_wydobycie'] . "<br/>";
        $__ResControl->add($_POST['input_surowiec'], $_POST['input_wydobycie'], $_POST["input_fabryka"], $_POST["input_grafika"], $_POST["input_grafika"]);
        $_SESSION["ActionInfo"] = "Dodano surowiec/fabrykę: " . $_POST["input_surowiec"];
    }
}//FINISH

if (isset($_POST["edytuj_fabryka"])) {

    if ($_POST['input_surowiec'] != "" && $_POST['input_wydobycie'] != "" && $_POST["input_fabryka"] != "") {
        include_once __DIR__ . "/../git-repo/resr/src/Controllers/ResourceController.php";
        $__ResControl = \Controller\ResourceController::getInstance();

        echo "POST<br/>";
        echo "Grafika: " . $_POST["input_grafika"] . "<br/>";
        echo "Grafika: " . $_POST["input_grafika_hidden"] . "<br/>";
        echo "Name: " . $_POST["input_fabryka"] . "<br/>";
        echo "Surowiec: " . $_POST['input_surowiec'] . "<br/>";
        echo "Wydobycie: " . $_POST['input_wydobycie'] . "<br/>";
        $graf = ($_POST["input_grafika"] == "") ? $_POST["input_grafika_hidden"] : $_POST["input_grafika"];
        $__ResControl->update($_POST['input_surowiec'], $_POST['input_wydobycie'], $_POST["input_fabryka"], $_POST["input_grafika"], $graf);
        $_SESSION["ActionInfo"] = "Edytowano surowiec/fabrykę: " . $_POST["input_surowiec"];
    }
}//FINISH

if (isset($_POST["del_fabryka"])) {

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/ResourceController.php";
    $__ResControl = \Controller\ResourceController::getInstance();

//    echo "POST<br/>";
//    echo "Grafika: " . $_POST["input_grafika"] . "<br/>";
//    echo "ID: " . $_POST["input_id_hidden"] . "<br/>";
//    echo "Name: " . $_POST["input_fabryka"] . "<br/>";
//    echo "Surowiec: " . $_POST['input_surowiec'] . "<br/>";
//    echo "Wydobycie: " . $_POST['input_wydobycie'] . "<br/>";
    $__ResControl->removeByID($_POST["input_id_hidden"]);
    $_SESSION["ActionInfo"] = "Usunięto surowiec/fabrykę: " . $_POST["input_surowiec"];
}//FINISH


if (isset($_POST["add_Question"])) {

    if ($_POST['select_task'] != "" && $_POST['txt_pytanie'] != "" && $_POST['txt_odp'] != "" && $_POST["txt_zle1"] != "" && ["txt_zle2"] != "" && $_POST["txt_zle3"] != "") {
        include_once __DIR__ . "/../git-repo/resr/src/Controllers/QuestionController.php";
        $__QuestControl = \Controller\QuestionController::getInstance();

//        echo "POST<br/>";
//        echo "Task ID: " . $_POST["select_task"] . "<br/>";
//        echo "Pytanie: " . $_POST["txt_pytanie"] . "<br/>";
//        echo "Odp: " . $_POST["txt_odp"] . "<br/>";
//        echo "Źle: " . $_POST['txt_zle1'] . "<br/>";
//        echo "Źle: " . $_POST['txt_zle2'] . "<br/>";
//        echo "Źle: " . $_POST['txt_zle3'] . "<br/>";
        $__QuestControl->add($_POST["select_task"], $_POST["txt_pytanie"], $_POST["txt_odp"],$_POST["txt_zle1"],$_POST["txt_zle2"],$_POST["txt_zle3"]);

            $_SESSION["ActionInfo"] = "Dodano Pytanie: " . $_POST["txt_pytanie"];
    }
}//FINISH

if (isset($_POST["edytuj_Question"])) {

    if ($_POST['select_task'] != "" && $_POST['txt_pytanie'] != "" && $_POST['txt_odp'] != "" && $_POST["txt_zle1"] != "" && ["txt_zle2"] != "" && $_POST["txt_zle3"] != "") {
        include_once __DIR__ . "/../git-repo/resr/src/Controllers/QuestionController.php";
        $__QuestControl = \Controller\QuestionController::getInstance();

        echo "POST<br/>";
        echo "Task ID: " . $_POST["select_task"] . "<br/>";
        echo "Quest ID: " . $_POST["quest_id"] . "<br/>";
        echo "Pytanie: " . $_POST["txt_pytanie"] . "<br/>";
        echo "Odp: " . $_POST["txt_odp"] . "<br/>";
        echo "Źle: " . $_POST['txt_zle1'] . "<br/>";
        echo "Źle: " . $_POST['txt_zle2'] . "<br/>";
        echo "Źle: " . $_POST['txt_zle3'] . "<br/>";
        $__QuestControl->remove($_POST["quest_id"]);
        $__QuestControl->add($_POST["select_task"], $_POST["txt_pytanie"], $_POST["txt_odp"],$_POST["txt_zle1"],$_POST["txt_zle2"],$_POST["txt_zle3"]);
        $_SESSION["ActionInfo"] = "Edytowano pytanie: " . $_POST["txt_pytanie"];
    }
}//FINISH

if (isset($_POST["del_Question"])) {
    include_once __DIR__ . "/../git-repo/resr/src/Controllers/QuestionController.php";
    $__QuestControl = \Controller\QuestionController::getInstance();
//    echo "Quest ID: " . $_POST["quest_id"] . "<br/>";
    $__QuestControl->remove($_POST["quest_id"]);
    $_SESSION["ActionInfo"] = "Usunięto pytanie: " . $_POST["quest_id"];
}//FINISH

header("Location: AdminControllerSystem.php");
?>
<br/>
<a href="AdminControllerSystem.php">Back to Admin</a>
