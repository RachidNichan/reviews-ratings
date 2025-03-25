<?php

if (!defined("nichan")):
    exit();
endif;

?>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?php echo $lang->get('about'); ?></h3>
                </div>
                <div class="card-body">
                    <p><?php echo Secure::escape($data->review_description); ?></p>
                </div>
            </div>
        </div>