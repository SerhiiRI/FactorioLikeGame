<?php

function javamessage($txt){
    echo "<script type='text/javascript'>alert('$txt');</script>";
}

function LewyPanelAdmina()
{
    include_once __DIR__ . "/../Controllers/UserController.php";
    $__userControler = \Controller\UserController::getInstance();

//    include_once __DIR__ . "/../Controllers/FactoryInstanceController.php";
//    $__facControler = \Controller\FactoryInstanceController::getInstance();

    include_once __DIR__ . "/../Controllers/ResourceController.php";
    $__resControler = \Controller\ResourceController::getInstance();


    include_once __DIR__ . "/../Controllers/TaskController.php";
    $__taskControler = \Controller\TaskController::getInstance();


    include_once __DIR__ . "/../Controllers/TaskController.php";
    $__scoreControler = \Controller\ScoreController::getInstance();


    $nameOfUser = $_SESSION["name_of_user"]; //Nazwa użytkowanik
    $userData = $__userControler->SearchByEmail($nameOfUser);
//    $factoryData = $__facControler->returnArray();
    $__surowce = $__resControler->returnArray();

    $howManyTask = 0;
    $TaskListByLvl = $__taskControler->returnTaskByLvl($userData->getLevel() + 1);
    foreach ($TaskListByLvl as $item) {
            $howManyTask++;
    }

    $howManyCurrentTask=0;
    $TaskList = $__taskControler->returnOnlyCurrentUserTaskArray();
    foreach ($TaskList as $item) {
        if ($item->getLevelTo() <= $userData->getLevel() + 1) {
            $status = $__scoreControler->searchByIdTask($item->getidTask());
            if ($status == false) {
                $howManyCurrentTask++;
            }
        }
    }
        //javamessage("Task: $howManyTask, CTask: $howManyCurrentTask");


    $imageOfUser = "resr/img/" . $userData->getIMG(); //Grafika usera
    $lvlGracza = $userData->getLevel();
    $LastLogin = $userData->getLastLogined();
    $secure = ($userData->getType() == 1) ? "Administrator" : "Gracz";

    $show = <<<HTML
    <div class="aleks_user_panel">

                <!--            Obrazek użytkownika-->
                <div class="aleks_user_img_div">
                    <img class="aleks_user_img" src="$imageOfUser"/>
                    <h5>$nameOfUser<br><span class="alx_h6_font_grey">- Poziom: $lvlGracza -</span></h5>

                    <!-- Funkcje dla admina -->
                    <br/>
                    <br/>
HTML;
    echo $show;
    $progress_start_calc = 0;
    $progress_finish_calc = 0;
    foreach ($__surowce as &$res) {
//            $surowiec = $__resControler->searchByID($res->getidResource());
        $surowiec = $res->getResourceName();
        $progres = rand(0, 100);
        $finish = 100;
        $progres_procent = ($progres * 100) / $finish;

    }
    ?>
<!--<p id="serhii_log"></p>-->
<?php
    $eofg="";
    $finishTask = $howManyTask - $howManyCurrentTask;
    if($howManyTask<=0 && $howManyTask<=0){
        $progres_procent=0;
        $wynik="It's end of game!";
        $eofg = "gameover";
    }else {
        $progres_procent = ($finishTask * 100) / $howManyTask;
        $wynik = "Postęp: " . round($progres_procent) . "%";
    }
//    $ButtonDisabled = ($progres_procent == 100) ?: "disabled";
    $ButtonDisabled = "disabled";
    if($progres_procent == 100){$ok="ok";}else{$ok="nope";}
//    javamessage("$progres_procent");
    $ButtonValue = ($progres_procent == 100) ? "LVL UP!" : $wynik;

    $show = <<<HTML

<p id="serhii_log"></p>

                <div class="alx_lvl_up_btn">
                    <button name="levelup_btn" class="btn btn_lvlup" id="lvlupBTN" value="$ok" onclick="lvlup_gratulation_open('$eofg')" $ButtonDisabled>
                    $ButtonValue
                    </button>
                </div>
                </div>
                        
                        <!--                        WYLOGOWANIE-->
                        <div class="alx_btn_logout">
                    <table>
                        <tr class="alx_przycisk_na_lewym_panelu">
                            <td class="alx_td_left alx_border_none">
                                <a href="hard_logout.php" class="alx_przycisk_wylogowania">
                                    <i class="icon-logout aleks_icon_logout"></i> Wyloguj
                                </a>
                            </td>
                        </tr>
                    </table>
                    </div>
            </div>
HTML;
    echo $show;
} //Dane wyświetlane po lewej stronie okna przeglądarki

