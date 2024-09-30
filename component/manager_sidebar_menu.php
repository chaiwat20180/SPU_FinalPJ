<?php

        $query_check_permission_manager = $db_connect -> prepare("
                                                                SELECT  
                                                                        tbm.Emp_ID,
                                                                        tbd.*
                                                                FROM
                                                                        tbemployee tbm
                                                                LEFT JOIN tbdepartment tbd ON tbd.Dep_ID = tbm.Dep_ID
                                                                LEFT JOIN tbassign_group tbag ON tbag.Emp_ID = tbm.Emp_ID
                                                                LEFT JOIN tbgroup tbg ON tbg.Group_ID = tbag.Group_ID
                                                                WHERE 
                                                                        tbm.Emp_ID = :Emp_ID
                                                                AND
                                                                        tbm.IsDeleted = '0'
                                                                AND 
                                                                    (
                                                                        tbd.Dep_Manager = :Emp_ID
                                                                OR 
                                                                        tbg.Group_Admin = '2'
                                                                    )


                ");
        $query_check_permission_manager -> bindParam(':Emp_ID', $_SESSION['Emp_ID']);
        $query_check_permission_manager -> execute();
        $fetch_check_user_permission_manager = $query_check_permission_manager->fetchAll();
        if($query_check_permission_manager -> rowCount() > 0 ){
            $query_count_wait_approve = $db_connect -> prepare("
                                                                SELECT 
                                                                        tbt.*
                                                                FROM  
                                                                        tbticket tbt
                                                                LEFT JOIN tbemployee tbm ON tbm.Emp_ID = tbt.Emp_ID
                                                                LEFT JOIN tbgroup tbg ON tbg.Group_ID = tbt.Group_ID
                                                                LEFT JOIN tbassign_group tbag ON tbag.Group_ID = tbt.Group_ID
                                                                LEFT JOIN tbcategory tbc ON tbc.Category_ID = tbt.Category_ID
                                                                LEFT JOIN tbdepartment tbd ON tbd.Dep_ID = tbm.Dep_ID
                                                                WHERE 
                                                                    tbt.State_ID = 'ST06'
                                                                AND
                                                                    tbc.Category_Type = '1'
                                                                AND (
                                                                    tbt.Group_ID IN (
                                                                        SELECT Group_ID 
                                                                        FROM tbassign_group 
                                                                        WHERE Emp_ID = :Emp_ID
                                                                    )
                                                                    OR
                                                                    tbm.Dep_ID = (
                                                                        SELECT Dep_ID 
                                                                        FROM tbemployee 
                                                                        WHERE Emp_ID = :Emp_ID
                                                                    )
                                                                        )
                                                                


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