<?php

if (!defined("nichan")):
    exit();
endif;

?>

<div class="container">
    <div class="row">
        
        <div class="col-md-12">
          <div class="row">

          <?php foreach ($categories->getMainCategories() as $category): ?>
              
              <div class="col-md-4">
                  <!-- list -->
                  <div class="card card-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header">
                      <h5 class="widget-user-desc"><?php echo Secure::escape($category->english); ?></h5>
                    </div>
                    <div class="card-footer p-0">
                      <ul class="nav flex-column">

                        <?php
                        $all_categories_row = $categories->getCategories($category->id);
                        if ($all_categories_row):
                        foreach ($all_categories_row as $category_data):
                        ?>
                        <li class="nav-item">
                          <a href="<?php echo $site->url.'/categories/'.Secure::escape($category_data->username); ?>" class="nav-link">
                            <?php echo Secure::escape($category_data->english); ?> <span class="float-right badge bg-primary"><?php echo $categories->countReviewInCategories($category_data->id); ?></span>
                          </a>
                        </li>
                        <?php
                        endforeach;
                        endif;
                        ?>

                      </ul>
                    </div>
                  </div>
                  <!-- /.list -->
              </div>

          <?php endforeach; ?>
              
          </div>
        </div>

    </div>
</div>