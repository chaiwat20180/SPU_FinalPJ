<?php
    if(isset($_POST['addcategory'])){
        $Category_Name = $_POST['category'];
        $Category_Description = $_POST['categoryinput'];
        $Category_Pic = $_FILES['category_pic'];
        $Category_Type = $_POST['categorytype'];
        
        if($Category_Description == "" || $Category_Description == "" || $Category_Type == "" || $Category_Pic == ""){
            $_SESSION['status_insert'] = 'nulldata'; 
        }
        else{
            $accrpt_image = array("jpg", "jpeg", "png");
            $type_image = pathinfo($_FILES['category_pic']['name'], PATHINFO_EXTENSION);
            if(!in_array($type_image, $accrpt_image)){
                $_SESSION['status_insert'] = 'nulldata'; 
                $_SESSION['custom_alert'] = $alert_pic_null;
            }
            else{
                $path_upload = "asset/category_pic/";
                $renew_name = uniqid('cat_', true) .hash('sha256',date("h:i:sa")). '.' . $type_image;
                $upload_file = $path_upload . $renew_name;

                list($original_width, $original_height) = getimagesize($Category_Pic['tmp_name']);

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
                        $source_image = imagecreatefromjpeg($Category_Pic['tmp_name']);
                        break;
                    case 'png':
                        $source_image = imagecreatefrompng($Category_Pic['tmp_name']);
                        imagealphablending($new_image, false);
                        imagesavealpha($new_image, true);
                        break;
                    case 'gif':
                        $source_image = imagecreatefromgif($Category_Pic['tmp_name']);
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
                    header("location:list_category.php");
                } 
                else {
                    //   test
                    $query_max_data = $db_connect-> prepare("
                                                    SELECT 
                                                            MAX(CAST(SUBSTRING(Category_ID, 2) AS INT)) as Max_ID
                                                    FROM 
                                                            tbcategory
                    ");
                    $query_max_data -> execute();
                    $fetch_max_id = $query_max_data -> fetch(PDO::FETCH_ASSOC);
                    $max_id = $fetch_max_id['Max_ID'];

                    if($max_id === NULL || $max_id == 0){
                        $max_id = 1; 
                        $new_id = "C".$max_id;
                        $insert_query = $db_connect -> prepare("
                                                                INSERT INTO 
                                                                            tbcategory
                                                                VALUES
                                                                            (
                                                                                :Category_ID,
                                                                                :Category_Name,
                                                                                :Category_Description,
                                                                                :Category_Pic,
                                                                                :Category_Type,
                                                                                NULL,
                                                                                :Emp_ID,
                                                                                NOW(),
                                                                                '0'
                                                                            )
                        ");
                        if ($insert_query->execute([
                            ':Category_ID' => $new_id,
                            ':Category_Name' => $Category_Name,
                            ':Category_Description' => $Category_Description,
                            ':Category_Pic' => $renew_name,
                            ':Category_Type' => $Category_Type,
                            ':Emp_ID' => $_SESSION['Emp_ID']
                        ])) {
                            $_SESSION['status_insert'] = 'true'; 
                            header("location:list_category.php");
                        } else {
                            $_SESSION['status_insert'] = 'false'; 
                            header("location:list_category.php");
                        }
                        
                    }
                    else{
                        $max_id = $max_id + 1; 
                        $new_id = "C".$max_id;
                        $insert_query = $db_connect -> prepare("
                                                                INSERT INTO 
                                                                            tbcategory
                                                                VALUES
                                                                            (
                                                                                :Category_ID,
                                                                                :Category_Name,
                                                                                :Category_Description,
                                                                                :Category_Pic,
                                                                                :Category_Type,
                                                                                NULL,
                                                                                :Emp_ID,
                                                                                NOW(),
                                                                                '0'
                                                                            )
                        ");
                        if ($insert_query->execute([
                            ':Category_ID' => $new_id,
                            ':Category_Name' => $Category_Name,
                            ':Category_Description' => $Category_Description,
                            ':Category_Pic' => $renew_name,
                            ':Category_Type' => $Category_Type,
                            ':Emp_ID' => $_SESSION['Emp_ID']
                        ])) {
                            $_SESSION['status_insert'] = 'true'; 
                            header("location:list_category.php");
                        } else {
                            $_SESSION['status_insert'] = 'false'; 
                            header("location:list_category.php");
                        }
                    }
                }
            }
        }
}
?>