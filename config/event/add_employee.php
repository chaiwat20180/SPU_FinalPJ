<?php
    if(isset($_POST['addemployee'])){
        $empfname = $_POST['empfname'];
        $emplname = $_POST['emplname'];
        $empgivenname = $_POST['empgivenname'];
        $empemail = $_POST['empemail'];
        $empphone = $_POST['empphone'];
        $empbusinessphone = $_POST['empbusinessphone'];
        $emp_pic = $_FILES['emp_pic'];
        $empusername = $_POST['empusername'];
        $emppassword = $_POST['emppassword'];
        $department = $_POST['department'];
        $position = $_POST['position'];
        $empstatus = $_POST['empstatus'];


        if($empfname == "" || $emplname =="" || $empgivenname == "" || $empemail == ""  || $empusername == "" || $emppassword == "" || $department == "" || $position == "" || $empstatus == ""){
            $_SESSION['status_insert'] = 'nulldata'; 
            header("location:list_employee.php");
        }
        else{
                $check_givenname = $db_connect -> prepare("
                                                        SELECT 
                                                                Emp_GivenName
                                                        FROM
                                                                tbemployee
                                                        WHERE
                                                                Emp_GivenName = :Emp_GivenName
                ");
                $check_givenname -> execute([
                    ':Emp_GivenName' => $empgivenname,
                ]);
                if($check_givenname -> fetchColumn() > 0){
                    $_SESSION['status_insert'] = 'nulldata'; 
                    $_SESSION['custom_alert'] = $alert_Emp_GivenName;
                    header("location:list_employee.php");
                }
                else{
                    $check_email = $db_connect -> prepare("
                                                            SELECT 
                                                                    Emp_Email
                                                            FROM
                                                                    tbemployee
                                                            WHERE
                                                                    Emp_Email = :empemail
                    ");
                    $check_email -> execute([
                        ':empemail' => $empemail,
                    ]);
                    if($check_email -> fetchColumn() > 0){
                        $_SESSION['status_insert'] = 'nulldata'; 
                        $_SESSION['custom_alert'] = $alert_emailduplicate;
                        header("location:list_employee.php");
                    }
                    else{
                        $check_username = $db_connect -> prepare("
                                                            SELECT 
                                                                    Emp_Email
                                                            FROM
                                                                    tbemployee
                                                            WHERE
                                                                    Emp_Username = :Emp_Username
                        ");
                        $check_username -> execute([
                            ':Emp_Username' => $empusername,
                        ]);
                        if($check_username -> fetchColumn() > 0){
                            $_SESSION['status_insert'] = 'nulldata'; 
                            $_SESSION['custom_alert'] = $alert_Username_Duplicate;
                            header("location:list_employee.php");
                        }
                        else{
                            $accrpt_image = array("jpg", "jpeg", "png");
                            $type_image = pathinfo($_FILES['emp_pic']['name'], PATHINFO_EXTENSION);
                            if(!in_array($type_image, $accrpt_image)){
                                $_SESSION['status_insert'] = 'nulldata'; 
                                $_SESSION['custom_alert'] = $alert_pic_wrong;
                                header("location:list_employee.php");
                            }
                            else{
                                $path_upload = "asset/emp_pic/";
                                $renew_name = uniqid('emp_', true) .base64_encode($empgivenname).base64_encode(date("Ymd_His")). '.' . $type_image;
                                $upload_file = $path_upload . $renew_name;
                                if (move_uploaded_file($emp_pic['tmp_name'], $upload_file)) {
                                    $file_path = 'asset/emp_pic/'."emp_66f845c89c1089.36327256YWZAZ21haWwuY29tMjAyNDA5MjhfMjAwNzA0.png";
                                    unlink($file_path);
                                    echo "<script>alert('suc');</script>";
                                } else {
                                    // Handle upload error
                                    echo "<script>alert('error');</script>";
                                }
                            }
                        }
                    }
                }
        }
}
?>