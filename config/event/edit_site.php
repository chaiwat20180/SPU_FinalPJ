<?php
    if(isset($_POST['editsite'])){
        $site_id = $_GET['site_id'];
        $site_name = $_POST['sitename'];
        $location = $_POST['location'];
        $street = $_POST['street'];
        $city = $_POST['city'];
        $provice = $_POST['provice'];
        $postcode = $_POST['postcode'];
        $manager = $_POST['manager'];
        if (!isset($site_id) || $site_id === "") {
            header("location:list_site.php");
            exit();  
        }
        else{
            
                $query_update_site = $db_connect-> prepare("
                UPDATE
                        tbsite
                SET
                        Site_Name = :Site_Name,
                        Site_Location = :Site_Location,
                        Site_Street = :Site_Street,
                        Site_City = :Site_City,
                        Site_Province = :Site_Province,
                        Site_Postal_Code = :Site_Postal_Code,
                        Site_Manager = :Site_Manager,
                        UpdatedBy = :UpdatedBy,
                        UpdatedDateTime = NOW()
                WHERE 
                        Site_ID = :Site_ID

            ");

            if ($query_update_site->execute([
                ':Site_ID' => $site_id,
                ':Site_Name' => $site_name,
                ':Site_Location' => $location,
                ':Site_Street' => $street,
                ':Site_City' => $city,
                ':Site_Province' => $provice,
                ':Site_Postal_Code' => $postcode,
                ':Site_Manager' => $manager,
                ':UpdatedBy' => $_SESSION['Emp_ID']

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
?>