<?php
include_once("resr/src/PAGE_INCLUDES_SCRIPT/PAGE_DEFINE_VARIABLE.php");
include_once ("resr/src/PAGE_INCLUDES_SCRIPT/PAGE_LOGOUT_BUTTON_AND_FORM.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User map</title>
    <link rel="stylesheet" type="text/css" href="style/login.css">

</head>
<body style="background-image: url(resr/img/land.jpg)">

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
<div class="login-page">
    <div class="form">
        <p class="message"> AdminConrollerSystem</p>
    </div>
</div>
<table>
    <?php
        echo "<tr>";
        echo "</tr>";
    ?>
</table>

</body>
</html>