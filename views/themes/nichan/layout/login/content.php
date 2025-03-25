<?php

if (!defined("nichan")):
  exit();
endif;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $site->get('site_title'); ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $site->dir_theme; ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo $site->dir_theme; ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $site->dir_theme; ?>/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1">Nichan</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg"><?php echo $lang->get('login'); ?></p>

      <form id="login_form" method="post">
        <div class="input-group mb-3">
          <input type="email" name="user_email" class="form-control" autocomplete="off" placeholder="<?php echo $lang->get('email'); ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="user_password" class="form-control" autocomplete="off" placeholder="<?php echo $lang->get('password'); ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div id="form_alert"></div>

        <div class="row">
          <input type="hidden" name="token_id" value="<?php echo Token::generate(); ?>">

          <div class="col-4" id="before_send">
            <button type="submit" name="submit" class="btn btn-primary btn-block"><?php echo $lang->get('login'); ?></button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-2 mb-1">
        <a href="<?php echo $site->url.'/forgot-password'; ?>"><?php echo $lang->get('forget_password'); ?></a>
      </p>
      <p class="mt-2"><?php echo $lang->get('dont_have_account'); ?> <a href="<?php echo $site->get('url').'/register'; ?>" class="text-center"><?php echo $lang->get('register'); ?></a></p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo $site->dir_theme; ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo $site->dir_theme; ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $site->dir_theme; ?>/dist/js/adminlte.min.js"></script>

<script>
$(document).ready(function(){
  $('#login_form').on('submit', function(event){
    event.preventDefault();
      var form_data = $(this).serialize();
      $.ajax({
        url:"<?php echo $site->dir_ajax; ?>?a=user&b=login",
        method:"POST",
        data:form_data,
        beforeSend: function(){
          $("#before_send").html('<button type="button" class="btn btn-primary btn-block" disabled><span class="spinner-border spinner-border-sm pr-1" role="status" aria-hidden="true"></span><?php echo $lang->get('login'); ?></button>');
        },
        success:function(data)
        {
          if(data.status == 'success'){
            $('#form_alert').html('<div class="callout callout-success"><p>' + data.message + '</p></div>');
            window.location.href = data.location;
          }else{
            $('#form_alert').html('<div class="callout callout-danger"><p>' + data.errors + '</p></div>');
            $("#before_send").html('<button type="submit" name="submit" class="btn btn-primary btn-block"><?php echo $lang->get('login'); ?></button>');
          }
        }
      });
  });
});
</script>

</body>
</html>