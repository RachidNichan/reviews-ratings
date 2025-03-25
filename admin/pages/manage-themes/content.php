    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Themes</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $site->dir_admin; ?>">Home</a></li>
              <li class="breadcrumb-item active">Themes</li>
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

        <?php
        foreach ($admin->getThemes() as $theme_url):
            if (file_exists($theme_url . '/info.php')):
                include($theme_url . '/info.php');
                $theme = str_replace('views/themes/', '', $theme_url);
        ?>

            <div class="col-md-6">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                    <li class="item">
                        <div class="product-img">
                          <img src="http://localhost/nichanme/upload/images/GrmQvdYF8cRyZcS2q313_user_avatar.png" style="height: 105px; width: 105px;" alt="Nichan" class="img-size-50">
                        </div>
                        <div class="product-info" style="margin-left: 120px;">
                          <a href="#" class="product-title">
                              <?php echo $themeName; ?>
                          </a>
                          <span class="product-description">
                              <p>Author: <?php echo $themeAuthor; ?></p>
                              <button type="submit" name="submit" class="btn btn-primary" disabled>Activated</button>
                          </span>
                        </div>
                    </li>
                    <!-- /.item -->
                </ul>
            </div>

        <?php
            endif;
        endforeach;
        ?>
        
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->