function MapaFabryki()
{
    include_once __DIR__ . "/../Controllers/UserController.php";
    $__userControler = \Controller\UserController::getInstance();

    include_once __DIR__ . "/../Controllers/FactoryInstanceController.php";
    $__facControler = \Controller\FactoryInstanceController::getInstance();

    include_once __DIR__ . "/../Controllers/MapController.php";
    $__mapControler = \Controller\MapController::getInstance();

    include_once __DIR__ . "/../Controllers/ResourceController.php";
    $__resControler = \Controller\ResourceController::getInstance();

    $nameOfUser = $_SESSION["name_of_user"]; //Nazwa użytkowanik
    $userData = $__userControler->SearchByEmail($nameOfUser);
    $userID = $userData->getidUser();

    $userMap = (!empty($__mapControler->returnArrayByID($userID))) ? $__mapControler->returnArrayByID($userID) : null;
    if (!empty($userMap)) {
        foreach ($userMap as &$item) {
            $CountFactory = $item->getCountFactory();
            for ($pi = 0; $pi < $CountFactory; $pi++) {
                $factoryID = $item->getidFactory();
                $WhichFactoryOnMap = $__facControler->returnFactoryByID($factoryID);
//            echo "<pre>";print_r($WhichFactoryOnMap);echo "</pre>";
                $WhatIsIDofResource = $WhichFactoryOnMap->getidResource();
//                echo "<pre>";print_r($WhatIsIDofResource);echo "</pre>";
                $WhichResource = $__resControler->returnArrayByID($WhatIsIDofResource);

                $lvl = $WhichFactoryOnMap->getUpgrade();
                $nameOfFactory = $WhichResource->getFactoryName();
                $nameOfResource = $WhichResource->getResourceName();
                $wydobycie = $WhichResource->getProductiveUnit();
                $grafika = $WhichResource->getIMGFactory();
                $show = <<<HTML
                <div class="alx_flex_dla_mapy_diva">
                    <img src="resr/img/$grafika" class="alx_flexy_w_divie_map" onclick="func_open_zindex('$grafika', '$wydobycie', '$lvl', '$nameOfFactory', '$nameOfResource', '$factoryID')">
                </div>
HTML;
                echo $show;
            }
        }
    } else {
        echo "<h4>Brak obiektów na mapie</h4>";
    }
} //Tabela z fabrykami

function PanelKontrolnyFabryki()
{

    $show = <<<HTML

<div class="alx_flexkontener_0" id="alx_flexkontener_0">
        <div id="edit_bg_1" class="alx_user_fabryka_flexkontener_A">
            <div class="alx_flexy_w_edycji_fabryk_pic">
                <img src="resr/img/Wood.png" class="alx_flexy_w_edycji_fabryk_pic_child" id="grafika_ligthbox">
                <img src="resr/img/gear3.svg" class="alx_btn_floating_ligthbox" id="working_ico">
            </div>
            <div class="alx_user_fabryka_flexkontener_B">
                <div class="alx_info_group_ligthbox">
                    <p class="alx_flexy_w_edycji_fabryk_info" id="lvl_ligthbox">?</p>
                    <p class="alx_flexy_w_edycji_fabryk_info" id="wydobycie_ligthbox">?</p>
                    <!--<p class="alx_flexy_w_edycji_fabryk_info">Opcjonalnie</p>-->

                </div>
                <p class="alx_flexy_w_edycji_fabryk_opis" id="opis_fabryki"></p>
                <div class="alx_button_group_ligthbox">
                    <!--<button class="btn alx_flexy_w_edycji_fabryk_button">Upgrade!</button>-->
                    <!--<button class="btn alx_flexy_w_edycji_fabryk_button" onclick="stop_working()" id="onClickWorking">Wstrzymaj/wznów prace</button>-->
                <form action="db_update_user.php" method="post" class="alx_button_group_ligthbox">
                    <input type="hidden" id="idOfFactoryOnMap" name="idOfFactoryOnMap">
                    <button class="btn alx_flexy_w_edycji_fabryk_button" name="destroy_factory">Zniszcz fabrykę</button>
                </form>
                    <button class="btn alx_flexy_w_edycji_fabryk_button" onclick="func_close_zindex()">Zamknij okno
                    </button>
                </div>
            </div>
        </div>
    </div>

HTML;
    echo $show;


}

