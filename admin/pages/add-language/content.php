    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add New Language & Key</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $site->dir_admin; ?>">Home</a></li>
              <li class="breadcrumb-item active">Add New Language & Key</li>
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
                            <h3 class="card-title">Add New Language</h3>
                        </div>
                        <div class="card-body">
                            <form id="add_new_language" method="POST">
                                <div class="form-group">
                                    <label>Language Name <small>Use only english letters, no spaces allowed. E.g: russian</small></label>
                                    <input type="text" name="lang" class="form-control">
                                </div>
                                <input type="hidden" name="token_id" value="<?php echo $token_id; ?>">
                                <div id="add_new_language_alert"></div>
                                <div id="before_add_new_language">
                                    <button type="submit" name="submit" class="btn btn-primary">Add Language</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add New Key</h3>
                        </div>
                        <div class="card-body">
                            <form id="add_new_key" method="POST">
                                <div class="form-group">
                                    <label>Key Name <small>Use only english letters, no spaces allowed, example: this_is_a_key</small></label>
                                    <input type="text" name="lang_key" class="form-control">
                                </div>
                                <input type="hidden" name="token_id" value="<?php echo $token_id; ?>">
                                <div id="add_new_key_alert"></div>
                                <div id="before_add_new_key">
                                    <button type="submit" name="submit" class="btn btn-primary">Add Key</button>
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
  $('#add_new_language').on('submit', function(event){
    event.preventDefault();
    var form_data = $(this).serialize();
      $.ajax({
        url:"<?php echo $site->dir_ajax; ?>?a=admin&b=add_new_language",
        method:"POST",
        data:form_data,
        beforeSend: function(){
          $("#before_add_new_language").html('<button type="button" class="btn btn-primary" disabled><span class="spinner-border spinner-border-sm pr-1" role="status" aria-hidden="true"></span>Add Language</button>');
        },
        success:function(data)
        {
          if(data.status == 'success'){
            $('#add_new_language_alert').html('<div class="callout callout-success"><p>' + data.message + '</p></div>');
            $("#before_add_new_language").html('<button type="submit" name="submit" class="btn btn-primary">Add Language</button>');
          }else{
            $('#add_new_language_alert').html('<div class="callout callout-danger"><p>' + data.errors + '</p></div>');
            $("#before_add_new_language").html('<button type="submit" name="submit" class="btn btn-primary">Add Language</button>');
          }
        }
      });
  });

  $('#add_new_key').on('submit', function(event){
    event.preventDefault();
    var form_data = $(this).serialize();
      $.ajax({
        url:"<?php echo $site->dir_ajax; ?>?a=admin&b=add_new_key",
        method:"POST",
        data:form_data,
        beforeSend: function(){
          $("#before_add_new_key").html('<button type="button" class="btn btn-primary" disabled><span class="spinner-border spinner-border-sm pr-1" role="status" aria-hidden="true"></span>Add Key</button>');
        },
        success:function(data)
        {
          if(data.status == 'success'){
            $('#add_new_key_alert').html('<div class="callout callout-success"><p>' + data.message + '</p></div>');
            $("#before_add_new_key").html('<button type="submit" name="submit" class="btn btn-primary">Add Key</button>');
          }else{
            $('#add_new_key_alert').html('<div class="callout callout-danger"><p>' + data.errors + '</p></div>');
            $("#before_add_new_key").html('<button type="submit" name="submit" class="btn btn-primary">Add Key</button>');
          }
        }
      });
  });

});
</script>