<?php

if (!defined("nichan")):
    exit();
endif;

?>

<div class="container">
    <div class="row">
        
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <div class="card">
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">

                    <?php
                    if ($all_search):
                    foreach ($all_search as $search_data): ?>
                        <li class="item">
                          <div class="product-img">
                          <a href="<?php echo $site->url.'/review/'.Secure::escape($search_data->review_username); ?>" class="product-title">
                            <img src="<?php echo $site->dir_image.'/'.Secure::escape($search_data->review_avatar); ?>" alt="<?php echo Secure::escape($search_data->review_name); ?>" class="img-size-50">
                          </a>
                          </div>
                          <div class="product-info">
                            <a href="<?php echo $site->url.'/review/'.Secure::escape($search_data->review_username); ?>" class="product-title">
                                <?php echo Secure::escape($search_data->review_name); ?>
                            </a>
                            <span class="product-description">
                                <select class="rating" data-current-rating="<?php echo $review->getRatingInReview($search_data->id); ?>" data-readonly="true">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                ·
                                <?php echo $review->countPostsInReview($search_data->id); ?> <?php echo $lang->get('reviews'); ?>
                            </span>
                          </div>
                        </li>
                        <!-- /.item -->
                    <?php
                    endforeach;
                    else:
                    ?>
                        <div class="empty_page">
                            <i class="icon fas fa-info"></i>
                            <h4><?php echo $lang->get('no_result_to_show'); ?></h4>
                        </div>
                    <?php endif; ?>

                    </ul>
                </div>
            </div>

                    <?php
                    if ($all_search):
                        PaginationWidget::widget([
                            'pagination' => $pagination,
                            // 'view' => 'simple',
                        ]);
                    endif;
                    ?>

        </div>
        <div class="col-md-3"></div>

    </div>
</div>

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