function ListaTaskowDlaUsera()
{
    include_once __DIR__ . "/../Controllers/UserController.php";
    $__userControler = \Controller\UserController::getInstance();

    include_once __DIR__ . "/../Controllers/TaskController.php";
    $__taskControler = \Controller\TaskController::getInstance();

    include_once __DIR__ . "/../Controllers/MapController.php";
    $__mapControler = \Controller\MapController::getInstance();

    include_once __DIR__ . "/../Controllers/QuestionController.php";
    $__questController = \Controller\QuestionController::getInstance();

    include_once __DIR__ . "/../Controllers/TaskController.php";
    $__scoreControler = \Controller\ScoreController::getInstance();

    $nameOfUser = $_SESSION["name_of_user"]; //Nazwa użytkowanik
    $userData = $__userControler->SearchByEmail($nameOfUser);
    $userID = $userData->getidUser();

    $howManyCurrentTask=0;
    $TaskList = $__taskControler->returnOnlyCurrentUserTaskArray();
    foreach ($TaskList as $item) {
        if ($item->getLevelTo() <= $userData->getLevel() + 1) {
            $status = $__scoreControler->searchByIdTask($item->getidTask());
            if ($status == false) {
                $howManyCurrentTask++;
                $lvl = $item->getLevelTo();
                $opis = $item->getTask();
                $taskID = $item->getidTask();
                $odkrycie = $item->getResourceTo();
//        $var = "456";

                $QuestData = $__questController->searchQuestionByIdOf_Task($taskID);
//            echo "<pre>";print_r($QuestData);echo"</pre>";
                $task = $opis;
                $quest = $QuestData->getQuestion();
                $answers = $QuestData->getAnswerList();
                $idQuest = $QuestData->getIdQuestion();
                $rand = rand(0, 2);
                if ($rand == 0) {
                    $odp1 = $answers[1]->getAnswer();
                    $odp2 = $answers[0]->getAnswer();
                    $odp3 = $answers[2]->getAnswer();
                    $odp4 = $answers[3]->getAnswer();
                    $odp1_id = $answers[1]->getidAnswers();
                    $odp2_id = $answers[0]->getidAnswers();
                    $odp3_id = $answers[2]->getidAnswers();
                    $odp4_id = $answers[3]->getidAnswers();
                } else if ($rand == 1) {
                    $odp1 = $answers[3]->getAnswer();
                    $odp2 = $answers[1]->getAnswer();
                    $odp3 = $answers[0]->getAnswer();
                    $odp4 = $answers[2]->getAnswer();
                    $odp1_id = $answers[3]->getidAnswers();
                    $odp2_id = $answers[1]->getidAnswers();
                    $odp3_id = $answers[0]->getidAnswers();
                    $odp4_id = $answers[2]->getidAnswers();
                } else if ($rand == 2) {
                    $odp1 = $answers[2]->getAnswer();
                    $odp2 = $answers[1]->getAnswer();
                    $odp3 = $answers[3]->getAnswer();
                    $odp4 = $answers[0]->getAnswer();
                    $odp1_id = $answers[2]->getidAnswers();
                    $odp2_id = $answers[1]->getidAnswers();
                    $odp3_id = $answers[3]->getidAnswers();
                    $odp4_id = $answers[0]->getidAnswers();
                }


                $show = <<<HTML
<div class="collapsible-body alx_flexkontener_user_task">
                            <div class="alx_flex_user_task">
                                Wymagany poziom: $lvl
                            </div>
                            <div class="alx_flex_user_task">
                                Opis: $opis
                            </div>
                            <div class="alx_flex_user_task">
                                <div class="alx_flex_user_task_forbtn">
                                    <div class="alx_flex_user_task_btn">
                                        <button class="btn" id="addBtnDesibled" name="addBtnDesibled" onclick="lvlup_open_zindex('$task', '$taskID', '$quest', '$idQuest', '$odp1', '$odp2', '$odp3', '$odp4', '$odp1_id', '$odp2_id', '$odp3_id', '$odp4_id');">Badaj</button>
                                    </div>
                                </div>
                            </div>
                        </div>
HTML;
                echo $show;
            } else {
                $lvl = $item->getLevelTo();
                $opis = $item->getTask();
                $odkrycie = $item->getResourceTo();
//        $var = "456";

                $show = <<<HTML
<div class="collapsible-body alx_flexkontener_user_task">
                            <div class="alx_flex_user_task">
                                Wymagany poziom: $lvl
                            </div>
                            <div class="alx_flex_user_task">
                                Opis: $opis
                            </div>
                            <div class="alx_flex_user_task">
                                <div class="alx_flex_user_task_forbtn">
                                    <div class="alx_flex_user_task_btn">
                                        <button class="btn" onclick="lvlup_open_zindex()" disabled>Finished</button>
                                    </div>
                                </div>
                            </div>
                        </div>
HTML;
                //---------------Desibled tasks
                echo $show;
            }
        }
    }
}

