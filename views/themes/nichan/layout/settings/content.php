<?php

if (!defined("nichan")):
    exit();
endif;

?>

<div class="container">
    <div class="row">
        <div class="col-md-3"></div>

        <div class="col-md-6">
            <div class="card">

                <form id="data_form" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                          <label><?php echo $lang->get('username'); ?></label>
                          <input type="text" value="<?php echo Secure::escape($user->data()->user_username); ?>" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                          <label><?php echo $lang->get('email'); ?></label>
                          <input type="email" value="<?php echo Secure::escape($user->data()->user_email); ?>" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label><?php echo $lang->get('language'); ?></label>
                            <select class="form-control" name="lang_code">
                                <?php
                                  foreach ($lang->getLangsNames() as $langs_names):
                                  $languages = $langs_names->Field;
                                  $languages_name = ucfirst(strtolower($languages));
                                  $selected_lang = ($languages == $site->get('defualt_lang')) ? ' selected' : '';
                                ?>
                                    <option value="<?php echo $languages; ?>"><?php echo $languages_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                          <label><?php echo $lang->get('your_profile_picture'); ?></label>
                          <input type="file" name="avatar" class="form-control" accept="image/x-png, image/jpeg, image/jpg">
                        </div>
                        <div class="form-group">
                          <label><?php echo $lang->get('about'); ?></label>
                          <textarea name="user_about" class="form-control" rows="4"><?php echo Secure::escape($user->data()->user_about); ?></textarea>
                        </div>
                        <div id="form_alert"></div>
                    </div>
                    <input type="hidden" name="token_id" value="<?php echo Token::generate(); ?>">
                    <div class="card-footer" id="before_send">
                      <button type="submit" name="submit" class="btn btn-primary"><?php echo $lang->get('save'); ?></button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->

<script>
$(document).ready(function(){
  $('#data_form').on('submit', function(event){
    event.preventDefault();
      $.ajax({
        url:"<?php echo $site->dir_ajax; ?>?a=user&b=update",
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function(){
          $("#before_send").html('<button type="button" class="btn btn-primary" disabled><span class="spinner-border spinner-border-sm pr-1" role="status" aria-hidden="true"></span><?php echo $lang->get('save'); ?></button>');
        },
        success:function(data)
        {
          if(data.status == 'success'){
            $('#form_alert').html('<div class="callout callout-success"><p>' + data.message + '</p></div>');
            $("#before_send").html('<button type="submit" name="submit" class="btn btn-primary"><?php echo $lang->get('save'); ?></button>');
          }else{
            $('#form_alert').html('<div class="callout callout-danger"><p>' + data.errors + '</p></div>');
            $("#before_send").html('<button type="submit" name="submit" class="btn btn-primary"><?php echo $lang->get('save'); ?></button>');
          }
        }
      });
  });
});
</script>