<?php

        $query_check_permission_manager = $db_connect -> prepare("
                                                                    SELECT 
                                                                    tbemp.Emp_ID,
                                                                    tbemp.Emp_FirstName,
                                                                    tbemp.Emp_LastName,
                                                                    tbemp.Dep_ID AS emp_dep,
                                                                    manager.Dep_ID AS manager_dep,
                                                                    tbd.Dep_Name,
                                                                    manager.Emp_ID AS Manager,
                                                                    tbg.Group_ID,
                                                                    tbg.Group_Name,
                                                                    tbg.Group_Admin
                                                                FROM
                                                                    tbemployee tbemp
                                                                INNER JOIN tbdepartment tbd ON tbd.Dep_ID = tbemp.Dep_ID
                                                                INNER JOIN tbemployee manager ON manager.Emp_ID = tbd.Dep_Manager
                                                                LEFT JOIN tbassign_group tbag ON tbag.Emp_ID = tbemp.Emp_ID
                                                                LEFT JOIN tbgroup tbg ON tbg.Group_ID = tbag.Group_ID
                                                                WHERE 
                                                                    manager.Emp_ID = :Emp_ID
                                                                    AND tbemp.IsDeleted = '0'
                                                                    AND (
                                                                        tbg.Group_ID IS NULL 
                                                                        OR tbg.Group_ID IN (
                                                                            SELECT tbag_inner.Group_ID 
                                                                            FROM tbassign_group tbag_inner
                                                                            LEFT JOIN tbgroup tbg_inner ON tbg_inner.Group_ID = tbag_inner.Group_ID
                                                                            WHERE
                                                                                tbag_inner.Emp_ID = :Emp_ID
                                                                                AND tbg_inner.Group_Admin = '2'
                                                                                AND tbag_inner.isDeleted = '0'
                                                                        )
                                                                    )
    

                ");
        $query_check_permission_manager -> bindParam(':Emp_ID', $_SESSION['Emp_ID']);
        $query_check_permission_manager -> execute();
        $fetch_check_user_permission_manager = $query_check_permission_manager->fetch();
        if (    $fetch_check_user_permission_manager && 
                ($_SESSION['Emp_ID'] == $fetch_check_user_permission_manager['Manager'] || 
                $fetch_check_user_permission_manager['Group_Admin'] == '2')
            ) { 
            IF($fetch_check_user_permission_manager['Group_Admin'] == '2'){
                $query_count_wait_approve = $db_connect -> prepare("
                                                               SELECT 
                                                                    COUNT(DISTINCT(tbt.Ticket_ID)) as Count_Ticket
                                                                FROM 
                                                                    tbticket tbt
                                                                INNER JOIN tbemployee emp ON emp.Emp_ID = tbt.Emp_ID
                                                                INNER JOIN tbdepartment dep ON dep.Dep_ID = emp.Dep_ID
                                                                INNER JOIN tbgroup tbg ON tbg.Group_ID = tbt.Group_ID
                                                                INNER JOIN tbassign_group tbag ON tbag.Group_ID = tbg.Group_ID
                                                                WHERE
                                                                        tbt.State_ID = 'ST06'
                                                                AND
                                                                        tbag.isDeleted = '0'

                ");
            }
            else{
                $query_count_wait_approve = $db_connect->prepare("
                                                                    SELECT 
                                                                        COUNT(tbt.Ticket_ID) as Count_Ticket
                                                                    FROM 
                                                                        tbticket tbt
                                                                    INNER JOIN tbemployee emp ON emp.Emp_ID = tbt.Emp_ID
                                                                    INNER JOIN tbdepartment dep ON dep.Dep_ID = emp.Dep_ID
                                                                    INNER JOIN tbgroup tbg ON tbg.Group_ID = tbt.Group_ID
                                                                    WHERE
                                                                        (
                                                                            dep.Dep_Manager = :Emp_ID
                                                                            AND tbt.State_ID = 'ST06'
                                                                        )
                                                                        OR 
                                                                        (
                                                                            tbg.Group_ID IN (
                                                                                SELECT tbag.Group_ID 
                                                                                FROM tbassign_group tbag 
                                                                                INNER JOIN tbgroup tbg ON tbg.Group_ID = tbag.Group_ID
                                                                                WHERE tbag.Emp_ID = :Emp_ID
                                                                                AND tbag.IsDeleted = '0'
                                                                                AND tbg.Group_Admin = '2'
                                                                            )
                                                                        )

                ");
                $query_count_wait_approve -> bindParam(':Emp_ID', $_SESSION['Emp_ID']);
            }
            
            @$query_count_wait_approve -> execute();
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