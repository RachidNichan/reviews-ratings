    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Site Advertisements</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $site->dir_admin; ?>">Home</a></li>
              <li class="breadcrumb-item active">Manage Site Advertisements</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      <!-- Default box -->
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Manage Site Advertisements</h3>
              </div>
              <div class="card-body">
                  <form id="ads_settings" method="POST">
                      <div class="form-group">
                          <label>Header</label>
                          <textarea name="header" class="form-control" rows="3"></textarea>
                      </div>
                      <div class="form-group">
                          <label>Sidebar</label>
                          <textarea name="sidebar" class="form-control" rows="3"></textarea>
                      </div>
                      <div class="form-group">
                          <label>Footer</label>
                          <textarea name="footer" class="form-control" rows="3"></textarea>
                      </div>
                      <input type="hidden" name="token_id" value="<?php echo Token::generate(); ?>">
                      <div id="ads_settings_alert"></div>
                      <div id="before_ads_settings">
                          <button type="submit" name="submit" class="btn btn-primary">Save</button>
                      </div>
                  </form> 
              </div>
          </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

<script>
$(document).ready(function(){
  $('#ads_settings').on('submit', function(event){
    event.preventDefault();
    var form_data = $(this).serialize();
      $.ajax({
        url:"<?php echo $site->dir_ajax; ?>?a=admin&b=ads_settings",
        method:"POST",
        data:form_data,
        beforeSend: function(){
          $("#before_ads_settings").html('<button type="button" class="btn btn-primary" disabled><span class="spinner-border spinner-border-sm pr-1" role="status" aria-hidden="true"></span>Save</button>');
        },
        success:function(data)
        {
          if(data.status == 'success'){
            $('#ads_settings_alert').html('<div class="callout callout-success"><p>' + data.message + '</p></div>');
            $("#before_ads_settings").html('<button type="submit" name="submit" class="btn btn-primary">Save</button>');
          }else{
            $('#ads_settings_alert').html('<div class="callout callout-danger"><p>' + data.errors + '</p></div>');
            $("#before_ads_settings").html('<button type="submit" name="submit" class="btn btn-primary">Save</button>');
          }
        }
      });
  });
});
</script>