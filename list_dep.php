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
                        <h1>Department Menu</h1>
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
                                          <span aria-hidden="true ">&times;</span>
                                          </button>
                                       </div>
                                       <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                                          <div class="modal-body">
                                             <div class="container">
                                                <div class="row">
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="Site Name"><?php echo $text_add_site_name ?></label>
                                                         <select class="select2" style="width: 100%;"  name="sitename">
                                                            <?php 
                                                               $query_all_site_value = $db_connect->prepare("
                                                                  SELECT
                                                                        Site_ID ,
                                                                        Site_Name,
                                                                        Site_Location
                                                                  FROM
                                                                        tbsite 
                                                               ");
                                                               $query_all_site_value->execute();
                                                               while ($select_all_site_value = $query_all_site_value->fetch(PDO::FETCH_ASSOC)) {
                                                            ?>
                                                               <option value="<?php echo $select_all_site_value['Site_ID']; ?>"><?php echo $select_all_site_value['Site_Name']." - ".$select_all_site_value['Site_Location']; ?></option>
                                                            <?php 
                                                               }
                                                            ?>
                                                         </select>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="Location"><?php echo $text_add_dep ?></label>
                                                         <input type="text" class="form-control" id="inputdepname" name="department" placeholder="Dep. name" required>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                        <label for="Location"><?php echo $text_add_employee ?></label>
                                                        <select class="select2" style="width: 100%;"  name="manager">
                                                            <option value="<?php echo $user_data['Emp_ID']?>" selected><?php echo $user_data['Emp_FirstName']." ".$user_data['Emp_LastName']?></option>
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
                                                            while ($select_all_emp_value = $query_all_emp_value->fetch(PDO::FETCH_ASSOC)) {
                                                            ?>
                                                            <option value="<?php echo $select_all_emp_value['Emp_ID']; ?>"><?php echo $select_all_emp_value['Emp_FirstName']." ".$select_all_emp_value['Emp_LastName']; ?></option>
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
                                             <button type="submit" name="adddep" class="btn btn-primary"><?php echo $text_add_site ?></button>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <form action="/list_dep.php" method="get">
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
                                       <th>DepID.</th>
                                       <th>Dep Name.</th>
                                       <th>Site Name.</th>
                                       <th>Manager.</th>
                                       <th>Create Date.</th>
                                       <th>Update By.</th>
                                       <th style="width: 150px;">Edit</th>
                                    </tr>
                                 </thead>
                                 <?php
                                    $limit_dep = 5;
                                    //ตรวจสอบว่ามีการส่งค่า page?= มาหรือยัง ถ้ายังจะเริ่มต้นที่ 1 
                                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // หน้าปัจจุบัน
                                    if($page < 1){
                                      $page = 1;
                                    }
                                     //สำหรับการดึงข้อมูลในหน้าเพจปัจจุบันโดยจะเริ่มรายการไหนเช่น หน้า2 ก็เริ่มรายการที่ 11-20 โดอิงจาก limit_site
                                    $start = ($page - 1) * $limit_dep;
                                    //สำหรับ search
                                    $search = isset($_GET['search']) ? $_GET['search'] : '';
                                    
                                    // คำนวณจำนวนหน้าทั้งหมด
                                    $query_all_dep = $db_connect->prepare("
                                                                              SELECT 
                                                                                        COUNT(*) 
                                                                              FROM 
                                                                                        tbdepartment tbd
                                                                              LEFT JOIN tbemployee employee on employee.Emp_ID = tbd.UpdatedBy
                                                                              LEFT JOIN tbemployee manager on manager.Emp_ID = tbd.Dep_Manager
                                                                              WHERE 
                                                                                        tbd.isDeleted = '0'
                                                                              AND  (
                                                                                          tbd.Dep_Name LIKE :search
                                                                              OR 
                                                                                          employee.Emp_FirstName LIKE :search
                                                                              OR
                                                                                          manager.Emp_FirstName LIKE :search
                                                                                       )
                                                                              
                                    ");
                                    
                                    //หาจำนวนรวมของทั้งหมด
                                    $query_all_dep->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
                                    $query_all_dep->execute();
                                    $total_records = $query_all_dep->fetchColumn();
                                    //คำนวณจำนวนหน้าทั้งหมดแล้วนำมาหารจำนวนรายการต่อหน้า ใช้ ceil ปัดเศษ
                                    $total_pages = ceil($total_records / $limit_dep);
                                    // ดึงข้อมูลโดยใช้ LIMIT และ OFFSET
                                    $query_dep = $db_connect->prepare("
                                                                              SELECT
                                                                                          tbdep.*,
                                                                                          site.Site_Name AS Site_Name,
                                                                                          manager.Emp_FirstName AS manager_FirstName,
                                                                                          manager.Emp_LastName AS manager_LastName,
                                                                                          employee.Emp_FirstName AS updated_by_FirstName,
                                                                                          employee.Emp_LastName AS updated_by_LastName
                                                                              FROM
                                                                                          tbdepartment tbdep
                                                                              LEFT JOIN tbsite site on site.Site_ID = tbdep.Site_ID
                                                                              LEFT JOIN tbemployee manager on manager.Emp_ID = tbdep.Dep_Manager
                                                                              LEFT JOIN tbemployee employee on employee.Emp_ID = tbdep.UpdatedBy
                                                                              WHERE 
                                                                                          tbdep.isDeleted = '0'
                                                                              AND  (
                                                                                          tbdep.Dep_ID LIKE :search
                                                                              OR 
                                                                                          tbdep.Dep_Name LIKE :search
                                                                              OR 
                                                                                          site.Site_Name LIKE :search
                                                                              OR
                                                                                          employee.Emp_FirstName LIKE :search
                                                                              OR
                                                                                          manager.Emp_FirstName LIKE :search
                                                                                       )
                                                                              ORDER BY 
                                                                                          tbdep.CreateDateTime desc
                                                                              LIMIT
                                                                                       :start, :limit_site
                                    ");
                                    //ป้องกัน SQL injection
                                    $query_dep->bindValue(':search', "%$search%", PDO::PARAM_STR);
                                    $query_dep->bindValue(':start', $start, PDO::PARAM_INT);
                                    $query_dep->bindValue(':limit_site', $limit_dep, PDO::PARAM_INT);
                                    $query_dep->execute();
                                    ?>
                                 <tbody>
                                    <?php 
                                       if($page > $total_pages){
                                         echo "<tr><td class='align-middle' colspan='12'>Not Found</td></tr>";
                                       }
                                       else{
                                       ?>
                                    <?php 
                                       $no_site = 0;
                                       while ($show_DepData = $query_dep->fetch(PDO::FETCH_ASSOC)) {
                                         $no_site++;
                                       ?>
                                    <tr>
                                       <td class="align-middle"><?php echo $no_site; ?></td>
                                       <td class="align-middle"><?php echo $show_DepData['Dep_ID']; ?></td>
                                       <td class="align-middle"><?php echo $show_DepData['Dep_Name']; ?></td>
                                       <td class="align-middle"><?php echo $show_DepData['Site_Name']; ?></span></td>
                                       <td class="align-middle"><?php echo $show_DepData['manager_FirstName']." ".$show_DepData['manager_LastName']; ?></td>
                                       <td class="align-middle"><?php echo $show_DepData['CreateDateTime']; ?></td>
                                       <td class="align-middle"><?php echo $show_DepData['updated_by_FirstName']." ".$show_DepData['updated_by_LastName']; ?></td>
                                       <td>
                                          <div class="row">
                                             <div class="col-lg-12 p-2">
                                                <a class="btn btn-block btn-primary" href="edit_dep.php?dep_id=<?php echo $show_DepData['Dep_ID']; ?>">
                                                   <i class="fas fa-edit"></i>
                                                   <?php echo $text_edit ?>
                                                </a>
                                             </div>
                                             <div class="col-lg-12 p-2">
                                                <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#deleteitem<?php echo $no_site;?>"><i class="fas fa-trash"></i> <?php echo $text_delete ?></button>
                                             </div>
                                          </div>
                                          <div class="modal fade" id="deleteitem<?php echo $no_site;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                         <a class="btn btn-danger delete-btn" data-id="<?php echo $show_DepData['Dep_ID']; ?>"><?php echo $text_delete ?></a>
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
                                 <form action="/list_dep.php" method="get">
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
            $('.delete-btn').click(function(e) {
            // var siteId = $(this).data('id');
             var Dep_ID = $(event.target).attr('data-id');
            $.ajax({
               type: 'POST',
               url: 'config/event/delete_dep.php',
               data: {Dep_ID: Dep_ID},
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
