<?php
include '../conn/koneksi.php';

// Check if the priority and id_pengaduan are sent via POST
if(isset($_POST['priority']) && isset($_POST['id_pengaduan'])) {
    // Sanitize the input to prevent SQL injection
    $priority = $_POST['priority'];
    $id_pengaduan = $_POST['id_pengaduan'];

    // Update the priority in the database
    $query = "UPDATE pengaduan SET prioritas = ? WHERE id_pengaduan = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    
    // Bind parameters with their respective data types
    mysqli_stmt_bind_param($stmt, "si", $priority, $id_pengaduan); // Assuming id_pengaduan is an integer
    
    mysqli_stmt_execute($stmt);

    // Check if the query executed successfully
    if(mysqli_stmt_affected_rows($stmt) > 0) {
        // Priority updated successfully
        echo json_encode(array('success' => true, 'message' => 'Priority updated successfully.'));
    } else {
        // Error updating priority
        echo json_encode(array('success' => false, 'message' => 'Error updating priority.'));
    }

    // Close statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($koneksi);
} else {
    // If priority or id_pengaduan is not set in the POST data
    echo json_encode(array('success' => false, 'message' => 'Priority or id_pengaduan not set.'));
}
?>
