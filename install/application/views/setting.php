<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default panel-form">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-9 col-sm-12">
                        <?php echo form_open_multipart('setting/create','class="form-inner"') ?>
                            <?php echo form_hidden('setting_id',$setting->setting_id) ?>

                            <div class="form-group row">
                                <label for="title" class="col-xs-3 col-form-label"><?php echo display('application_title') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="title" type="text" class="form-control" id="title" placeholder="<?php echo display('application_title') ?>" value="<?php echo $setting->title ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-xs-3 col-form-label"><?php echo display('address') ?></label>
                                <div class="col-xs-9">
                                    <input name="description" type="text" class="form-control" id="description" placeholder="<?php echo display('address') ?>"  value="<?php echo $setting->description ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-xs-3 col-form-label"><?php echo display('email')?></label>
                                <div class="col-xs-9">
                                    <input name="email" type="text" class="form-control" id="email" placeholder="<?php echo display('email')?>"  value="<?php echo $setting->email ?>">
                                </div>
                            </div>
 
                            <div class="form-group row">
                                <label for="phone" class="col-xs-3 col-form-label"><?php echo display('phone') ?></label>
                                <div class="col-xs-9">
                                    <input name="phone" type="text" class="form-control" id="phone" placeholder="<?php echo display('phone') ?>"  value="<?php echo $setting->phone ?>" >
                                </div>
                            </div>


                            <!-- if setting favicon is already uploaded -->
                            <?php if(!empty($setting->favicon)) {  ?>
                            <div class="form-group row">
                                <label for="faviconPreview" class="col-xs-3 col-form-label"></label>
                                <div class="col-xs-9">
                                    <img src="<?php echo base_url($setting->favicon) ?>" alt="Favicon" class="img-thumbnail" />
                                </div>
                            </div>
                            <?php } ?>

                            <div class="form-group row">
                                <label for="favicon" class="col-xs-3 col-form-label"><?php echo display('favicon') ?> </label>
                                <div class="col-xs-9">
                                    <input type="file" name="favicon" id="favicon">
                                    <input type="hidden" name="old_favicon" value="<?php echo $setting->favicon ?>">
                                </div>
                            </div>


                            <!-- if setting logo is already uploaded -->
                            <?php if(!empty($setting->logo)) {  ?>
                            <div class="form-group row">
                                <label for="logoPreview" class="col-xs-3 col-form-label"></label>
                                <div class="col-xs-9">
                                    <img src="<?php echo base_url($setting->logo) ?>" alt="Picture" class="img-thumbnail" />
                                </div>
                            </div>
                            <?php } ?>

                            <div class="form-group row">
                                <label for="logo" class="col-xs-3 col-form-label"><?php echo display('logo') ?></label>
                                <div class="col-xs-9">
                                    <input type="file" name="logo" id="logo">
                                    <input type="hidden" name="old_logo" value="<?php echo $setting->logo ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="footer_text" class="col-xs-3 col-form-label"><?php echo display('language') ?></label>
                                <div class="col-xs-9">
                                    <?= form_dropdown('language',$languageList,$setting->language, 'class="form-control"') ?>
                                </div>
                            </div> 

                            <div class="form-group row">
                                <label for="footer_text" class="col-xs-3 col-form-label"><?php echo display('site_align') ?></label>
                                <div class="col-xs-9">
                                    <?= form_dropdown('site_align', array('LTR' => display('left_to_right'), 'RTL' => display('right_to_left')) ,$setting->site_align, 'class="form-control"') ?>
                                </div>
                            </div> 

                            <div class="form-group row">
                                <label for="footer_text" class="col-xs-3 col-form-label"><?php echo display('footer_text') ?></label>
                                <div class="col-xs-9">
                                    <textarea name="footer_text" class="form-control"  placeholder="Footer Text" maxlength="140" rows="7"><?php echo $setting->footer_text ?></textarea>
                                </div>
                            </div>  

                            <div class="form-group row">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <div class="ui buttons">
                                        <button type="reset" class="ui button"><?php echo display('reset') ?></button>
                                        <div class="or"></div>
                                        <button class="ui positive button"><?php echo display('save') ?></button>
                                    </div>
                                </div>
                            </div>
                        <?php echo form_close() ?>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </div>

</div>