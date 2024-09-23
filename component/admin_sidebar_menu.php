            <li class="nav-header">
                <?php echo $text_menu_admin; ?>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-user-cog"></i>
                    <p>
                        <?php echo $text_menu_User_Management ?>
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item ">
                        <a href="pages/charts/chartjs.html" class="nav-link pl-4">
                            <i class="far fa-edit nav-icon"></i>
                            <p><?php echo $text_menu_add_user ?> </p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="list_status.php" class="nav-link pl-4">
                            <i class="far fa-edit nav-icon"></i>
                            <p><?php echo $text_menu_user_status ?> </p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="list_position.php" class="nav-link pl-4">
                            <i class="far fa-edit nav-icon"></i>
                            <p><?php echo $text_menu_position_add ?> </p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-sitemap"></i>
                    <p>
                        <?php echo $text_menu_Depart_Management ?>
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item ">
                        <a href="list_dep.php" class="nav-link pl-4">
                            <i class="far fa-edit nav-icon"></i>
                            <p><?php echo $text_menu_depart_add ?> </p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="list_site.php" class="nav-link pl-4">
                            <i class="far fa-edit nav-icon"></i>
                            <p><?php echo $text_menu_site_add ?> </p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-users-cog"></i>
                    <p>
                        <?php echo $text_menu_assigngroup_Management ?>
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item ">
                        <a href="list_group.php" class="nav-link pl-4">
                            <i class="far fa-edit nav-icon"></i>
                            <p><?php echo $text_menu_group_add ?> </p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="list_assigngroup.php" class="nav-link pl-4">
                            <i class="far fa-edit nav-icon"></i>
                            <p><?php echo $text_menu_assigngroup_add ?> </p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-clipboard"></i>
                    <p>
                        <?php echo $text_menu_ticket_Management ?>
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item ">
                        <a href="list_closencode.php" class="nav-link pl-4">
                            <i class="far fa-edit nav-icon"></i>
                            <p><?php echo $text_menu_Add_Close_Code ?> </p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href=list_actioncode.php" class="nav-link pl-4">
                            <i class="far fa-edit nav-icon"></i>
                            <p><?php echo $text_menu_Add_Action_Code ?> </p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="pages/charts/chartjs.html" class="nav-link pl-4">
                            <i class="far fa-edit nav-icon"></i>
                            <p><?php echo $text_menu_Add_category ?> </p>
                        </a>
                    </li>
                </ul>
            </li>