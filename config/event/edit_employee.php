<?php
    if(isset($_POST['editemployee'])){
        $emp_id = $_GET['emp_id'];
        $empfname = $_POST['empfname'];
        $emplname = $_POST['emplname'];
        $empphone = $_POST['empphone'];
        $empbusinessphone = $_POST['empbusinessphone'];
        $emppassword = $_POST['emppassword'];
        $department = $_POST['department'];
        $position = $_POST['position'];
        $empstatus = $_POST['empstatus'];
        $emp_pic = $_FILES['emp_pic'];
        $options = [
            'cost' => 12,
        ];
        $hash_password = password_hash($emppassword, PASSWORD_BCRYPT, $options);
        if (!isset($emp_id) || $emp_id == "") {
            header("location:list_employee.php");
            exit();  
        }
        else{
            if  (
                    $empfname == "" ||
                    $emplname == "" ||
                    $department == "" ||
                    $position == "" ||
                    $empstatus == "" 
                ){
                    $_SESSION['status_insert'] = 'nulldata'; 
                    $_SESSION['custom_alert'] = $alert_nullData;
            }
            else{
                if($emp_pic['error'] == UPLOAD_ERR_OK ){
                    $query_check_image = $db_connect ->prepare("
                                                                    SELECT 
                                                                            Emp_Pic,
                                                                            Emp_GivenName

                                                                    FROM 
                                                                            tbemployee
                                                                    WHERE 
                                                                            Emp_ID = :Emp_ID
                    ");
                    if ($query_check_image->execute([
                        ':Emp_ID' => $emp_id,
                    ])) {
                        $accrpt_image = array("jpg", "jpeg", "png");
                        $type_image = pathinfo($_FILES['emp_pic']['name'], PATHINFO_EXTENSION);
                        if(!in_array($type_image, $accrpt_image)){
                            $_SESSION['status_insert'] = 'nulldata'; 
                            $_SESSION['custom_alert'] = $alert_pic_wrong;
                            header("location:list_employee.php");
                        }
                        else{
                            $fetch_emp = $query_check_image -> fetch(PDO::FETCH_ASSOC);
                            
                            // echo $fetch_max_group_id['Emp_Pic'];
                            $path_upload = "asset/emp_pic/";
                            $renew_name = uniqid('emp_', true) .hash('sha256',$fetch_emp['Emp_ID']). '.' . $type_image;
                            $upload_file = $path_upload . $renew_name;
                            if (!is_dir($path_upload) || !is_writable($path_upload)) {
                                echo "<script>alert('Directory does not exist or is not writable');</script>";
                                exit;
                            }
                            list($original_width, $original_height) = getimagesize($emp_pic['tmp_name']);

                            // กำหนดขนาดที่ต้องการ (เช่น 300x300)
                            $new_width = 300;
                            $new_height = 300;
                            // หาความกว้างและความสูงของการครอบ
                            $crop_size = min($original_width, $original_height);
                            $crop_x = ($original_width - $crop_size) / 2;
                            $crop_y = ($original_height - $crop_size) / 2;

                            // สร้างภาพใหม่ด้วยขนาดที่ต้องการ enable extension=gd ในไฟล์ php.ini ก่อนโปรแกรม xampp
                            $new_image = imagecreatetruecolor($new_width, $new_height);
                            
                            // โหลดภาพต้นฉบับตามประเภทไฟล์
                            switch ($type_image) {
                                case 'jpeg':
                                case 'jpg':
                                    $source_image = imagecreatefromjpeg($emp_pic['tmp_name']);
                                    break;
                                case 'png':
                                    $source_image = imagecreatefrompng($emp_pic['tmp_name']);
                                    imagealphablending($new_image, false);
                                    imagesavealpha($new_image, true);
                                    break;
                                case 'gif':
                                    $source_image = imagecreatefromgif($emp_pic['tmp_name']);
                                    break;
                                default:
                                    echo "<script>alert('Unsupported image type');</script>";
                                    exit;
                            }
                            // ครอบและปรับขนาดภาพ
                            imagecopyresampled(
                                $new_image,          // ภาพปลายทาง
                                $source_image,       // ภาพต้นฉบับ
                                0, 0,                // พิกัดของภาพปลายทาง
                                $crop_x, $crop_y,    // พิกัดเริ่มต้นของภาพที่จะครอบ
                                $new_width, $new_height,  // ขนาดของภาพปลายทาง
                                $crop_size, $crop_size    // ขนาดของภาพที่ครอบ
                            );
                            // ปรับขนาดภาพ
                            // imagecopyresampled($new_image, $source_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);

                            // บันทึกภาพใหม่
                            switch ($type_image) {
                                case 'jpeg':
                                case 'jpg':
                                    imagejpeg($new_image, $upload_file);
                                    break;
                                case 'png':
                                    imagepng($new_image, $upload_file);
                                    break;
                                case 'gif':
                                    imagegif($new_image, $upload_file);
                                    break;
                            }

                            imagedestroy($source_image);
                            imagedestroy($new_image);
                            if (!file_exists($upload_file)) {
                                $_SESSION['status_insert'] = 'nulldata'; 
                                $_SESSION['custom_alert'] = $alert_error_upload_img;
                            } else {
                                //delete_old_image
                                @$file_path = 'asset/emp_pic/' . $fetch_emp['Emp_Pic'];
                                @unlink($file_path);

                                //Update_new_image
                                $query_update = $db_connect -> prepare("
                                                                            UPDATE
                                                                                    tbemployee
                                                                            SET
                                                                                    Emp_FirstName = :Emp_FirstName,
                                                                                    Emp_LastName = :Emp_LastName,
                                                                                    Emp_Phone = :Emp_Phone,
                                                                                    Emp_BusinessPhone = :Emp_BusinessPhone,
                                                                                    Emp_Pic = :Emp_Pic,
                                                                                    Emp_Password = :Emp_Password,
                                                                                    Dep_ID = :Dep_ID,
                                                                                    Position_ID = :Position_ID,
                                                                                    Status_ID = :Status_ID,
                                                                                    UpdatedBy = :UpdatedBy
                                                                            WHERE 
                                                                                    Emp_ID =:Emp_ID
                                ");
                                if ($query_update->execute([
                                    ':Emp_ID' => $emp_id,
                                    ':Emp_FirstName' => $empfname,
                                    ':Emp_LastName' => $emplname,
                                    ':Emp_Phone' => $empphone,
                                    ':Emp_BusinessPhone' => $empbusinessphone,
                                    ':Emp_Pic' => $renew_name,
                                    ':Emp_Password' => $hash_password,
                                    ':Dep_ID' => $department,
                                    ':Position_ID' => $position,
                                    ':Status_ID' => $empstatus,
                                    ':UpdatedBy' => $_SESSION['Emp_ID']
                                ])) {
                                $_SESSION['status_insert'] = 'true'; 
                                    header("location:list_employee.php");
                                    exit();
                                } else {
                                $_SESSION['status_insert'] = 'false'; 
                                    header("location:list_employee.php");
                                    exit();
                                }
                            }
                        }
                        
                    } else {
                    $_SESSION['status_insert'] = 'false'; 
                        header("location:list_employee.php");
                        exit();
                    }
                }
                else{
                    if($emppassword == ""){
                        $query_update = $db_connect -> prepare("
                                                                UPDATE
                                                                        tbemployee
                                                                SET
                                                                        Emp_FirstName = :Emp_FirstName,
                                                                        Emp_LastName = :Emp_LastName,
                                                                        Emp_Phone = :Emp_Phone,
                                                                        Emp_BusinessPhone = :Emp_BusinessPhone,
                                                                        Dep_ID = :Dep_ID,
                                                                        Position_ID = :Position_ID,
                                                                        Status_ID = :Status_ID,
                                                                        UpdatedBy = :UpdatedBy
                                                                WHERE 
                                                                        Emp_ID =:Emp_ID
                        ");
                        if ($query_update->execute([
                            ':Emp_ID' => $emp_id,
                            ':Emp_FirstName' => $empfname,
                            ':Emp_LastName' => $emplname,
                            ':Emp_Phone' => $empphone,
                            ':Emp_BusinessPhone' => $empbusinessphone,
                            ':Dep_ID' => $department,
                            ':Position_ID' => $position,
                            ':Status_ID' => $empstatus,
                            ':UpdatedBy' => $_SESSION['Emp_ID']
                        ])) {
                        $_SESSION['status_insert'] = 'true'; 
                            header("location:list_employee.php");
                            exit();
                        } else {
                        $_SESSION['status_insert'] = 'false'; 
                            header("location:list_employee.php");
                            exit();
                        }
                    }
                    else{
                        $query_update = $db_connect -> prepare("
                                                                UPDATE
                                                                        tbemployee
                                                                SET
                                                                        Emp_FirstName = :Emp_FirstName,
                                                                        Emp_LastName = :Emp_LastName,
                                                                        Emp_Phone = :Emp_Phone,
                                                                        Emp_BusinessPhone = :Emp_BusinessPhone,
                                                                        Emp_Password = :Emp_Password,
                                                                        Dep_ID = :Dep_ID,
                                                                        Position_ID = :Position_ID,
                                                                        Status_ID = :Status_ID,
                                                                        UpdatedBy = :UpdatedBy
                                                                WHERE 
                                                                        Emp_ID =:Emp_ID
                        ");
                        if ($query_update->execute([
                            ':Emp_ID' => $emp_id,
                            ':Emp_FirstName' => $empfname,
                            ':Emp_LastName' => $emplname,
                            ':Emp_Phone' => $empphone,
                            ':Emp_BusinessPhone' => $empbusinessphone,
                            ':Emp_Password' => $hash_password,
                            ':Dep_ID' => $department,
                            ':Position_ID' => $position,
                            ':Status_ID' => $empstatus,
                            ':UpdatedBy' => $_SESSION['Emp_ID']
                        ])) {
                        $_SESSION['status_insert'] = 'true'; 
                            header("location:list_employee.php");
                            exit();
                        } else {
                        $_SESSION['status_insert'] = 'false'; 
                            header("location:list_employee.php");
                            exit();
                        }
                    }
                }
            }
        }













}
?>