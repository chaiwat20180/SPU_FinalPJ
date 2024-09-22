<?php
include '../core_db.php';

if (isset($_POST['Assign_Group_ID'])) {
    $Assign_Group_ID = $_POST['Assign_Group_ID'];

    error_log("Received POST with siteId: " . $Assign_Group_ID); // Debugging line
    try {
        $update_isDeleted = $db_connect->prepare("UPDATE tbassign_group SET isDeleted=1 WHERE Assign_Group_ID = :Assign_Group_ID");
        $update_isDeleted->bindParam(':Assign_Group_ID', $Assign_Group_ID);
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
