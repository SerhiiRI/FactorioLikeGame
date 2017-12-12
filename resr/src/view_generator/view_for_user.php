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

    $imageOfUser = "resr/img/".$userData->getIMG(); //Grafika usera
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
    $progress_start_calc=0;
    $progress_finish_calc=0;
    foreach ($__surowce as &$res) {
//            $surowiec = $__resControler->searchByID($res->getidResource());
            $surowiec = $res->getResourceName();
            $progres = rand(0, 100);
            $finish = 100;
            $progres_procent=($progres*100)/$finish;
            $progress_start_calc=$progress_start_calc+$progres;
            $progress_finish_calc=$progress_finish_calc+$finish;

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

    $progres_procent=($progress_start_calc*100)/$progress_finish_calc;
    $ButtonDisabled=($progres_procent==100)?:"disabled";
    $ButtonValue=($progres_procent==100)?"LVL UP!":"Postęp: ".$progres_procent."%";

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

    $listaTestowa[0]['lvl'] = '3';
    $listaTestowa[0]['wydobycie'] = 10;
    $listaTestowa[0]['grafika'] = "zelazo.png";
    $listaTestowa[0]['working'] = "true";
    $listaTestowa[0]['opis'] = "Takie fjane z opisem."; // ---------------doróbka

    $listaTestowa[1]['lvl'] = '1';
    $listaTestowa[1]['wydobycie'] = 10;
    $listaTestowa[1]['grafika'] = "image.svg";

    $listaTestowa[2]['lvl'] = '6';
    $listaTestowa[2]['wydobycie'] = 60;
    $listaTestowa[2]['grafika'] = "logout.svg";

    $listaTestowa[3]['lvl'] = '2';
    $listaTestowa[3]['wydobycie'] = 20;
    $listaTestowa[3]['grafika'] = "tap.svg";

    $listaTestowa[4]['lvl'] = '5';
    $listaTestowa[4]['wydobycie'] = 50;
    $listaTestowa[4]['grafika'] = "gear5.svg";

    foreach ($listaTestowa as &$item) {

        $lvl = $item['lvl'];
        $wydobycie = $item['wydobycie'];
        $grafika = $item['grafika'];

        $show = <<<HTML
    <div class="alx_flex_dla_mapy_diva">
                    <img src="resr/img/$grafika" class="alx_flexy_w_divie_map" onclick="func_open_zindex('$grafika', '$wydobycie', '$lvl')">
                </div>
HTML;
        echo $show;
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
                <p class="alx_flexy_w_edycji_fabryk_opis">Opis fabryki jakiś tam itd itp Opis fabryki jakiś tam itd itp
                    Opis fabryki jakiś tam itd itp</p>
                <div class="alx_button_group_ligthbox">
                    <button class="btn alx_flexy_w_edycji_fabryk_button">Upgrade!</button>
                    <button class="btn alx_flexy_w_edycji_fabryk_button" onclick="stop_working()" id="onClickWorking">Wstrzymaj/wznów prace</button>
                    <button class="btn alx_flexy_w_edycji_fabryk_button">Zniszcz fabrykę</button>
                    <button class="btn alx_flexy_w_edycji_fabryk_button" onclick="func_close_zindex()">Zamknij okno
                    </button>
                </div>
            </div>
        </div>
    </div>

HTML;
    echo $show;


}

?>