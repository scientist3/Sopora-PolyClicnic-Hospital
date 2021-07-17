 <div class="panel panel-default thumbnail">

    <div class="panel-heading">
        <div class="btn-group"> 
            <a class="btn btn-success" href="<?php echo base_url("language/phrase") ?>"> <i class="fa fa-plus"></i> Add Phrase</a> 
        </div> 
    </div>


    <div class="panel-body">
        <div class="row">

            <!-- language -->
            <div class="col-sm-12">
 
              <table class="table table-striped">
                <thead>
                    <tr>
                        <td colspan="3">
                            <?= form_open('language/addlanguage', ' class="form-inline" ') ?> 
                                <div class="form-group">
                                    <label class="sr-only" for="addLanguage"> Language Name</label>
                                    <input name="language" type="text" class="form-control" id="addLanguage" placeholder="Language Name">
                                </div>
                                  
                                <button type="submit" class="btn btn-primary">Save</button>
                            <?= form_close(); ?>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-th-list"></i></th>
                        <th>Language</th>
                        <th><i class="fa fa-cogs"></i></th>
                    </tr>
                </thead>


                <tbody>
                    <?php if (!empty($languages)) {?>
                        <?php $sl = 1 ?>
                        <?php foreach ($languages as $key => $language) {?>
                        <tr>
                            <td><?= $sl++ ?></td>
                            <td><?= $language ?></td>
                            <td><a href="<?= base_url("language/editPhrase/$key") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>  
                            </td> 
                        </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>

              </table>
            </div>
 

        </div>
    </div>
  
</div>

