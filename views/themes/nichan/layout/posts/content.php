            <div class="card card-widget" id="remove_delete_post_<?php echo $post_data->id; ?>">
              <div class="card-header">
                <div class="user-block">
                  <a href="<?php echo $site->dir_user; ?>/<?php echo Secure::escape($user_post->data()->user_username); ?>">
                      <img class="img-circle" src="<?php echo $site->dir_image.'/'.Secure::escape($user_post->data()->user_avatar); ?>" alt="<?php echo Secure::escape($user_post->data()->user_username); ?>">
                  </a>
                  <span class="username"><a href="<?php echo $site->dir_user; ?>/<?php echo Secure::escape($user_post->data()->user_username); ?>"><?php echo Secure::escape($user_post->data()->user_username); ?></a></span>
                  <span class="description">
                      MA
                  </span>
                </div>
                <!-- /.user-block -->
                <div class="card-tools">
                    <div class="btn btn-tool">
                        <i class="fas fa-angle-left"></i>
                    </div>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <select class="rating" data-current-rating="<?php echo Secure::escape($post_data->rating); ?>" data-readonly="true">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>

                <p class="h5"><?php echo Secure::escape($post_data->post_content); ?></p>
                <hr>
                <?php if ($post_data->user_id == $user->data()->id): ?>
                    <div id="before_delete_post_<?php echo $post_data->id; ?>">
                        <button type="button" onClick="deletePost(<?php echo $post_data->id; ?>);" class="btn btn-default btn-sm"><i class="fas fa-trash"></i> <?php echo $lang->get('delete'); ?></button>
                    </div>
                <?php else: ?>
                    <div id="switch_helpful_<?php echo $post_data->id; ?>">
                        <button type="button" onClick="helpful(<?php echo $post_data->id; ?>,<?php echo $review->isHelpful($post_data->id); ?>);" class="btn <?php if ($review->isHelpful($post_data->id) == 1): ?> btn-primary <?php else: ?> btn-default <?php endif; ?> btn-sm"><i class="far fa-thumbs-up"></i> <?php echo $lang->get('helpful'); ?></button>
                    </div>
                <?php endif; ?>
              </div>
              <!-- /.card-body -->
            </div>

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