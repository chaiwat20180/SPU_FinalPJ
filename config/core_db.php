<?php 
    session_start();
    //Main
    include 'config/db_connect.php';

    //lange
    include 'lang/lang_en.php';

    //Event
    include 'event/login.php';
    include 'event/addsite.php';

    //config&query
    include 'config/fetch_userdata.php';
?>