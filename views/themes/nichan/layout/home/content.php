<?php

if (!defined("nichan")):
    exit();
endif;

?>

<div class="container">
    <div class="row mb-5 p-5" style="background-image: url('<?php echo $site->dir_theme; ?>/dist/img/background.png');">

        <div class="col-md-8 offset-md-2">
            <h3>Behind every review is an experience that matters.</h3>
            <h5>Read reviews. Write reviews. Find companies.</h5>
            <form id="search_companies_form" method="post">
                <div class="input-group typeahead-container">
                    <input type="text" name="query_companies" id="query_companies" class="form-control form-control-lg typeahead" placeholder="Company" data-provide="typeahead" autocomplete="off">
                    <div class="input-group-append" id="before_search_companies">
                        <button type="submit" name="submit" class="btn btn-lg btn-default">
                            <?php echo $lang->get('search'); ?>
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <!-- /.row -->

    <h4 class="pb-3">Explore categories</h4>
    <div class="row">

        <?php foreach ($main_categories->getExploreCategories(0, 3) as $category): ?>
        <a href="<?php echo $site->url.'/categories/'.Secure::escape($category->username); ?>" class="col-md-4">
            <!-- list -->
            <div class="card card-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header">
                <h5 class="widget-user-desc"><?php echo Secure::escape($category->english); ?></h5>
              </div>
            </div>
            <!-- /.list -->
        </a>
        <?php endforeach; ?>

    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Be heard</h3>
                </div>
                <div class="card-body">
                    <p>Trustpilot is free and open to every company and consumer everywhere. Sharing your experiences helps others make better choices and companies up their game.</p>
                    <button type="button" class="btn btn-primary">What we do</button>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">We protect and promote trust</h3>
                </div>
                <div class="card-body">
                    <p>Check out our Transparency Report to find out how we ensure our platform’s integrity.</p>
                    <button type="button" class="btn btn-primary">Take a look</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

</div><!-- /.container-fluid -->

<script>
$(document).ready(function(){

    $('#query_companies').typeahead({
     source: function(query, result)
     {
      $.ajax({
       url:"<?php echo $site->dir_ajax; ?>?a=search&b=view_search_companies",
       method:"POST",
       data:{query:query},
       dataType:"json",
       success:function(data)
       {
        result($.map(data, function(item){
         return item;
        }));
       }
      })
     }
    });

    $('#search_companies_form').on('submit', function(event){
    event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
          url:"<?php echo $site->dir_ajax; ?>?a=search&b=search_companies_home",
          method:"POST",
          data:form_data,
          beforeSend: function(){
            $("#before_search_companies").html('<button type="button" class="btn btn-lg btn-default" disabled><span class="spinner-border spinner-border-sm pr-1" role="status" aria-hidden="true"></span> <?php echo $lang->get('search'); ?></button>');
          },
          success:function(data)
          {
            if(data.status == 'success'){
              window.location.href = data.location;
            }else{
              $("#before_search_companies").html('<button type="submit" name="submit" class="btn btn-lg btn-default"><?php echo $lang->get('search'); ?></button>');
            }
          }
        });
    });

});
</script>

<script src="<?php echo $site->dir_theme; ?>/plugins/typeahead/typeahead.bundle.js"></script>