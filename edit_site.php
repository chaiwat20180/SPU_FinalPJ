<?php
   include 'config/core_db.php';
   if(@$_SESSION['Emp_ID'] != "" && $_GET['site_id'] != ""){
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
      <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
      <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
      <link rel="stylesheet" href="dist/css/adminlte.min.css">
      <link rel="stylesheet" href="plugins/customcss/customcss.css">
   </head>
   <body class=" layout-fixed" style="background-color: #f9f4f3;">
      <!-- Site wrapper -->
      <div class="wrapper d-flex flex-column min-vh-100">
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
                        <h1>Site Menu</h1>
                     </div>
                  </div>
               </div>
               <!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
               <div class="container-fluid p-4 bg-white rounded">
                  <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
                  <div class="row p-4" >
                  <div class="container">
                  <a href="list_site.php" class="btn btn-danger mb-4"><i class="fas fa-reply"></i> Back</a>
                     <div class="row">
                        <div class="col-lg-6">
                           <?php
                              $get_siteId = $_GET['site_id'];
                              $query_last_data_value = $db_connect->prepare("
                                 SELECT
                                       tbemp.Emp_ID ,
                                       tbemp.Emp_FirstName,
                                       tbemp.Emp_LastName,
                                       tbs.*
                                 FROM
                                       tbsite tbs
                                 LEFT JOIN tbemployee tbemp ON tbemp.Emp_ID = tbs.Site_Manager
                                 WHERE
                                       tbs.Site_ID = :site_id

                              ");
                              $query_last_data_value->bindParam(':site_id', $get_siteId);
                              $query_last_data_value->execute();
                              $last_data = $query_last_data_value->fetch(PDO::FETCH_ASSOC);
                           ?>
                           <div class="form-group">
                              <label for="Site Name"><?php echo $text_add_site_name ?></label>
                              <input type="text" class="form-control" id="inputsitename" name="sitename" placeholder="TH,JP" value="<?php echo $last_data['Site_Name']; ?>" required>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label for="Location"><?php echo $text_add_site_location ?></label>
                              <input type="text" class="form-control" id="inputlocation" name="location" placeholder="Location" value="<?php echo $last_data['Site_Location']; ?>" required>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label for="Location"><?php echo $text_add_site_street ?></label>
                              <input type="text" class="form-control" id="inputlocation" name="street" placeholder="Street" value="<?php echo $last_data['Site_Street']; ?>" required>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label for="Location"><?php echo $text_add_site_city ?></label>
                              <input type="text" class="form-control" id="inputlocation" name="city" placeholder="City" value="<?php echo $last_data['Site_City']; ?>" required>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label for="Location"><?php echo $text_add_site_province ?></label>
                              <input type="text" class="form-control" id="inputlocation" name="provice" placeholder="Province" value="<?php echo $last_data['Site_Province']; ?>" required>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label for="Location"><?php echo $text_add_site_postcode ?></label>
                              <input type="text" class="form-control" id="inputlocation" name="postcode" placeholder="Post Code" value="<?php echo $last_data['Site_Postal_Code']; ?>" required>
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="form-group">
                              <label>Manager</label>
                              <select class="select2" style="width: 100%;"  name="manager">
                                 <?php 
                                    $query_all_emp_value = $db_connect->prepare("
                                       SELECT
                                             Emp_ID ,
                                             Emp_FirstName,
                                             Emp_LastName
                                       FROM
                                             tbemployee 
                                    ");
                                    $query_all_emp_value->execute();
                                 ?>
                                  <option value="<?php echo $last_data['Emp_ID']?>" selected><?php echo @$last_data['Emp_FirstName']." ".$last_data['Emp_LastName']?></option>
                                 <?php
                                    while ($select_all_emp_value = $query_all_emp_value->fetch(PDO::FETCH_ASSOC)) {
                                 ?>
                                    <option value="<?php echo $select_all_emp_value['Emp_ID']; ?>"><?php echo $select_all_emp_value['Emp_FirstName']." ".$select_all_emp_value['Emp_LastName']; ?></option>
                                 <?php 
                                    }
                                 ?>
                              </select>
                              <div class="mt-5 ml-auto">
                                 <div class="row d-flex justify-content-end">
                                    <div class="col-sm-12 col-lg-2">
                                       <button type="submit" name="editsite" class="btn btn-primary w-100"><i class="far fa-save"></i> <?php echo $text_save ?></button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  </div>
                  </form>
               </div>
            </section>
            <!-- /.content -->
         </div>
         <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
               <b>Version</b> 0.0.1
            </div>
            <strong>Copyright &copy; 2024 <a href="https://web.facebook.com/kchaiwat24">SPU_66701067</a>.</strong> All rights reserved.
         </footer>
         <!-- Modal -->

         <!-- /.content-wrapper -->
         <!-- Control Sidebar -->
         <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
         </aside>
         <!-- /.control-sidebar -->
      </div>

      <!-- ./wrapper -->
      <!-- jQuery -->
      <script src="plugins/jquery/jquery.min.js"></script>
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
      <!-- Select2 -->
      <script src="plugins/select2/js/select2.full.min.js"></script>
      <script>
         $(function () {
           $('.select2').select2({})
         });
      </script>
      <?php include 'component/modal.php'; ?>
      <script>
         $(document).ready(function(){
            var operationSuccess = "<?php echo $_SESSION['status_insert'] ?? 'false'; ?>";

            if (operationSuccess === 'true') {
               $('#successarlert').modal('show');

               // Set a timeout to hide the modal after 2 seconds
               setTimeout(function() {
                  $('#successarlert').modal('hide');
               }, 2000);

               // Set another timeout to clear the session 1 second after the modal closes
               setTimeout(function() {
                  $.ajax({
                        url: 'unset_session.php', 
                        type: 'POST',
                        success: function(response) {
                           console.log('Session cleared:', response);
                        },
                        error: function() {
                           console.log('Error unsetting the session variable.'); 
                        }
                  });
               }, 3000); // This triggers 3 seconds after the page loads
            }
            if (operationSuccess === 'nulldata') {
               $('#nullalert').modal('show');

               // Set a timeout to hide the modal after 2 seconds
               setTimeout(function() {
                  $('#nullalert').modal('hide');
               }, 2000);

               // Set another timeout to clear the session 1 second after the modal closes
               setTimeout(function() {
                  $.ajax({
                        url: 'unset_session.php', 
                        type: 'POST',
                        success: function(response) {
                           console.log('Session cleared:', response);
                        },
                        error: function() {
                           console.log('Error unsetting the session variable.'); 
                        }
                  });
               }, 3000); // This triggers 3 seconds after the page loads
            }
            if (operationSuccess === 'duplicatealert') {
               $('#duplicatealert').modal('show');

               // Set a timeout to hide the modal after 2 seconds
               setTimeout(function() {
                  $('#duplicatealert').modal('hide');
               }, 2000);

               // Set another timeout to clear the session 1 second after the modal closes
               setTimeout(function() {
                  $.ajax({
                        url: 'unset_session.php', 
                        type: 'POST',
                        success: function(response) {
                           console.log('Session cleared:', response);
                        },
                        error: function() {
                           console.log('Error unsetting the session variable.'); 
                        }
                  });
               }, 3000); // This triggers 3 seconds after the page loads
            }
            if (operationSuccess === 'error') {
               $('#errorarlert').modal('show');

               // Set a timeout to hide the modal after 2 seconds
               setTimeout(function() {
                  $('#errorarlert').modal('hide');
               }, 2000);

               // Set another timeout to clear the session 1 second after the modal closes
               setTimeout(function() {
                  $.ajax({
                        url: 'unset_session.php', 
                        type: 'POST',
                        success: function(response) {
                           console.log('Session cleared:', response);
                        },
                        error: function() {
                           console.log('Error unsetting the session variable.'); 
                        }
                  });
               }, 3000); // This triggers 3 seconds after the page loads
            }
            $('.delete-btn').click(function(e) {
            // var siteId = $(this).data('id');
             var siteId = $(event.target).attr('data-id');
            $.ajax({
               type: 'POST',
               url: 'config/event/delete_site.php',
               data: {site_id: siteId},
               success: function(response) {
                     const result = JSON.parse(response);
                     if(result.status === 'success') {
                        location.reload();
                     } else {
                        location.reload();
                     }
               }
            });
         });
         });
      </script>
   </body>
</html>
<?php 
   }
   else{
       header("location:list_site.php");
   }
   ?>
