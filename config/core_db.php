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

    //config&query
    include 'config/fetch_userdata.php';
?>