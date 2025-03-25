    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Custom Pages</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $site->dir_admin; ?>">Home</a></li>
              <li class="breadcrumb-item active">Manage Custom Pages</li>
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
          <h3 class="card-title">Manage & Edit Custom Pages</h3>
          <a class="btn btn-primary btn-sm float-right" href="<?php echo $site->dir_admin; ?>/new-custom-page">
              Create New Custom Page
          </a>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 5%">
                          ID
                      </th>
                      <th style="width: 20%">
                          PAGE NAME
                      </th>
                      <th style="width: 20%">
                          PAGE TITLE
                      </th>
                      <th style="width: 20%">
                      </th>
                  </tr>
              </thead>
              <tbody>

              <?php
                    $pagination = new Pagination([
                        'totalCount' => $admin->countAllData('nr_custompages'),
                    ]);

                    $all_data = $admin->custompagesData($pagination->offset, $pagination->limit);
                    if ($all_data):
                    foreach ($all_data as $pageslist):
                ?>
 
                  <tr id="id_data_<?php echo Secure::escape($pageslist->id); ?>">
                      <td>
                          <?php echo Secure::escape($pageslist->id); ?>
                      </td>
                      <td>
                          <?php echo Secure::escape($pageslist->page_name); ?>
                      </td>
                      <td>
                          <?php echo Secure::escape($pageslist->page_title); ?>
                      </td>
                      <td class="project-actions text-right">
                          <div class="d-inline">
                              <a class="btn btn-primary btn-sm" href="<?php echo $site->dir_admin; ?>/edit-custom-page/<?php echo Secure::escape($pageslist->id); ?>">
                                  Edit
                              </a>
                          </div>
                          <div class="d-inline" id="load_delete_admin_<?php echo Secure::escape($pageslist->id); ?>">
                              <button type="button" class="btn btn-danger btn-sm" onClick="deleteData(<?php echo Secure::escape($pageslist->id); ?>);">
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
        data: {id:id,action:"nr_custompages"},
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