
foreach ($QuestData as &$item) {
$pytanie = $item->getQuestion();
$AnsList = $item->getAnswerList();
$odp = $AnsList;
$zle1 = $AnsList;
$zle2 = $AnsList;
$zle3 = $AnsList;
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



------------------------------

for($i=0;$i<10;$i++) {
$show = <<<HTML
<div class="alx_flex_dla_mapy_diva">
    <img src="resr/img/plus1.svg" class="alx_flexy_w_divie_map" onclick="add_func_open_zindex()">
</div>
HTML;
echo $show;
}