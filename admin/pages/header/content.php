<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin CP</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo $site->url; ?>/admin/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $site->url; ?>/admin/assets/dist/css/adminlte.min.css">
  <!-- jQuery -->
  <script src="<?php echo $site->url; ?>/admin/assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo $site->url; ?>/admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo $site->url; ?>/admin/assets/dist/js/adminlte.min.js"></script>
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo $site->url; ?>/admin/assets/plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo $site->url; ?>" class="brand-link">
      <img src="views/themes/nichan/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Nichan</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $site->dir_image.'/'.$user->data()->user_avatar; ?>" class="img-circle elevation-2" alt="<?php echo $user->data()->user_username; ?>">
        </div>
        <div class="info">
          <a href="<?php echo $site->dir_user; ?>/<?php echo $user->data()->user_username; ?>" class="d-block"><?php echo $user->data()->user_username; ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo $site->dir_admin; ?>" class="nav-link <?php if(empty(Input::get('page2'))): echo 'active'; endif; ?>">
              <i class="nav-icon fas fa-th"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item <?php if(Input::get('page2') == 'general-settings' || Input::get('page2') == 'site-settings' || Input::get('page2') == 'site-features' || Input::get('page2') == 'email-settings'): echo 'menu-open'; endif; ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $site->dir_admin; ?>/general-settings" class="nav-link <?php if(Input::get('page2') == 'general-settings'): echo 'active'; endif; ?>">
                  <p>General Settings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $site->dir_admin; ?>/site-settings" class="nav-link <?php if(Input::get('page2') == 'site-settings'): echo 'active'; endif; ?>">
                  <p>Site Settings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $site->dir_admin; ?>/site-features" class="nav-link <?php if(Input::get('page2') == 'site-features'): echo 'active'; endif; ?>">
                  <p>Manage Site Features</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $site->dir_admin; ?>/email-settings" class="nav-link <?php if(Input::get('page2') == 'email-settings'): echo 'active'; endif; ?>">
                  <p>E-mail & SMS Settings</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?php if(Input::get('page2') == 'add-language' || Input::get('page2') == 'manage-languages'): echo 'menu-open'; endif; ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-language"></i>
              <p>
                Languages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $site->dir_admin; ?>/add-language" class="nav-link <?php if(Input::get('page2') == 'add-language'): echo 'active'; endif; ?>">
                  <p>Add New Language & Keys</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $site->dir_admin; ?>/manage-languages" class="nav-link <?php if(Input::get('page2') == 'manage-languages'): echo 'active'; endif; ?>">
                  <p>Manage Languages</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?php if(Input::get('page2') == 'manage-users' || Input::get('page2') == 'online-users'): echo 'menu-open'; endif; ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $site->dir_admin; ?>/manage-users" class="nav-link <?php if(Input::get('page2') == 'manage-users'): echo 'active'; endif; ?>">
                  <p>Manage Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $site->dir_admin; ?>/online-users" class="nav-link <?php if(Input::get('page2') == 'online-users'): echo 'active'; endif; ?>">
                  <p>Online Users</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?php if(Input::get('page2') == 'manage-companies' || Input::get('page2') == 'manage-reviews'): echo 'menu-open'; endif; ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Manage Features
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $site->dir_admin; ?>/manage-companies" class="nav-link <?php if(Input::get('page2') == 'manage-companies'): echo 'active'; endif; ?>">
                  <p>Companies</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $site->dir_admin; ?>/manage-reviews" class="nav-link <?php if(Input::get('page2') == 'manage-reviews'): echo 'active'; endif; ?>">
                  <p>Reviews</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?php if(Input::get('page2') == 'manage-main-categories' || Input::get('page2') == 'manage-categories'): echo 'menu-open'; endif; ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tags"></i>
              <p>
                Categories
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $site->dir_admin; ?>/manage-main-categories" class="nav-link <?php if(Input::get('page2') == 'manage-main-categories'): echo 'active'; endif; ?>">
                  <p>Manage Main Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $site->dir_admin; ?>/manage-categories" class="nav-link <?php if(Input::get('page2') == 'manage-categories'): echo 'active'; endif; ?>">
                  <p>Manage Categories</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?php echo $site->dir_admin; ?>/manage-ads" class="nav-link <?php if(Input::get('page2') == 'manage-ads'): echo 'active'; endif; ?>">
              <i class="nav-icon fas fa-dollar-sign"></i>
              <p>Advertisement</p>
            </a>
          </li>
          <li class="nav-item <?php if(Input::get('page2') == 'manage-themes' || Input::get('page2') == 'manage-site-design'): echo 'menu-open'; endif; ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-palette"></i>
              <p>
                Design
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $site->dir_admin; ?>/manage-themes" class="nav-link <?php if(Input::get('page2') == 'manage-themes'): echo 'active'; endif; ?>">
                  <p>Themes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $site->dir_admin; ?>/manage-site-design" class="nav-link <?php if(Input::get('page2') == 'manage-site-design'): echo 'active'; endif; ?>">
                  <p>Change Site Design</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?php if(Input::get('page2') == 'generate-sitemap'): echo 'menu-open'; endif; ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tools"></i>
              <p>
                Tools
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $site->dir_admin; ?>/generate-sitemap" class="nav-link <?php if(Input::get('page2') == 'generate-sitemap'): echo 'active'; endif; ?>">
                  <p>Generate Sitemap</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?php if(Input::get('page2') == 'manage-custom-pages' || Input::get('page2') == 'edit-terms-pages'): echo 'menu-open'; endif; ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Pages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $site->dir_admin; ?>/manage-custom-pages" class="nav-link <?php if(Input::get('page2') == 'manage-custom-pages'): echo 'active'; endif; ?>">
                  <p>Manage Custom Pages</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $site->dir_admin; ?>/edit-terms-pages" class="nav-link <?php if(Input::get('page2') == 'edit-terms-pages'): echo 'active'; endif; ?>">
                  <p>Edit Terms Pages</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?php echo $site->dir_admin; ?>/manage-reports" class="nav-link <?php if(Input::get('page2') == 'manage-reports'): echo 'active'; endif; ?>">
              <i class="nav-icon fas fa-info"></i>
              <p>Reports</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo $site->dir_admin; ?>/manage-updates" class="nav-link <?php if(Input::get('page2') == 'manage-updates'): echo 'active'; endif; ?>">
              <i class="nav-icon fas fa-cloud"></i>
              <p>Updates</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo $site->dir_admin; ?>/changelogs" class="nav-link <?php if(Input::get('page2') == 'changelogs'): echo 'active'; endif; ?>">
              <i class="nav-icon fas fa-clock"></i>
              <p>Changelogs</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">