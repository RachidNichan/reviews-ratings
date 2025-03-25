<?php

if (!defined("nichan")):
    exit();
endif;

$pagination = new Pagination([
  'totalCount' => $review->countPostsInReview($data->id),
]);

?>

        <div class="col-md-8">

        <?php include './views/themes/nichan/layout/posts/publisher-box.php'; ?>

        <div id="load_data">
            <?php

            $get_posts = $review->getPostsInReview($data->id, $pagination->offset, $pagination->limit);
            if ($get_posts):
            foreach ($get_posts as $post_data):
                $user_post = new User($post_data->user_id);
                include './views/themes/nichan/layout/posts/content.php';
            endforeach;
            else:
            ?>
            <div class="empty_page">
                <i class="icon fas fa-info"></i>
                <h4><?php echo $lang->get('no_reviews_yet'); ?></h4>
            </div>
            <?php endif; ?>
        </div>

        <?php
        if ($get_posts):
            PaginationWidget::widget([
                'pagination' => $pagination,
                // 'view' => 'simple',
            ]);
        endif;
        ?>

        </div>

<script>
function deletePost(id) {
  $.ajax({
  url: "<?php echo $site->dir_ajax; ?>?a=post&b=delete",
  data: {id:id},
  type: "POST",
  beforeSend: function(){
    $('#before_delete_post_'+id).html('<button type="button" class="btn btn-default btn-sm" disabled><span class="spinner-border spinner-border-sm pr-1" role="status" aria-hidden="true"></span> <?php echo $lang->get('delete'); ?></button>');
  },
  success: function(data){
    $("#remove_delete_post_"+id).remove();
  }
  });
}
</script>

<script>
function helpful(id,action) {
  $.ajax({
  url: "<?php echo $site->dir_ajax; ?>?a=helpful&b=create",
  data: {id:id,action:action},
  type: "POST",
  beforeSend: function(){
    $('#switch_helpful_'+id).html('<button type="button" class="btn btn-default btn-sm" disabled><span class="spinner-border spinner-border-sm pr-1" role="status" aria-hidden="true"></span> <?php echo $lang->get('helpful'); ?></button>');
  },
  success: function(data){
  switch(action) {
    case 0:
    $('#switch_helpful_'+id).html('<button type="button" class="btn btn-primary btn-sm" onClick="helpful('+id+',1)"><i class="far fa-thumbs-up"></i> <?php echo $lang->get('helpful'); ?></button>');
    break;
    case 1:
    $('#switch_helpful_'+id).html('<button type="button" class="btn btn-default btn-sm"  onClick="helpful('+id+',0)"><i class="far fa-thumbs-up"></i> <?php echo $lang->get('helpful'); ?></button>');
    break;
  }
  }
  });
}
</script>