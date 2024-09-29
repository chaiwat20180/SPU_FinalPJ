<?php
    if(isset($_POST['addclosecode'])){
        $closecode = $_POST['closecode'];

        if($closecode == ""){
            $_SESSION['status_insert'] = 'nulldata'; 
            header("location:list_close_code.php");
        }
        else{
        $query_max_data = $db_connect-> prepare("
                                                    SELECT 
                                                            MAX(CAST(SUBSTRING(Close_Code_ID, 3) AS INT)) as Max_ID
                                                    FROM 
                                                            tbclose_code
        ");
        $query_max_data -> execute();
        $fetch_max_id = $query_max_data -> fetch(PDO::FETCH_ASSOC);
        $max_id = $fetch_max_id['Max_ID'];

        if($max_id === NULL || $max_id == 0){
            $max_id = 1; 
            $new_id = "CC".$max_id;
            $insert_query = $db_connect -> prepare("
                                                    INSERT INTO 
                                                                tbclose_code
                                                    VALUES
                                                                (
                                                                    :Close_Code_ID,
                                                                    :Close_Code_Name,
                                                                    NULL,
                                                                    :Emp_ID,
                                                                    NOW(),
                                                                    '0'
                                                                )
            ");
            if ($insert_query->execute([
                ':Close_Code_ID' => $new_id,
                ':Close_Code_Name' => $closecode,
                ':Emp_ID' => $_SESSION['Emp_ID']
            ])) {
                $_SESSION['status_insert'] = 'true'; 
                header("location:list_closecode.php");
            } else {
                $_SESSION['status_insert'] = 'false'; 
                header("location:list_closecode.php");
            }
            
        }
        else{
            $max_id = $max_id + 1; 
            $new_id = "CC".$max_id;
            $insert_query = $db_connect -> prepare("
                                                    INSERT INTO 
                                                                tbclose_code
                                                    VALUES
                                                                (
                                                                    :Close_Code_ID,
                                                                    :Close_Code_Name,
                                                                    NULL,
                                                                    :Emp_ID,
                                                                    NOW(),
                                                                    '0'
                                                                )
            ");
            if ($insert_query->execute([
                ':Close_Code_ID' => $new_id,
                ':Close_Code_Name' => $closecode,
                ':Emp_ID' => $_SESSION['Emp_ID']
            ])) {
                $_SESSION['status_insert'] = 'true'; 
                header("location:list_closecode.php");
            } else {
                $_SESSION['status_insert'] = 'false'; 
                header("location:list_closecode.php");
            }
        }
    }
}
?>