<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user inputs
    $living_area = $_POST['living_area'];
    $bedrooms = $_POST['bedrooms'];
    $full_baths = $_POST['full_baths'];
    $neighborhood = escapeshellarg($_POST['neighborhood']); // Escape for shell command

    // Command to execute the Python script
    $command = "python3 ../predict_price.py $living_area $bedrooms $full_baths $neighborhood";

    // Execute the command and capture the output
    $output = shell_exec($command);

    // Return the result as JSON
    header('Content-Type: application/json');
    echo json_encode(['predicted_price' => $output]);
}
?>