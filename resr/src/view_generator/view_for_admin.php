<?php

function LewyPanelAdmina()
{
    include_once __DIR__ . "/../Controllers/UserController.php";
    $__userControler = \Controller\UserController::getInstance();

    $uIS_tmp = 0;
    $usersInSysytem = $__userControler->returnArray();
    foreach ($usersInSysytem as &$item) {
        $uIS_tmp++;
    }
    $_SESSION["HowManyUsers"] = $uIS_tmp;
    $nameOfUser = $_SESSION["name_of_user"]; //Nazwa użytkowanik
    $userData = $__userControler->SearchByEmail($nameOfUser);

//    $imageOfUser = $userData->getIMG(); //Grafika admina
    $imageOfUser = ($userData->getIMG() == '') ? "defoult_user.svg" : $userData->getIMG();
    $lastVisit = $_SESSION["LastLogin"];
    $usersInSysytem = $_SESSION["HowManyUsers"];
    $show = <<<HTML
    <div class="aleks_user_panel">
                <!--            Obrazek użytkownika-->
                <div class="aleks_user_img_div">
                    <img class="aleks_user_img" src="resr/img/$imageOfUser"/>
                    <h5>$nameOfUser<br><span class="alx_h6_font_grey">- Administrator -</span></h5>

                    <!-- Funkcje dla admina -->
                    <br/>
                    <br/>
                    <table class="alx_table_admin_menu">
                        <tr class="alx_przycisk_na_lewym_panelu">
                            <td class="alx_td_left"><p class="alx_ststystyka">Użytkownicy w systemie:</p>
                            <span style="font-weight: lighter">$usersInSysytem</span></td>
                        </tr>
                        <tr class="alx_przycisk_na_lewym_panelu">
                            <td class="alx_td_left"><p class="alx_ststystyka">Ostatnie logowanie:</p><span style="font-weight: lighter">$lastVisit</span></td>
                        </tr>
                        <!--<tr>-->
                            <!--<td class="alx_admin_standardowy_element_menu_lewy_panel">Ustawienia</td>-->
                        <!--</tr>-->
                    </table>

                </div>
                        
                        <!--                        WYLOGOWANIE-->
                        <div class="alx_btn_logout">
                    <table>
                        <tr class="alx_przycisk_na_lewym_panelu_wyloguj">
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
} //Dane wyświetlane po lewej stronie okna przeglądarki//FINISH

function wyswietlanieStatystykSystemu()
{

    $lastVisit = $_SESSION["LastLogin"];
    $usersInSysytem = $_SESSION["HowManyUsers"];
    $show = <<<HTML
<div class="collapsible-body alx_ststystyka">
        <table>
            <tr>
                <td><p class="alx_ststystyka_ico"><i class="icon-users"></i></p></td>
                <td><p class="alx_ststystyka_txt">Użytkowników w systemie:</p><span style="font-weight: lighter">$usersInSysytem</span></td>
            </tr>
        </table>        
    </div>
<div class="collapsible-body alx_ststystyka">
        <table>
            <tr>
                <td><p class="alx_ststystyka_ico"><i class="icon-users"></i></p></td>
                <td><p class="alx_ststystyka_txt">Ostatnie logowanie:</p><span style="font-weight: lighter">$lastVisit</span></td>
            </tr>
        </table>        
    </div>
HTML;
    echo $show;
} //Edycja surowców oraz odpowiedzialnych za wydobycie fabryk//FINISH

