<?php
include_once("resr/src/PAGE_INCLUDES_SCRIPT/PAGE_DEFINE_VARIABLE.php");
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

</head>
<body style="background-image: url(resr/img/land.jpg)">
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="style/materialize/js/materialize.min.js"></script>

<?php
/**
 * TODO: tu musi być funkcja, która, korzystając z funkcyj Klasów Question, Factory, Answer...
 * TODO: we wszystkich clasach(potrzebującę widokiem) z metodami, przypomnianych w Interface  -  GraficView.php
 *
 * Example:
 *
 * for(...){
 *      <tr>
 *          <td> Factory->__view__Generate() </td>
 *      </tr>
 * }
 *
 * for(...){
 *      <tr>
 *          <td> Question->__view__Generate() </td>
 *      </tr>
 * }
 *
 * for(...){
 *      <tr>
 *          <td> Answer->__view__Generate() </td>
 *      </tr>
 * }
 */
?>
<div style="padding: 3%">
    <div class="row">
        <!--lewy panel użytkownika-->
        <div class="col s3 aleks_user_panel">

            <!--            Obrazek użytkownika-->
            <div class="aleks_user_img_div">
                <img class="aleks_user_img" src="resr/img/defoult_user.svg"/>
                <h5>Aleks<!--Trzeba tu wrzucić pobranie obecnego gracza--></h5>

                <!--                Zasoby użytkownika-->
            </div>
            <br/>
            <div class="aleks_center">
                <p>Węgiel: 100/250</p>
                <p>Węgiel: 100/250</p>
                <p>Węgiel: 100/250</p>
                <p>Węgiel: 100/250</p>
                <p>Węgiel: 100/250</p>
                <p>Węgiel: 100/250</p>
                <br/>
                <?php include_once("resr/src/PAGE_INCLUDES_SCRIPT/PAGE_LOGOUT_BUTTON_AND_FORM.php");?>
            </div>
            <br/>
        </div>

        <div class="col s1 aleks_vertical_space"></div>

        <!--prawy panel użytkownika (content)-->
        <div class="aleks_content_panel">
            <p> - Workspace gracza - </p>
        </div>

    </div>
</div>

</body>
</html>