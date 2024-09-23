<?php 
    session_start();
    //Main
    include 'config/db_connect.php';

    //lange
    include 'lang/lang_en.php';

    //Event
    include 'event/login.php';
    include 'event/logout.php';
    include 'event/add_site.php';
    include 'event/edit_site.php';
    include 'event/add_dep.php';
    include 'event/edit_dep.php';
    include 'event/add_group.php';
    include 'event/edit_group.php';
    include 'event/add_assigngroup.php';
    include 'event/edit_assigngroup.php';
    include 'event/add_position.php';
    include 'event/edit_position.php';
    include 'event/add_status.php';
    include 'event/edit_status.php';
    //config&query
    include 'config/fetch_userdata.php';
?>