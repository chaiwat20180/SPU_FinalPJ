<?php
    if(isset($_POST['editgroup'])){
        $group_id = $_GET['group_id'];
        $group_name = $_POST['group'];
        $group_type = $_POST['grouptype'];
        if (!isset($group_name) || $group_name == "" || $group_type == "") {
            header("location:list_group.php");
            exit();  
        }
        else{
            
                $query_update_group = $db_connect-> prepare("
                UPDATE
                        tbgroup
                SET
                        Group_Name = :Group_Name,
                        Group_Admin = :Group_Admin,
                        UpdatedBy = :UpdatedBy,
                        UpdatedDateTime = NOW()
                WHERE 
                        Group_ID  = :Group_ID 

            ");

            if ($query_update_group->execute([
                ':Group_ID' => $group_id,
                ':Group_Name' => $group_name,
                ':Group_Admin' => $group_type,
                ':UpdatedBy' => $_SESSION['Emp_ID']
            ])) {
            $_SESSION['status_insert'] = 'true'; 
                header("location:list_group.php");
                exit();
            } else {
            $_SESSION['status_insert'] = 'false'; 
                header("location:list_group.php");
                exit();
            }
        }
                                                            
}
?>