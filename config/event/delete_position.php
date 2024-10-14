<?php
include '../core_db.php';

if (isset($_POST['Position_ID'])) {
    $Position_ID = $_POST['Position_ID'];

    error_log("Received POST with siteId: " . $Position_ID); // Debugging line
    try {
        $update_isDeleted = $db_connect->prepare("UPDATE tbposition SET isDeleted='1' WHERE Position_ID  = :Position_ID ");
        $update_isDeleted->bindParam(':Position_ID', $Position_ID);
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
