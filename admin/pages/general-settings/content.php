    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">General Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $site->dir_admin; ?>">Home</a></li>
              <li class="breadcrumb-item active">General Settings</li>
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
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">User Settings</h3>
                        </div>
                        <div class="card-body">
                            <form id="user_settings" method="POST">
                                <label>User Registration</label>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" name="user_registration" id="user_registration-enabled" value="1" <?php echo ($site->get('user_registration') == 1) ? 'checked': '';?>>
                                                <label for="user_registration-enabled" class="custom-control-label">Enabled</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" name="user_registration" id="user_registration-disabled" value="0" <?php echo ($site->get('user_registration') == 0) ? 'checked': '';?>>
                                                <label for="user_registration-disabled" class="custom-control-label">Disabled</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <label>Account Validation</label>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" name="email_validation" id="email_validation-enabled" value="1" <?php echo ($site->get('email_validation') == 1) ? 'checked': '';?>>
                                                <label for="email_validation-enabled" class="custom-control-label">Enabled</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" name="email_validation" id="email_validation-disabled" value="0" <?php echo ($site->get('email_validation') == 0) ? 'checked': '';?>>
                                                <label for="email_validation-disabled" class="custom-control-label">Disabled</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <label>User Account Delation</label>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" name="delete_account" id="delete_account-enabled" value="1" <?php echo ($site->get('delete_account') == 1) ? 'checked': '';?>>
                                                <label for="delete_account-enabled" class="custom-control-label">Enabled</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" name="delete_account" id="delete_account-disabled" value="0" <?php echo ($site->get('delete_account') == 0) ? 'checked': '';?>>
                                                <label for="delete_account-disabled" class="custom-control-label">Disabled</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="token_id" value="<?php echo $token_id; ?>">
                                <div id="user_settings_alert"></div>
                                <div id="before_user_settings">
                                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

<script>
$(document).ready(function(){
  $('#user_settings').on('submit', function(event){
    event.preventDefault();
    var form_data = $(this).serialize();
      $.ajax({
        url:"<?php echo $site->dir_ajax; ?>?a=admin&b=update_config",
        method:"POST",
        data:form_data,
        beforeSend: function(){
          $("#before_user_settings").html('<button type="button" class="btn btn-primary" disabled><span class="spinner-border spinner-border-sm pr-1" role="status" aria-hidden="true"></span>Save</button>');
        },
        success:function(data)
        {
          if(data.status == 'success'){
            $('#user_settings_alert').html('<div class="callout callout-success"><p>' + data.message + '</p></div>');
            $("#before_user_settings").html('<button type="submit" name="submit" class="btn btn-primary">Save</button>');
          }else{
            $('#user_settings_alert').html('<div class="callout callout-danger"><p>' + data.errors + '</p></div>');
            $("#before_user_settings").html('<button type="submit" name="submit" class="btn btn-primary">Save</button>');
          }
        }
      });
  });
});
</script>