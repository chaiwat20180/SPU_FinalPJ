<?php
    if(isset($_POST['addassigngroup'])){
        $employee = $_POST['employee'];
        $Group_Name = $_POST['group'];
        if($employee =="" || $Group_Name==""){
            $_SESSION['status_insert'] = 'nulldata'; 
            header("location:list_assigngroup.php");
        }
        else{
            $check_query = $db_connect->prepare("
            SELECT COUNT(*) AS exist_count
            FROM tbassign_group
            WHERE Emp_ID = :Emp_ID_Assign AND Group_ID = :Group_ID
        ");
        $check_query->execute([
            ':Emp_ID_Assign' => $employee,
            ':Group_ID' => $Group_Name
        ]);
        $result = $check_query->fetch(PDO::FETCH_ASSOC);

        if ($result['exist_count'] > 0) {
            // Redirect with an error message if the combination exists
            $_SESSION['status_insert'] = 'duplicatealert'; 
            header("location:list_assigngroup.php");
            exit;
        } else {
        $query_max_group = $db_connect-> prepare("
                                                    SELECT 
                                                            MAX(CAST(SUBSTRING(Assign_Group_ID, 3) AS INT)) as Max_Group_ID
                                                    FROM 
                                                            tbassign_group
        ");
        $query_max_group -> execute();
        $fetch_max_group_id = $query_max_group -> fetch(PDO::FETCH_ASSOC);
        $max_group_id = $fetch_max_group_id['Max_Group_ID'];

        if($max_group_id === NULL || $max_group_id == 0){
            $max_group_id = 1; 
            $new_group_id = "AG".$max_group_id;
            $insert_query = $db_connect -> prepare("
                                                    INSERT INTO 
                                                                    tbassign_group
                                                    VALUES
                                                                (
                                                                    :Assign_Group_ID,
                                                                    :Emp_ID_Assign,
                                                                    :Group_ID,
                                                                    NULL,
                                                                    :Emp_ID,
                                                                    NOW(),
                                                                    '0'
                                                                )
            ");
            if ($insert_query->execute([
                ':Assign_Group_ID' => $new_group_id,
                ':Emp_ID_Assign' => $employee,
                ':Group_ID' => $Group_Name,
                ':Emp_ID' => $_SESSION['Emp_ID']
            ])) {
                $_SESSION['status_insert'] = 'true'; 
                header("location:list_assigngroup.php");
            } else {
                $_SESSION['status_insert'] = 'false'; 
                header("location:list_assigngroup.php");
            }
            
        }
        else{
            $max_group_id = $max_group_id + 1; 
            $new_group_id = "AG".$max_group_id;
            $insert_query = $db_connect -> prepare("
                                                    INSERT INTO 
                                                                    tbassign_group
                                                    VALUES
                                                                (
                                                                    :Assign_Group_ID,
                                                                    :Emp_ID_Assign,
                                                                    :Group_ID,
                                                                    NULL,
                                                                    :Emp_ID,
                                                                    NOW(),
                                                                    '0'
                                                                )
            ");
            if ($insert_query->execute([
                ':Assign_Group_ID' => $new_group_id,
                ':Emp_ID_Assign' => $employee,
                ':Group_ID' => $Group_Name,
                ':Emp_ID' => $_SESSION['Emp_ID']
            ])) {
                $_SESSION['status_insert'] = 'true'; 
                header("location:list_assigngroup.php");
            } else {
                $_SESSION['status_insert'] = 'false'; 
                header("location:list_assigngroup.php");
            }
        }
    }
    }
}
?>