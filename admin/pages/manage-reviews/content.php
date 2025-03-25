    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Reviews</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $site->dir_admin; ?>">Home</a></li>
              <li class="breadcrumb-item active">Reviews</li>
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
          <h3 class="card-title">Manage & Edit Reviews</h3>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 5%">
                          ID
                      </th>
                      <th style="width: 10%">
                          PUBLISHER
                      </th>
                      <th style="width: 10%">
                          POST LINK
                      </th>
                      <th style="width: 30%">
                          POSTED
                      </th>
                      <th style="width: 10%">
                          STATUS
                      </th>
                      <th style="width: 20%">
                      </th>
                  </tr>
              </thead>
              <tbody>

                <?php
                    $pagination = new Pagination([
                        'totalCount' => $admin->countAllData('nr_posts'),
                    ]);

                    $all_data = $admin->postsData($pagination->offset, $pagination->limit);
                    if ($all_data):
                    foreach ($all_data as $postlist):
                        $user_post = new User($postlist->user_id);
                ?>

                  <tr id="id_data_<?php echo Secure::escape($postlist->id); ?>">
                      <td>
                          <?php echo Secure::escape($postlist->id); ?>
                      </td>
                      <td>
                          <?php echo Secure::escape($user_post->data()->user_username); ?>
                      </td>
                      <td>
                          <a href="#" target="_blank">Open Post</a>
                      </td>
                      <td>
                          <?php echo Secure::escape($postlist->time); ?>
                      </td>
                      <td>
                          Active
                      </td>
                      <td class="project-actions text-right">
                          <div class="d-inline" id="load_delete_admin_<?php echo Secure::escape($postlist->id); ?>">
                            <button type="button" class="btn btn-danger btn-sm" onClick="deleteData(<?php echo Secure::escape($postlist->id); ?>);">
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
        data: {id:id,action:"nr_posts"},
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