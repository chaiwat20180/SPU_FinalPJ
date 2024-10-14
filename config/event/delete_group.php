<?php
include '../core_db.php';

if (isset($_POST['Group_ID'])) {
    $Group_ID = $_POST['Group_ID'];

    error_log("Received POST with siteId: " . $Group_ID); // Debugging line
    try {
        $update_isDeleted = $db_connect->prepare("UPDATE tbgroup SET isDeleted='1' WHERE Group_ID = :Group_ID");
        $update_isDeleted->bindParam(':Group_ID', $Group_ID);
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
