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
                
                <form id="data_form" class="form-horizontal" method="post">
                    <div class="card-body">
                    <input type="hidden" name="id" value="<?php echo $review->data()->id; ?>">
                        <div class="form-group">
                          <label><?php echo $lang->get('category'); ?></label>

                          <?php $categories = new Categories(); ?>

                          <select class="form-control select2" name="review_category" style="width: 100%;">

                          <?php foreach ($categories->getCategories() as $category_data): ?>

                              <option value="<?php echo $category_data->id; ?>"><?php echo Secure::escape($category_data->english); ?></option>

                          <?php endforeach; ?>

                          </select>
                        </div>
                        <div class="form-group">
                          <label><?php echo $lang->get('description'); ?></label>
                          <textarea name="review_description" class="form-control" rows="4"></textarea>
                        </div>
                        <div id="form_alert"></div>
                    </div>
                    <input type="hidden" name="token_id" value="<?php echo Token::generate(); ?>">
                    <div class="card-footer" id="before_send">
                      <a href="<?php echo $site->get('url').'/review/'.Secure::escape($review->data()->review_username); ?>" class="btn btn-default mr-2"><?php echo $lang->get('skip'); ?></a>
                      <button type="submit" name="submit" class="btn btn-primary"><?php echo $lang->get('save'); ?></button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->

<!-- Select2 -->
<script src="<?php echo $site->dir_theme; ?>/plugins/select2/js/select2.full.min.js"></script>

<script>
$(document).ready(function(){

  $('.select2').select2();

  $('#data_form').on('submit', function(event){
    event.preventDefault();
      var form_data = $(this).serialize();
      $.ajax({
        url:"<?php echo $site->dir_ajax; ?>?a=review&b=step_2",
        method:"POST",
        data:form_data,
        beforeSend: function(){
          $("#before_send").html('<button type="button" class="btn btn-primary" disabled><span class="spinner-border spinner-border-sm pr-1" role="status" aria-hidden="true"></span><?php echo $lang->get('save'); ?></button>');
        },
        success:function(data)
        {
          if(data.status == 'success'){
            window.location.href = data.location;
          }else{
            $('#form_alert').html('<div class="callout callout-danger"><p>' + data.errors + '</p></div>');
            $("#before_send").html('<button type="submit" name="submit" class="btn btn-primary"><?php echo $lang->get('save'); ?></button>');
          }
        }
      });
  });

});
</script>