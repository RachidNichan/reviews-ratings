<?php

if (!defined("nichan")):
    exit();
endif;

?>

<div class="container">
    <div class="row">
        
        <div class="col-md-3">

                  <!-- list -->
                  <div class="card card-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header">
                      <h5><?php echo $categories->mainCategoriesTable($data->category_main_id, 'english'); ?></h5>
                    </div>
                    <div class="card-footer p-0">
                      <ul class="nav flex-column">

                        <?php foreach ($categories->getCategoriesSidebar($data->category_main_id) as $category_data): ?>
                        <li class="nav-item">
                          <a href="<?php echo $site->url.'/categories/'.$category_data->username; ?>" class="nav-link <?php if ($category_data->id === $categories->data()->id): ?> bg-green <?php endif; ?>">
                            <?php echo $category_data->english; ?> <span class="float-right badge bg-primary"><?php echo $categories->countReviewInCategories($category_data->id); ?></span>
                          </a>
                        </li>
                        <?php endforeach; ?>

                      </ul>
                    </div>
                  </div>
                  <!-- /.list -->

        </div>
        <div class="col-md-9">

            <div class="card">
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">

                    <?php
                    $all_review_in_categories = $categories->getReviewInCategories($data->id, $pagination->offset, $pagination->limit);
                    if ($all_review_in_categories):
                    foreach ($all_review_in_categories as $review_data): ?>
                        <li class="item">
                          <div class="product-img">
                          <a href="<?php echo $site->url.'/review/'.Secure::escape($review_data->review_username); ?>" class="product-title">
                            <img src="<?php echo $site->dir_image.'/'.Secure::escape($review_data->review_avatar); ?>" alt="<?php echo Secure::escape($review_data->review_name); ?>" class="img-size-50">
                          </a>
                          </div>
                          <div class="product-info">
                            <a href="<?php echo $site->url.'/review/'.Secure::escape($review_data->review_username); ?>" class="product-title">
                                <?php echo $review_data->review_name; ?>
                            </a>
                            <span class="product-description">
                                <select class="rating" data-current-rating="<?php echo $categories->getRatingInReview($review_data->id); ?>" data-readonly="true">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                ·
                                <?php echo $categories->countPostsInReview($review_data->id); ?> <?php echo $lang->get('reviews'); ?>
                            </span>
                          </div>
                        </li>
                        <!-- /.item -->
                    <?php
                    endforeach;
                    endif;
                    ?>

                    </ul>
                </div>
            </div>

                    <?php
                    if ($all_review_in_categories):
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