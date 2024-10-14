<?php

    include 'config/core_db.php';
    if(@$_SESSION['Emp_ID'] != "" && $_GET['type'] != "" && $_GET['catgory_id'] != "" ){
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

<body class="hold-transition sidebar-mini layout-fixed" style="background-color: #f9f4f3;">
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
              <h1>Request Menu</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <div class="container-fluid p-4 bg-white rounded">
            <div class="container">
            <button class="btn btn-danger mb-4" onclick="history.back()"><i class="fas fa-reply"></i> Back</button>
              <div class="row">
                <div class="col-lg-12 border p-4 rounded">
                  <?php
                  $get_id = $_GET['catgory_id'];
                  $get_type = $_GET['type'];
                  if($get_type == 0){
                        $query_tyepe_ticket = $db_connect -> prepare("
                                                                        SELECT 
                                                                                * 
                                                                        FROM
                                                                                tbcategory
                                                                        WHERE 
                                                                                Category_ID = :Get_ID
                                                                        AND
                                                                                Category_Type = :Get_Type
                                                                        AND
                                                                                IsDeleted = '0'
                        ");
                  }
                  elseif($get_type == 1){
                        $query_tyepe_ticket = $db_connect -> prepare("
                                                                        SELECT 
                                                                                * 
                                                                        FROM
                                                                                tbcategory
                                                                        WHERE 
                                                                                Category_ID = :Get_ID
                                                                        AND
                                                                                Category_Type = :Get_Type
                                                                        AND
                                                                                IsDeleted = '0'
                        ");
                  }
                  else{
                        header("location:homepage.php");
                  }
                  $query_tyepe_ticket->bindParam(':Get_ID', $get_id);
                  $query_tyepe_ticket->bindParam(':Get_Type', $get_type);
                  $query_tyepe_ticket->execute();
                  $show_TicketData = $query_tyepe_ticket->fetch(PDO::FETCH_ASSOC);
                  ?>
                  <div class="col-lg-12 mb-4">
                    <div class="row">
                      <div class="col-md-12 col-lg-6 text-center">
                        <img class="card-img-top img-thumbnail emp_pic p-4" src="../asset/category_pic/<?php echo $show_TicketData['Category_Pic']; ?>"  alt="Category Pic" style="border: none; box-shadow:none;">
                      </div>
                      <div class="col-md-12 col-lg-6 p-4">
                        <div class="card-body">
                          <h5 class="card-title"><strong><?php echo $show_TicketData['Category_Name']; ?></strong></h5><br>
                          <p class="card-text text-break" ><?php echo $show_TicketData['Category_Description']; ?></p><br>
                        </div>
                      </div>
                    </div>  
                  </div>
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                  <?php
                    $query_user_req_ticket = $db_connect -> prepare("
                                                                        SELECT 
                                                                                * 
                                                                        FROM
                                                                                tbemployee
                                                                        WHERE 
                                                                                Emp_ID = :Emp_ID
                                                                        AND
                                                                                IsDeleted = '0'
                      ");
                      $query_user_req_ticket->bindParam(':Emp_ID', $_SESSION['Emp_ID']);
                      $query_user_req_ticket->execute();
                      $show_user_req_ticket = $query_user_req_ticket->fetch(PDO::FETCH_ASSOC);
                    ?>
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label for="RequestFor"><?php echo $text_request_for ?></label>
                          <input type="text" class="form-control" id="RequestFor" placeholder="<?php echo $show_user_req_ticket['Emp_FirstName']." ".$show_user_req_ticket['Emp_LastName'] ?>" disabled>
                        </div>
                      </div>
                      <?php
                          if($get_type == 1){
                            $query_user_manager_ticket = $db_connect -> prepare("
                                                                                  SELECT 
                                                                                          tbemp.Emp_FirstName as Manager_Firstname,
                                                                                          tbemp.Emp_LastName as Manager_LastName,
                                                                                          tbemp.Emp_ID as Manager_ID
                                                                                  FROM 
                                                                                          tbdepartment tbdep
                                                                                          INNER JOIN tbemployee tbe ON tbe.Dep_ID = tbdep.Dep_ID
                                                                                          INNER JOIN tbemployee tbemp ON tbemp.Emp_ID = tbdep.Dep_Manager
                                                                                  WHERE 
                                                                                          tbe.Emp_ID = :Emp_ID;
                            ");
                            $query_user_manager_ticket->bindParam(':Emp_ID', $_SESSION['Emp_ID']);
                            $query_user_manager_ticket->execute();
                            $show_user_manager_ticket = $query_user_manager_ticket->fetch(PDO::FETCH_ASSOC);
                      ?>
                            <div class="form-group">
                              <label for="exampleFormControlSelect1"><?php echo $text_request_Manager ?></label>
                             <select class="form-control" id="manager" name="manager" disabled >
                                <option value="<?php echo $show_user_manager_ticket['Manager_ID']; ?>"><?php echo $show_user_manager_ticket['Manager_Firstname']." ".$show_user_manager_ticket['Manager_LastName'] ?></option>
                              </select>
                            </div>
                      <?php
                          }
                      ?>
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label for="exampleFormControlSelect1"><?php echo $text_add_category_code ?></label>
                          <select class="form-control" id="category" disabled>
                            <option value="<?php echo $show_TicketData['Category_ID']; ?>"><?php echo $show_TicketData['Category_Name']; ?></option>
                          </select>
                        </div>
                        </div>
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label for="exampleFormControlSelect1"><?php echo $text_request_priority ?></label>
                          <select class="form-control" id="priority" name="priority">
                          <?php 
                              $query_all_Priority_value = $db_connect->prepare("
                                  SELECT
                                          Priority_ID  ,
                                          Priority_Name
                                  FROM
                                          tbpriority 
                                  WHERE
                                          IsDeleted = '0' 
                                  Order by
                                          Priority_ID 
                                          Desc
                              ");
                              $query_all_Priority_value->execute();
                              while ($select_all_priority_value = $query_all_Priority_value->fetch(PDO::FETCH_ASSOC)) {
                              ?>
                              <option value="<?php echo @$select_all_priority_value['Priority_ID']; ?>"><?php echo @$select_all_priority_value['Priority_Name'];?></option>
                              <?php 
                              }
                              ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label for="exampleFormControlSelect1"><?php echo $text_menu_assigngroup_Management ?></label>
                          <select class="form-control select2" style="width: 100%;"  id="group" name="group">
                          <?php 
                              $query_all_group_value = $db_connect->prepare("
                                  SELECT
                                          Group_ID ,
                                          Group_Name
                                  FROM
                                          tbgroup 
                                  WHERE
                                          IsDeleted = '0' 
                                  Order by
                                          Group_ID 
                                          Desc
                              ");
                              $query_all_group_value->execute();
                              while ($select_all_group_value = $query_all_group_value->fetch(PDO::FETCH_ASSOC)) {
                              ?>
                              <option value="<?php echo @$select_all_group_value['Group_ID']; ?>"><?php echo @$select_all_group_value['Group_Name'];?></option>
                              <?php 
                              }
                              ?>
                          </select>
                        </div>  
                      </div> 
                      <?php
                            if($get_type == 1){ 
                      ?>
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label for="RequestFor"><?php echo $text_request_customer ?></label>
                          <input type="text" class="form-control" id="RequestFor" name="customercomment" placeholder="Customer" >
                        </div>
                      </div>

                      <?php } ?> 
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label for="Description"><?php echo $text_request_Description; ?></label>
                          <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label for="Description"><?php echo $text_request_AdditionalComment; ?></label>
                          <textarea class="form-control" name="additionalcomment" rows="3"></textarea>
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary" name="submitrequest" >Submit</button>
                        </div>
                      </div>
                  </form>
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
    <!-- Select2 -->
    <script src="plugins/select2/js/select2.full.min.js"></script>
      <script>
         $(function () {
           $('.select2').select2({})
         });
      </script>
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