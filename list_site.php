<?php

    include 'config/core_db.php';
    if(@$_SESSION['Emp_ID'] != ""){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title_webpage; ?></title>
    <link rel="icon" type="image/x-icon" href="../images/logo-ico.ico">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="plugins/customcss/customcss.css">
    
</head>

<body class="hold-transition sidebar-mini layout-fixed" style="background-color: #f9f4f3;">
<!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-primary navbar-light fixed-top">
      <!-- Left navbar links -->
      <ul class="navbar-nav ">
        <li class="nav-item ">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars text-white"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <?php include 'component/sidebar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper mt-5 p-4">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              <h1>Fixed Layout</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <div class="container-fluid p-4 bg-white rounded">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <div class="card-header bg-primary">
                          <h3 class="card-title">Fixed Header Table</h3>
                          <div class="card-tools">
                          <div class="input-group input-group-sm" style="100%">
                              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                              <div class="input-group-append">
                                  <button type="submit" class="btn btn-danger">
                                  <i class="fas fa-search"></i>
                                  </button>
                              </div>
                          </div>
                          </div>
                      </div>
                      <div class="card-body table-responsive p-0" h-100>
                          <table class="table table-head-fixed text-nowrap">
                          <thead>
                              <tr>
                                  <th>No.</th>
                                  <th>SiteID.</th>
                                  <th>Site Name.</th>
                                  <th>Location.</th>
                                  <th>Street.</th>
                                  <th>City.</th>
                                  <th>Province.</th>
                                  <th>Postal Code.</th>
                                  <th>Manager Site</th>
                                  <th>Street</th>
                                  <th>Update By.</th>
                                  <th>Edit</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>183</td>
                                  <td>John Doe</td>
                                  <td>11-7-2014</td>
                                  <td><span class="tag tag-success">Approved</span></td>
                                  <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                              </tr>
                          </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    
    <!-- /.content-wrapper -->
        
    <footer class="main-footer mt-2">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 0.0.1
      </div>
      <strong>Copyright &copy; 2024 <a href="https://web.facebook.com/kchaiwat24">SPU_66701067</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->


    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <script src="../assets/js/custom.js"></script>
    
</body>

</html>
<?php 
    }
    else{
        header("location:index.php");
    }
?>