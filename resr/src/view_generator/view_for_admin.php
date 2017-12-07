<?php

function LewyPanelAdmina()
{
    $nameOfUser = $_SESSION["name_of_user"]; //Nazwa użytkowanik
    $imageOfUser = "resr/img/defoult_user.svg"; //Grafika admina
    $show = <<<HTML
    <div class="aleks_user_panel">

                <!--            Obrazek użytkownika-->
                <div class="aleks_user_img_div">
                    <img class="aleks_user_img" src="$imageOfUser"/>
                    <h5>$nameOfUser
                        <br><span class="alx_h6_font_grey">- Administrator -</span></h5>

                    <!-- Funkcje dla admina -->
                    <br/>
                    <table class="alx_table_admin_menu">
                        <!--<tr>-->
                            <!--<td class="alx_admin_standardowy_element_menu_lewy_panel">Edytuj elementy gry</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                            <!--<td class="alx_admin_standardowy_element_menu_lewy_panel">Ustawienia</td>-->
                        <!--</tr>-->

                        <!--                        WYLOGOWANIE-->
                        <tr>
                            <td class="alx_admin_ostatni_element_menu_lewy_panel">
                                <a href="hard_logout.php" class="alx_display_block">
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
    $action = "#";
    $userInSystem = 12;
    $imageOfUser = "resr/img/defoult_user.svg";

    $show = <<<HTML
    <div class="collapsible-body">
                            <table>
                                <tr>
                                    <form action="$action">
                                        <td  class="alx_szerokosc_kolumny_dla_grafiki_w_statystyce">
                                                <img src="$imageOfUser" class="alx_img_src">
                                        </td>
                                        <td class="alx_tabela_surowcow_admin">
                                            <p>Ilość użytkowników w systemie: $userInSystem</p>
                                        </td>
                                    </form>
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
}

?>