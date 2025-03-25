    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Site Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $site->dir_admin; ?>">Home</a></li>
              <li class="breadcrumb-item active">Site Settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Website Settings</h3>
                        </div>
                        <div class="card-body">
                            <form id="site_settings" method="POST">
                                <div class="form-group">
                                    <label>Site Title</label>
                                    <input type="text" name="site_title" value="<?php echo $site->get('site_title'); ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Site Name</label>
                                    <input type="text" name="site_name" value="<?php echo $site->get('site_name'); ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Site Email</label>
                                    <input type="email" name="site_email" value="<?php echo $site->get('site_email'); ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Site Keywords</label>
                                    <input type="text" name="site_keywords" value="<?php echo $site->get('site_keywords'); ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Site Description</label>
                                    <textarea name="site_description" class="form-control" rows="3"><?php echo $site->get('site_description'); ?></textarea>
                                </div>
                                <input type="hidden" name="token_id" value="<?php echo $token_id; ?>">
                                <div id="site_settings_alert"></div>
                                <div id="before_site_settings">
                                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Other Settings</h3>
                        </div>
                        <div class="card-body">
                            <form id="other_settings" method="POST">
                                <div class="form-group">
                                    <label>Default Language</label>
                                    <select class="form-control" name="defualt_lang">
                                    <?php
                                    foreach ($lang->getLangsNames() as $langs_names):
                                    $languages = $langs_names->Field;
                                    $languages_name = ucfirst(strtolower($languages));
                                    $selected_lang = ($languages == $site->get('defualt_lang')) ? ' selected' : '';
                                    ?>
                                        <option value="<?php echo $languages; ?>" <?php echo $selected_lang;?>><?php echo $languages_name; ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                                <input type="hidden" name="token_id" value="<?php echo $token_id; ?>">
                                <div id="other_settings_alert"></div>
                                <div id="before_other_settings">
                                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

<script>
$(document).ready(function(){
  $('#site_settings').on('submit', function(event){
    event.preventDefault();
    var form_data = $(this).serialize();
      $.ajax({
        url:"<?php echo $site->dir_ajax; ?>?a=admin&b=update_config",
        method:"POST",
        data:form_data,
        beforeSend: function(){
          $("#before_site_settings").html('<button type="button" class="btn btn-primary" disabled><span class="spinner-border spinner-border-sm pr-1" role="status" aria-hidden="true"></span>Save</button>');
        },
        success:function(data)
        {
          if(data.status == 'success'){
            $('#site_settings_alert').html('<div class="callout callout-success"><p>' + data.message + '</p></div>');
            $("#before_site_settings").html('<button type="submit" name="submit" class="btn btn-primary">Save</button>');
          }else{
            $('#site_settings_alert').html('<div class="callout callout-danger"><p>' + data.errors + '</p></div>');
            $("#before_site_settings").html('<button type="submit" name="submit" class="btn btn-primary">Save</button>');
          }
        }
      });
  });
});
</script>

<script>
$(document).ready(function(){
  $('#other_settings').on('submit', function(event){
    event.preventDefault();
    var form_data = $(this).serialize();
      $.ajax({
        url:"<?php echo $site->dir_ajax; ?>?a=admin&b=update_config",
        method:"POST",
        data:form_data,
        beforeSend: function(){
          $("#before_other_settings").html('<button type="button" class="btn btn-primary" disabled><span class="spinner-border spinner-border-sm pr-1" role="status" aria-hidden="true"></span>Save</button>');
        },
        success:function(data)
        {
          if(data.status == 'success'){
            $('#other_settings_alert').html('<div class="callout callout-success"><p>' + data.message + '</p></div>');
            $("#before_other_settings").html('<button type="submit" name="submit" class="btn btn-primary">Save</button>');
          }else{
            $('#other_settings_alert').html('<div class="callout callout-danger"><p>' + data.errors + '</p></div>');
            $("#before_other_settings").html('<button type="submit" name="submit" class="btn btn-primary">Save</button>');
          }
        }
      });
  });
});
</script>