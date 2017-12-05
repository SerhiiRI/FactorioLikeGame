<?php
include_once("resr/src/PAGE_INCLUDES_SCRIPT/PAGE_DEFINE_VARIABLE.php");
if (isset($_SESSION["idUser"]) && $_SESSION["UserType"] == "1") {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="style/materialize/css/materialize.min.css"
              media="screen,projection"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <!--Import aleks_style.css-->
        <link type="text/css" rel="stylesheet" href="style/aleks_style.css"/>

        <meta charset="UTF-8">
        <title>User map</title>
        <link rel="stylesheet" type="text/css" href="style/login.css">
        <!--import czcionek-->
        <?php include_once("style/fonts.html") ?>
    </head>
    <body style="background-image: url(resr/img/land.jpg)">
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="style/materialize/js/materialize.min.js"></script>

    <div class="alx_border_space">
        <div>
            <!--lewy panel użytkownika-->
            <div class="aleks_user_panel">

                <!--            Obrazek użytkownika-->
                <div class="aleks_user_img_div">
                    <img class="aleks_user_img" src="resr/img/defoult_user.svg"/>
                    <h5><?php echo $_SESSION["name_of_user"] ?>
                        <br><span class="alx_h6_font_grey">- Administrator -</span></h5>

                    <!-- Funkcje dla admina -->
                    <br/>
                    <table class="alx_table_admin_menu">
                        <tr>
                            <td class="alx_admin_standardowy_element_menu_lewy_panel">Edytuj elementy gry</td>
                        </tr>
                        <tr>
                            <td class="alx_admin_standardowy_element_menu_lewy_panel">Ustawienia</td>
                        </tr>

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

            <!--KONIEC PANELU LEWEGO-->

            <!--prawy panel użytkownika (content)-->

            <div class="aleks_content_panel">
                <h1 style="text-align: center">Panel administratora</h1>

                <!--                PANEL NARZĘDZI-->
                <ul class="collapsible popout" data-collapsible="accordion">

                    <!--                    PIERWSZE NARZĘDZIE "STATYSTYKA"-->
                    <li>
                        <div class="collapsible-header"><i class="material-icons">sort</i>Statystyka</div>

                        <!--                        PIERWSZY ELEMENT PO ROZWINIECIU-->
                        <div class="collapsible-body">
                            <table>
                                <tr>
                                    <form action="#">
                                        <td class="alx_table_edit_res_pic">
                                            <div class="file-field input-field">
                                                <img src="resr/img/defoult_user.svg" class="alx_img_src">
                                            </div>
                                        </td>
                                        <td class="alx_tabela_surowcow_admin">
                                            <p>Ilość użytkowników w systemie: 12
                                                <!--                                            !!!Podliczenie iliści użytkowników-->
                                            </p>
                                        </td>
                                    </form>
                                </tr>
                            </table>
                        </div>
                        <!--                        KONIEC PIERWSZEGO ELEMENTU-->
                    </li>
                    <!--                    KONIEC PIERWSZEGO NARZEDZIA-->

                    <!--                    DRUGIE NARZĘDZIE "EDYCJA SUROWCOW"-->
                    <li>
                        <div class="collapsible-header">
                            <i class="icon-industrial-building aleks_icon"></i>
                            Zarządzaj surowcami w grze
                        </div>

                        <!--             PĘTLA Z WIERSZAMI W DODAJ SUROWCE DO GRY-->
                        <?php for ($i = 0; $i < 2; $i++) { ?>
                            <div class="collapsible-body">
                                <table>
                                    <tr>
                                        <form action="#">
                                            <td class="alx_table_edit_res_pic">
                                                <div class="file-field input-field">
                                                    <img src="resr/img/miscellaneous.svg" class="alx_img_src">
                                                    <!--                                                DODAJ OBRAZEK-->
                                                    <div class="btn-floating alx_btn_floating">
                                                        <i class="icon-wrench"></i>
                                                        <!--                                                    Ikona dodania/edycji ebrazka surowca-->
                                                        <input type="file">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="alx_tabela_surowcow_admin">
                                                <div class="input-field">
                                                    <input value="Wodociąg" id="first_name2" type="text"
                                                           class="validate">
                                                    <!--        DO VALUE FABRYKA JESLI ISTENIE-->
                                                    <label class="active" for="first_name2">Fabryka</label>
                                                </div>
                                            </td>
                                            <td class="alx_tabela_surowcow_admin">
                                                <div class="input-field">
                                                    <input value="Woda" id="first_name2" type="text" class="validate">
                                                    <!--                                                DO VALUE SUROWIEC JESLI ISTENIE-->
                                                    <label class="active" for="first_name2">Surowiec</label>
                                                </div>
                                            </td>
                                            <td class="alx_tabela_surowcow_admin">
                                                <div class="input-field">
                                                    <input value="10" id="first_name2" type="number" class="validate">
                                                    <!--                                            DO VALUE ILOSC WYDOBYCIA JESLI ISTNIEJE-->
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
                                                                Edytuj <i class="icon-cogs alx_h8_font"></i>
                                                            </button>
                                                        </div>
                                                    </tr>
                                                    <tr class="alx_padding_edit_users_button">
                                                        <div class="alx_padding_edit_users_button">
                                                            <button class="btn waves-effect waves-light alx_h8_font alx_button_width"
                                                                    type="submit"
                                                                    name="usuwanie">
                                                                Usuń <i class="icon-block alx_h8_font"></i>
                                                            </button>
                                                        </div>
                                                    </tr>
                                                </table>
                                            </td>
                                        </form>
                                    </tr>
                                </table>
                            </div>
                        <?php } ?>
                        <!--    KONIEC PĘTLI Z WIERSZAMI   -->

                        <!--           POCZĄTEK OSTATNI WIERSZ -->
                        <div class="collapsible-body">
                            <table>
                                <tr>
                                    <form action="#">
                                        <td class="alx_table_edit_res_pic">
                                            <div class="file-field input-field">
                                                <img src="resr/img/image.svg" class="alx_img_src">
                                                <div class="btn-floating alx_btn_floating">
                                                    <i class="icon-plus"></i>
                                                    <input type="file">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="alx_tabela_surowcow_admin">
                                            <div class="input-field">
                                                <input value="" id="first_name2" type="text" class="validate">
                                                <label class="active" for="first_name2">Fabryka</label>
                                            </div>
                                        </td>
                                        <td class="alx_tabela_surowcow_admin">
                                            <div class="input-field">
                                                <input value="" id="first_name2" type="text" class="validate">
                                                <label class="active" for="first_name2">Surowiec</label>
                                            </div>
                                        </td>
                                        <td class="alx_tabela_surowcow_admin">
                                            <div class="input-field">
                                                <input value="" id="first_name2" type="number" class="validate">
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
                        </div>
                    </li>
                    <!--                KONIEC OSTATNI WIERSZ Z DODANIEM-->
                    <!--                    KONIEC OPCJI 2-->


                    </li>

                    <!--                    POCZĄTEK OPCJI 3 - PYTANIA DO GRY-->
                    <li>
                        <div class="collapsible-header"><i class="icon-code-outline aleks_icon"></i>Dodaj zadanie do
                            gry
                        </div>


                        <!--             PĘTLA Z WIERSZAMI W PYTANIA DO GRY-->
                        <?php for ($i = 0; $i < 2; $i++) { ?>
                            <div class="collapsible-body">
                                <table>
                                    <tr>
                                        <form action="#">
                                            <td>
                                                <div class="input-field col s12">
                                                    <textarea id="textarea1" class="materialize-textarea">
                                                        Kasia kupiła 10 jabłek, a Adaś ma biegunkę. Co jest sensem życia?
                                                    </textarea>
                                                    <label for="textarea1">Pytanie</label>
                                                </div>
                                            </td>
                                            <td class="alx_edytor_pytań">
                                                <div class="input-field col s12">
                                                    <textarea id="textarea1" class="materialize-textarea">
                                                        42
                                                    </textarea>
                                                    <label for="textarea1">Odpowiedź</label>
                                                </div>
                                            </td>
                                            <td class="alx_edytor_pytań">
                                                <div class="input-field col s12">
                                                    <textarea id="textarea1" class="materialize-textarea">
                                                        Nie wiem...
                                                    </textarea>
                                                    <label for="textarea1">Źle</label>
                                                </div>
                                            </td>
                                            <td class="alx_edytor_pytań">
                                                <div class="input-field col s12">
                                                    <textarea id="textarea1" class="materialize-textarea">
                                                        PHP
                                                    </textarea>
                                                    <label for="textarea1">Źle</label>
                                                </div>
                                            </td>
                                            <td class="alx_edytor_pytań">
                                                <div class="input-field col s12">
                                                    <textarea id="textarea1" class="materialize-textarea">
                                                        Wait! Ta sraka to po jabłkach?
                                                    </textarea>
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
                                                                    name="ban">
                                                                Edytuj <i class="icon-cogs alx_h8_font"></i>
                                                            </button>
                                                        </div>
                                                    </tr>
                                                    <tr class="alx_padding_edit_users_button">
                                                        <div class="alx_padding_edit_users_button">
                                                            <button class="btn waves-effect waves-light alx_h8_font alx_button_width"
                                                                    type="submit"
                                                                    name="usuwanie">
                                                                Usuń <i class="icon-block alx_h8_font"></i>
                                                            </button>
                                                        </div>
                                                    </tr>
                                                </table>
                                            </td>
                                        </form>
                                    </tr>
                                </table>
                            </div>
                        <?php } ?>
                        <!--    KONIEC PĘTLI Z WIERSZAMI   -->

                        <!--           POCZĄTEK OSTATNI WIERSZ -->
                        <div class="collapsible-body">
                            <table>
                                <tr>
                                    <form action="#">
                                        <td>
                                            <div class="input-field col s12">
                                                <textarea id="textarea1" class="materialize-textarea"></textarea>
                                                <label for="textarea1">Pytanie</label>
                                            </div>
                                        </td>
                                        <td class="alx_edytor_pytań">
                                            <div class="input-field col s12">
                                                <textarea id="textarea1" class="materialize-textarea"></textarea>
                                                <label for="textarea1">Odpowiedź</label>
                                            </div>
                                        </td>
                                        <td class="alx_edytor_pytań">
                                            <div class="input-field col s12">
                                                <textarea id="textarea1" class="materialize-textarea"></textarea>
                                                <label for="textarea1">Źle</label>
                                            </div>
                                        </td>
                                        <td class="alx_edytor_pytań">
                                            <div class="input-field col s12">
                                                <textarea id="textarea1" class="materialize-textarea"></textarea>
                                                <label for="textarea1">Źle</label>
                                            </div>
                                        </td>
                                        <td class="alx_edytor_pytań">
                                            <div class="input-field col s12">
                                                <textarea id="textarea1" class="materialize-textarea"></textarea>
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
                        </div>
                    </li>
                    <!--KONIEC OPCJI Z PYTANIAMI DO GRY-->


                    <li>
                        <div class="collapsible-header"><i class="icon-key aleks_icon"></i>Zarządzaj użytkownikami
                        </div>
                        <!--             PĘTLA Z WIERSZAMI W ZARZĄDZAJ UŻYTKOWNIKAMI-->
                        <?php for ($i = 0; $i < 2; $i++) { ?>
                            <div class="collapsible-body">
                                <table>
                                    <tr>
                                        <form action="#">
                                            <td class="alx_table_edit_res_pic">
                                                <div class="file-field input-field">
                                                    <img src="resr/img/miscellaneous.svg" class="alx_img_src">
                                                    <!--                                                DODAJ OBRAZEK-->
                                                </div>
                                            </td>
                                            <td class="alx_info_o_graczu">
                                                <table>
                                                    <tr>
                                                        <div class="input-field">
                                                            <input value="aleks" id="first_name2" type="text"
                                                                   class="validate">
                                                            <label class="active"
                                                                   for="first_name2">Użytkownik</label>
                                                        </div>

                                                    </tr>
                                                    <tr>
                                                        <div class="input-field">
                                                            <input value="2" id="first_name2" type="text"
                                                                   class="validate">
                                                            <label class="active" for="first_name2">Poziom</label>
                                                        </div>
                                                    </tr>
                                                    <tr>
                                                        <div class="input-field">
                                                            <input value="Gracz" id="first_name2" type="text"
                                                                   class="validate">
                                                            <label class="active alx_2rem_font"
                                                                   for="first_name2">Uprawnienia</label>
                                                        </div>
                                                    </tr>
                                                </table>
                                            </td>

                                            <!--                                            STATY GRACZA-->
                                            <td class="alx_info_o_graczu_spadding">
                                                <table>
                                                    <tr class="alx_info_bar">
                                                        <?php for ($j = 0;
                                                        $j < 5;
                                                        $j++){ ?>
                                                    <tr>
                                                        <td class="alx_center_th alx_th_padding">
                                                                <input value="Węgiel: 50/100" type="text" class="alx_small_input">
                                                            <div class="progress">
                                                                <div class="determinate" style="width: 50%;"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                    </tr>
                                                </table>

                                            </td>

<!--                                            BUTTONY-->
                                            <td class="alx_btn_space_in_users_edit" ">
                                                <table>
                                                    <tr>
                                                        <button class="btn waves-effect waves-light alx_h8_font alx_button_width"
                                                                type="submit"
                                                                name="ban">
                                                            Ban <i class="icon-block alx_h8_font"></i>
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
                            </div>
                        <?php } ?>
                        <!--    KONIEC PĘTLI Z WIERSZAMI   -->

                    </li>
                </ul>

            </div>

        </div>
    </div>

    </body>
    </html>
<?php } else if (isset($_SESSION["idUser"]) && $_SESSION["UserType"] == "2") {
    header("Location:Map.php");
} else if (!isset($_SESSION["idUser"])) {
    header("Location:index.php");
} ?>