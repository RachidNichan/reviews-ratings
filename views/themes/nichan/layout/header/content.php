<?php

if (!defined("nichan")):
    exit();
endif;

?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $site->get('site_title'); ?></title>
  <meta name="description" content="<?php echo $site->get('site_description'); ?>" />
  <meta name="keywords" content="<?php echo $site->get('site_keywords'); ?>" />

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo $site->dir_theme; ?>/plugins/fontawesome-free/css/all.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo $site->dir_theme; ?>/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo $site->dir_theme; ?>/plugins/jquery-barrating/bootstrap-stars.css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $site->dir_theme; ?>/dist/css/adminlte.css">
  <!-- jQuery -->
  <script src="<?php echo $site->dir_theme; ?>/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo $site->dir_theme; ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo $site->dir_theme; ?>/dist/js/adminlte.min.js"></script>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="<?php echo $site->url; ?>" class="navbar-brand">
        <span class="brand-text font-weight-light"><?php echo $site->get('site_name'); ?></span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <?php if ($site->get('companies') == 1): ?>
          <li class="nav-item">
            <a href="<?php echo $site->url; ?>/categories" class="nav-link"><?php echo $lang->get('categories'); ?></a>
          </li>
          <?php endif; ?>
        </ul>

        <!-- SEARCH FORM -->
        <form id="search_form" class="form-inline ml-0 ml-md-3" method="post">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" name="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append" id="before_search">
              <button class="btn btn-navbar" type="submit" name="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

        <?php if ($user->isLoggedIn()): ?>
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $site->dir_image.'/'.Secure::escape($user->data()->user_avatar); ?>" class="user-image img-circle elevation-2" alt="<?php echo Secure::escape($user->data()->user_username); ?>">
              <span class="d-none d-md-inline"><?php echo Secure::escape($user->data()->user_username); ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a class="dropdown-item" href="<?php echo $site->dir_user; ?>/<?php echo Secure::escape($user->data()->user_username); ?>"><?php echo $lang->get('profile'); ?></a>
                <a class="dropdown-item" href="<?php echo $site->url; ?>/settings"><?php echo $lang->get('settings'); ?></a>
                <?php if ($site->get('companies') == 1): ?><a class="dropdown-item" href="<?php echo $site->url; ?>/create-review"><?php echo $lang->get('add_company'); ?></a><?php endif; ?>
                <?php if ($user->data()->admin == 1): ?><a class="dropdown-item" href="<?php echo $site->dir_admin; ?>"><?php echo $lang->get('admin-area'); ?></a><?php endif; ?>
                <a class="dropdown-item" href="<?php echo $site->url; ?>/logout"><?php echo $lang->get('logout'); ?></a>
            </ul>
        </li>
        <?php else: ?>
          <a href="<?php echo $site->url; ?>/login" class="btn btn-primary ml-3"><?php echo $lang->get('login'); ?></a>
          <a href="<?php echo $site->url; ?>/register" class="btn btn-primary ml-3"><?php echo $lang->get('register'); ?></a>
        <?php endif; ?>

      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Content Header (Page header) -->
    <div class="content-header"></div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">

<script>
$(document).ready(function(){
  $('#search_form').on('submit', function(event){
    event.preventDefault();
      var form_data = $(this).serialize();
      $.ajax({
        url:"<?php echo $site->dir_ajax; ?>?a=search&b=get_search",
        method:"POST",
        data:form_data,
        beforeSend: function(){
          $("#before_search").html('<button type="button" class="btn btn-navbar" disabled><span class="spinner-border spinner-border-sm pr-1" role="status" aria-hidden="true"></span><i class="fas fa-search"></i></button>');
        },
        success:function(data)
        {
          if(data.status == 'success'){
            window.location.href = data.location;
            $("#before_search").html('<button type="submit" name="submit" class="btn btn-navbar"><i class="fas fa-search"></i></button>');
          }
        }
      });
  });
});
</script>