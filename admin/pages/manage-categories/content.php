    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Categories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $site->dir_admin; ?>">Home</a></li>
              <li class="breadcrumb-item active">Manage Categories</li>
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
          <h3 class="card-title">Manage Categories</h3>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 5%">
                          ID
                      </th>
                      <th style="width: 20%">
                          CATEGORY NAME
                      </th>
                      <th style="width: 20%">
                      </th>
                  </tr>
              </thead>
              <tbody>

                <?php
                    $pagination = new Pagination([
                        'totalCount' => $admin->countAllData('nr_categories'),
                    ]);

                    $all_data = $admin->categoriesData($pagination->offset, $pagination->limit);
                    if ($all_data):
                    foreach ($all_data as $categorieslist):
                ?>
 
                  <tr id="id_data_<?php echo Secure::escape($categorieslist->id); ?>">
                      <td>
                          <?php echo Secure::escape($categorieslist->id); ?>
                      </td>
                      <td>
                          <?php echo Secure::escape($categorieslist->english); ?>
                      </td>
                      <td class="project-actions text-right">
                          <a class="btn btn-primary btn-sm" href="#">
                              Edit
                          </a>
                          <a class="btn btn-danger btn-sm" href="#">
                              Delete
                          </a>
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