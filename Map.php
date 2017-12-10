<?php
include_once("resr/src/PAGE_INCLUDES_SCRIPT/PAGE_DEFINE_VARIABLE.php");
if (isset($_SESSION["idUser"]) && $_SESSION["UserType"] == "2") {

    include_once("resr/src/view_generator/view_for_user.php"); ?>

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
    <a href="Credits.html"><img src="resr/img/gear6.gif" class="autorzy_btn"></a>

    <?php PanelKontrolnyFabryki(); ?>

    <div>
        <div>
            <!--lewy panel Admina-->
            <?php LewyPanelAdmina(); ?>
            <!--KONIEC PANELU LEWEGO-->

            <!--prawy panel Admina (content)-->
            <div class="aleks_content_panel">

                <h1 class="alx_h1_title">Mapa Fabryki</h1>
                <!--Mapa gracza-->
                <div class="alx_flex_dla_mapy_diva">
                    <?php MapaFabryki(); ?>
                </div>
                <!--Koniec części z Mapą Fabryki-->
            </div>

        </div>
    </div>
    <script>
        function func_open_zindex(grafika, wydobycie, lvl) {
            document.getElementById("alx_flexkontener_0").style.opacity = 1;
            document.getElementById("alx_flexkontener_0").style.zIndex = 5;
            document.getElementById("grafika_ligthbox").src = "resr/img/" + grafika;
            document.getElementById("lvl_ligthbox").innerHTML = "Poziom: " + lvl;
            document.getElementById("wydobycie_ligthbox").innerHTML = "Wydobycie: " + wydobycie + "/h";
            document.getElementById("alx_flexkontener_0").style.transition = "all 500ms";
        }

        function func_close_zindex() {
            document.getElementById("alx_flexkontener_0").style.opacity = 0;
            document.getElementById("alx_flexkontener_0").style.zIndex = -1;
        }


        function start_working() {
            document.getElementById("working_ico").src = "resr/img/gear3.svg";
            document.getElementById("working_ico").style.animationIterationCount = 1000;
            document.getElementById("onClickWorking").setAttribute("onClick", "javascript: stop_working();")
        }

        function stop_working() {
            document.getElementById("working_ico").style.animationIterationCount = 0;
            document.getElementById("working_ico").src = "resr/img/stop.png";
            document.getElementById("onClickWorking").setAttribute("onClick", "javascript: start_working();")
        }


    </script>

    </body>
    </html>

<?php } else if (isset($_SESSION["idUser"]) && $_SESSION["UserType"] == "1") {
    header("Location:AdminControllerSystem.php");
} else if (!isset($_SESSION["idUser"])) {
    header("Location:index.php");
} ?>