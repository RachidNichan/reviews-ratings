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
                            <div class="position-relative">
                                <img src="<?php echo $site->dir_image.'/'.Secure::escape($data->review_avatar); ?>" alt="<?php echo Secure::escape($data->review_name); ?>" class="img-fluid">
                            </div>

                        </div>

                        <div class="col-md-5">
                            <h1><?php echo Secure::escape($data->review_name); ?></h1>
                            <p><?php echo $lang->get('reviews'); ?> <?php echo $review->countPostsInReview($data->id); ?></p>

                            <select class="rating" data-current-rating="<?php echo $review->getRatingInReview($data->id); ?>" data-readonly="true">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>

                        </div>
                        <div class="col-md-4">
                            <a href="<?php echo Secure::escape($data->review_url); ?>" target="_blank">
                                <div class="border p-2">
                                    <h5><?php echo Secure::escape($data->review_username); ?></h5>
                                    <p><?php echo $lang->get('visit_this_website'); ?></p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- /.row -->

                </div>
            </div>
        </div>
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