function zarządzanieFabrykamiOrazSurowcami()
{
    include_once __DIR__ . "/../Controllers/ResourceController.php";
    $__ResControler = \Controller\ResourceController::getInstance();

    $factoryData = $__ResControler->returnArray();
    $action = "db_update.php";

    $show = <<<HTML
                        <div class="collapsible-body">
                            <table>
                                <tr>
                                    <form action="$action" method="post">
                                       <td class="alx_szerokosc_kolumny_dla_grafiki_w_statystyce">
                                                <div class="file-field input-field">
                                                    <div class="btn-floating alx_btn_floating">
                                                        <i class="icon-plus"></i>
                                                        <input type="file" name="input_grafika">
                                                    </div>
                                                    <img src="resr/img/image.svg" class="alx_img_src">
                                                </div>
                                            </td>
                                            <td class="alx_tabela_surowcow_admin">
                                                <div class="input-field">
                                                    <input value="" id="first_name2" type="text" class="validate" name="input_fabryka">
                                                    <label class="active" for="first_name2">Fabryka</label>
                                                </div>
                                            </td>
                                            <td class="alx_tabela_surowcow_admin">
                                                <div class="input-field">
                                                    <input value="" id="first_name2" type="text" class="validate" name="input_surowiec">
                                                    <label class="active" for="first_name2">Surowiec</label>
                                                </div>
                                            </td>
                                            <td class="alx_tabela_surowcow_admin">
                                                <div class="input-field">
                                                    <input value="" id="first_name2" type="number" class="validate" name="input_wydobycie">
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
                                                                name="add_fabryka">
                                                            Dodaj <i class="icon-plus alx_h8_font"></i>
                                                        </button>
                                                    </div>
                                                </tr>
                                            </table>
                                        </td>
                                    </form>
                                </tr>
                            </table>
                        </div> <!--Element dodający (ostatni)-->
HTML;
    echo $show;
    //Dodawanie nowego surowca/fabryki


    foreach ($factoryData as &$item) {

        $fabricName = $item->getFactoryName();//jaka fabryka wydobywa
        $surowiec = $item->getResourceName();//jaki surowiec jest wydobywany
        $wydobyciePodstawowe = $item->getProductiveUnit();//wydobycie na 1 lvl
//        $imageOfUser = $item->getIMGFactory(); //Grafika fabryki
        $fabrykaGrafika = ($item->getIMGFactory() == "") ? "image.svg" : $item->getIMGFactory(); //Grafika fabryki
        $id_res = $item->getIdResources();
        if($fabricName=="Wodociąg"){
            $dontTouch="disabled";
        }else{
            $dontTouch="";
        }

        $show = <<<HTML
                            <div class="collapsible-body">
                                <table>
                                    <tr>
                                        <form action="$action" method="post">
                                          <input type="hidden" value="$id_res" name="input_id_hidden">
                                            <td class="alx_szerokosc_kolumny_dla_grafiki_w_statystyce">
                                                <div class="file-field input-field">
                                                    <div class="btn-floating alx_btn_floating">
                                                        <i class="icon-wrench"></i>
                                                        <input type="file" name="input_grafika" >
                                                        <input type="hidden" value="$fabrykaGrafika" name="input_grafika_hidden">
                                                    </div>
                                                    <img src="resr/img/$fabrykaGrafika" class="alx_img_src">
                                                </div>
                                            </td>
                                            <td class="alx_tabela_surowcow_admin">
                                                <div class="input-field">
                                                    <input value="$fabricName" id="first_name2" type="text" class="validate" name="input_fabryka">
                                                    <label class="active" for="first_name2">Fabryka</label>
                                                </div>
                                            </td>
                                            <td class="alx_tabela_surowcow_admin">
                                                <div class="input-field">
                                                    <input value="$surowiec" id="first_name2" type="text" class="validate" name="input_surowiec">
                                                    <label class="active" for="first_name2">Surowiec</label>
                                                </div>
                                            </td>
                                            <td class="alx_tabela_surowcow_admin">
                                                <div class="input-field">
                                                    <input value="$wydobyciePodstawowe" id="first_name2" type="number" class="validate" name="input_wydobycie">
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
                                                                    name="edytuj_fabryka">
                                                                Edytuj <i class="icon-cogs alx_h8_font"></i>
                                                            </button>
                                                        </div>
                                                    </tr>
                                                    <tr class="alx_padding_edit_users_button">
                                                        <div class="alx_padding_edit_users_button">
                                                            <button class="btn waves-effect waves-light alx_h8_font alx_button_width"
                                                                    type="submit"
                                                                    name="del_fabryka" $dontTouch>
                                                                Usuń <i class="icon-block alx_h8_font"></i>
                                                            </button>
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
}//Edycja fabryk i surowców //FINISH

function EdycjaPytanDoGry()
{
    include_once __DIR__ . "/../Controllers/QuestionController.php";
    $__QuestControler = \Controller\QuestionController::getInstance();

    include_once __DIR__ . "/../Controllers/TaskController.php";
    $__TaskControler = \Controller\TaskController::getInstance();

    $TaskData = $__TaskControler->returnArray();
    if ($__QuestControler->returnArray() == null) {
        $action = "db_update.php";

        $show = <<<HTML
    <div class="collapsible-body">
        <div class="alx_flexkontener_quest">
                                        <form action="$action" method="post">
                                        <select name="select_task">
                                        <option value="" disabled selected>Lista Zadań</option>
                                        
                                        
HTML;
        echo $show;
        foreach ($TaskData as &$Item) {
            $task = $Item->getTask();
            $task_id = $Item->getidTask();
//            print_r($test);
            $show = <<<HTML
                                        <option value="$task_id">$task</option>
HTML;
            echo $show;
        }

        $show = <<<HTML
                                        </select>                                    
                                    <table>
                                    <tr>
                                            <td class="alx_flex_quest_input">
                                                <div class="input-field col s12">
                                                    <textarea id="textarea1" class="materialize-textarea" name="txt_pytanie"></textarea>
                                                    <label for="textarea1" >Pytanie</label>
                                                </div>
                                            </td>
                                            <td class="alx_edytor_pytań">
                                                <div class="input-field col s12">
                                                    <textarea id="textarea1" class="materialize-textarea" name="txt_odp"></textarea>
                                                    <label for="textarea1">Odpowiedź</label>
                                                </div>
                                            </td>
                                            </tr>
                                            </table>
                                            
                                            <table>
                                            <tr>                                           
                                            <td class="alx_edytor_pytań">
                                                <div class="input-field col s12">
                                                    <textarea id="textarea1" class="materialize-textarea" name="txt_zle1"></textarea>
                                                    <label for="textarea1">Źle</label>
                                                </div>
                                            </td>
                                            <td class="alx_edytor_pytań">
                                                <div class="input-field col s12">
                                                    <textarea id="textarea1" class="materialize-textarea" name="txt_zle2"></textarea>
                                                    <label for="textarea1">Źle</label>
                                                </div>
                                            </td>
                                            <td class="alx_edytor_pytań">
                                                <div class="input-field col s12">
                                                    <textarea id="textarea1" class="materialize-textarea" name="txt_zle3"></textarea>
                                                    <label for="textarea1">Źle</label>
                                                </div>
                                            </td>

                                            <!--                                            BUTTONY-->
                                            <td class="alx_edit_users_button">
                                                <table>
                                                    <tr class="alx_padding_edit_users_button">
                                                        <div class="alx_padding_edit_users_button">
                                                            <button class="btn waves-effect waves-light alx_h8_font alx_button_width"
                                                                    type="submit"
                                                                    name="add_Question">
                                                                Dodaj <i class="icon-plus alx_h8_font"></i>
                                                            </button>
                                                        </div>
                                                    </tr>
                                                </table>
                                            </td>
                                            </tr>
                                            </table>
                                        </form>
                                </div>
                            </div> <!--Ostatnii element dodający-->
HTML;
        echo $show;
    } else {
        $QuestData = $__QuestControler->returnArray();
        $action = "db_update.php";

        $show = <<<HTML
    <div class="collapsible-body">
        <div class="alx_flexkontener_quest">
                                        <form action="$action" method="post">
                                        <select name="select_task">
                                        <option value="" disabled selected>Lista Zadań</option>
                                        
                                        
HTML;
        echo $show;
        foreach ($TaskData as &$Item) {
            $task = $Item->getTask();
            $task_id = $Item->getidTask();
//            print_r($test);
            $show = <<<HTML
                                        <option value="$task_id">$task</option>
HTML;
            echo $show;
        }

        $show = <<<HTML
                                        </select>                                    
                                    <table>
                                    <tr>
                                            <td class="alx_flex_quest_input">
                                                <div class="input-field col s12">
                                                    <textarea id="textarea1" class="materialize-textarea" name="txt_pytanie"></textarea>
                                                    <label for="textarea1" >Pytanie</label>
                                                </div>
                                            </td>
                                            <td class="alx_edytor_pytań">
                                                <div class="input-field col s12">
                                                    <textarea id="textarea1" class="materialize-textarea" name="txt_odp"></textarea>
                                                    <label for="textarea1">Odpowiedź</label>
                                                </div>
                                            </td>
                                            </tr>
                                            </table>
                                            
                                            <table>
                                            <tr>                                           
                                            <td class="alx_edytor_pytań">
                                                <div class="input-field col s12">
                                                    <textarea id="textarea1" class="materialize-textarea" name="txt_zle1"></textarea>
                                                    <label for="textarea1">Źle</label>
                                                </div>
                                            </td>
                                            <td class="alx_edytor_pytań">
                                                <div class="input-field col s12">
                                                    <textarea id="textarea1" class="materialize-textarea" name="txt_zle2"></textarea>
                                                    <label for="textarea1">Źle</label>
                                                </div>
                                            </td>
                                            <td class="alx_edytor_pytań">
                                                <div class="input-field col s12">
                                                    <textarea id="textarea1" class="materialize-textarea" name="txt_zle3"></textarea>
                                                    <label for="textarea1">Źle</label>
                                                </div>
                                            </td>

                                            <!--                                            BUTTONY-->
                                            <td class="alx_edit_users_button">
                                                <table>
                                                    <tr class="alx_padding_edit_users_button">
                                                        <div class="alx_padding_edit_users_button">
                                                            <button class="btn waves-effect waves-light alx_h8_font alx_button_width"
                                                                    type="submit"
                                                                    name="add_Question">
                                                                Dodaj <i class="icon-plus alx_h8_font"></i>
                                                            </button>
                                                        </div>
                                                    </tr>
                                                </table>
                                            </td>
                                            </tr>
                                            </table>
                                        </form>
                                </div>
                            </div> <!--Ostatnii element dodający-->
HTML;
        echo $show;

        foreach ($QuestData as &$item) {
            $task_id_InQuest = $item->getIdTask();
            $pytanie = $item->getQuestion();
            $answers = $item->getAnswerList();
            $idQuest = $item->getIdQuestion();

            $odp = $answers[0]->getAnswer();
            $zle1 = $answers[1]->getAnswer();
            $zle2 = $answers[2]->getAnswer();
            $zle3 = $answers[3]->getAnswer();

            $show = <<<HTML
    <div class="collapsible-body">
        <div class="alx_flexkontener_quest">
                                        <form action="$action" method="post">
                                        <input type="hidden" value="$idQuest" name="quest_id">
                                        <select name="select_task">
                                        <option value="" disabled selected>Lista Zadań</option>
                                        
                                        
HTML;
            echo $show;
            foreach ($TaskData as &$Item) {
                $task = $Item->getTask();
                $task_id = $Item->getidTask();
                $isSelect = ($Item->getidTask() == $task_id_InQuest) ? "selected" : "";
//            print_r($test);
                $show = <<<HTML
                                        <option value="$task_id" $isSelect>$task</option>
HTML;
                echo $show;
            }

            $show = <<<HTML
                                        </select>                                    
                                    <table>
                                    <tr>
                                            <td class="alx_flex_quest_input">
                                                <div class="input-field col s12">
                                                    <textarea id="textarea1" class="materialize-textarea" name="txt_pytanie">$pytanie</textarea>
                                                    <label for="textarea1" >Pytanie</label>
                                                </div>
                                            </td>
                                            <td class="alx_edytor_pytań">
                                                <div class="input-field col s12">
                                                    <textarea id="textarea1" class="materialize-textarea" name="txt_odp">$odp</textarea>
                                                    <label for="textarea1">Odpowiedź</label>
                                                </div>
                                            </td>
                                            </tr>
                                            </table>
                                            
                                            <table>
                                            <tr>                                           
                                            <td class="alx_edytor_pytań">
                                                <div class="input-field col s12">
                                                    <textarea id="textarea1" class="materialize-textarea" name="txt_zle1">$zle1</textarea>
                                                    <label for="textarea1">Źle</label>
                                                </div>
                                            </td>
                                            <td class="alx_edytor_pytań">
                                                <div class="input-field col s12">
                                                    <textarea id="textarea1" class="materialize-textarea" name="txt_zle2">$zle2</textarea>
                                                    <label for="textarea1">Źle</label>
                                                </div>
                                            </td>
                                            <td class="alx_edytor_pytań">
                                                <div class="input-field col s12">
                                                    <textarea id="textarea1" class="materialize-textarea" name="txt_zle3">$zle3</textarea>
                                                    <label for="textarea1">Źle</label>
                                                </div>
                                            </td>

                                            <!--                                            BUTTONY-->
                                            <td class="alx_edit_users_button">
                                                <table>
                                                    <tr class="alx_padding_edit_users_button">
                                                        <div class=" alx_padding_edit_users_button">
                                                            <button class="btn waves-effect waves-light alx_h8_font alx_button_width"
                                                                    type="submit"
                                                                    name="edytuj_Question">
                                                                Edytuj <i class="icon-cogs alx_h8_font"></i>
                                                            </button>
                                                        </div>
                                                    </tr>
                                                    <tr class="alx_padding_edit_users_button">
                                                        <div class="alx_padding_edit_users_button">
                                                            <button class="btn waves-effect waves-light alx_h8_font alx_button_width"
                                                                    type="submit"
                                                                    name="del_Question">
                                                                Usuń <i class="icon-block alx_h8_font"></i>
                                                            </button>
                                                        </div>
                                                    </tr>
                                                </table>
                                            </td>
                                            </tr>
                                            </table>
                                        </form>
                                </div>
                            </div> <!--Ostatnii element dodający-->
HTML;
            echo $show;
        }
    }

}//Edytor pytań

function EdytorZadańDoGry()
{

    include_once __DIR__ . "/../Controllers/ResourceController.php";
    $__ResControler = \Controller\ResourceController::getInstance();

    $factoryData = $__ResControler->returnArray();

    include_once __DIR__ . "/../Controllers/TaskController.php";
    $__TaskControler = \Controller\TaskController::getInstance();

    include_once __DIR__ . "/../Controllers/MySQLController.php";
    $__DB = \Controller\MySQLController::getInstance();

    $result =  $__DB->__System__GetMaxLevel();
    $suka = "1";
    foreach ($result as $item) {
        $suka = $item["LevelTo"];
    }
    $max = $suka+1;
    $min = 1;
//    javaalert($max);

    $TaskData = $__TaskControler->returnArray();
    $grupa = 0;
    $sumakoncowa = 0;
    $action = "db_update.php";

    $show = <<<HTML
                        <div class="collapsible-body">
                            <form action="$action" method="post">
                                <div class="alx_flexkontener_task">
                                    <div class="input-field alx_flex_w_edytorze_taskow_radio">
                                        <select name="input_res_task">
                                        <option value="" disabled selected>Surowce</option>
                                        
                                        
HTML;
    echo $show;

    $tst = 0;
    foreach ($factoryData as &$Res) {
        $tst++;
        $surowiec = $Res->getResourceName();
        $id_res = $Res->getIdResources();
//            print_r($test);
        $show = <<<HTML
                                        <option value="$id_res">$surowiec</option>
HTML;
        echo $show;
    }

    $show = <<<HTML
                                        </select>                                    

                                    </div>
                                    <div class="input-field alx_flex_w_edytorze_taskow_midlle">
                                        <div>
                                            <input type="text" class="alx_task_input" name="input_task" value="">
                                            <label>Zadanie</label>
                                        </div>
                                        <div>
                                            <div class="input-field">
                                                <input type="number" min="$min" max="$max" class="alx_task_input" name="input_lvl_task" value="">
                                                <label>Wymagany poziom</label>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="input-field">
                                                <input type="number" min="$min" class="alx_task_input" name="input_needed_task" value="">
                                                <label>Resource To</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!--                                            BUTTONY-->
                                    <div class="alx_flex_w_edytorze_taskow">
                                        <table>
                                            <tr class="alx_padding_edit_users_button">
                                                <div class=" alx_padding_edit_users_button">
                                                    <button class="btn waves-effect waves-light alx_h8_font alx_button_width"
                                                            type="submit"
                                                            name="add_task">
                                                        Dodaj <i class="icon-plus alx_h8_font"></i>
                                                    </button>
                                                </div>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </form>
                        </div><!--Elementy w pętli-->   
HTML;
    echo $show;

    //-------------------------------pętla z taskami
    foreach ($TaskData as $Item) {
//        echo "<pre>";
//        print_r($Item);
//        echo "</pre>";
        $grupa++;
        $sumakoncowa++;
        $resrc = $Item->getidResources();
        $neededRes = $Item->getResourceTo();

        $task = $Item->getTask();
        $neededLVL = $Item->getLevelTo();
        $idOfTask = $Item->getidTask();

        $show = <<<HTML
                        <div class="collapsible-body">
                            <form action="$action" method="post">
                                <div class="alx_flexkontener_task">
                                    <div class="input-field alx_flex_w_edytorze_taskow_radio">
                                        <input type="hidden" value="$idOfTask" name="idOfTask">
                                        <select name="input_res_task">
                                        <option value="" disabled selected>Surowce</option>
                                        
                                        
HTML;
        echo $show;
        $tst = 0;
        foreach ($factoryData as &$Res) {
            $tst++;
            $surowiec = $Res->getResourceName();
            $id_res = $Res->getIdResources();
            $isSelect = ($Res->getIdResources() == $resrc) ? "selected" : "";
//            print_r($test);

            $show = <<<HTML
                                        <option value="$id_res" $isSelect>$surowiec</option>
HTML;
            echo $show;
        }

        $show = <<<HTML
                                        </select>                                    

                                    </div>
                                    <div class="input-field alx_flex_w_edytorze_taskow_midlle">
                                        <div>
                                            <input type="text" class="alx_task_input" name="input_task" value="$task">
                                            <label>Zadanie</label>
                                        </div>
                                        <div>
                                            <div class="input-field">
                                                <input type="number" min="$min" max="$max" class="alx_task_input" name="input_lvl_task" value="$neededLVL">
                                                <label>Wymagany poziom</label>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="input-field">
                                                <input type="number" min="$min" class="alx_task_input" name="input_needed_task" value="$neededRes">
                                                <label>Resource To</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!--                                            BUTTONY-->
                                    <div class="alx_flex_w_edytorze_taskow">
                                        <table>
                                            <tr class="alx_padding_edit_users_button">
                                                <div class=" alx_padding_edit_users_button">
                                                    <button class="btn waves-effect waves-light alx_h8_font alx_button_width"
                                                            type="submit"
                                                            name="edytuj_task">
                                                        Edytuj <i class="icon-cogs alx_h8_font"></i>
                                                    </button>
                                                </div>
                                            </tr>
                                            <tr class="alx_padding_edit_users_button">
                                                <div class="alx_padding_edit_users_button">
                                                    <button class="btn waves-effect waves-light alx_h8_font alx_button_width"
                                                            type="submit"
                                                            name="del_task">
                                                        Usuń <i class="icon-block alx_h8_font"></i>
                                                    </button>
                                                </div>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </form>
                        </div><!--Elementy w pętli-->   
HTML;
        echo $show;
//        echo $sumakoncowa;
    }
} //FINISH

function EdtyorUzytkownikow()
{
    include_once __DIR__ . "/../Controllers/UserController.php";
    $__userControler = \Controller\UserController::getInstance();

    $nameOfUser = $_SESSION["name_of_user"]; //Nazwa użytkowanik
    $usersData = $__userControler->returnArray();

    foreach ($usersData as &$data) {

//        $action = "db_update.php";
        $action = "db_update.php";
        $grafikaUsera = ($data->getIMG() == '') ? "defoult_user.svg" : $data->getIMG();
        $name = $data->getEmail();
        $lvl = ($data->getLevel() < 0) ? "---" : $data->getLevel();
        $secure = ($data->getType() == 1) ? "Administrator" : "Gracz";
        $passwd = $data->getPasswd();
        $ban = 'BAN';
        $banico = 'icon-universal-access';
        $idOfUser = $data->getidUser();
        $AdminStyle = ($data->getType() == 1) ? "style='background-color: rgba(188, 234, 131, 1);'" : "";

        $show = <<<HTML
                            <div class="collapsible-body" $AdminStyle>
                                <table $AdminStyle>
                                    <tr>
                                        <form action="$action" method="post">
                                        <input type="hidden" value="$name"  name="input_name">
                                            <td class="alx_szerokosc_kolumny_dla_grafiki_w_statystyce">
                                                <div class="file-field input-field">
                                                    <div class="btn-floating alx_btn_floating">
                                                        <i class="icon-wrench"></i>
                                                        <input type="file" name="input_grafika_new">
                                                        <input type="hidden" name="input_grafika" value="$grafikaUsera">
                                                    </div>
                                                    <img src="resr/img/$grafikaUsera" class="alx_img_src">
                                                </div>
                                            </td>
                                            <td class="alx_info_o_graczu">
                                                <table>
                                                    <tr>
                                                        <div class="input-field alx_margin0">
                                                            <input value="$name" id="first_name2" type="text" class="validate" disabled>
                                                            <label class="active" for="first_name2">Użytkownik</label>
                                                        </div>
                                                    </tr>
                                                    <tr>
                                                        <div class="input-field alx_margin0">
                                                            <input value="$lvl" id="first_name2" type="text" class="validate" disabled>
                                                            <label class="active" for="first_name2">Poziom</label>
                                                        </div>
                                                    </tr>
                                                    <tr>
                                                        <div class="input-field alx_margin0">
                                                            <input value="$secure" id="first_name2" type="text" class="validate" disabled>
                                                            <label class="active alx_2rem_font" for="first_name2">Uprawnienia</label>
                                                        </div>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <div class="input-field alx_margin0">
                                                            <input value="$passwd" id="first_name2" type="password" class="validate" name="input_passwd">
                                                            <label class="active alx_2rem_font" for="first_name2">Hasło</label>
                                                        </div>
                                                    </tr>
                                                </table>
                                            </td>

                                            <!--                                            BUTTONY-->
                                            <td class="alx_btn_space_in_users_edit">
                                            <table>
                                                <tr>
                                                    <button class="btn waves-effect waves-light alx_h8_font alx_button_width"
                                                            type="submit" name="edytuj_user">
                                                        Edytuj <i class="icon-cogs alx_h8_font"></i>
                                                    </button>
                                                </tr>

HTML;
        echo $show;
        if ($data->getType() > 1) {
            $show = <<<HTML
                                                <tr>
                                                    <button class="btn waves-effect waves-light alx_h8_font alx_button_width"
                                                            type="submit"
                                                            name="del_user">
                                                        Usuń <i class="icon-user-delete-outline alx_h8_font"></i>
                                                    </button>
                                                </tr>
HTML;
            echo $show;
        }
        $show = <<<HTML
                                                
                                            </table>
                                            </td>
                                        </form>
                                    </tr>
                                </table>
                            </div> <!--Generowanie widoku dla edyci graczy-->
HTML;
        echo $show;
    }
}//Edytor użytkowników //PRAWIE FINISH

?>