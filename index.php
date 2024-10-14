<?php 
    include 'config/core_db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title_webpage; ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <!-- CustomCss -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="plugins/customcss/customcss.css">
    <link rel="icon" type="image/x-icon" href="asset/image/logo-ico.ico">
  
</head>
<body class="bg-img">
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="row w-100 justify-content-center">
        <div class="col-lg-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h1 class="card-title"><?php echo $title_card; ?></h1>
                </div>
                <div class="row">
                    <div class="col-md-12 p-2">
                        <img src="asset/image/logo-ico.png" alt="..." class="img-fluid border-0 d-block mx-auto " style="box-shadow:none;">
                    </div>
                    <div class="col-lg-12">
                    <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="Username">Username</label>
                                <input type="text" name="username" class="form-control" id="username" placeholder="<?php echo $tile_placeholder_login; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="Password"><?php echo $title_password_login; ?></label>
                                <input type="password" name="password" class="form-control" id="<?php echo $title_password_login; ?>" placeholder="<?php echo $tile_placeholder_login_pw; ?>" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary w-100" name="sigin" value="<?php echo $title_sigin; ?>"></input>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
