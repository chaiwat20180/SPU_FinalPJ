<?php
    if(isset($_POST['editdep'])){
        $dep_id = $_GET['dep_id'];
        $dep_name = $_POST['depname'];
        $location = $_POST['location'];
        $manager = $_POST['manager'];
        if (!isset($dep_id) || $dep_id === "") {
            header("location:list_dep.php");
            exit();  
        }
        else{
            
                $query_update_dep = $db_connect-> prepare("
                UPDATE
                        tbdepartment
                SET
                        Site_ID = :Site_Name,
                        Dep_Name = :Dep_Name,
                        Dep_Manager = :Dep_Manager,
                        UpdatedBy = :UpdatedBy,
                        UpdatedDateTime = NOW()
                WHERE 
                        Dep_ID = :dep_id

            ");

            if ($query_update_dep->execute([
                ':dep_id' => $dep_id,
                ':Site_Name' => $location,
                ':Dep_Name' => $dep_name,
                ':Dep_Manager' => $manager,
                ':UpdatedBy' => $_SESSION['Emp_ID']
            ])) {
            $_SESSION['status_insert'] = 'true'; 
                header("location:list_dep.php");
                exit();
            } else {
            $_SESSION['status_insert'] = 'false'; 
                header("location:list_dep.php");
                exit();
            }
        }
                                                            
}
?>