<?php
    $query_user = $db_connect -> prepare("
                                        SELECT 
                                                tbemp.*
                                        FROM
                                                tbemployee tbemp
                                        WHERE
                                                tbemp.Emp_ID = :Emp_ID
    "); 
    $query_user -> bindParam(':Emp_ID', $_SESSION['Emp_ID']);
    $query_user -> execute();
    $user_data = $query_user -> fetch(PDO::FETCH_ASSOC);
?>