<?php
session_start();
if(isset($_SESSION['status_insert'])) {
    unset($_SESSION['status_insert']); // Unset the session variable
    echo 'Session variable unset successfully'; // Response back to AJAX
} else {
    echo 'Session variable not found or already unset'; // Alternative response
}
?>