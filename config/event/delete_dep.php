<?php
include '../core_db.php';

if (isset($_POST['Dep_ID'])) {
    $depID = $_POST['Dep_ID'];

    error_log("Received POST with siteId: " . $depID); // Debugging line
    try {
        $update_isDeleted = $db_connect->prepare("UPDATE tbdepartment SET isDeleted=1 WHERE DeP_ID = :depID");
        $update_isDeleted->bindParam(':depID', $depID);
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
