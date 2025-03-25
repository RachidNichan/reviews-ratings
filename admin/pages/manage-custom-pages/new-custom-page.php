    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Create New Custom Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $site->dir_admin; ?>">Home</a></li>
              <li class="breadcrumb-item active">Create New Custom Page</li>
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
                    <h3 class="card-title">Create New Custom Page</h3>
                  </div>
                  <div class="card-body">
                        <form id="site_settings" method="POST">
                            <div class="form-group">
                                <label>Page Name <small><?php echo $site->url; ?>/page/PAGE_NAME</small></label>
                                <input type="text" name="page_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Page Title <small>The page title that will show in the footer</small></label>
                                <input type="text" name="page_title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Page Content <small>The page content (HTML allowed)</small></label>
                                <textarea name="page_content" class="form-control" rows="5"></textarea>
                            </div>
                            <input type="hidden" name="token_id" value="<?php echo $token_id; ?>">
                            <div id="alert_settings"></div>
                            <div id="before_settings">
                                <button type="submit" name="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
        </div>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

<script>
$(document).ready(function(){
  $('#site_settings').on('submit', function(event){
    event.preventDefault();
    var form_data = $(this).serialize();
      $.ajax({
        url:"<?php echo $site->dir_ajax; ?>?a=admin&b=add_new_page",
        method:"POST",
        data:form_data,
        beforeSend: function(){
          $("#before_settings").html('<button type="button" class="btn btn-primary" disabled><span class="spinner-border spinner-border-sm pr-1" role="status" aria-hidden="true"></span>Create</button>');
        },
        success:function(data)
        {
          if(data.status == 'success'){
            $('#alert_settings').html('<div class="callout callout-success"><p>' + data.message + '</p></div>');
            window.location.href = data.location;
          }else{
            $('#alert_settings').html('<div class="callout callout-danger"><p>' + data.errors + '</p></div>');
            $("#before_settings").html('<button type="submit" name="submit" class="btn btn-primary">Create</button>');
          }
        }
      });
  });
});
</script>