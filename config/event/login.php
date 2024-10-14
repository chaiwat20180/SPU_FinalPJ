<?php
    if(isset($_POST['sigin'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $check_user = $db_connect -> prepare("
                                                SELECT  
                                                        Emp_ID,
                                                        Emp_Username,
                                                        Emp_Password
                                                FROM
                                                        tbemployee
                                                WHERE
                                                        Emp_Username = :username
        ");
        $check_user -> bindParam(':username', $username);
        $check_user -> execute();
        $fetch_check_user = $check_user -> fetch(PDO::FETCH_ASSOC);
        if($check_user -> rowCount() > 0 ){
            if(password_verify($password,$fetch_check_user['Emp_Password'])){
                $_SESSION['Emp_ID'] = $fetch_check_user['Emp_ID'];
                header("location:homepage.php");
            }
            else{
                echo "<script>alert('".$alert_login."'); window.location.href='index.php';</script>";
            }
        }
        else{
            echo "<script>alert('".$alert_login."'); window.location.href='index.php';</script>";    
        }
        
    }
?>