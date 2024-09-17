<?php
    $query_user = $db_connect -> prepare("
                                        SELECT 
                                                tbemp.*,
                                                tbdep.Dep_ID as Dep_ID,
                                                tbdep.Dep_Name as Dep_Name,
                                                tbsite.Site_ID as Site_ID,
                                                tbsite.Site_Name as Site_Name

                                        FROM
                                                tbemployee tbemp
                                        LEFT JOIN tbdepartment tbdep ON tbdep.Dep_ID = tbemp.Dep_ID
                                        LEFT JOIN tbsite ON tbsite.Site_ID = tbdep.Site_ID
                                        WHERE
                                                tbemp.Emp_ID = :Emp_ID
    "); 
    $query_user -> bindParam(':Emp_ID', $_SESSION['Emp_ID']);
    $query_user -> execute();
    $user_data = $query_user -> fetch(PDO::FETCH_ASSOC);
?>