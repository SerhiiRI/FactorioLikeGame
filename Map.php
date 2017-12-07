<?php
include_once("resr/src/PAGE_INCLUDES_SCRIPT/PAGE_DEFINE_VARIABLE.php");
if(isset($_SESSION["idUser"]) && $_SESSION["UserType"]=="2") {
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
    <!--progresbar-->


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
                <h5><?php echo $_SESSION["name_of_user"] ?>
                    <br><span class="alx_h6_font_grey">- Poziom: 1 -</span></h5>

                <!--                Zasoby użytkownika-->
            </div>
            <div class="aleks_center">
                <!--                dodać php-->

                <br/>
                <table class="alx_table_admin_menu">
                    <?php for ($i = 0;
                               $i < 5;
                               $i++){ ?>
                        <tr>
                            <td class="alx_center_th alx_th_padding">
                                Węgiel: 50/100
                                <div class="progress alx_left_th">
                                    <div class="determinate" style="width: 25%"></div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </table>

                <br/>

                <table class="alx_table_admin_menu">
                    <tr>
                        <td class="alx_przycisk_na_lewym_panelu">
                            <a href="hard_logout.php" class="alx_przycisk_wylogowania">
                                <i class="icon-logout aleks_icon_logout"></i> Wyloguj
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!--prawy panel użytkownika (content)-->
        <div class="aleks_content_panel">
            <p> - Workspace gracza - </p>
        </div>

    </div>
</div>

</body>
</html>
<?php }else if (isset($_SESSION["idUser"]) && $_SESSION["UserType"]=="1"){header("Location:AdminControllerSystem.php");}
else if (!isset($_SESSION["idUser"])){header("Location:index.php");}?>