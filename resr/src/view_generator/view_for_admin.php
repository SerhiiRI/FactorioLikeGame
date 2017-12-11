<?php

function LewyPanelAdmina()
{
    include_once __DIR__ . "/../Controllers/UserController.php";
    $__userControler = \Controller\UserController::getInstance();
    $listOfUser = $__userControler->returnArray();

    $nameOfUser = $_SESSION["name_of_user"]; //Nazwa użytkowanik
    $imageOfUser = "defoult_user.svg"; //Grafika admina
    $lastVisit = "07-12-2017r.";
    $usersInSysytem = 12;
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

function wyswietlanieStatystykSystemu()
{

    $lastVisit = "07-12-2017r.";
    $usersInSysytem = 12;
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
} //Edycja surowców oraz odpowiedzialnych za wydobycie fabryk

function zarządzanieFabrykamiOrazSurowcami()
{
    $listaTestowa[0]['fabryka'] = 'Wodociąg';
    $listaTestowa[0]['surowiec'] = 'Woda';
    $listaTestowa[0]['wydobycie'] = 10;
    $listaTestowa[0]['grafika'] = "miscellaneous.svg";

    $listaTestowa[1]['fabryka'] = 'Kopalnia żelaza';
    $listaTestowa[1]['surowiec'] = 'Żelazo';
    $listaTestowa[1]['wydobycie'] = 10;
    $listaTestowa[1]['grafika'] = "zelazo.png";


    foreach ($listaTestowa as &$item) {
        $action = "#";
        $fabricName = $item['fabryka'];//jaka fabryka wydobywa
        $surowiec = $item['surowiec'];//jaki surowiec jest wydobywany
        $wydobyciePodstawowe = $item['wydobycie'];//wydobycie na 1 lvl
        $imageOfUser = $item['grafika']; //Grafika fabryki

        $show = <<<HTML
                            <div class="collapsible-body">
                                <table>
                                    <tr>
                                        <form action="$action">
                                            <td class="alx_szerokosc_kolumny_dla_grafiki_w_statystyce">
                                                <div class="file-field input-field">
                                                    <div class="btn-floating alx_btn_floating">
                                                        <i class="icon-wrench"></i>
                                                        <input type="file" name="input_grafika">
                                                    </div>
                                                    <img src="resr/img/$imageOfUser" class="alx_img_src">
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
                                                                    name="edit">
                                                                Edytuj <i class="icon-cogs alx_h8_font"></i>
                                                            </button>
                                                        </div>
                                                    </tr>
                                                    <tr class="alx_padding_edit_users_button">
                                                        <div class="alx_padding_edit_users_button">
                                                            <button class="btn waves-effect waves-light alx_h8_font alx_button_width"
                                                                    type="submit"
                                                                    name="del">
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
    $show_end = <<<HTML
<div class="collapsible-body">
                            <table>
                                <tr>
                                    <form action="$action">
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
                                                                name="ban">
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
    echo $show_end;
} //Edycja fabryk i surowców

function EdycjaPytanDoGry()
{
    $listaTestowa[0]['pytanie'] = 'Co jest sensem zycia?';
    $listaTestowa[0]['odp'] = '42';
    $listaTestowa[0]['zle1'] = "Zycie nie ma sensu.";
    $listaTestowa[0]['zle2'] = "Piernik torunski.";
    $listaTestowa[0]['zle3'] = "PHP";

    $listaTestowa[1]['pytanie'] = 'Ile wazy slonce?';
    $listaTestowa[1]['odp'] = 'Duzo';
    $listaTestowa[1]['zle1'] = "Nie wazy.";
    $listaTestowa[1]['zle2'] = "Tyle co Adas.";
    $listaTestowa[1]['zle3'] = "Tak";

    foreach ($listaTestowa as &$item) {
        $action = "#";
        $pytanie = $item['pytanie'];
        $odp = $item['odp'];
        $zle1 = $item['zle1'];
        $zle2 = $item['zle2'];
        $zle3 = $item['zle3'];
        $show = <<<HTML
                            <div class="collapsible-body">
                                <table>
                                    <tr>
                                        <form action="$action">
                                            <td>
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
                                                                    name="edit">
                                                                Edytuj <i class="icon-cogs alx_h8_font"></i>
                                                            </button>
                                                        </div>
                                                    </tr>
                                                    <tr class="alx_padding_edit_users_button">
                                                        <div class="alx_padding_edit_users_button">
                                                            <button class="btn waves-effect waves-light alx_h8_font alx_button_width"
                                                                    type="submit"
                                                                    name="del">
                                                                Usuń <i class="icon-block alx_h8_font"></i>
                                                            </button>
                                                        </div>
                                                    </tr>
                                                </table>
                                            </td>
                                        </form>
                                    </tr>
                                </table>
                            </div><!--Elementy w pętli-->   
HTML;
        echo $show;
    }
    $show = <<<HTML
    <div class="collapsible-body">
                                <table>
                                    <tr>
                                        <form action="$action">
                                            <td>
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
                                                                    name="add">
                                                                Dodaj <i class="icon-plus alx_h8_font"></i>
                                                            </button>
                                                        </div>
                                                    </tr>
                                                </table>
                                            </td>
                                        </form>
                                    </tr>
                                </table>
                            </div> <!--Ostatnii element dodający-->
HTML;
    echo $show;
}//Edytor pytań

function EdtyorUzytkownikow()
{
    $listaTestowa[0][0]['graphic'] = "defoult_user.svg";
    $listaTestowa[0][0]['name'] = "aleks";
    $listaTestowa[0][0]['lvl'] = 2;
    $listaTestowa[0][0]['secure'] = "Gracz";
    $listaTestowa[0][0]['ban'] = "BAN";
    $listaTestowa[0][0]['banico'] = "icon-block";

    $listaTestowa[0][0]['surowiec'] = "Woda";
    $listaTestowa[0][0]['progres'] = 25;
    $listaTestowa[0][0]['finish'] = 100;
    $listaTestowa[0][1]['surowiec'] = "Węgiel";
    $listaTestowa[0][1]['progres'] = 69;
    $listaTestowa[0][1]['finish'] = 100;
    $listaTestowa[0][2]['surowiec'] = "Drewno";
    $listaTestowa[0][2]['progres'] = 45;
    $listaTestowa[0][2]['finish'] = 100;
    $listaTestowa[0][3]['surowiec'] = "Gaz ziemny";
    $listaTestowa[0][3]['progres'] = 10;
    $listaTestowa[0][3]['finish'] = 100;
    $listaTestowa[0][4]['surowiec'] = "Ropa";
    $listaTestowa[0][4]['progres'] = 88;
    $listaTestowa[0][4]['finish'] = 100;


    $listaTestowa[1][0]['graphic'] = "defoult_user.svg";
    $listaTestowa[1][0]['name'] = "serhii";
    $listaTestowa[1][0]['lvl'] = 3;
    $listaTestowa[1][0]['secure'] = "Administrator";
    $listaTestowa[1][0]['ban'] = "UNBAN";
    $listaTestowa[1][0]['banico'] = "icon-universal-access";

    $listaTestowa[1][0]['surowiec'] = "Woda";
    $listaTestowa[1][0]['progres'] = 50;
    $listaTestowa[1][0]['finish'] = 100;
    $listaTestowa[1][1]['surowiec'] = "Węgiel";
    $listaTestowa[1][1]['progres'] = 30;
    $listaTestowa[1][1]['finish'] = 100;
    $listaTestowa[1][2]['surowiec'] = "Drewno";
    $listaTestowa[1][2]['progres'] = 40;
    $listaTestowa[1][2]['finish'] = 100;
    $listaTestowa[1][3]['surowiec'] = "Gaz ziemny";
    $listaTestowa[1][3]['progres'] = 80;
    $listaTestowa[1][3]['finish'] = 100;
    $listaTestowa[1][4]['surowiec'] = "Ropa";
    $listaTestowa[1][4]['progres'] = 3;
    $listaTestowa[1][4]['finish'] = 100;

    foreach ($listaTestowa as &$item) {

        $data = $item[0];
        $action = "#";
        $grafikaUsera = $data['graphic'];
        $name = $data['name'];
        $lvl = $data['lvl'];
        $secure = $data['secure'];
        $ban = $data['ban'];
        $banico = $data['banico'];

        $show = <<<HTML
                            <div class="collapsible-body">
                                <table>
                                    <tr>
                                        <form action="$action">
                                            <td class="alx_szerokosc_kolumny_dla_grafiki_w_statystyce">
                                                <div class="file-field input-field">
                                                    <div class="btn-floating alx_btn_floating">
                                                        <i class="icon-wrench"></i>
                                                        <input type="file" name="input_grafika">
                                                    </div>
                                                    <img src="resr/img/$grafikaUsera" class="alx_img_src">
                                                </div>
                                            </td>
                                            <td class="alx_info_o_graczu">
                                                <table>
                                                    <tr>
                                                        <div class="input-field">
                                                            <input value="$name" id="first_name2" type="text" class="validate">
                                                            <label class="active" for="first_name2">Użytkownik</label>
                                                        </div>

                                                    </tr>
                                                    <tr>
                                                        <div class="input-field">
                                                            <input value="$lvl" id="first_name2" type="text" class="validate">
                                                            <label class="active" for="first_name2">Poziom</label>
                                                        </div>
                                                    </tr>
                                                    <tr>
                                                        <div class="input-field">
                                                            <input value="$secure" id="first_name2" type="text" class="validate">
                                                            <label class="active alx_2rem_font" for="first_name2">Uprawnienia</label>
                                                        </div>
                                                    </tr>
                                                </table>
                                            </td>

                                            <!--                                            STATY GRACZA-->
                                            <td class="alx_info_o_graczu_spadding">
                                                <table>
                                                    <tr class="alx_info_bar">
HTML;
        echo $show;
        foreach ($item as &$res) {
            $surowiec = $res['surowiec'];
            $progres = $res['progres'];
            $finish = $res['finish'];
            $show = <<<HTML
                                                    <tr>
                                                        <td class="alx_center_th alx_th_padding">
                                                            <input value="$surowiec: $progres/$finish" type="text" class="alx_small_input">
                                                            <div class="progress">
                                                                <div class="determinate" style="width: $progres%;"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
HTML;
            echo $show;
        }
        $show = <<<HTML
                                                    </tr>
                                                </table>

                                            </td>

                                            <!--                                            BUTTONY-->
                                            <td class="alx_btn_space_in_users_edit"
                                            ">
                                            <table>
                                                <tr>
                                                    <button class="btn waves-effect waves-light alx_h8_font alx_button_width"
                                                            type="submit"
                                                            name="ban">
                                                        $ban <i class="$banico alx_h8_font"></i>
                                                    </button>
                                                </tr>
                                                <tr>
                                                    <button class="btn waves-effect waves-light alx_h8_font alx_button_width"
                                                            type="submit"
                                                            name="edytuj">
                                                        Edytuj <i class="icon-cogs alx_h8_font"></i>
                                                    </button>
                                                </tr>
                                                <tr>
                                                    <button class="btn waves-effect waves-light alx_h8_font alx_button_width"
                                                            type="submit"
                                                            name="usuwanie">
                                                        Usuń <i class="icon-user-delete-outline alx_h8_font"></i>
                                                    </button>
                                                </tr>
                                            </table>
                                            </td>

                                        </form>
                                    </tr>
                                </table>
                            </div> <!--Generowanie widoku dla edyci graczy-->
HTML;
        echo $show;
    }
}//Edytor użytkowników

?>