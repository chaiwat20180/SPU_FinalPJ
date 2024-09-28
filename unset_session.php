<?php
session_start();
if(isset($_SESSION['status_insert'])) {
    unset($_SESSION['status_insert']); 
    unset($_SESSION['custom_alert']); 
}
?>