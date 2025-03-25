<?php

if (!defined("nichan")):
    exit();
endif;

$custom_page = new CustomPage();

?>

</div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      1.0
    </div>
    <!-- Default to the left -->
    
        <?php 
					$copy = str_replace('{site_name}', $site->get('site_name'), $lang->get('copyrights'));
					echo $copy = str_replace('{date}', date('Y'), $copy);
				?>

    <div class="row">
        <a href="<?php echo $site->url; ?>/terms/about-us"><?php echo $lang->get('about'); ?></a>  ·  
        <a href="<?php echo $site->url; ?>/terms/privacy-policy"><?php echo $lang->get('privacy_policy'); ?></a>  ·  
        <a href="<?php echo $site->url; ?>/terms/terms-of-use"><?php echo $lang->get('terms_of_use'); ?></a>  ·  
        <?php
            $all_custom_pages = $custom_page->getCustomPages();
            if ($all_custom_pages):
            foreach ($all_custom_pages as $custom_pages_data):
        ?>
        <a href="<?php echo $site->url; ?>/page/<?php echo Secure::escape($custom_pages_data->page_name); ?>"><?php echo Secure::escape($custom_pages_data->page_title); ?></a>  ·  
        <?php
            endforeach;
            endif;
        ?>
    </div>

  </footer>
  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

</body>
</html>