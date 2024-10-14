<?php
include '../core_db.php';

if (isset($_POST['Emp_ID'])) {
    $Emp_ID = $_POST['Emp_ID'];

    error_log("Received POST with siteId: " . $Emp_ID); // Debugging line
    try {
        $update_isDeleted = $db_connect->prepare("UPDATE tbemployee SET isDeleted='1' WHERE Emp_ID = :Emp_ID");
        $update_isDeleted->bindParam(':Emp_ID', $Emp_ID);
        $update_isDeleted->execute();

        if ($update_isDeleted->rowCount() > 0) {
            $_SESSION['status_insert'] = 'true'; 
            echo json_encode(["status" => "success"]);
        } else {
            $_SESSION['status_insert'] = 'error'; 
            echo json_encode(["status" => "error"]);
        }
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        echo json_encode(["status" => "error"]);
    }
}
?>
