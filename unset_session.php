<?php
session_start();
if(isset($_SESSION['status_insert'])) {
    unset($_SESSION['status_insert']); // Unset the session variable
}
?>