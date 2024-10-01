<?php
    if(isset($_POST['submitrequest'])){
        $get_type = $_GET['type'];
        $get_catgory_id = $_GET['catgory_id'];
        $group = $_POST['group'];
        $priority = $_POST['priority'];
        $description = $_POST['description'];
        $customercomment = $_POST['customercomment'];
        $additionalcomment = $_POST['additionalcomment'];



        if($get_type == 0){
            
            $query_max_data = $db_connect-> prepare("
                                                            SELECT 
                                                                    MAX(CAST(SUBSTRING(Ticket_ID, 4) AS INT)) as Max_INC_ID
                                                            FROM 
                                                                    tbticket
                                                            WHERE
                                                                    Ticket_ID LIKE 'INC%'
            ");
            $query_max_data -> execute();
            $fetch_max_id = $query_max_data -> fetch(PDO::FETCH_ASSOC);
            $max_id = $fetch_max_id['Max_INC_ID'];

            if($max_id === NULL || $max_id == 0){
            $max_id = 1; 
            $new_id = "INC0000001".$max_id;
            $insert_query = $db_connect -> prepare("
                    INSERT INTO 
                                tbticket
                    VALUES
                                (
                                    :Ticket_ID,
                                    :Emp_ID,
                                    :Group_ID,
                                    NULL,
                                    :Priority_ID,
                                    :Category_ID,
                                    NULL,
                                    NULL,
                                    'ST01',
                                    NULL,
                                    NULL,
                                    NOW()
                                )
            ");
            $insert_query_detail = $db_connect -> prepare("
                    INSERT INTO 
                                tbticketdetail
                                (Ticket_ID, Ticket_Detail, Ticket_AdditionalComment, Ticket_CustomerComment)
                    VALUES
                                (
                                    :Ticket_ID,
                                    :Ticket_Detail,
                                    :Ticket_AdditionalComment,
                                    :Ticket_CustomerComment
                                )
            ");
            if ($insert_query->execute([
            ':Ticket_ID' => $new_id,
            ':Group_ID' => $group,
            ':Priority_ID' => $priority,
            ':Category_ID' => $get_catgory_id,
            ':Emp_ID' => $_SESSION['Emp_ID']
            ])) {
                if ($insert_query_detail->execute([
                    ':Ticket_ID' => $new_id,
                    ':Ticket_Detail' => $description,
                    ':Ticket_AdditionalComment' => $additionalcomment,
                    ':Ticket_CustomerComment' => $customercomment,
                    ])) {
                        $_SESSION['status_insert'] = 'true'; 
                        $_SESSION['custom_alert'] = $alert_success_request; 
                        header("location:homepage.php");
                    }
                    else{
                        $_SESSION['status_insert'] = 'false'; 
                        $_SESSION['custom_alert'] = $alert_error_data; 
                        header("location:homepage.php");
                    }
            } else {
                $_SESSION['status_insert'] = 'false'; 
                $_SESSION['custom_alert'] = $alert_error_data; 
                header("location:homepage.php");
            }

            }
            else{
            $max_id = $max_id + 1; 
            $new_id = "INC" . str_pad($max_id, 7, '0', STR_PAD_LEFT);
            $insert_query = $db_connect -> prepare("
                    INSERT INTO 
                                tbticket
                    VALUES
                                (
                                    :Ticket_ID,
                                    :Emp_ID,
                                    :Group_ID,
                                    NULL,
                                    :Priority_ID,
                                    :Category_ID,
                                    NULL,
                                    NULL,
                                    'ST01',
                                    NULL,
                                    NULL,
                                    NOW()
                                )
            ");
            $insert_query_detail = $db_connect -> prepare("
                    INSERT INTO 
                                tbticketdetail
                                (Ticket_ID, Ticket_Detail, Ticket_AdditionalComment, Ticket_CustomerComment)
                    VALUES
                                (
                                    :Ticket_ID,
                                    :Ticket_Detail,
                                    :Ticket_AdditionalComment,
                                    :Ticket_CustomerComment
                                )
            ");
            if ($insert_query->execute([
            ':Ticket_ID' => $new_id,
            ':Group_ID' => $group,
            ':Priority_ID' => $priority,
            ':Category_ID' => $get_catgory_id,
            ':Emp_ID' => $_SESSION['Emp_ID']
            ])) {
                if ($insert_query_detail->execute([
                    ':Ticket_ID' => $new_id,
                    ':Ticket_Detail' => $description,
                    ':Ticket_AdditionalComment' => $additionalcomment,
                    ':Ticket_CustomerComment' => $customercomment,
                    ])) {
                        $_SESSION['status_insert'] = 'true'; 
                        $_SESSION['custom_alert'] = $alert_success_request; 
                        header("location:homepage.php");
                    }
                    else{
                        $_SESSION['status_insert'] = 'false'; 
                        $_SESSION['custom_alert'] = $alert_error_data; 
                        header("location:homepage.php");
                    }
                } else {
                    $_SESSION['status_insert'] = 'false'; 
                    $_SESSION['custom_alert'] = $alert_error_data; 
                    header("location:homepage.php");
                }
            }

        }
        elseif($get_type == 1) {
             
            $query_max_data = $db_connect-> prepare("
                                                            SELECT 
                                                                    MAX(CAST(SUBSTRING(Ticket_ID, 4) AS INT)) as Max_Ser_ID
                                                            FROM 
                                                                    tbticket
                                                            WHERE
                                                                    Ticket_ID LIKE 'SER%'
            ");
            $query_max_data -> execute();
            $fetch_max_id = $query_max_data -> fetch(PDO::FETCH_ASSOC);
            $max_id = $fetch_max_id['Max_Ser_ID'];








            if($max_id === NULL || $max_id == 0){
            $max_id = 1; 
            $new_id = "SER0000001".$max_id;
            $insert_query = $db_connect -> prepare("
                    INSERT INTO 
                                tbticket
                    VALUES
                                (
                                    :Ticket_ID,
                                    :Emp_ID,
                                    :Group_ID,
                                    NULL,
                                    :Priority_ID,
                                    :Category_ID,
                                    NULL,
                                    NULL,
                                    'ST06',
                                    NULL,
                                    NULL,
                                    NOW()
                                )
            ");
            $insert_query_detail = $db_connect -> prepare("
                    INSERT INTO 
                                tbticketdetail
                                (Ticket_ID, Ticket_Detail, Ticket_AdditionalComment, Ticket_CustomerComment)
                    VALUES
                                (
                                    :Ticket_ID,
                                    :Ticket_Detail,
                                    :Ticket_AdditionalComment,
                                    :Ticket_CustomerComment
                                )
            ");
            if ($insert_query->execute([
            ':Ticket_ID' => $new_id,
            ':Group_ID' => $group,
            ':Priority_ID' => $priority,
            ':Category_ID' => $get_catgory_id,
            ':Emp_ID' => $_SESSION['Emp_ID']
            ])) {
                if ($insert_query_detail->execute([
                    ':Ticket_ID' => $new_id,
                    ':Ticket_Detail' => $description,
                    ':Ticket_AdditionalComment' => $additionalcomment,
                    ':Ticket_CustomerComment' => $customercomment,
                    ])) {
                        $_SESSION['status_insert'] = 'true'; 
                        $_SESSION['custom_alert'] = $alert_success_request; 
                        header("location:homepage.php");
                    }
                    else{
                        $_SESSION['status_insert'] = 'false'; 
                        $_SESSION['custom_alert'] = $alert_error_data; 
                        header("location:homepage.php");
                    }
                } else {
                    $_SESSION['status_insert'] = 'false'; 
                    $_SESSION['custom_alert'] = $alert_error_data; 
                    header("location:homepage.php");
                }

            }
            else{
            $max_id = $max_id + 1; 
            $new_id = "SER" . str_pad($max_id, 7, '0', STR_PAD_LEFT);
            $insert_query = $db_connect -> prepare("
                    INSERT INTO 
                                tbticket
                    VALUES
                                (
                                    :Ticket_ID,
                                    :Emp_ID,
                                    :Group_ID,
                                    NULL,
                                    :Priority_ID,
                                    :Category_ID,
                                    NULL,
                                    NULL,
                                    'ST06',
                                    NULL,
                                    NULL,
                                    NOW()
                                )
            ");
            $insert_query_detail = $db_connect -> prepare("
                    INSERT INTO 
                                tbticketdetail
                                (Ticket_ID, Ticket_Detail, Ticket_AdditionalComment, Ticket_CustomerComment)
                    VALUES
                                (
                                    :Ticket_ID,
                                    :Ticket_Detail,
                                    :Ticket_AdditionalComment,
                                    :Ticket_CustomerComment
                                )
            ");
            if ($insert_query->execute([
            ':Ticket_ID' => $new_id,
            ':Group_ID' => $group,
            ':Priority_ID' => $priority,
            ':Category_ID' => $get_catgory_id,
            ':Emp_ID' => $_SESSION['Emp_ID']
            ])) {
                if ($insert_query_detail->execute([
                    ':Ticket_ID' => $new_id,
                    ':Ticket_Detail' => $description,
                    ':Ticket_AdditionalComment' => $additionalcomment,
                    ':Ticket_CustomerComment' => $customercomment,
                    ])) {
                        $_SESSION['status_insert'] = 'true'; 
                        $_SESSION['custom_alert'] = $alert_success_request; 
                        header("location:homepage.php");
                    }
                    else{
                        $_SESSION['status_insert'] = 'false'; 
                        $_SESSION['custom_alert'] = $alert_error_data; 
                        header("location:homepage.php");
                    }
                } else {
                    $_SESSION['status_insert'] = 'false'; 
                    $_SESSION['custom_alert'] = $alert_error_data; 
                    header("location:homepage.php");
                }
            }
        }
    }
?>