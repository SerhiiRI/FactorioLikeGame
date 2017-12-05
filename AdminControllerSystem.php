<?php
include_once("resr/src/PAGE_INCLUDES_SCRIPT/PAGE_DEFINE_VARIABLE.php");
if(isset($_SESSION["idUser"]) && $_SESSION["UserType"]=="1") {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="style/materialize/css/materialize.min.css" media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!--Import aleks_style.css-->
    <link type="text/css" rel="stylesheet" href="style/aleks_style.css"/>

    <meta charset="UTF-8">
    <title>User map</title>
    <link rel="stylesheet" type="text/css" href="style/login.css">
    <!--import czcionek-->
    <?php include_once("style/fonts.html")?>
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
                <h5><?php echo $_SESSION["name_of_user"]?>
                    <br><span class="alx_h6_font_grey">- Administrator -</span></h5>

                <!-- Funkcje dla admina -->
                <br/>
                <table class="alx_table_admin_menu">
                    <tr>
                        <td class="alx_table_admin_menu_th">Edytuj elementy gry</td>
                    </tr>
                    <tr>
                        <td class="alx_table_admin_menu_th">Ustawienia</td>
                    </tr>
                    <tr>
                        <td class="alx_table_admin_menu_th_last">
                            <a href="hard_logout.php" class="alx_display_block">
                                <i class="icon-logout aleks_icon_logout"></i> Wyloguj
                            </a>
                        </td>
                    </tr>
                </table>

            </div>
        </div>

        <!--prawy panel użytkownika (content)-->

        <div class="aleks_content_panel">
            <h1 style="text-align: center">Panel administratora</h1>
            <ul class="collapsible popout" data-collapsible="accordion">
                <li>
                    <div class="collapsible-header"><i class="material-icons">sort</i>Statystyka</div>
                    <div class="collapsible-body">
                        <i class="icon-users aleks_icon"></i><span style="margin-left: 2rem"/>
                        <!--dodać podlicznaie ilości użytkowników-->
                        Ilość użytkowników w systemie:<span style="margin-left: 1rem"/>12
                    </span>
                    </div>
                    <div class="collapsible-body">
                        <i class="icon-users aleks_icon"></i><span style="margin-left: 2rem"/>
                        <!--dodać podlicznaie ilości użytkowników-->
                        Ilość użytkowników w systemie:<span style="margin-left: 1rem"/>12
                        </span>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">add_circle_outline</i>Dodawanie elementów gry</div>
                    <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">person_pin</i>Zarządzaj użytkownikami</div>
                    <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                </li>
            </ul>

        </div>

    </div>
</div>

</body>
</html>
<?php }else if (isset($_SESSION["idUser"]) && $_SESSION["UserType"]=="2"){header("Location:Map.php");}
else if (!isset($_SESSION["idUser"])){header("Location:index.php");}?>