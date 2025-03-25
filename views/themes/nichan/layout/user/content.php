<?php

if (!defined("nichan")):
    exit();
endif;

?>

<div class="container">
    <div class="row">

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-3">
                    <!-- Profile Image -->
                    
                      <div class="box-profile">
                        <div class="text-center">
                          <img class="profile-user-img img-fluid img-circle"
                               src="<?php echo $site->dir_image.'/'.Secure::escape($data->user_avatar); ?>"
                               alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center"><?php echo Secure::escape($data->user_username); ?></h3>
                      </div>
                      <!-- /.card-body -->
                
                    </div>

                    <div class="col-md-3"></div>

                    <div class="col-md-6 text-center">
                        <div class="row">
                            <div class="col-md-3">
                                <h3><?php echo $posts->countPostsInUser($data->id); ?></h3>
                                <p><?php echo $lang->get('reviews'); ?></p>
                            </div>
                            <div class="col-md-3">
                                <h3><?php echo $posts->countHelpfulInUser($data->id); ?></h3>
                                <p><?php echo $lang->get('helpful'); ?></p>
                            </div>
                        </div>
                    </div>

                  </div>
              </div>
        </div>
    </div>
    <!-- /.col -->

    </div>
    <!-- /.row -->

    <div class="row">

        <?php
            include 'reviews.php';
            include 'sidebar.php';
        ?>

    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->

<script src="<?php echo $site->dir_theme; ?>/plugins/jquery-barrating/jquery.barrating.min.js"></script>

<script>
  (function ($) {
    if ($().barrating) {
      $(".rating").each(function () {
        var current = $(this).data("currentRating");
        var readonly = $(this).data("readonly");
        $(this).barrating({
          theme: "bootstrap-stars",
          initialRating: current,
          readonly: readonly
        });
      });
    }
  })(jQuery);
</script>