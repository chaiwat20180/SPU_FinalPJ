<?php
    if(isset($_POST['addsite'])){
        $site_name = $_POST['sitename'];
        $location = $_POST['location'];
        $street = $_POST['street'];
        $city = $_POST['city'];
        $provice = $_POST['provice'];
        $postcode = $_POST['postcode'];
        $manager = $_POST['manager'];
        if($site_name == "" || $location =="" || $street == "" || $city == "" || $provice == "" || $postcode == "" || $manager == ""){
            $_SESSION['status_insert'] = 'nulldata'; 
            header("location:list_list.php");
        }
        else{
        $query_max_site = $db_connect-> prepare("
                                                    SELECT 
                                                            MAX(CAST(SUBSTRING(Site_ID, 2) AS INT)) as Max_Site_ID
                                                    FROM 
                                                            tbsite
        ");
        $query_max_site -> execute();
        $fetch_max_site_id = $query_max_site -> fetch(PDO::FETCH_ASSOC);
        $max_site_id = $fetch_max_site_id['Max_Site_ID'];

        if($max_site_id === NULL || $max_site_id == 0){
            $max_site_id = 1; 
            $new_site_id = "S".$max_site_id;
            $insert_query = $db_connect -> prepare("
                                                    INSERT INTO 
                                                                tbsite
                                                    VALUES
                                                                (
                                                                    :Site_ID,
                                                                    :Site_Name,
                                                                    :Site_Location,
                                                                    :Site_Street,
                                                                    :Site_City,
                                                                    :Site_Province,
                                                                    :Site_Postal_Code,
                                                                    :Site_Manager,
                                                                    NULL,
                                                                    :Emp_ID,
                                                                    NOW(),
                                                                    0
                                                                )
            ");
            if ($insert_query->execute([
                ':Site_ID' => $new_site_id,
                ':Site_Name' => $site_name,
                ':Site_Location' => $location,
                ':Site_Street' => $street,
                ':Site_City' => $city,
                ':Site_Province' => $provice,
                ':Site_Postal_Code' => $postcode,
                ':Site_Manager' => $manager,
                ':Emp_ID' => $_SESSION['Emp_ID']
            ])) {
                $_SESSION['status_insert'] = 'true'; 
                header("location:list_site.php");
            } else {
                $_SESSION['status_insert'] = 'false'; 
                header("location:list_site.php");
            }
            
        }
        else{
            $max_site_id = $max_site_id + 1; 
            $new_site_id = "S".$max_site_id;
            $insert_query = $db_connect -> prepare("
                                                    INSERT INTO 
                                                                tbsite
                                                    VALUES
                                                                (
                                                                    :Site_ID,
                                                                    :Site_Name,
                                                                    :Site_Location,
                                                                    :Site_Street,
                                                                    :Site_City,
                                                                    :Site_Province,
                                                                    :Site_Postal_Code,
                                                                    :Site_Manager,
                                                                    NULL,
                                                                    :Emp_ID,
                                                                    NOW(),
                                                                    0
                                                                )
            ");
            if ($insert_query->execute([
                ':Site_ID' => $new_site_id,
                ':Site_Name' => $site_name,
                ':Site_Location' => $location,
                ':Site_Street' => $street,
                ':Site_City' => $city,
                ':Site_Province' => $provice,
                ':Site_Postal_Code' => $postcode,
                ':Site_Manager' => $manager,
                ':Emp_ID' => $_SESSION['Emp_ID']
            ])) {
                $_SESSION['status_insert'] = 'true'; 
                header("location:list_site.php");
                exit();
            } else {
                $_SESSION['status_insert'] = 'false'; 
                header("location:list_site.php");
                exit();
            }
        }
    }
}
?>