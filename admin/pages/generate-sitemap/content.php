    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Generate Sitemap</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $site->dir_admin; ?>">Home</a></li>
              <li class="breadcrumb-item active">Generate Sitemap</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

            <div class="col-md-6">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Generate Sitemap</h3>
                    </div>
                    <div class="card-body">
                        <form id="sitemap_settings" method="POST">
                            <input type="hidden" name="token_id" value="<?php echo Token::generate(); ?>">
                            <button type="submit" name="submit" class="btn btn-primary">Generate</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->