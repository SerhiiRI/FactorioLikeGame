<?php

function LewyPanelAdmina()
{
    include_once __DIR__ . "/../Controllers/UserController.php";
    $__userControler = \Controller\UserController::getInstance();

//    include_once __DIR__ . "/../Controllers/FactoryInstanceController.php";
//    $__facControler = \Controller\FactoryInstanceController::getInstance();

    include_once __DIR__ . "/../Controllers/ResourceController.php";
    $__resControler = \Controller\ResourceController::getInstance();

    $nameOfUser = $_SESSION["name_of_user"]; //Nazwa użytkowanik
    $userData = $__userControler->SearchByEmail($nameOfUser);
//    $factoryData = $__facControler->returnArray();
    $__surowce = $__resControler->returnArray();

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
        $progress_start_calc = $progress_start_calc + $progres;
        $progress_finish_calc = $progress_finish_calc + $finish;

        $show = <<<HTML
                                                    <tr>
                                                        <td class="alx_center_th alx_th_padding">
                                                            <input value="$surowiec: $progres/$finish" type="text" class="alx_small_input" disabled>
                                                            <div class="progress">
                                                                <div class="determinate" style="width: $progres_procent%;"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
HTML;
        echo $show;
    }

    $progres_procent = ($progress_start_calc * 100) / $progress_finish_calc;
    $ButtonDisabled = ($progres_procent == 100) ?: "disabled";
    $ButtonValue = ($progres_procent == 100) ? "LVL UP!" : "Postęp: " . $progres_procent . "%";

    $show = <<<HTML

                <div class="alx_lvl_up_btn">
                    <button name="levelup_btn" class="btn btn_lvlup" $ButtonDisabled>
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
                <img src="resr/img/zelazotest.jpg" class="alx_flexy_w_edycji_fabryk_pic_child" id="grafika_ligthbox">
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
                    <button class="btn alx_flexy_w_edycji_fabryk_button">Upgrade!</button>
                    <button class="btn alx_flexy_w_edycji_fabryk_button" onclick="stop_working()" id="onClickWorking">Wstrzymaj/wznów prace</button>
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

    $lvl = "Poziom: 5";
    $opis = "Nowoczesne metody wydobywcze.";
    $odkrycie = "Nowoczesna rafineria";
    $var = "456";

    for ($i = 0; $i < 10; $i++) {
        $show = <<<HTML
<div class="collapsible-body alx_flexkontener_user_task">
                            <div class="alx_flex_user_task">
                                $lvl
                            </div>
                            <div class="alx_flex_user_task">
                                $opis
                            </div>
                            <div class="alx_flex_user_task">
                                $odkrycie
                            </div>
                            <div class="alx_flex_user_task">
                                $var
                            </div>
                            <div class="alx_flex_user_task">
                                <div class="alx_flex_user_task_forbtn">
                                    <div class="alx_flex_user_task_btn">
                                        <button class="btn">Badaj</button>
                                    </div>
                                </div>
                            </div>
                        </div>
HTML;
        echo $show;
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

    $factoryData = $__ResControler->returnArray();
    $action = "db_update_user.php";

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
}

?>