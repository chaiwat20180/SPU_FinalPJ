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
              <h1>My Ticket Request</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <div class="container-fluid p-4 bg-white rounded">
            <div class="row">
              <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-danger">
                                <h3 class="card-title">My Incident Reuqest</h3>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th style="width: 150px;">Ticket No.</th>
                                            <th style="width: 200px;">Request Date</th>
                                            <th style="width: 150px;">Status</th>
                                            <th>Reason</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $limit_inc = 5;
                                    //ตรวจสอบว่ามีการส่งค่า page?= มาหรือยัง ถ้ายังจะเริ่มต้นที่ 1 
                                    $page = isset($_GET['page_inc']) ? (int)$_GET['page_inc'] : 1; // หน้าปัจจุบัน
                                    if($page < 1){
                                      $page = 1;
                                    }
                                     //สำหรับการดึงข้อมูลในหน้าเพจปัจจุบันโดยจะเริ่มรายการไหนเช่น หน้า2 ก็เริ่มรายการที่ 11-20 โดอิงจาก limit_site
                                    $start = ($page - 1) * $limit_inc;
                                    //สำหรับ search
                                    $search = isset($_GET['search']) ? $_GET['search'] : '';
                                    
                                    // คำนวณจำนวนหน้าทั้งหมด
                                    $query_all_inc = $db_connect->prepare("
                                                                              SELECT
                                                                                    COUNT(*)
                                                                              FROM
                                                                                    tbticket tbt
                                                                              INNER JOIN tbcategory tbc ON tbc.Category_ID = tbt.Category_ID
                                                                              INNER JOIN tbemployee tbemp ON tbemp.Emp_ID = tbt.Emp_ID
                                                                              INNER JOIN tbstate tbs ON tbs.State_ID = tbt.State_ID
                                                                              WHERE
                                                                                  tbt.Emp_ID = :Emp_ID
                                                                              AND
                                                                                      tbc.Category_Type = '0'
                                                                              AND   
                                                                                    (
                                                                                        tbt.Ticket_ID  LIKE :search
                                                                              OR 
                                                                                        tbemp.Emp_FirstName LIKE :search
                                                                                    )
                                                                              ORDER BY 
                                                                                    tbt.CreateDateTime desc

                                    ");
                                    $query_all_inc->bindValue(':search', "%$search%", PDO::PARAM_STR);
                                    $query_all_inc->bindParam(':Emp_ID', $_SESSION['Emp_ID']);
                                    $query_all_inc->execute();
                                    $total_records = $query_all_inc->fetchColumn();
                                    //คำนวณจำนวนหน้าทั้งหมดแล้วนำมาหารจำนวนรายการต่อหน้า ใช้ ceil ปัดเศษ
                                    $total_pages = ceil($total_records / $limit_inc);
                                    // ดึงข้อมูลโดยใช้ LIMIT และ OFFSET
                                    $query_inc = $db_connect->prepare("
                                                                           SELECT
                                                                                    tbt.*,
                                                                                    tbemp.*,
                                                                                    tbs.*,
                                                                                    tbtd.*,
                                                                                    tbc.Category_Type as Category_Type
                                                                           FROM
                                                                                    tbticket tbt
                                                                           INNER JOIN tbcategory tbc ON tbc.Category_ID = tbt.Category_ID
                                                                           INNER JOIN tbemployee tbemp ON tbemp.Emp_ID = tbt.Emp_ID
                                                                           INNER JOIN tbstate tbs ON tbs.State_ID = tbt.State_ID
                                                                           INNER JOIN tbticketdetail tbtd ON tbtd.Ticket_ID  = tbt.Ticket_ID 
                                                                           WHERE
                                                                                  tbt.Emp_ID = :Emp_ID
                                                                           AND
                                                                                  tbc.Category_Type = '0'
                                                                           AND   
                                                                                (
                                                                                    tbt.Ticket_ID  LIKE :search
                                                                           OR 
                                                                                    tbemp.Emp_FirstName LIKE :search
                                                                                 )
                                                                           ORDER BY 
                                                                                    tbt.CreateDateTime desc
                                                                           LIMIT
                                                                                    :start, :limit_inc
                                    ");
                                    //ป้องกัน SQL injection
                                    $query_inc->bindParam(':Emp_ID', $_SESSION['Emp_ID']);
                                    $query_inc->bindValue(':search', "%$search%", PDO::PARAM_STR);
                                    $query_inc->bindValue(':start', $start, PDO::PARAM_INT);
                                    $query_inc->bindValue(':limit_inc', $limit_inc, PDO::PARAM_INT);
                                    $query_inc->execute();
                                    ?>
                                    <tbody>
                                        <?php 
                                            if($page > $total_pages){
                                              echo "<tr><td class='align-middle text-center' colspan='4'>Not Found</td></tr>";
                                            }
                                            else{
                                          ?>
                                          <?php 
                                            $no_inc = 0;
                                            while ($show_inc = $query_inc->fetch(PDO::FETCH_ASSOC)) {
                                              $no_inc++;
                                          ?>
                                        <tr>
                                            <td><a href="ticket_detail.php?ticket_id=<?php echo $show_inc['Ticket_ID']; ?>&type=<?php echo $show_inc['Category_Type']; ?>"><?php echo $show_inc['Ticket_ID']; ?></a></td>
                                            <td><?php echo $show_inc['CreateDateTime']; ?></td>
                                            <td><span class="tag tag-success"><?php echo $show_inc['State_Name']; ?></span></td>
                                            <td class="text-break"><?php echo $show_inc['Ticket_Detail']; ?></td>
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table>
                                <div class="card-footer clearfix bg-white">
                                 <form action="/homepage.php" method="get">
                                    <ul class="pagination pagination-sm m-0 float-right">
                                       <!-- Previous Page Link -->
                                       <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                                          <a class="page-link" href="?page_inc=<?php echo max(1, $page - 1); ?>&search=<?php echo urlencode($search); ?>">«</a>
                                       </li>
                                       <!-- Page Number Links -->
                                       <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                       <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                          <a class="page-link" href="?page_inc=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>"><?php echo $i; ?></a>
                                       </li>
                                       <?php endfor; ?>
                                       <!-- Next Page Link -->
                                       <li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
                                          <a class="page-link" href="?page_inc=<?php echo min($total_pages, $page + 1); ?>&search=<?php echo urlencode($search); ?>">»</a>
                                       </li>
                                    </ul>
                                 </form>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <h3 class="card-title">My Service Reuqest</h3>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th style="width: 150px;">Ticket No.</th>
                                            <th style="width: 200px;">Request Date</th>
                                            <th style="width: 150px;">Status</th>
                                            <th>Reason</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $limit_ser = 5;
                                    //ตรวจสอบว่ามีการส่งค่า page?= มาหรือยัง ถ้ายังจะเริ่มต้นที่ 1 
                                    $page = isset($_GET['page_ser']) ? (int)$_GET['page_ser'] : 1; // หน้าปัจจุบัน
                                    if($page < 1){
                                      $page = 1;
                                    }
                                     //สำหรับการดึงข้อมูลในหน้าเพจปัจจุบันโดยจะเริ่มรายการไหนเช่น หน้า2 ก็เริ่มรายการที่ 11-20 โดอิงจาก limit_site
                                    $start = ($page - 1) * $limit_ser;
                                    //สำหรับ search
                                    $search = isset($_GET['search_ser']) ? $_GET['search_ser'] : '';
                                    
                                    // คำนวณจำนวนหน้าทั้งหมด
                                    $query_all_ser = $db_connect->prepare("
                                                                              SELECT
                                                                                    COUNT(*)
                                                                              FROM
                                                                                    tbticket tbt
                                                                              INNER JOIN tbcategory tbc ON tbc.Category_ID = tbt.Category_ID
                                                                              INNER JOIN tbemployee tbemp ON tbemp.Emp_ID = tbt.Emp_ID
                                                                              INNER JOIN tbstate tbs ON tbs.State_ID = tbt.State_ID
                                                                              WHERE
                                                                                  tbt.Emp_ID = :Emp_ID
                                                                              AND
                                                                                      tbc.Category_Type = '1'
                                                                              AND   
                                                                                    (
                                                                                        tbt.Ticket_ID  LIKE :search
                                                                              OR 
                                                                                        tbemp.Emp_FirstName LIKE :search
                                                                                    )
                                                                              ORDER BY 
                                                                                    tbt.CreateDateTime desc

                                    ");
                                    $query_all_ser->bindValue(':search', "%$search%", PDO::PARAM_STR);
                                    $query_all_ser->bindParam(':Emp_ID', $_SESSION['Emp_ID']);
                                    $query_all_ser->execute();
                                    $total_records = $query_all_ser->fetchColumn();
                                    //คำนวณจำนวนหน้าทั้งหมดแล้วนำมาหารจำนวนรายการต่อหน้า ใช้ ceil ปัดเศษ
                                    $total_pages = ceil($total_records / $limit_ser);
                                    // ดึงข้อมูลโดยใช้ LIMIT และ OFFSET
                                    $query_ser = $db_connect->prepare("
                                                                           SELECT
                                                                                    tbt.*,
                                                                                    tbemp.*,
                                                                                    tbs.*,
                                                                                    tbtd.*,
                                                                                    tbc.Category_Type as Category_Type
                                                                           FROM
                                                                                    tbticket tbt
                                                                           INNER JOIN tbcategory tbc ON tbc.Category_ID = tbt.Category_ID
                                                                           INNER JOIN tbemployee tbemp ON tbemp.Emp_ID = tbt.Emp_ID
                                                                           INNER JOIN tbstate tbs ON tbs.State_ID = tbt.State_ID
                                                                           INNER JOIN tbticketdetail tbtd ON tbtd.Ticket_ID  = tbt.Ticket_ID 
                                                                           WHERE
                                                                                  tbt.Emp_ID = :Emp_ID
                                                                           AND
                                                                                  tbc.Category_Type = '1'
                                                                           AND   
                                                                                (
                                                                                    tbt.Ticket_ID  LIKE :search
                                                                           OR 
                                                                                    tbemp.Emp_FirstName LIKE :search
                                                                                 )
                                                                           ORDER BY 
                                                                                    tbt.CreateDateTime desc
                                                                           LIMIT
                                                                                    :start, :limit_inc
                                    ");
                                    //ป้องกัน SQL injection
                                    $query_ser->bindParam(':Emp_ID', $_SESSION['Emp_ID']);
                                    $query_ser->bindValue(':search', "%$search%", PDO::PARAM_STR);
                                    $query_ser->bindValue(':start', $start, PDO::PARAM_INT);
                                    $query_ser->bindValue(':limit_inc', $limit_ser, PDO::PARAM_INT);
                                    $query_ser->execute();
                                    ?>
                                    <tbody>
                                        <?php 
                                            if($page > $total_pages){
                                              echo "<tr><td class='align-middle text-center' colspan='4'>Not Found</td></tr>";
                                            }
                                            else{
                                          ?>
                                          <?php 
                                            $no_ser = 0;
                                            while ($show_ser = $query_ser->fetch(PDO::FETCH_ASSOC)) {
                                              $no_ser++;
                                          ?>
                                        <tr>
                                            <td><a href="ticket_detail.php?ticket_id=<?php echo $show_ser['Ticket_ID']; ?>&type=<?php echo $show_ser['Category_Type']; ?>"><?php echo $show_ser['Ticket_ID']; ?></a></td>
                                            <td><?php echo $show_ser['CreateDateTime']; ?></td>
                                            <td><span class="tag tag-success"><?php echo $show_ser['State_Name']; ?></span></td>
                                            <td class="text-break"><?php echo $show_ser['Ticket_Detail']; ?></td>
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table>
                                <div class="card-footer clearfix bg-white">
                                 <form action="/homepage.php" method="get">
                                    <ul class="pagination pagination-sm m-0 float-right">
                                       <!-- Previous Page Link -->
                                       <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                                          <a class="page-link" href="?page_ser=<?php echo max(1, $page - 1); ?>&search_ser=<?php echo urlencode($search); ?>">«</a>
                                       </li>
                                       <!-- Page Number Links -->
                                       <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                       <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                          <a class="page-link" href="?page_ser=<?php echo $i; ?>&search_ser=<?php echo urlencode($search); ?>"><?php echo $i; ?></a>
                                       </li>
                                       <?php endfor; ?>
                                       <!-- Next Page Link -->
                                       <li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
                                          <a class="page-link" href="?page_ser=<?php echo min($total_pages, $page + 1); ?>&search_ser=<?php echo urlencode($search); ?>">»</a>
                                       </li>
                                    </ul>
                                 </form>
                              </div>
                            </div>
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
            var Action_Code_ID = $(event.target).attr('data-id');
          $.ajax({
              type: 'POST',
              url: 'config/event/delete_actioncode.php',
              data: {Action_Code_ID: Action_Code_ID},
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