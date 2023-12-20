<div class="round_extrastop loc1">
    <div class="element_wrapper extradetailloc">
        <div class="label_wrapper">
            Extra Return Stop Location
        </div>
        <div class="input_wrapper">

        </div>
    </div>
    <div class="element_wrapper">
        <div class="label_wrapper">
            Address:
        </div>
        <div class="input_wrapper">
            <input type="text" id="round_extra_street" value="<?= rs(post('round_extra_street')) ?>" name="round_extra_street" size="20" class="formbox" readonly>
            <input type="button" class="btn bt-sm btn-primary" onclick="addExtraRoundStop(this)" value="+" />
        </div>
    </div>
    <div class="element_wrapper" style="display: none;">
        <div class="label_wrapper">
            City:
        </div>
        <div class="input_wrapper">
            <input type="text" id="round_extra_city" value="<?= rs(post('round_extra_city')) ?>" name="round_extra_city" maxlength="25" size="20" class="formbox" >
        </div>
    </div>

    <div class="element_wrapper" style="display: none;">
        <div class="label_wrapper">
            State/Zip:
        </div>
        <div class="input_wrapper input_wrapper_2">                                        
            <select name="round_extra_state" id="round_extra_state" size="1" class="formselect" style="width:130px; margin-right:10px !important"> 
                <option value="">Please Select ...</option>                                          
                <?php foreach ($state_list as $key => $val) { ?>
                    <option value="<?= $val ?>" <?= (rs(post('round_extra_state')) == $val ? 'selected=selected' : ''); ?>><?= $val ?></option>
                    <?php
                }
                ?>                                          
            </select>
            <input type="text" value="<?= rs(post('round_extra_zip')) ?>" name="round_extra_zip" maxlength="25" size="15" class="formbox" style="width:100px !important;" id="round_extra_zip"> 
        </div>
    </div>
</div>