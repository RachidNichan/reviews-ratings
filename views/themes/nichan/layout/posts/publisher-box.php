<?php

if (!defined("nichan")):
    exit();
endif;

?>

    <div class="card">
        <form id="data_form" class="form-horizontal" method="post">
            <div class="card-body">

                <h4 class="text-center mt-2 mb-4">
	        		<i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
	        	</h4>

                <div class="form-group">
                    <label>Write a review</label>
                    <textarea name="post_content" id="post_content" autocomplete="off" class="form-control" rows="3"></textarea>
                </div>
            </div>
            <input type="hidden" name="review_id" id="review_id" value="<?php echo $data->id; ?>">
            <input type="hidden" name="token_id" id="token_id" value="<?php echo Token::generate(); ?>">
            <div class="card-footer" id="before_send">
                <button type="submit" name="submit" class="btn btn-primary"><?php echo $lang->get('share'); ?></button>
            </div>
        </form>
    </div>

<script>
$(document).ready(function(){

    var rating_data = 0;

    $(document).on('mouseenter', '.submit_star', function(){

        var rating = $(this).data('rating');

        reset_background();

        for(var count = 1; count <= rating; count++)
        {

            $('#submit_star_'+count).addClass('text-warning');

        }

    });

    function reset_background()
    {
        for(var count = 1; count <= 5; count++)
        {

            $('#submit_star_'+count).addClass('star-light');

            $('#submit_star_'+count).removeClass('text-warning');

        }
    }

    $(document).on('mouseleave', '.submit_star', function(){

        reset_background();

        for(var count = 1; count <= rating_data; count++)
        {

            $('#submit_star_'+count).removeClass('star-light');

            $('#submit_star_'+count).addClass('text-warning');
        }

    });

    $(document).on('click', '.submit_star', function(){

        rating_data = $(this).data('rating');

    });

    $('#data_form').on('submit', function(event){
      event.preventDefault();
        $.ajax({
          url:"<?php echo $site->dir_ajax; ?>?a=post&b=create",
          type: "POST",
          data:  {post_content:$("#post_content").val(), review_id:$("#review_id").val(), token_id:$("#token_id").val(), rating_data:rating_data},
          beforeSend: function(){
            $("#before_send").html('<button type="button" class="btn btn-primary" disabled><span class="spinner-border spinner-border-sm pr-1" role="status" aria-hidden="true"></span> <?php echo $lang->get('share'); ?></button>');
          },
          success:function(data)
          {
              $('#data_form')[0].reset();
              $('#form_alert').html('');
              $("#before_send").html('<button type="submit" name="submit" class="btn btn-primary"><?php echo $lang->get('share'); ?></button>');
              $('#load_data').prepend(data);
          }
        });
    });

});
</script>