<?php
   include 'config/core_db.php';
   if(@$_SESSION['Emp_ID'] != "" && $_GET['group_id'] != ""){
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
                        <h1>Group Menu</h1>
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
                  <a href="list_group.php" class="btn btn-danger mb-4"><i class="fas fa-reply"></i> Back</a>
                     <div class="row d-flex justify-content-center">
                        <div class="col-lg-6">
                           <?php
                              $get_groupId = $_GET['group_id'];
                              $query_last_data_value = $db_connect->prepare("
                                 SELECT
                                       tbg.*
                                 FROM
                                       tbgroup tbg
                                 WHERE
                                       tbg.Group_ID  = :Group_ID 

                              ");
                              $query_last_data_value->bindParam(':Group_ID', $get_groupId);
                              $query_last_data_value->execute();
                              $last_data = $query_last_data_value->fetch(PDO::FETCH_ASSOC);
                           ?>
                           <div class="form-group">
                              <label for="Site Name"><?php echo $text_add_assigngroup_ID; ?></label>
                              <input type="text" class="form-control" id="groupID" name="groupID" value="<?php echo $last_data['Group_ID']; ?>" disabled>
                           </div>
                           <div class="form-group">
                              <label for="Site Name"><?php echo $text_add_assigngroup ?></label>
                              <input type="text" class="form-control" id="inputgroupname" name="group" placeholder="Group. Name" value="<?php echo $last_data['Group_Name']; ?>" required>
                           </div>
                           <div class="form-group">
                              <label for="position"><?php echo $text_add_employee_position; ?></label>
                              <select class="select2" style="width: 100%;"  name="grouptype">
                                 <option value="<?php echo $last_data['Group_Admin']; ?>">
                                 <?php 
                                       if($last_data['Group_Admin'] == '1'){
                                          echo "Admin";
                                       }
                                       else{
                                          echo "None Admin";
                                       }
                                 ?>
                                 </option>
                                 <option value="0">None Admin</option>
                                 <option value="1">Admin</option>
                               </select>
                           </div>
                           <div class="mt-5 ml-auto">
                                 <div class="row d-flex justify-content-end">
                                    <div class="col-sm-12 col-lg-2">
                                       <button type="submit" name="editgroup" class="btn btn-primary w-100"><i class="far fa-save"></i> <?php echo $text_save ?></button>
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
               url: 'config/event/delete_dep.php',
               data: {dep_id: depId},
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
       header("location:list_group.php");
   }
   ?>
