<?php
    if(isset($_POST['editposition'])){
        $position_id = $_GET['position_id'];
        $position_name = $_POST['positionname'];
        if (!isset($position_name) || $position_name == "") {
            header("location:list_position.php");
            exit();  
        }
        else{
            
                $query_update_group = $db_connect-> prepare("
                UPDATE
                        tbposition
                SET
                        Position_name = :Position_name,
                        UpdatedBy = :UpdatedBy,
                        UpdatedDateTime = NOW()
                WHERE 
                        Position_ID = :Position_ID  

            ");

            if ($query_update_group->execute([
                ':Position_ID' => $position_id,
                ':Position_name' => $position_name,
                ':UpdatedBy' => $_SESSION['Emp_ID']
            ])) {
            $_SESSION['status_insert'] = 'true'; 
                header("location:list_position.php");
                exit();
            } else {
            $_SESSION['status_insert'] = 'false'; 
                header("location:list_position.php");
                exit();
            }
        }
                                                            
}
?>