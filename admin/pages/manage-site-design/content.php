    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Change Site Design</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $site->dir_admin; ?>">Home</a></li>
              <li class="breadcrumb-item active">Change Site Design</li>
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
                <!-- Default box -->
                <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Change Site Design</h3>
                      </div>
                      <div class="card-body">
                          <form id="design_settings" method="POST" enctype="multipart/form-data">
                              <div class="form-group">
                                <label for="favicon">Favicon</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                      <input type="file" name="favicon" id="favicon" class="custom-file-input" accept="image/x-png, image/jpeg, image/jpg">
                                      <label class="custom-file-label" for="favicon">Choose file</label>
                                  </div>
                                  <div class="input-group-append">
                                      <span class="input-group-text">Upload</span>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="logo">Logo</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                      <input type="file" name="logo" id="logo" class="custom-file-input" accept="image/x-png, image/jpeg, image/jpg">
                                      <label class="custom-file-label" for="logo">Choose file</label>
                                  </div>
                                  <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                  </div>
                                </div>
                              </div>
                              <input type="hidden" name="token_id" value="<?php echo $token_id; ?>">
                              <div id="design_settings_alert"></div>
                              <div id="before_design_settings">
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
  $('#design_settings').on('submit', function(event){
    event.preventDefault();
      $.ajax({
        url:"<?php echo $site->dir_ajax; ?>?a=admin&b=update_config",
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function(){
          $("#before_design_settings").html('<button type="button" class="btn btn-primary" disabled><span class="spinner-border spinner-border-sm pr-1" role="status" aria-hidden="true"></span>Save</button>');
        },
        success:function(data)
        {
          if(data.status == 'success'){
            $('#design_settings_alert').html('<div class="callout callout-success"><p>' + data.message + '</p></div>');
            $("#before_design_settings").html('<button type="submit" name="submit" class="btn btn-primary">Save</button>');
          }else{
            $('#design_settings_alert').html('<div class="callout callout-danger"><p>' + data.errors + '</p></div>');
            $("#before_design_settings").html('<button type="submit" name="submit" class="btn btn-primary">Save</button>');
          }
        }
      });
  });
});
</script>