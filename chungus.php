<?php
// Database connection parameters
$dsn = 'sqlite:housingprices.db'; // Adjust the path to your SQLite database file
$csv_file = 'data.csv'; // Path to your CSV file

try {
    // Create a new PDO instance
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Open the CSV file
    if (($handle = fopen($csv_file, 'r')) !== FALSE) {
        // Read the header row
        $header = fgetcsv($handle);
        
        // Find the index of the Neighborhood column
        $neighborhood_index = array_search('Neighborhood', $header);
        if ($neighborhood_index === false) {
            throw new Exception("Neighborhood column not found in CSV.");
        }

        // Prepare the SQL update statement using a unique column instead of id
        $update_sql = "UPDATE properties SET Neighborhood = :neighborhood WHERE id = :id"; // Using the new id column
        $update_stmt = $pdo->prepare($update_sql);

        // Initialize a counter for the id
        $id_counter = 1;

        // Read each row of the CSV
        while (($data = fgetcsv($handle)) !== FALSE) {
            // Assign the current row number as the id
            $id = $id_counter++;
            $neighborhood = $data[$neighborhood_index];

            // Execute the update statement
            $update_stmt->execute([':neighborhood' => $neighborhood, ':id' => $id]);
        }

        fclose($handle);
        echo "Neighborhood column populated successfully.";

    } else {
        throw new Exception("Could not open the CSV file.");
    }

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>