<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 07.01.18
 * Time: 14:00
 */

include_once __DIR__."/../Controllers/ResourceController.php";
include_once __DIR__."/../Controllers/TaskController.php";


// get the q parameter from URL
$__Resource__ = \Controller\ResourceController::getInstance();
$__Task__ = \Controller\TaskController::getInstance();
$__Resource__->initializeResourceScoreForFrontEnd();
$__Resource__->updateResourceScoreForFrontEnd();

$tf = true;
foreach ($__Resource__->returnArrayForCurrentUserResource($_SESSION["idUser"]) as $value){
    $surowiec = $value->getResourceName();
    $progres = $_SESSION[$value->getResourceName()];
    $finish = $__Task__->searchLevelByIdResorce($value->getIdResources());
    $progres_procent = ($progres * 100) / $finish;

    if($tf==true){
        if($progres==$finish){$tf=true;}else{$tf=false;}
    }


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
if($tf==true){
    $_SESSION["BtnDes"]="odblokuj";

}else{
    $_SESSION["BtnDes"]="zablokuj";
}

