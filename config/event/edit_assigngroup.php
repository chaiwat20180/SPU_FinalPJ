<?php
    if(isset($_POST['editag'])){
        $ag_id = $_GET['ag_id'];
        $employe_id = $_POST['employe_id'];
        $assigngroup = $_POST['assigngroup'];
        $group_name = $_POST['group'];
        if (!isset($assigngroup) || $assigngroup == "") {
            header("location:list_assigngroup.php");
            exit();  
        }
        else{
            $check_query = $db_connect->prepare("
            SELECT COUNT(*) AS exist_count
            FROM tbassign_group
            WHERE Emp_ID = :Emp_ID_Assign AND Group_ID = :Group_ID
            AND IsDeleted ='0'           
            ");
            $check_query->execute([
                ':Emp_ID_Assign' => $employe_id,
                ':Group_ID' => $assigngroup
            ]);
            $result = $check_query->fetch(PDO::FETCH_ASSOC);

            if ($result['exist_count'] > 0) {
                // Redirect with an error message if the combination exists
                $_SESSION['status_insert'] = 'duplicatealert'; 
                header("location:list_assigngroup.php");
                exit;
            }
            else{
                $query_update_group = $db_connect-> prepare("
                UPDATE
                        tbassign_group
                SET
                        Group_ID = :Group_ID,
                        UpdatedBy = :UpdatedBy,
                        UpdatedDateTime = NOW()
                WHERE 
                        Assign_Group_ID = :Assign_Group_ID 

            ");

            if ($query_update_group->execute([
                ':Assign_Group_ID' => $ag_id,
                ':Group_ID' => $assigngroup,
                ':UpdatedBy' => $_SESSION['Emp_ID']
            ])) {
            $_SESSION['status_insert'] = 'true'; 
                header("location:list_assigngroup.php");
                exit();
            } else {
            $_SESSION['status_insert'] = 'false'; 
                header("location:list_assigngroup.php");
                exit();
            }
        }
    }                                                       
}
?>