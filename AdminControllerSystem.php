<?php
//include_once("db_update.php");
include_once("resr/src/PAGE_INCLUDES_SCRIPT/PAGE_DEFINE_VARIABLE.php");
if (isset($_SESSION["idUser"]) && $_SESSION["UserType"] == "1") {

    include_once("resr/src/view_generator/view_for_message.php");
    include_once("resr/src/view_generator/view_for_admin.php");
    $whatShouldOpen = $_SESSION["whatShouldOpen"];
    ?>


    <!DOCTYPE html>
    <html lang="pl">

    <head>
        <meta charset="UTF-8">
        <title>Admin Tools</title>
        <!--Import materialize.css-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="style/materialize/css/materialize.min.css"
              media="screen,projection"/>
        <!--Import czcionek-->
        <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700|Bahiana|Chelsea+Market|Cinzel:400,700,900|Dosis:200,300,400,500,600,700,800|Jim+Nightshade|Nosifer|Poiret+One|Quicksand:300,400,500,700|Text+Me+One&amp;subset=latin-ext"
              rel="stylesheet">
        <!--Import fontello-->
        <link rel="stylesheet" href="style/fontello/css/fontello.css">
        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="style/materialize/js/materialize.min.js"></script>
        <!--Import aleks_style.css-->
        <link type="text/css" rel="stylesheet" href="style/aleks_style.css"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body class="alx_bg_img">
    <div class="jsmessage" id="jsmessagestyle"><h4 id="jsmessage">TXT</h4></div>
    <?php
    if(isset($_SESSION["ActionInfo"])){
        if($_SESSION["ActionInfo"]!= ""){
            javamessage($_SESSION["ActionInfo"]);
            $_SESSION["ActionInfo"] = "";
        }
    }
//    javamessage("Wygląda na to że działa :D")
    ;?>
    <a href="Credits.html"><img src="resr/img/gear6.gif" class="autorzy_btn"></a>
    <div class="alx_border_space">
        <div>
            <!--lewy panel Admina-->
            <?php LewyPanelAdmina(); ?>
            <!--KONIEC PANELU LEWEGO-->

            <!--prawy panel Admina (content)-->
            <div class="aleks_content_panel">
                <h1 class="alx_h1_title">Panel administratora</h1>

                <!--                PANEL NARZĘDZI-->
                <ul class="collapsible popout" data-collapsible="accordion">

                    <!------------------------------------------------------------------------------------------------>
                    <!--PIERWSZE NARZĘDZIE "STATYSTYKA"-->
                    <li class="alx_zmiana_stylu_listy_panel_admina">
                        <div class="collapsible-header <?php if($whatShouldOpen == "statystyka" || $whatShouldOpen == "startPage"){echo "active";} ?>"><i class="material-icons">sort</i>Statystyka</div>
                        <!--PIERWSZY ELEMENT PO ROZWINIECIU-->
                        <?php wyswietlanieStatystykSystemu(); ?>
                        <!--KONIEC PIERWSZEGO ELEMENTU-->
                    </li>
                    <!--KONIEC PIERWSZEGO NARZEDZIA-->
                    <!------------------------------------------------------------------------------------------------>

                    <!--DRUGIE NARZĘDZIE "EDYCJA SUROWCOW"-->
                    <li class="alx_zmiana_stylu_listy_panel_admina">
                        <div class="collapsible-header <?php if($whatShouldOpen == "edytor fabryk"){echo "active";} ?>">
                            <i class="icon-industrial-building aleks_icon"></i>
                            Edytor fabryk/surowców
                        </div>

                        <!--    PĘTLA Z WIERSZAMI W Zarządzaie Surowcami w grze-->
                        <?php zarządzanieFabrykamiOrazSurowcami(); ?>
                        <!--KONIEC OPCJI 2-->
                        <!------------------------------------------------------------------------------------------------>

                        <!--POCZĄTEK OPCJI 3 - PYTANIA DO GRY-->
                    <li class="alx_zmiana_stylu_listy_panel_admina">
                        <div class="collapsible-header <?php if($whatShouldOpen == "edytor pytań"){echo "active";} ?>"><i class="icon-code-outline aleks_icon"></i>Edytor pytań
                        </div>

                        <!--PĘTLA Z WIERSZAMI W PYTANIA DO GRY-->
                        <?php EdycjaPytanDoGry(); ?>
                        <!--Koniec opcji 3-->
                        <!------------------------------------------------------------------------------------------------>


                        <!--POCZĄTEK OPCJI 4 - Taski DO GRY-->
                    <li class="alx_zmiana_stylu_listy_panel_admina ">
                        <div class="collapsible-header  <?php if($whatShouldOpen == "edytor zadań"){echo "active";} ?>"><i class="icon-tools aleks_icon"></i>Edytor zadań
                        </div>


                        <!--PĘTLA Z WIERSZAMI W Taski DO GRY-->
                        <?php EdytorZadańDoGry(); ?>
                        <!--Koniec opcji 3-->
                        <!------------------------------------------------------------------------------------------------>


                        <!--POCZĄTEK OPCJI 5 - Edytor użytkownikow-->
                    <li class="alx_zmiana_stylu_listy_panel_admina">
                        <div class="collapsible-header <?php if($whatShouldOpen == "edytuj usera"){echo "active";} ?>">
                            <i class="icon-key aleks_icon"></i>Zarządzaj użytkownikami
                        </div>

                        <!--PĘTLA Z WIERSZAMI W ZARZĄDZAJ UŻYTKOWNIKAMI-->
                        <?php EdtyorUzytkownikow(); ?>
                        <!--Koniec opcji 5-->
                        <!------------------------------------------------------------------------------------------------>

                    </li>
                </ul>

            </div>

        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('select').material_select();
        });
    </script>
    </body>
    </html>

<?php

    if($_SESSION['ref'] == true){
        $_SESSION['ref'] = false;
        echo '<script>
//        window.location.reload(true);
        </script>';
    }

} else if (isset($_SESSION["idUser"]) && $_SESSION["UserType"] == "2") {
    header("Location:Map.php");
} else if (!isset($_SESSION["idUser"])) {
    header("Location:Index.php");
} ?>