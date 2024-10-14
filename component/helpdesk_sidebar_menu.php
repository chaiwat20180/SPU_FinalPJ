<?php

        $query_check_permission_support = $db_connect -> prepare("
                                                                SELECT  
                                                                        tbm.Emp_ID,
                                                                        tbag.Group_ID,
                                                                        tbg.Group_Name as Group_Name
                                                                FROM
                                                                        tbemployee tbm
                                                                INNER  JOIN tbassign_group tbag ON tbag.Emp_ID = tbm.Emp_ID
                                                                INNER  JOIN tbgroup tbg ON tbg.Group_ID = tbag.Group_ID
                                                                WHERE 
                                                                        tbag.Emp_ID = :Emp_ID
                                                                AND
                                                                        tbag.IsDeleted = '0'
                                                                AND (
                                                                        tbg.Group_Admin = '1'
                                                                OR
                                                                        tbg.Group_Admin = '2'
                                                                    )

                ");
        $query_check_permission_support -> bindParam(':Emp_ID', $_SESSION['Emp_ID']);
        $query_check_permission_support -> execute();
        $fetch_check_user_permission_support = $query_check_permission_support->fetchAll();
        if($query_check_permission_support -> rowCount() > 0 ){
?> 
 <li class="nav-header">
                <?php echo $text_Menu_helpdesk ?>
            </li>
            <li class="nav-item">
                <a href="pages/gallery.html" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        <?php echo $text_menu_Dashboard ?>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="pages/gallery.html" class="nav-link">
                    <i class="nav-icon fas fa-exclamation-triangle"></i>
                    <p>
                        <?php echo $text_Menu_helpdesk_ticket_inc ?>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="pages/gallery.html" class="nav-link">
                    <i class="nav-icon fas fa-tasks"></i>
                    <p>
                        <?php echo $text_Menu_helpdesk_ticket_ser ?>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="pages/gallery.html" class="nav-link">
                    <i class="nav-icon fas fa-exclamation-triangle"></i>
                    <p>
                        <?php echo $text_Menu_helpdesk_ticket_un_inc ?>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="pages/gallery.html" class="nav-link">
                    <i class="nav-icon fas fa-tasks"></i>
                    <p>
                        <?php echo $text_Menu_helpdesk_ticket_un_ser ?>
                    </p>
                </a>
            </li>
<?php
        }
?>