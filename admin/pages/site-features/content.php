    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Features</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $site->dir_admin; ?>">Home</a></li>
              <li class="breadcrumb-item active">Manage Features</li>
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
                            <h3 class="card-title">Site Features</h3>
                        </div>
                        <div class="card-body">
                            <form id="site_settings" method="POST">
                                <label>Companies System</label>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" name="companies" id="companies-enabled" value="1" <?php echo ($site->get('companies') == 1) ? 'checked': '';?>>
                                                <label for="companies-enabled" class="custom-control-label">Enabled</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" name="companies" id="companies-disabled" value="0" <?php echo ($site->get('companies') == 0) ? 'checked': '';?>>
                                                <label for="companies-disabled" class="custom-control-label">Disabled</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <label>Reviews System</label>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" name="reviews" id="reviews-enabled" value="1" <?php echo ($site->get('reviews') == 1) ? 'checked': '';?>>
                                                <label for="reviews-enabled" class="custom-control-label">Enabled</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" name="reviews" id="reviews-disabled" value="0" <?php echo ($site->get('reviews') == 0) ? 'checked': '';?>>
                                                <label for="reviews-disabled" class="custom-control-label">Disabled</label>
                                            </div>
                                        </div>
                                    </div>
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