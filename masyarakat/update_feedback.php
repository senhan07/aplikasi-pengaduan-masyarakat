<?php
include '../conn/koneksi.php';

// Check if the id_pengaduan and feedback are sent via POST
if(isset($_POST['id_pengaduan']) && isset($_POST['feedback'])) {
    // Sanitize the input to prevent SQL injection
    $id_pengaduan = $_POST['id_pengaduan'];
    $feedback = $_POST['feedback'];

    // Update the feedback in the database
    $query = "UPDATE pengaduan SET penilaian = ? WHERE id_pengaduan = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    
    // Bind parameters with their respective data types
    mysqli_stmt_bind_param($stmt, "si", $feedback, $id_pengaduan); // Assuming id_pengaduan is an integer and feedback is a string
    
    mysqli_stmt_execute($stmt);

    // Check if the query executed successfully
    if(mysqli_stmt_affected_rows($stmt) > 0) {
        // Feedback updated successfully
        echo json_encode(array('success' => true, 'message' => 'Feedback updated successfully.'));
    } else {
        // Error updating feedback
        echo json_encode(array('success' => false, 'message' => 'Error updating feedback.'));
    }

    // Close statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($koneksi);
} else {
    // If id_pengaduan or feedback is not set in the POST data
    echo json_encode(array('success' => false, 'message' => 'id_pengaduan or feedback not set.'));
}
?>
