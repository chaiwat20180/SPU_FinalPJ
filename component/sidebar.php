  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="homepage.php" class="brand-link">
      <img src="asset/image/logo-ico.png" alt="AdminLTE Logo" class="brand-image " style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo $title_webpage; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user  -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="stroage/images/<?php echo $user_data['Emp_Pic'] ?>" class="img-circle elevation-1" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $user_data['Emp_FirstName']. " ". $user_data['Emp_LastName'];  ?></a>
        </div>
      </div>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <?php include 'user_sidebar_menu.php' ?>
            <?php include 'manager_sidebar_menu.php' ?>
            <?php include 'helpdesk_sidebar_menu.php' ?>
            <?php include 'admin_sidebar_menu.php' ?>
        </ul>   
        <div class="user-panel  pb-3 mb-3 d-flex align-items-end flex-column" style="height: 100px;">
            <div class="info mx-auto mt-auto w-100">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <button type="submit" class="d-block btn btn-danger w-100" name="logout" ><?php echo $title_logout ?></button>
                </form>
            </div>
        </div>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>