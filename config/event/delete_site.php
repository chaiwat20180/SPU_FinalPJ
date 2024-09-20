<?php
include '../core_db.php';

if (isset($_POST['id'])) {
    $siteId = $_POST['id'];

    error_log("Received POST with siteId: " . $siteId); // Debugging line

    $stmt = $db_connect->prepare("DELETE FROM tbsite WHERE Site_ID = :siteId");
    $stmt->bindParam(':siteId', $siteId);

    try {
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            echo "Record deleted successfully $siteId";
            $_SESSION['status_insert'] = 'true'; 
            header("location:list_site.php");
        } else {
            echo "No record found with ID $siteId";
            error_log("No record found with ID: " . $siteId); // Debugging line
        }
    } catch (PDOException $e) {
        echo "Error deleting record: " . $e->getMessage();
        error_log("Error deleting record: " . $e->getMessage()); // Debugging line
    }
}
?>
