<?php
    if(isset($_POST['editstatus'])){
        $group_id = $_GET['status_id'];
        $group_name = $_POST['statusname'];
        if (!isset($group_name) || $group_name == "") {
            header("location:list_status.php");
            exit();  
        }
        else{
            
                $query_update_group = $db_connect-> prepare("
                UPDATE
                        tbemployeestatus
                SET
                        Status_Name = :Status_Name,
                        UpdatedBy = :UpdatedBy,
                        UpdatedDateTime = NOW()
                WHERE 
                        Status_ID   = :Status_ID  

            ");

            if ($query_update_group->execute([
                ':Status_ID' => $group_id,
                ':Status_Name' => $group_name,
                ':UpdatedBy' => $_SESSION['Emp_ID']
            ])) {
            $_SESSION['status_insert'] = 'true'; 
                header("location:list_status.php");
                exit();
            } else {
            $_SESSION['status_insert'] = 'false'; 
                header("location:list_status.php");
                exit();
            }
        }
                                                            
}
?>