function ListaFabrykDoBudowyDlaUsera()
{
    include_once __DIR__ . "/../Controllers/ResourceController.php";
    $__ResControler = \Controller\ResourceController::getInstance();

    include_once __DIR__ . "/../Controllers/UserController.php";
    $__userControler = \Controller\UserController::getInstance();

    $nameOfUser = $_SESSION["name_of_user"]; //Nazwa użytkowanik
    $userData = $__userControler->SearchByEmail($nameOfUser);
    $idUser = $userData->getidUser();
    $_SESSION['idUser'] = $idUser;

    $factoryData = $__ResControler->returnArrayForCurrentUserResource($idUser);
    if(!empty($factoryData)) {
        $action = "db_update_user.php";
//    echo "<pre>";print_r($factoryData);echo"</pre>";

        foreach ($factoryData as &$item) {

            $fabricName = $item->getFactoryName();//jaka fabryka wydobywa
            $surowiec = $item->getResourceName();//jaki surowiec jest wydobywany
            $wydobyciePodstawowe = $item->getProductiveUnit();//wydobycie na 1 lvl
            $fabrykaGrafika = ($item->getIMGFactory() == "") ? "image.svg" : $item->getIMGFactory(); //Grafika fabryki
            $id_res = $item->getIdResources();
            $upgradeLvl = 1;

            $show = <<<HTML
                            <div class="collapsible-body">
                                <table>
                                    <tr>
                                        <form action="$action" method="post">
                                          <input type="hidden" value="$id_res" name="idResource">
                                          <input type="hidden" value="$upgradeLvl" name="upgradeLvl">
                                          <input type="hidden" value="$idUser" name="idUser">
                                            <td class="alx_szerokosc_kolumny_dla_grafiki_w_statystyce">
                                                <div class="file-field input-field">
                                                    <div class="btn-floating alx_btn_floating">
                                                        <i class="icon-wrench"></i>
                                                        <input type="hidden" value="$fabrykaGrafika" name="input_grafika_hidden">
                                                    </div>
                                                    <img src="resr/img/$fabrykaGrafika" class="alx_img_src">
                                                </div>
                                            </td>
                                            <td class="alx_tabela_surowcow_admin">
                                                <div class="input-field">
                                                    <input disabled value="$fabricName" id="first_name2" type="text" class="validate" name="input_fabryka">
                                                    <label class="active" for="first_name2">Fabryka</label>
                                                </div>
                                            </td>
                                            <td class="alx_tabela_surowcow_admin">
                                                <div class="input-field">
                                                    <input disabled value="$surowiec" id="first_name2" type="text" class="validate" name="input_surowiec">
                                                    <label class="active" for="first_name2">Surowiec</label>
                                                </div>
                                            </td>
                                            <td class="alx_tabela_surowcow_admin">
                                                <div class="input-field">
                                                    <input disabled value="$wydobyciePodstawowe" id="first_name2" type="number" class="validate" name="input_wydobycie">
                                                    <label class="active" for="first_name2">Wydobycie</label>
                                                </div>
                                            </td>

                                            <!--                                            BUTTONY-->
                                            <td class="alx_edit_users_button">
                                                <table>
                                                    <tr class="alx_padding_edit_users_button">
                                                        <div class=" alx_padding_edit_users_button">
                                                            <button class="btn waves-effect waves-light alx_h8_font alx_button_width"
                                                                    type="submit"
                                                                    name="create_factory">
                                                                Buduj <i class="icon-tools alx_h8_font"></i>
                                                            </button>
                                                        </div>
                                                    </tr>
                                                        </div>
                                                    </tr>
                                                </table>
                                            </td>
                                        </form>
                                    </tr>
                                </table>
                            </div><!-- Elementy do wczytaj i edytuj-->
HTML;
            echo $show;
        }
    }else{
        echo "<div class=\"collapsible-body\"><h4 style='padding: 2rem; text-align: center'>Nie odkryto jeszcze technologii</h4></div>";
        header("Location: Map.php?");
    }
}

