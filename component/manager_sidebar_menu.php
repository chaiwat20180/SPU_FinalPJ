<?php

        $query_check_permission_manager = $db_connect -> prepare("
                                                                SELECT 
                                                                                tbemp.Emp_ID,
                                                                                tbemp.Emp_FirstName ,
                                                                                tbemp.Emp_LastName,
                                                                                tbemp.Dep_ID emp_dep,
                                                                                manager.Dep_ID as manager_dep,
                                                                                tbd.Dep_Name,
                                                                                manager.Emp_ID as Manager,
                                                                                tbg.Group_ID,
                                                                                tbg.Group_Name,
                                                                                tbg.Group_Admin
                                                                FROM
                                                                                tbemployee tbemp
                                                                LEFT JOIN tbdepartment tbd ON tbd.Dep_ID = tbemp.Dep_ID
                                                                LEFT JOIN tbemployee manager ON manager.Emp_ID = tbd.Dep_Manager	
                                                                LEFT JOIN tbassign_group tbag ON tbag.Emp_ID = tbemp.Emp_ID
                                                                LEFT JOIN tbgroup tbg ON tbg.Group_ID = tbag.Group_ID
                                                                WHERE 
                                                                            (tbemp.Emp_ID = :Emp_ID AND tbemp.IsDeleted = '0')
    															OR 
                                                                			(tbemp.Emp_ID = :Emp_ID AND tbg.Group_Admin = '2');


                ");
        $query_check_permission_manager -> bindParam(':Emp_ID', $_SESSION['Emp_ID']);
        $query_check_permission_manager -> execute();
        $fetch_check_user_permission_manager = $query_check_permission_manager->fetch();
        if(
                $fetch_check_user_permission_manager['Emp_ID'] == $fetch_check_user_permission_manager['Manager'] || 
                $fetch_check_user_permission_manager['Group_Admin'] == '2'  &&
                $fetch_check_user_permission_manager['emp_dep'] == $fetch_check_user_permission_manager['manager_dep']
        ){ 
            $query_count_wait_approve = $db_connect -> prepare("
                                                               SELECT 
                                                                    COUNT(tbt.Ticket_ID) as Count_Ticket
                                                                FROM  
                                                                    tbticket tbt
                                                                LEFT JOIN tbemployee tbemp ON tbemp.Emp_ID = tbt.Emp_ID
                                                                LEFT JOIN tbdepartment tbd ON tbd.Dep_ID = tbemp.Dep_ID
                                                                LEFT JOIN tbemployee manager ON manager.Emp_ID = tbd.Dep_Manager
                                                                LEFT JOIN tbdepartment managerDept ON managerDept.Dep_ID = manager.Dep_ID
                                                                LEFT JOIN tbgroup tbg ON tbg.Group_ID = tbt.Group_ID
                                                                LEFT JOIN tbassign_group tbag ON tbag.Group_ID = tbg.Group_ID

                                                                WHERE
                                                                        manager.Emp_ID = :Emp_ID



                ");
            $query_count_wait_approve -> bindParam(':Emp_ID', $_SESSION['Emp_ID']);
            $query_count_wait_approve -> execute();
            $fetch_check_count_wait_approve = $query_count_wait_approve->fetch(PDO::FETCH_ASSOC);
?> 

<li class="nav-item">
                <a href="pages/gallery.html" class="nav-link">
                    <i class="nav-icon fas fa-file-signature"></i>
                    <p>
                        <?php echo $text_menu_wait_approve ?>
                        <span class="badge badge-info right"><?php echo $fetch_check_count_wait_approve['Count_Ticket']; ?></span>
                    </p>
                </a>
            </li>
<?php 
}
?>