<?php
// Starter code to set up database connection to get data

$servername = "localhost";
$username = "root";
$dbname = "database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['zip_code'])) {
    $zipcode = $_GET['zip_code'];
    $stmt = $conn->prepare("SELECT data FROM boston_zipcodes WHERE zipcode = ?");
    $stmt->bind_param("s", $zipcode);
    $stmt->execute();
    $stmt->bind_result($data);
    
    if ($stmt->fetch()) {
        echo json_encode(['zipcode' => $zipcode, 'data' => $data]);
    } else {
        echo json_encode(['error' => 'Zip code not found']);
    }
    
    $stmt->close();
}
$conn->close();
?>
