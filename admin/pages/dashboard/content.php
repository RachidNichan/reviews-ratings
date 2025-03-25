    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $site->dir_admin; ?>">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
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

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">TOTAL USERS</span>
                <span class="info-box-number"><?php echo $admin->countAllData('nr_users'); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-pen"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">TOTAL REVIEWS</span>
                <span class="info-box-number"><?php echo $admin->countAllData('nr_posts'); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-flag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">TOTAL COMPANIES</span>
                <span class="info-box-number"><?php echo $admin->countAllData('nr_review'); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">ONLINE USERS</span>
                <span class="info-box-number"><?php echo $admin->countOnlineUser(); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-12">
                <!-- STATISTICS -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">STATICS</h3>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                          <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

<?php
$user_statistics = array();
$review_statistics = array();
$posts_statistics = array();

$months = array('01','02','03','04','05','06','07','08','09','10','11','12');
// user_statistics
foreach ($months as $value) {
   $user_statistics[] = $admin->registeredData($value, 'nr_users');
}
$user_statistics = implode(', ', $user_statistics);

// review_statistics
foreach ($months as $value) {
   $review_statistics[] = $admin->registeredData($value, 'nr_review');
}
$review_statistics = implode(', ', $review_statistics);

// posts_statistics
foreach ($months as $value) {
  $posts_statistics[] = $admin->registeredData($value, 'nr_posts');
}
$posts_statistics = implode(', ', $posts_statistics);
?>

<!-- ChartJS -->
<script src="<?php echo $site->url; ?>/admin/assets/plugins/chart.js/Chart.min.js"></script>

<script>
  $(function () {

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
      labels  : ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
      datasets: [
        {
          label               : 'Users',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php echo $user_statistics; ?>]
        },
        {
          label               : 'Companies',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo $review_statistics; ?>]
        },
        {
          label               : 'Reviews',
          backgroundColor     : 'rgba(255,101,80,0.4)',
          borderColor         : 'rgba(255,101,80,0.4)',
          pointRadius         : false,
          pointColor          : 'rgba(255,101,80,0.4)',
          pointStrokeColor    : '#ff6550',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo $posts_statistics; ?>]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvas, {
      type: 'bar',
      data: areaChartData,
      options: areaChartOptions
    })

    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = $.extend(true, {}, areaChartOptions)
    var lineChartData = $.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    })

  })
</script>