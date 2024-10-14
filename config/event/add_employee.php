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
        $options = [
            'cost' => 12,
        ];
        $hash_password = password_hash($emppassword, PASSWORD_BCRYPT, $options);

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
                                $renew_name = uniqid('emp_', true) .hash('sha256',date("h:i:sa")). '.' . $type_image;
                                $upload_file = $path_upload . $renew_name;

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

                                // ตรวจสอบการอัพโหลดและลบไฟล์เก่าถ้ามี
                                if (!file_exists($upload_file)) {
                                    $_SESSION['status_insert'] = 'nulldata'; 
                                    $_SESSION['custom_alert'] = $alert_error_upload_img;
                                    header("location:list_employee.php");
                                } else {

                                    // delete files
                                    // $file_path = 'asset/emp_pic/' . "emp_66f91478884835.66543421dGV0QGdtYWlsLmNvbQ==MjAyNDA5MjlfMTA0ODU2.png";
                                    // unlink($file_path);
                                    $query_max_en = $db_connect-> prepare("
                                                    SELECT 
                                                            MAX(CAST(SUBSTRING(Emp_ID, 3) AS INT)) as Max_en_ID
                                                    FROM 
                                                            tbemployee
                                    ");
                                    $query_max_en -> execute();
                                    $fetch_max_en_id = $query_max_en -> fetch(PDO::FETCH_ASSOC);
                                    $max_en_id = $fetch_max_en_id['Max_en_ID'];
                                    if($max_en_id === NULL || $max_en_id == 0){
                                        $max_en_id = "00000001";
                                        $new_en_id = "th".$max_en_id;
                                        $insert_query = $db_connect -> prepare("
                                                                                    INSERT INTO 
                                                                                                    tbemployee
                                                                                    VALUES
                                                                                                (
                                                                                                    :Emp_ID,
                                                                                                    :Emp_FirstName,
                                                                                                    :Emp_LastName,
                                                                                                    :Emp_GivenName,
                                                                                                    :Emp_Email,
                                                                                                    :Emp_Phone,
                                                                                                    :Emp_BusinessPhone,
                                                                                                    :Emp_Pic,
                                                                                                    :Emp_Username,
                                                                                                    :Emp_Password,
                                                                                                    :Dep_ID,
                                                                                                    :Position_ID,
                                                                                                    :Status_ID,
                                                                                                    NULL,
                                                                                                    :Emp_ID_Update,
                                                                                                    NOW(),
                                                                                                    '0'
                                                                                                )
                                        ");
                                        if ($insert_query->execute([
                                            ':Emp_ID' => $new_en_id,
                                            ':Emp_FirstName' => $empfname,
                                            ':Emp_LastName' => $emplname,
                                            ':Emp_GivenName' => $empgivenname,
                                            ':Emp_Email' => $empemail,
                                            ':Emp_Phone' => $empphone,
                                            ':Emp_BusinessPhone' => $empbusinessphone,
                                            ':Emp_Pic' => $renew_name,
                                            ':Emp_Username' => $empusername,
                                            ':Emp_Password' => $hash_password,
                                            ':Dep_ID' => $department,
                                            ':Position_ID' => $position,
                                            ':Status_ID' => $empstatus,
                                            ':Emp_ID_Update' => $_SESSION['Emp_ID']
                                        ])) {
                                            $_SESSION['status_insert'] = 'true'; 
                                            header("location:list_employee.php");
                                        } else {
                                            $_SESSION['status_insert'] = 'false'; 
                                            header("location:list_employee.php");
                                        }
                                    }
                                    else{
                                        $max_en_id = $max_en_id + 1;
                                        $new_en_id = "th" . str_pad($max_en_id, 8, '0', STR_PAD_LEFT);
                                        $insert_query = $db_connect -> prepare("
                                                                                    INSERT INTO 
                                                                                                    tbemployee
                                                                                    VALUES
                                                                                                (
                                                                                                    :Emp_ID,
                                                                                                    :Emp_FirstName,
                                                                                                    :Emp_LastName,
                                                                                                    :Emp_GivenName,
                                                                                                    :Emp_Email,
                                                                                                    :Emp_Phone,
                                                                                                    :Emp_BusinessPhone,
                                                                                                    :Emp_Pic,
                                                                                                    :Emp_Username,
                                                                                                    :Emp_Password,
                                                                                                    :Dep_ID,
                                                                                                    :Position_ID,
                                                                                                    :Status_ID,
                                                                                                    NULL,
                                                                                                    :Emp_ID_Update,
                                                                                                    NOW(),
                                                                                                    '0'
                                                                                                )
                                        ");
                                        if ($insert_query->execute([
                                            ':Emp_ID' => $new_en_id,
                                            ':Emp_FirstName' => $empfname,
                                            ':Emp_LastName' => $emplname,
                                            ':Emp_GivenName' => $empgivenname,
                                            ':Emp_Email' => $empemail,
                                            ':Emp_Phone' => $empphone,
                                            ':Emp_BusinessPhone' => $empbusinessphone,
                                            ':Emp_Pic' => $renew_name,
                                            ':Emp_Username' => $empusername,
                                            ':Emp_Password' => $hash_password,
                                            ':Dep_ID' => $department,
                                            ':Position_ID' => $position,
                                            ':Status_ID' => $empstatus,
                                            ':Emp_ID_Update' => $_SESSION['Emp_ID']
                                        ])) {
                                            $_SESSION['status_insert'] = 'true'; 
                                            header("location:list_employee.php");
                                        } else {
                                            $_SESSION['status_insert'] = 'false'; 
                                            header("location:list_employee.php");
                                        }
                                    }
                                }

                            }
                        }
                    }
                }
        }
}
?>