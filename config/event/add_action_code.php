<?php
    if(isset($_POST['addactioncode'])){
        $actioncode = $_POST['actioncode'];

        if($actioncode == ""){
            $_SESSION['status_insert'] = 'nulldata'; 
            header("location:list_actioncode.php");
        }
        else{
        $query_max_data = $db_connect-> prepare("
                                                    SELECT 
                                                            MAX(CAST(SUBSTRING(Action_Code_ID, 3) AS INT)) as Max_ID
                                                    FROM 
                                                            tbaction_code
        ");
        $query_max_data -> execute();
        $fetch_max_id = $query_max_data -> fetch(PDO::FETCH_ASSOC);
        $max_id = $fetch_max_id['Max_ID'];

        if($max_id === NULL || $max_id == 0){
            $max_id = 1; 
            $new_id = "AC".$max_id;
            $insert_query = $db_connect -> prepare("
                                                    INSERT INTO 
                                                                tbaction_code
                                                    VALUES
                                                                (
                                                                    :Action_Code_ID,
                                                                    :Action_Code_Name,
                                                                    NULL,
                                                                    :Emp_ID,
                                                                    NOW(),
                                                                    '0'
                                                                )
            ");
            if ($insert_query->execute([
                ':Action_Code_ID' => $new_id,
                ':Action_Code_Name' => $actioncode,
                ':Emp_ID' => $_SESSION['Emp_ID']
            ])) {
                $_SESSION['status_insert'] = 'true'; 
                header("location:homepage.php");
            } else {
                $_SESSION['status_insert'] = 'false'; 
                header("location:list_actioncode.php");
            }
            
        }
        else{
            $max_id = $max_id + 1; 
            $new_id = "AC".$max_id;
            $insert_query = $db_connect -> prepare("
                                                    INSERT INTO 
                                                                tbaction_code
                                                    VALUES
                                                                (
                                                                    :Action_Code_ID,
                                                                    :Action_Code_Name,
                                                                    NULL,
                                                                    :Emp_ID,
                                                                    NOW(),
                                                                    '0'
                                                                )
            ");
            if ($insert_query->execute([
                ':Action_Code_ID' => $new_id,
                ':Action_Code_Name' => $actioncode,
                ':Emp_ID' => $_SESSION['Emp_ID']
            ])) {
                $_SESSION['status_insert'] = 'true'; 
                header("location:list_actioncode.php");
            } else {
                $_SESSION['status_insert'] = 'false'; 
                header("location:list_actioncode.php");
            }
        }
    }
}
?>