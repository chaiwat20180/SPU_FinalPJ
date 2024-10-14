<?php
include '../core_db.php';

if (isset($_POST['Close_Code_ID'])) {
    $Close_Code_ID = $_POST['Close_Code_ID'];

    error_log("Received POST with siteId: " . $Close_Code_ID); // Debugging line
    try {
        $update_isDeleted = $db_connect->prepare("UPDATE tbclose_code SET isDeleted='1' WHERE Close_Code_ID = :Close_Code_ID");
        $update_isDeleted->bindParam(':Close_Code_ID', $Close_Code_ID);
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