function lvlupLightbox()
{
    include_once __DIR__ . "/../Controllers/QuestionController.php";
    $__questControler = \Controller\QuestionController::getInstance();

    $_SESSION["whatShouldOpen"] = "Task";

//    $action="#";
    $action="db_update_user.php";
    $task = "Podstawowe wydobywanie rudy węgla.";
    $quest = "Czy możesz użyć węgla jako paliwa?";
    $odp1="Tak";
        $odp2="Nie";
            $odp3="Może";
                $odp4="PHP";
    $show = <<<HTML
<div class="alx_flexkontener_lvlup_bg" id="lvlup_lightbox">
        <div class="alx_flexkontener_lvlup_1" >
            <div class="alx_flex_lvlup_1" id="task_lightbox">Pytanie do zadania: <br/>$task</div>
            <div class="alx_flex_lvlup_3" id="quest_lightbox">Pytanie: <br/>$quest</div>
            <form class="alx_flex_lvlup_2" method="post" action="$action">
                <input type="hidden" id="hodp1" name="hodp1" value="Defoult"/>
                <input type="hidden" id="hodp2" name="hodp2" value="Defoult"/>
                <input type="hidden" id="hodp3" name="hodp3" value="Defoult"/>
                <input type="hidden" id="hodp4" name="hodp4" value="Defoult"/>
                <input type="hidden" id="questID" name="questID" value="Defoult"/>
                <input type="hidden" id="taskID" name="taskID" value="Defoult"/>
                <button class="btn alx_flex_lvlup_2_1" id="odp1" name="odp1">$odp1</button>
                <button class="btn alx_flex_lvlup_2_1" id="odp2" name="odp2">$odp2</button>
                <button class="btn alx_flex_lvlup_2_1" id="odp3" name="odp3">$odp3</button>
                <button class="btn alx_flex_lvlup_2_1" id="odp4" name="odp4">$odp4</button>
            </form>
        </div>
    </div>
HTML;
    echo $show;
}


function lvlupGratulation()
{
    $show = <<<HTML
<div class="alx_flexkontener_lvlup_bg" id="lvlup_gratulation">
        <div class="alx_pepe_lvlup">
        <h1 class="alx_pepe_text">LEVEL UP!</h1>
            <img src="resr/img/DancingPepe.gif" class="alx_pepe_size" onclick="lvlup_gratulation_close()">
        <h1 class="alx_pepe_text">Congratulation!</h1>
        </div>
    </div>
HTML;
    echo $show;
}


?>