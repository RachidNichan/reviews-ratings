    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Companies</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $site->dir_admin; ?>">Home</a></li>
              <li class="breadcrumb-item active">Companies</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Manage & Edit Companies</h3>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 5%">
                          ID
                      </th>
                      <th style="width: 10%">
                          NAME
                      </th>
                      <th style="width: 10%">
                          OWNER
                      </th>
                      <th style="width: 20%">
                          CATEGORY
                      </th>
                      <th style="width: 20%">
                      </th>
                  </tr>
              </thead>
              <tbody>

                <?php
                    $pagination = new Pagination([
                        'totalCount' => $admin->countAllData('nr_review'),
                    ]);

                    $all_data = $admin->reviewData($pagination->offset, $pagination->limit);
                    if ($all_data):
                    foreach ($all_data as $reviewlist):
                        $user_review = new User($reviewlist->review_user_id);
                        $user_category = new Review($reviewlist->review_category);
                ?>
 
                  <tr id="id_data_<?php echo Secure::escape($reviewlist->id); ?>">
                      <td>
                          <?php echo Secure::escape($reviewlist->id); ?>
                      </td>
                      <td>
                          <?php echo Secure::escape($reviewlist->review_name); ?>
                      </td>
                      <td>
                          <?php echo Secure::escape($user_review->data()->user_username); ?>
                      </td>
                      <td>
                          <?php echo Secure::escape($reviewlist->review_category); ?>
                      </td>
                      <td class="project-actions text-right">
                          <div class="d-inline" id="load_delete_admin_<?php echo Secure::escape($reviewlist->id); ?>">
                            <button type="button" class="btn btn-danger btn-sm" onClick="deleteData(<?php echo Secure::escape($reviewlist->id); ?>);">
                                Delete
                            </button>
                          </div>
                      </td>
                  </tr>
                  
                    <?php
                        endforeach;
                        endif;
                    ?>

              </tbody>
          </table>

            <?php
                if ($all_data):
                    PaginationWidget::widget([
                        'pagination' => $pagination,
                        // 'view' => 'simple',
                    ]);
                endif;
            ?>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

<script>
function deleteData(id) {
    $.ajax({
        url: "<?php echo $site->dir_ajax; ?>?a=admin&b=delete",
        data: {id:id,action:"nr_review"},
        type: "POST",
        beforeSend: function(){
            $("#load_delete_admin_"+id).html('<button type="button" class="btn btn-danger btn-sm" disabled><span class="spinner-border spinner-border-sm pr-1" role="status" aria-hidden="true"></span> Delete</button>');
        },
        success: function(data) {
          if (data.status == 'success') {
            $("#id_data_"+id).remove();
          }
        }
    });
}
</script>