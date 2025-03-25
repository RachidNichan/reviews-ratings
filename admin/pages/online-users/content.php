    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Online Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $site->dir_admin; ?>">Home</a></li>
              <li class="breadcrumb-item active">Online Users</li>
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
          <h3 class="card-title">Online Users</h3>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 5%">
                          ID
                      </th>
                      <th style="width: 10%">
                          USERNAME
                      </th>
                      <th style="width: 30%">
                          E-MAIL
                      </th>
                      <th style="width: 10%">
                          IP ADDRESS
                      </th>
                      <th style="width: 10%">
                          STATUS
                      </th>
                  </tr>
              </thead>
              <tbody>

                <?php
                    $pagination = new Pagination([
                        'totalCount' => $admin->countAllData('nr_users'),
                    ]);

                    $all_data = $admin->usersDataOnline($pagination->offset, $pagination->limit);
                    if ($all_data):
                    foreach ($all_data as $userlist):
                ?>

                  <tr id="id_data_<?php echo Secure::escape($userlist->id); ?>">
                      <td>
                            <?php echo Secure::escape($userlist->id); ?>
                      </td>
                      <td>
                            <?php echo Secure::escape($userlist->user_username); ?>
                      </td>
                      <td>
                            <?php echo Secure::escape($userlist->user_email); ?>
                      </td>
                      <td>
                            <?php echo Secure::escape($userlist->ip_address); ?>
                      </td>
                      <td>
                            <?php echo ($userlist->active == 1) ? "Active" : "Inactive"; ?>
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