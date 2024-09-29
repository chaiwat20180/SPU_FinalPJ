<?php
    if(isset($_POST['editac'])){
        $data_id = $_GET['action_code'];
        $data_name = $_POST['action_code_name'];
       

        if (!isset($data_id) || $data_id === "") {
            header("location:list_actioncode.php");
            exit();  
        }
        else{
            
                $query_update_data = $db_connect-> prepare("
                UPDATE
                        tbaction_code
                SET
                        Action_Code_Name = :Action_Code_Name,
                        UpdatedBy = :UpdatedBy,
                        UpdatedDateTime = NOW()
                WHERE 
                        Action_Code_ID  = :Action_Code_ID 

            ");

            if ($query_update_data->execute([
                ':Action_Code_ID' => $data_id,
                ':Action_Code_Name' => $data_name,
                ':UpdatedBy' => $_SESSION['Emp_ID']

            ])) {
            $_SESSION['status_insert'] = 'true'; 
                header("location:list_actioncode.php");
                exit();
            } else {
            $_SESSION['status_insert'] = 'false'; 
                header("location:list_actioncode.php");
                exit();
            }
        }
                                                            
}
?>