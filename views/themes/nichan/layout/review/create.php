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
                        <div class="form-group">
                          <label><?php echo $lang->get('review_name'); ?></label>
                          <input type="text" name="review_name" class="form-control">
                        </div>
                        <div class="form-group">
                          <label><?php echo $lang->get('website_url'); ?></label>
                          <input type="url" name="review_url" class="form-control">
                        </div>
                        <div id="form_alert"></div>
                    </div>
                    <input type="hidden" name="token_id" value="<?php echo Token::generate(); ?>">
                    <div class="card-footer" id="before_send">
                      <button type="submit" name="submit" class="btn btn-primary"><?php echo $lang->get('create'); ?></button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->

<script>
$(document).ready(function(){
  $('#data_form').on('submit', function(event){
    event.preventDefault();
      var form_data = $(this).serialize();
      $.ajax({
        url:"<?php echo $site->dir_ajax; ?>?a=review&b=create",
        method:"POST",
        data:form_data,
        beforeSend: function(){
          $("#before_send").html('<button type="button" class="btn btn-primary" disabled><span class="spinner-border spinner-border-sm pr-1" role="status" aria-hidden="true"></span><?php echo $lang->get('create'); ?></button>');
        },
        success:function(data)
        {
          if(data.status == 'success'){
            window.location.href = data.location;
          }else{
            $('#form_alert').html('<div class="callout callout-danger"><p>' + data.errors + '</p></div>');
            $("#before_send").html('<button type="submit" name="submit" class="btn btn-primary"><?php echo $lang->get('create'); ?></button>');
          }
        }
      });
  });
});
</script>