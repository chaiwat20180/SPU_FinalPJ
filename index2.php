<?php 
    include 'config/core_db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title_webpage; ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <!-- CustomCss -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="plugins/customcss/customcss.css">
    <link rel="icon" type="image/x-icon" href="asset/image/logo-ico.ico">
  
</head>
<body class="bg-img">
<?php 
            $searchTerm = 'chaiwat';
            $offset = 'chaiwat';
        
            $stmt = $db_connect->prepare("SELECT Emp_ID, Emp_FirstName, Emp_LastName FROM employees 
                                        WHERE (Emp_FirstName LIKE ? OR Emp_LastName LIKE ?) AND IsDeleted = 0 
                                        ORDER BY Emp_FirstName LIMIT 5 OFFSET ?");
            $searchTerm = "%$searchTerm%";
            $offset = (int)$offset;  // Cast to integer for safety
        
            // Bind parameters explicitly
            $stmt->bindParam(1, $searchTerm, PDO::PARAM_STR);
            $stmt->bindParam(2, $searchTerm, PDO::PARAM_STR);
            $stmt->bindParam(3, $offset, PDO::PARAM_INT);
            $stmt->execute();
            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $row) {
                echo "<option value='{$row['Emp_ID']}'>{$row['Emp_FirstName']} {$row['Emp_LastName']}</option>";
            }
?>
<div class="container mt-5">
    <div class="form-group">
        <label for="inputEmployee">Employee Name:</label>
        <input type="text" class="form-control" id="inputEmployee" onkeyup="searchEmployees()">
        <select class="form-control mt-2" id="employeeList" size="5"></select>
    </div>
</div>

<script>
let offset = 2;

function searchEmployees() {
    const searchTerm = document.getElementById('inputEmployee').value;
    offset = 0; // Reset offset on new search
    loadEmployees(searchTerm, offset);
}

function loadEmployees(searchTerm, offset) {
    $.ajax({
        url: 'fetch_employees.php',
        type: 'POST',
        data: {
            searchTerm: searchTerm,
            offset: offset
        },
        success: function(data) {
            if (offset === 0) {
                $('#employeeList').html(data);
            } else {
                $('#employeeList').append(data);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error fetching employees:", error);
        }
    });
}

$('#employeeList').scroll(function() {
    if ($(this).scrollTop() + $(this).innerHeight() >= this.scrollHeight) {
        offset += 5;
        loadEmployees($('#inputEmployee').val(), offset);
    }
});
</script>


</body>
</html>
