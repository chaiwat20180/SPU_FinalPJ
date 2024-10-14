<?php
    if(isset($_POST['adddep'])){
        $site_id = $_POST['sitename'];
        $department = $_POST['department'];
        $manager = $_POST['manager'];
        if($site_id == "" || $department =="" ){
            $_SESSION['status_insert'] = 'nulldata'; 
            header("location:list_dep.php");
        }
        else{
        $query_max_dep = $db_connect-> prepare("
                                                    SELECT 
                                                            MAX(CAST(SUBSTRING(Dep_ID, 2) AS INT)) as Max_Dep_ID
                                                    FROM 
                                                            tbdepartment
        ");
        $query_max_dep -> execute();
        $fetch_max_dep_id = $query_max_dep -> fetch(PDO::FETCH_ASSOC);
        $max_dep_id = $fetch_max_dep_id['Max_Dep_ID'];

        if($max_dep_id === NULL || $max_dep_id == 0){
            $max_dep_id = 1; 
            $new_dep_id = "D".$max_dep_id;
            $insert_query = $db_connect -> prepare("
                                                    INSERT INTO 
                                                                    tbdepartment
                                                    VALUES
                                                                (
                                                                    :Dep_ID,
                                                                    :Site_ID,
                                                                    :Dep_Name,
                                                                    :Dep_Manager,
                                                                    NULL,
                                                                    :Emp_ID,
                                                                    NOW(),
                                                                    '0'
                                                                )
            ");
            if ($insert_query->execute([
                ':Dep_ID' => $new_dep_id,
                ':Site_ID' => $site_id,
                ':Dep_Name' => $department,
                ':Dep_Manager' => $manager,
                ':Emp_ID' => $_SESSION['Emp_ID']
            ])) {
                $_SESSION['status_insert'] = 'true'; 
                header("location:list_dep.php");
            } else {
                $_SESSION['status_insert'] = 'false'; 
                header("location:list_dep.php");
            }
            
        }
        else{
            $max_dep_id = $max_dep_id + 1; 
            $new_dep_id = "D".$max_dep_id;
            $insert_query = $db_connect -> prepare("
                                                    INSERT INTO 
                                                                    tbdepartment
                                                    VALUES
                                                                (
                                                                    :Dep_ID,
                                                                    :Site_ID,
                                                                    :Dep_Name,
                                                                    :Dep_Manager,
                                                                    NULL,
                                                                    :Emp_ID,
                                                                    NOW(),
                                                                    '0'
                                                                )
            ");
            if ($insert_query->execute([
                ':Dep_ID' => $new_dep_id,
                ':Site_ID' => $site_id,
                ':Dep_Name' => $department,
                ':Dep_Manager' => $manager,
                ':Emp_ID' => $_SESSION['Emp_ID']
            ])) {
                $_SESSION['status_insert'] = 'true'; 
                header("location:list_dep.php");
            } else {
                $_SESSION['status_insert'] = 'false'; 
                header("location:list_dep.php");
            }
        }
    }
}
?>