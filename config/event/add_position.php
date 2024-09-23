<?php
    if(isset($_POST['addposition'])){
        $position_Name = $_POST['position'];
        if($position_Name ==""){
            $_SESSION['status_insert'] = 'nulldata'; 
            header("location:list_position.php");
        }
        else{
        $query_max_position = $db_connect-> prepare("
                                                    SELECT 
                                                            MAX(CAST(SUBSTRING(Position_ID, 2) AS INT)) as Max_position_ID
                                                    FROM 
                                                            tbposition
        ");
        $query_max_position -> execute();
        $fetch_max_position_id = $query_max_position -> fetch(PDO::FETCH_ASSOC);
        $max_position_id = $fetch_max_position_id['Max_position_ID'];

        if($max_position_id === NULL || $max_position_id == 0){
            $max_position_id = 1; 
            $new_position_id = "P".$max_position_id;
            $insert_query = $db_connect -> prepare("
                                                    INSERT INTO 
                                                                    tbposition
                                                    VALUES
                                                                (
                                                                    :Position_ID,
                                                                    :Position_name,
                                                                    NULL,
                                                                    :Emp_ID,
                                                                    NOW(),
                                                                    '0'
                                                                )
            ");
            if ($insert_query->execute([
                ':Position_ID' => $new_position_id,
                ':Position_name' => $position_Name,
                ':Emp_ID' => $_SESSION['Emp_ID']
            ])) {
                $_SESSION['status_insert'] = 'true'; 
                header("location:list_position.php");
            } else {
                $_SESSION['status_insert'] = 'false'; 
                header("location:list_position.php");
            }
            
        }
        else{
            $max_position_id = $max_position_id + 1; 
            $new_position_id = "P".$max_position_id;
            $insert_query = $db_connect -> prepare("
                                                    INSERT INTO 
                                                                    tbposition
                                                    VALUES
                                                                (
                                                                    :Position_ID,
                                                                    :Position_name,
                                                                    NULL,
                                                                    :Emp_ID,
                                                                    NOW(),
                                                                    '0'
                                                                )
            ");
            if ($insert_query->execute([
                ':Position_ID' => $new_position_id,
                ':Position_name' => $position_Name,
                ':Emp_ID' => $_SESSION['Emp_ID']
            ])) {
                $_SESSION['status_insert'] = 'true'; 
                header("location:list_position.php");
            } else {
                $_SESSION['status_insert'] = 'false'; 
                header("location:list_position.php");
            }
        }
    }
}
?>