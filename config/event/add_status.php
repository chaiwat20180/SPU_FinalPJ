<?php
    if(isset($_POST['addstatus'])){
        $Group_Name = $_POST['status'];
        if($Group_Name ==""){
            $_SESSION['status_insert'] = 'nulldata'; 
            header("location:list_status.php");
        }
        else{
        $query_max_group = $db_connect-> prepare("
                                                    SELECT 
                                                            MAX(CAST(SUBSTRING(Status_ID , 2) AS INT)) as Max_Status_ID
                                                    FROM 
                                                            tbemployeestatus
        ");
        $query_max_group -> execute();
        $fetch_max_group_id = $query_max_group -> fetch(PDO::FETCH_ASSOC);
        $max_group_id = $fetch_max_group_id['Max_Status_ID'];

        if($max_group_id === NULL || $max_group_id == 0){
            $max_group_id = 1; 
            $new_group_id = "S".$max_group_id;
            $insert_query = $db_connect -> prepare("
                                                    INSERT INTO 
                                                                    tbemployeestatus
                                                    VALUES
                                                                (
                                                                    :Status_ID,
                                                                    :Status_Name,
                                                                    NULL,
                                                                    :Emp_ID,
                                                                    NOW(),
                                                                    '0'
                                                                )
            ");
            if ($insert_query->execute([
                ':Status_ID' => $new_group_id,
                ':Status_Name' => $Group_Name,
                ':Emp_ID' => $_SESSION['Emp_ID']
            ])) {
                $_SESSION['status_insert'] = 'true'; 
                header("location:list_group.php");
            } else {
                $_SESSION['status_insert'] = 'false'; 
                header("location:list_group.php");
            }
            
        }
        else{
            $max_group_id = $max_group_id + 1; 
            $new_group_id = "S".$max_group_id;
            $insert_query = $db_connect -> prepare("
                                                    INSERT INTO 
                                                                    tbemployeestatus
                                                    VALUES
                                                                (
                                                                    :Status_ID,
                                                                    :Status_Name,
                                                                    NULL,
                                                                    :Emp_ID,
                                                                    NOW(),
                                                                    '0'
                                                                )
            ");
            if ($insert_query->execute([
                ':Status_ID' => $new_group_id,
                ':Status_Name' => $Group_Name,
                ':Emp_ID' => $_SESSION['Emp_ID']
            ])) {
                $_SESSION['status_insert'] = 'true'; 
                header("location:list_status.php");
            } else {
                $_SESSION['status_insert'] = 'false'; 
                header("location:list_status.php");
            }
        }
    }
}
?>