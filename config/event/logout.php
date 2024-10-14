<?php 
    if(isset($_POST['logout'])){
        SESSION_DESTROY();
        header("location:index.php");
    }
?>