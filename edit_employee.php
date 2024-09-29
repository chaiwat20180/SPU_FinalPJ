<?php
   include 'config/core_db.php';
   if(@$_SESSION['Emp_ID'] != "" && $_GET['emp_id'] != ""){
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
                        <h1>Employee Menu</h1>
                     </div>
                  </div>
               </div>
               <!-- /.container-fluid -->
            </section>
            
            <!-- Main content -->
            <section class="content">
               
               <div class="container-fluid p-4 bg-white rounded">
                  <form action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                  <div class="row p-4" >
                     <div class="container">
                     <a href="list_employee.php" class="btn btn-danger mb-4"><i class="fas fa-reply"></i> Back</a>
                        <div class="row">
                           <div class="col-lg-6">
                              <div class="col-lg-12">
                                 <?php
                                    $get_empId = $_GET['emp_id'];
                                    $query_last_data_value = $db_connect->prepare("
                                       SELECT
                                             tbemp.* ,
                                             tbd.Dep_Name as Dep_Name,
                                             tbp.Position_Name as Positon_Name,
                                             tbs.Status_Name as Status_Name
                                       FROM
                                             tbemployee tbemp
                                       LEFT JOIN tbdepartment tbd ON tbd.Dep_ID = tbemp.Dep_ID
                                       LEFT JOIN tbposition tbp ON tbp.Position_ID = tbemp.Position_ID
                                       LEFT JOIN tbemployeestatus tbs ON tbs.Status_ID = tbemp.Status_ID
                                       WHERE
                                             tbemp.Emp_ID = :Emp_ID

                                    ");
                                    $query_last_data_value->bindParam(':Emp_ID', $get_empId);
                                    $query_last_data_value->execute();
                                    $last_data = $query_last_data_value->fetch(PDO::FETCH_ASSOC);
                                 ?>
                                 <div class="form-group">
                                    <label for="employee Name"><?php echo $text_add_employee_id ?></label>
                                    <input type="text" class="form-control" placeholder="EmpId" value="<?php echo $last_data['Emp_ID']; ?>" Disabled>
                                 </div>
                              </div>
                              <div class="col-lg-12">
                                    <div class="form-group">
                                       <label for="employee Name"><?php echo $text_add_employee_fname ?></label>
                                       <input type="text" class="form-control" id="inputempfname" name="empfname" placeholder="First Name" value="<?php echo $last_data['Emp_FirstName']; ?>" required>
                                    </div>
                                 </div>
                              <div class="col-lg-12">
                                 <div class="form-group">
                                    <label for="employee Name"><?php echo $text_add_employee_lname ?></label>
                                    <input type="text" class="form-control" id="inputemplname" name="emplname" placeholder="Last Name" value="<?php echo $last_data['Emp_LastName']; ?>" required>
                                 </div>
                              </div>
                              <div class="col-lg-12">
                                 <div class="form-group">
                                    <label for="employee Name"><?php echo $text_add_employee_givenname ?></label>
                                    <input type="text" class="form-control" id="inputempgivenname" placeholder="Given Name" value="<?php echo $last_data['Emp_GivenName']; ?>" disabled>
                                 </div>
                              </div>
                              <div class="col-lg-12">
                                 <div class="form-group">
                                    <label for="empgivenname"><?php echo $text_add_employee_email ?></label>
                                    <input type="text" class="form-control" id="inputempemail" placeholder="E-mail" value="<?php echo $last_data['Emp_Email']; ?>" disabled>
                                 </div>
                              </div>
                              <div class="col-lg-12">
                                 <div class="form-group">
                                    <label for="empgivenname"><?php echo $text_add_employee_phone ?></label>
                                    <input type="text" class="form-control" id="inputempemail" maxlength="10" name="empphone" placeholder="Phone" value="<?php echo $last_data['Emp_Phone']; ?>" required>
                                 </div>
                              </div>
                              <div class="col-lg-12">
                                 <div class="form-group">
                                    <label for="empgivenname"><?php echo $text_add_employee_businessphone ?></label>
                                    <input type="text" class="form-control" id="inputempemail" maxlength="10"  name="empbusinessphone" placeholder="Business Phone" value="<?php echo $last_data['Emp_BusinessPhone']; ?>" required>
                                 </div>
                              </div>
                              <div class="col-lg-12">
                                    <label for="profilepic"><?php echo $text_change_pic; ?></label>
                                    <label for="profilepic" class="badge badge-danger"><?php echo $text_warning_pic; ?></label>
                                 <div class="form-group custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="emp_pic" accept="image/jpeg, image/png, image/jpg" style="cursor:pointer;" onchange="previewImage(event)">
                                    <label class="custom-file-label" for="customFile" id="customFileLabel">Choose file</label>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="col-lg-12">
                                 <div class="form-group">
                                    <label for="username"><?php echo $title_user_login; ?></label>
                                    <input type="text" class="form-control" id="inputempusername" placeholder="Username" value="<?php echo $last_data['Emp_Username'];?>" disabled>
                                 </div>
                              </div>
                              <div class="col-lg-12">
                                 <div class="form-group">
                                    <label for="username"><?php echo $title_password_login; ?></label>
                                    <input type="password" class="form-control" id="inputemppassword" name="emppassword" placeholder="Password" >
                                 </div>
                              </div>
                              <div class="col-lg-12">
                                 <div class="form-group">
                                 <label for="position"><?php echo $text_add_employee_department; ?></label>
                                    <select class="select2" style="width: 100%;"  name="department">
                                    <option value="<?php echo $last_data['Dep_ID']; ?>" selected><?php echo $last_data['Dep_Name']; ?></option>
                                       <?php 
                                          $query_all_department_value = $db_connect->prepare("
                                             SELECT
                                                   Dep_ID,
                                                   Dep_Name
                                             FROM
                                                   tbdepartment 
                                          ");
                                          $query_all_department_value->execute();
                                          while ($select_all_department_value = $query_all_department_value->fetch(PDO::FETCH_ASSOC)) {
                                       ?>
                                          <option value="<?php echo $select_all_department_value['Dep_ID']; ?>"><?php echo $select_all_department_value['Dep_Name']; ?></option>
                                       <?php 
                                          }
                                       ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-lg-12">
                                 <div class="form-group">
                                    <label for="position"><?php echo $text_add_employee_position; ?></label>
                                    <select class="select2" style="width: 100%;"  name="position">
                                    <option value="<?php echo $last_data['Position_ID']; ?>" selected><?php echo $last_data['Positon_Name']; ?></option>
                                       <?php 
                                          $query_all_position_value = $db_connect->prepare("
                                             SELECT
                                                   Position_ID,
                                                   Position_name
                                             FROM
                                                   tbposition 
                                          ");
                                          $query_all_position_value->execute();
                                          while ($select_all_position_value = $query_all_position_value->fetch(PDO::FETCH_ASSOC)) {
                                       ?>
                                          <option value="<?php echo $select_all_position_value['Position_ID']; ?>"><?php echo $select_all_position_value['Position_name']; ?></option>
                                       <?php 
                                          }
                                       ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-lg-12">
                                 <div class="form-group">
                                 <label for="empstatus"><?php echo $text_add_employee_status; ?></label>
                                    <select class="select2" style="width: 100%;"  name="empstatus">
                                    <option value="<?php echo $last_data['Status_ID']; ?>" seleted><?php echo $last_data['Status_Name']; ?></option>
                                       <?php 
                                          $query_all_empstatus_value = $db_connect->prepare("
                                             SELECT
                                                   Status_ID,
                                                   Status_Name
                                             FROM
                                                   tbemployeestatus 
                                          ");
                                          $query_all_empstatus_value->execute();
                                          while ($select_all_empstatus_value = $query_all_empstatus_value->fetch(PDO::FETCH_ASSOC)) {
                                       ?>
                                          <option value="<?php echo $select_all_empstatus_value['Status_ID']; ?>"><?php echo $select_all_empstatus_value['Status_Name']; ?></option>
                                       <?php 
                                          }
                                       ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-lg-12">
                                 <div class="form-group text-center">
                                    <label for="empemail"><?php echo $text_preview_pic ?></label><br>
                                    <img id="emp_pic_preview" src="../asset/emp_pic/<?php echo $last_data['Emp_Pic']; ?>" class="img-thumbnail emp_pic" style="width: 300px; height: 300px; object-fit: cover;">
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <hr>
                              <div class="mt-5 ml-auto">
                              <div class="row d-flex justify-content-end">
                                 <div class="col-sm-12 col-lg-2">
                                    <button type="submit" name="editemployee" class="btn btn-primary w-100"><i class="far fa-save"></i> <?php echo $text_save ?></button>
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
            <!-- Control sidebar content goes here -->1
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
             var emp_id = $(event.target).attr('data-id');
            $.ajax({
               type: 'POST',
               url: 'config/event/delete_site.php',
               data: {emp_id: emp_id},
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
         function previewImage(event) {
         const reader = new FileReader();
         reader.onload = function() {
            const output = document.getElementById('emp_pic_preview');
            output.src = reader.result;
         }
         reader.readAsDataURL(event.target.files[0]);

         // อัพเดตข้อความของ label เมื่อเลือกไฟล์
         const fileName = event.target.files[0].name;
         const label = document.getElementById('customFileLabel');
         label.textContent = fileName;
      }
      </script>
   </body>
</html>
<?php 
   }
   else{
       header("location:list_employee.php");
   }
   ?>
