<?php
// Check if the motorbike ID is provided in the URL
if(isset($_GET['motorbikeID'])) {
    // Include your database configuration or any necessary files here
    require('dbinit.php');

    $motorbike_id = filter_var($_GET['motorbikeID'], FILTER_SANITIZE_NUMBER_INT);

    $sql = "DELETE FROM motorbike WHERE motorbikeID = ?";
    $stmt = $dbc->prepare($sql);
    $stmt->bind_param("i", $motorbike_id);
    $stmt->execute();
    
    // Close statement
    $stmt->close();

    // Close database connection
    $dbc->close();

    // Redirect back to the admin portal or wherever appropriate
    header("Location: addProduct.php");
    exit();
} else {
    // If motorbike ID is not provided, redirect back to the admin portal or display an error message
    header("Location: addProduct.php");
    exit();
}
?>
