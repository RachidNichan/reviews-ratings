<?php
    $terms = new Terms();
?>
    
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Terms Pages</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $site->dir_admin; ?>">Home</a></li>
              <li class="breadcrumb-item active">Edit Terms Pages</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      <form id="terms_pages_settings" method="POST">
      <div class="card">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">
                  <h3 class="card-title">
                    Terms of Use (HTML Allowed)
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <textarea id="terms-of-use" name="terms-of-use"><?php echo $terms->get('terms-of-use'); ?></textarea>
                </div>
            </div>
            <!-- /.col-->

            <div class="col-md-12">
                <div class="card-header">
                  <h3 class="card-title">
                    Privacy Policy (HTML Allowed)
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <textarea id="privacy-policy" name="privacy-policy"><?php echo $terms->get('privacy-policy'); ?></textarea>
                </div>
            </div>
            <!-- /.col-->

            <div class="col-md-12">
                <div class="card-header">
                  <h3 class="card-title">
                    About (HTML Allowed)
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <textarea id="about-us" name="about-us"><?php echo $terms->get('about-us'); ?></textarea>
                  <input type="hidden" name="token_id" value="<?php echo Token::generate(); ?>">
                  <div id="terms_setting_alert"></div>
                  <div id="before_terms_setting">
                      <button type="submit" name="submit" class="btn btn-primary">Save</button>
                  </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
        <!-- /.row -->
        </div>
        </form>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

<!-- Summernote -->
<script src="<?php echo $site->url; ?>/admin/assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    // Terms of Use
    $('#terms-of-use').summernote({
        minHeight: 300
    })

    // Privacy Policy
    $('#privacy-policy').summernote({
        minHeight: 300
    })

    // About
    $('#about-us').summernote({
        minHeight: 300
    })
  })
</script>

<script>
$(document).ready(function(){
  $('#terms_pages_settings').on('submit', function(event){
    event.preventDefault();
    var form_data = $(this).serialize();
      $.ajax({
        url:"<?php echo $site->dir_ajax; ?>?a=admin&b=update_terms_setting",
        method:"POST",
        data:form_data,
        beforeSend: function(){
          $("#before_terms_setting").html('<button type="button" class="btn btn-primary" disabled><span class="spinner-border spinner-border-sm pr-1" role="status" aria-hidden="true"></span>Save</button>');
        },
        success:function(data)
        {
          if(data.status == 'success'){
            $('#terms_setting_alert').html('<div class="callout callout-success"><p>' + data.message + '</p></div>');
            $("#before_terms_setting").html('<button type="submit" name="submit" class="btn btn-primary">Save</button>');
          }else{
            $('#terms_setting_alert').html('<div class="callout callout-danger"><p>' + data.errors + '</p></div>');
            $("#before_terms_setting").html('<button type="submit" name="submit" class="btn btn-primary">Save</button>');
          }
        }
      });
  });
});
</script>