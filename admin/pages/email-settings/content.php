    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">E-mail & SMS Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $site->dir_admin; ?>">Home</a></li>
              <li class="breadcrumb-item active">E-mail & SMS Settings</li>
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
                            <h3 class="card-title">E-mail Settings</h3>
                        </div>
                        <div class="card-body">
                            <form id="email_settings" method="POST">
                            <label>Server Type</label>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" name="smtp_or_mail" id="smtp_or_mail-enabled" value="smtp" <?php echo ($site->get('smtp_or_mail') == 'smtp') ? 'checked': '';?>>
                                                <label for="smtp_or_mail-enabled" class="custom-control-label">SMTP Server</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" name="smtp_or_mail" id="smtp_or_mail-disabled" value="mail" <?php echo ($site->get('smtp_or_mail') == 'mail') ? 'checked': '';?>>
                                                <label for="smtp_or_mail-disabled" class="custom-control-label">Server Mail (Default)</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>SMTP Host</label>
                                    <input type="text" name="smtp_host" value="<?php echo $site->get('smtp_host'); ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>SMTP Username</label>
                                    <input type="text" name="smtp_username" value="<?php echo $site->get('smtp_username'); ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>SMTP Password</label>
                                    <input type="password" name="smtp_password" autocomplete="off" value="<?php echo $site->get('smtp_password'); ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>SMTP Port</label>
                                    <input type="text" name="smtp_port" value="<?php echo $site->get('smtp_port'); ?>" class="form-control">
                                </div>
                                <label>SMTP Encryption</label>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" name="smtp_encryption" id="smtp_encryption-enabled" value="tls" <?php echo ($site->get('smtp_encryption') == 'tls') ? 'checked': '';?>>
                                                <label for="smtp_encryption-enabled" class="custom-control-label">TLS</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" name="smtp_encryption" id="smtp_encryption-disabled" value="ssl" <?php echo ($site->get('smtp_encryption') == 'ssl') ? 'checked': '';?>>
                                                <label for="smtp_encryption-disabled" class="custom-control-label">SSL</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="token_id" value="<?php echo $token_id; ?>">
                                <div id="email_settings_alert"></div>
                                <div id="before_email_settings">
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
  $('#email_settings').on('submit', function(event){
    event.preventDefault();
    var form_data = $(this).serialize();
      $.ajax({
        url:"<?php echo $site->dir_ajax; ?>?a=admin&b=update_config",
        method:"POST",
        data:form_data,
        beforeSend: function(){
          $("#before_email_settings").html('<button type="button" class="btn btn-primary" disabled><span class="spinner-border spinner-border-sm pr-1" role="status" aria-hidden="true"></span>Save</button>');
        },
        success:function(data)
        {
          if(data.status == 'success'){
            $('#email_settings_alert').html('<div class="callout callout-success"><p>' + data.message + '</p></div>');
            $("#before_email_settings").html('<button type="submit" name="submit" class="btn btn-primary">Save</button>');
          }else{
            $('#email_settings_alert').html('<div class="callout callout-danger"><p>' + data.errors + '</p></div>');
            $("#before_email_settings").html('<button type="submit" name="submit" class="btn btn-primary">Save</button>');
          }
        }
      });
  });
});
</script>