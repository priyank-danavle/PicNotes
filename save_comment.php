<?php
// Connect to your database (replace with your credentials)
$conn = mysqli_connect('localhost', 'root', '', 'images');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get data from POST request
$data = json_decode(file_get_contents('php://input'), true);
$imageUrl = $data['image_url']; // Assuming the JSON provides "imageUrl"
$comment = $data['comment'];
echo $comment;

// **Sanitize and Validate Image URL:**
// - Prevent SQL injection and potential image path vulnerabilities
$imageUrl = filter_var($imageUrl, FILTER_SANITIZE_URL); // Basic URL sanitization

// **Check if Image URL Exists in Database (Optional):**
// - Improves data integrity if your structure allows
$sql_exists = "SELECT 1 FROM images WHERE image_url = ?";
$stmt_exists = mysqli_prepare($conn, $sql_exists);
mysqli_stmt_bind_param($stmt_exists, 's', $imageUrl);
mysqli_stmt_execute($stmt_exists);
$result_exists = mysqli_stmt_get_result($stmt_exists);
$image_exists = mysqli_fetch_assoc($result_exists)['1']; // Assuming the existence check returns a single value

if ($image_exists) { // Update only if image URL exists (optional check)

    // Prepare update query (modify based on your needs)
    $sql = "UPDATE images SET comment = ? WHERE image_url = ?";

    // Prepare statement (for security)
    $stmt = mysqli_prepare($conn, $sql);

    // // Bind parameters (for security)
    // mysqli_stmt_bind_param($stmt, 'is', $comment, $imageUrl);
    // Bind parameters (for security)
    mysqli_stmt_bind_param($stmt, 'ss', $comment, $imageUrl); // Change 'i' to 's' for comment parameter

    // Execute statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Comment saved successfully";
    } else {
        echo "Error saving comment: " . mysqli_error($conn);
    }
} else {
    echo "Error: Image URL not found in database"; // Inform user if image doesn't exist (optional)
}

// Close statements and connection
mysqli_stmt_close($stmt_exists); // Close optional existence check statement
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>