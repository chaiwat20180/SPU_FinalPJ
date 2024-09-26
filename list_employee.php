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
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="row">
                           <div class="p-2">
                              <button type="button" class="btn btn-block btn-success" style="width: 150px;"  data-toggle="modal" data-target="#addsite">
                              <i class="far fa-edit nav-icon"></i>
                              <?php echo $text_add_new  ?>
                              </button>
                              <!-- Modal -->
                              <div class="modal fade" id="addsite" role="dialog" aria-labelledby="addsite" aria-hidden="true">
                                 <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $text_add_site; ?></h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                          </button>
                                       </div>
                                       <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                                          <div class="modal-body">
                                             <div class="container">
                                                <div class="row">
                                                   <div class="col-lg-6">
                                                      <div class="form-group">
                                                         <label for="empfname"><?php echo $text_add_employee_fname ?></label>
                                                         <input type="text" class="form-control" id="inputempfname" name="empfname" placeholder="First Name" required>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <div class="form-group">
                                                         <label for="emplname"><?php echo $text_add_employee_lname ?></label>
                                                         <input type="text" class="form-control" id="inputemplname" name="emplname" placeholder="Last Name" required>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="empgivenname"><?php echo $text_add_employee_givenname ?></label>
                                                         <input type="text" class="form-control" id="inputempgivenname" name="empgivenname" placeholder="Given Name" required>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="empemail"><?php echo $text_add_employee_email ?></label>
                                                         <input type="email" class="form-control" id="inputempemail" name="empemail" placeholder="E-mail" required>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <div class="form-group">
                                                         <label for="empphone"><?php echo $text_add_employee_phone ?></label>
                                                         <input type="text" class="form-control" id="inputempphone" name="empphone" placeholder="Phone" required>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <div class="form-group">
                                                         <label for="businessphone"><?php echo $text_add_employee_businessphone; ?></label>
                                                         <input type="text" class="form-control" id="inputempbusinessphone" name="empbusinessphone" placeholder="Business Phone" required>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-12">
                                                         <label for="profilepic"><?php echo $text_add_employee_pic; ?></label>
                                                      <div class="form-group custom-file">
                                                         <input type="file" class="custom-file-input" id="customFile" name="empprofilepic"required>
                                                         <label class="custom-file-label" for="customFile">Choose file</label>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-6 mt-3">
                                                      <div class="form-group">
                                                         <label for="username"><?php echo $title_user_login; ?></label>
                                                         <input type="text" class="form-control" id="inputempusername" name="empusername" placeholder="Username" required>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-6 mt-3">
                                                      <div class="form-group">
                                                         <label for="password"><?php echo $title_password_login; ?></label>
                                                         <input type="password" class="form-control" id="inputemppassword" name="emppassword" placeholder="Password" required>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                      <label for="position"><?php echo $text_add_employee_department; ?></label>
                                                         <select class="select2" style="width: 100%;"  name="department">
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
                                                </div>
                                             </div>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                             <button type="submit" name="addemployee" class="btn btn-primary"><?php echo $text_add_site ?></button>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <form action="/list_employee.php" method="get">
                           <div class="input-group">
                              <input type="search" class="form-control form-control-lg" name="search" placeholder="Search">
                              <div class="input-group-append">
                                 <button type="submit" class="btn btn-lg btn-default">
                                 <i class="fa fa-search"></i>
                                 </button>
                              </div>
                           </div>
                        </form>
                     </div>
                     <div class="col-12 mt-4">
                        <div class="card">
                           <div class="card-body table-responsive p-4" >
                              <table class="table table-head-fixed text-nowrap table-bordered table-hover w-100 text-center">
                                 <thead>
                                    <tr class="color-thtd">
                                       <th>No.</th>
                                       <th>Emp ID.</th>
                                       <th>Emp Pic.</th>
                                       <th>Emp Name.</th>
                                       <th>Emp Givename.</th>
                                       <th>Emp Email.</th>
                                       <th>Emp Phone.</th>
                                       <th>Emp Businessphone.</th>
                                       <th>Department.</th>
                                       <th>Position.</th>
                                       <th>Status.</th>
                                       <th>Create Date.</th>
                                       <th>Update By.</th>
                                       <th style="width: 150px;">Edit</th>
                                    </tr>
                                 </thead>
                                 <?php
                                    $limit_emp = 5;
                                    //ตรวจสอบว่ามีการส่งค่า page?= มาหรือยัง ถ้ายังจะเริ่มต้นที่ 1 
                                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // หน้าปัจจุบัน
                                    if($page < 1){
                                      $page = 1;
                                    }
                                     //สำหรับการดึงข้อมูลในหน้าเพจปัจจุบันโดยจะเริ่มรายการไหนเช่น หน้า2 ก็เริ่มรายการที่ 11-20 โดอิงจาก limit_site
                                    $start = ($page - 1) * $limit_emp;
                                    //สำหรับ search
                                    $search = isset($_GET['search']) ? $_GET['search'] : '';
                                    
                                    // คำนวณจำนวนหน้าทั้งหมด
                                    $query_all_emp = $db_connect->prepare("
                                                                              SELECT 
                                                                                      COUNT(*) 
                                                                              FROM 
                                                                                      tbemployee
                                                                              WHERE 
                                                                                      isDeleted = '0'
                                                                              AND  (
                                                                                      Emp_ID LIKE :search
                                                                              OR 
                                                                                      Emp_FirstName LIKE :search
                                                                              OR 
                                                                                      Emp_LastName LIKE :search
                                                                              OR 
                                                                                      Emp_GivenName LIKE :search
                                                                              OR 
                                                                                      Emp_Email LIKE :search
                                                                              OR 
                                                                                      Emp_Phone LIKE :search
                                                                              OR 
                                                                                      Emp_Username LIKE :search
                                                                                    )
                                    ");
                                    
                                    //หาจำนวนรวมของทั้งหมด
                                    $query_all_emp->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
                                    $query_all_emp->execute();
                                    $total_records = $query_all_emp->fetchColumn();
                                    //คำนวณจำนวนหน้าทั้งหมดแล้วนำมาหารจำนวนรายการต่อหน้า ใช้ ceil ปัดเศษ
                                    $total_pages = ceil($total_records / $limit_emp);
                                    // ดึงข้อมูลโดยใช้ LIMIT และ OFFSET
                                    $query_emp = $db_connect->prepare("
                                                                           SELECT
                                                                                    tbm.*
                                                                           FROM
                                                                                    tbemployee tbm
                                                                           WHERE 
                                                                                    tbm.isDeleted = '0'
                                                                           AND  (
                                                                                    Emp_ID LIKE :search
                                                                           OR 
                                                                                    Emp_FirstName LIKE :search
                                                                           OR 
                                                                                    Emp_LastName LIKE :search
                                                                           OR 
                                                                                    Emp_GivenName LIKE :search
                                                                           OR 
                                                                                    Emp_Email LIKE :search
                                                                           OR 
                                                                                    Emp_Phone LIKE :search
                                                                           OR 
                                                                                    Emp_Username LIKE :search
                                                                                 )
                                                                           ORDER BY 
                                                                                    tbm.CreateDateTime desc
                                                                           LIMIT
                                                                                    :start, :limit_site
                                    ");
                                    //ป้องกัน SQL injection
                                    $query_emp->bindValue(':search', "%$search%", PDO::PARAM_STR);
                                    $query_emp->bindValue(':start', $start, PDO::PARAM_INT);
                                    $query_emp->bindValue(':limit_site', $limit_emp, PDO::PARAM_INT);
                                    $query_emp->execute();
                                    ?>
                                 <tbody>
                                    <?php 
                                       if($page > $total_pages){
                                         echo "<tr><td class='align-middle' colspan='14'>Not Found</td></tr>";
                                       }
                                       else{
                                       ?>
                                    <?php 
                                       $no_emp = 0;
                                       while ($show_empData = $query_emp->fetch(PDO::FETCH_ASSOC)) {
                                         $no_emp++;
                                       ?>
                                    <tr>
                                       <td class="align-middle"><?php echo $no_emp; ?></td>
                                       <td class="align-middle"><?php echo $show_empData['Emp_ID']; ?></td>
                                       <td class="align-middle"><?php echo $show_empData['Emp_Pic']; ?></td>
                                       <td class="align-middle"><?php echo $show_empData['Emp_FirstName']." ".$show_empData['Emp_LastName']; ?></span></td>
                                       <td class="align-middle"><?php echo $show_empData['Emp_GivenName']; ?></td>
                                       <td class="align-middle"><?php echo $show_empData['Emp_Email']; ?></td>
                                       <td class="align-middle"><?php echo $show_empData['Emp_Phone']; ?></td>
                                       <td class="align-middle"><?php echo $show_empData['Emp_BusinessPhone']; ?></td>
                                       <td class="align-middle"><?php echo $show_empData['Dep_ID']; ?></td>
                                       <td class="align-middle"><?php echo $show_empData['Position_ID']; ?></td>
                                       <td class="align-middle"><?php echo $show_empData['Status_ID']; ?></td>
                                       <td class="align-middle"><?php echo $show_empData['CreateDateTime']; ?></td>
                                       <td class="align-middle"><?php echo $show_empData['UpdatedBy']; ?></td>
                                       <td>
                                          <div class="row">
                                             <div class="col-lg-12 p-2">
                                                <a class="btn btn-block btn-primary" href="edit_site.php?site_id=<?php echo $show_siteData['Site_ID']; ?>">
                                                   <i class="fas fa-edit"></i>
                                                   <?php echo $text_edit ?>
                                                </a>
                                             </div>
                                             <div class="col-lg-12 p-2">
                                                <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#deleteitem<?php echo $no_emp;?>"><i class="fas fa-trash"></i> <?php echo $text_delete ?></button>
                                             </div>
                                          </div>
                                          <div class="modal fade" id="deleteitem<?php echo $no_emp;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                             <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                   <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $alert_site_title;?></h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                      </button>
                                                   </div>
                                                   <div class="modal-body">
                                                      <div class="mb-3">
                                                         <img src="asset/image/warning-icon.gif" class="img-thumbnail border-0 clear-shardow resizer-logo150px" alt="" srcset="">
                                                      </div>
                                                      <div class="mb-3">
                                                         <?php echo $alert_site;?>
                                                      </div>
                                                      <div class="modal-footer">
                                                         <a class="btn btn-secondary" data-dismiss="modal"><?php echo $text_cancel ?></a>
                                                         <a class="btn btn-danger delete-btn" data-id="<?php echo $show_siteData['Site_ID']; ?>"><?php echo $text_delete ?></a>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    <?php } } ?>
                                 </tbody>
                              </table>
                              <div class="card-footer clearfix bg-white">
                                 <form action="/list_site.php" method="get">
                                    <ul class="pagination pagination-sm m-0 float-right">
                                       <!-- Previous Page Link -->
                                       <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                                          <a class="page-link" href="?page=<?php echo max(1, $page - 1); ?>&search=<?php echo urlencode($search); ?>">«</a>
                                       </li>
                                       <!-- Page Number Links -->
                                       <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                       <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                          <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>"><?php echo $i; ?></a>
                                       </li>
                                       <?php endfor; ?>
                                       <!-- Next Page Link -->
                                       <li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
                                          <a class="page-link" href="?page=<?php echo min($total_pages, $page + 1); ?>&search=<?php echo urlencode($search); ?>">»</a>
                                       </li>
                                    </ul>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
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
            $(".custom-file-input").on("change", function() {
               var fileName = $(this).val().split("\\").pop();
               $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
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
       header("location:index.php");
   }
   ?>
