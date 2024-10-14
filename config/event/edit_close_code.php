<?php
    if(isset($_POST['editcc'])){
        $data_id = $_GET['close_code'];
        $data_name = $_POST['close_code_name'];
       

        if (!isset($data_id) || $data_id === "") {
            header("location:list_closecode.php");
            exit();  
        }
        else{
            
                $query_update_data = $db_connect-> prepare("
                UPDATE
                        tbclose_code
                SET
                        Close_Code_Name = :Close_Code_Name,
                        UpdatedBy = :UpdatedBy,
                        UpdatedDateTime = NOW()
                WHERE 
                        Close_Code_ID  = :Close_Code_ID 

            ");

            if ($query_update_data->execute([
                ':Close_Code_ID' => $data_id,
                ':Close_Code_Name' => $data_name,
                ':UpdatedBy' => $_SESSION['Emp_ID']

            ])) {
            $_SESSION['status_insert'] = 'true'; 
                header("location:list_closecode.php");
                exit();
            } else {
            $_SESSION['status_insert'] = 'false'; 
                header("location:list_closecode.php");
                exit();
            }
        }
                                                            
}
?>