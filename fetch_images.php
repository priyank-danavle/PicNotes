<?php
// Connect to your database (replace with your credentials)
$conn = mysqli_connect('localhost', 'root', '', 'images');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Prepare a query to retrieve image URLs (modify as needed)
$sql = "SELECT image_url FROM images";

// Execute the query
$result = mysqli_query($conn, $sql);

// Process results and prepare response data
$image_data = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $image_data['images'][] = $row['image_url'];
    }
} else {
    echo "No images found"; // Handle no images scenario
}

// Encode data as JSON and send response
header('Content-Type: application/json');
echo json_encode($image_data);

// Close connection
mysqli_close($conn);
?>
