<?php
include '../core_db.php';

if (isset($_POST['site_id'])) {
    $siteId = $_POST['site_id'];

    error_log("Received POST with siteId: " . $siteId); // Debugging line
    try {
        $update_isDeleted = $db_connect->prepare("UPDATE tbsite SET isDeleted=1 WHERE Site_ID = :siteId");
        $update_isDeleted->bindParam(':siteId', $siteId);
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
