<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Increase memory limit if necessary
ini_set('memory_limit', '512M');

// Set the number of rows per page to 20
$rowsPerPage = 20;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $rowsPerPage;

$data = [];
$header = [];

// Open the CSV file and read it line by line
if (($handle = fopen("../data.csv", "r")) !== FALSE) {
    $header = fgetcsv($handle); // Get the header
    while (($row = fgetcsv($handle)) !== FALSE) {
        $data[] = array_combine($header, $row); // Combine header with row data
    }
    fclose($handle);
}

// Sort the data if a sort field is provided
if (isset($_GET['sort'])) {
    $sortField = $_GET['sort'];
    usort($data, function($a, $b) use ($sortField) {
        return strcmp($a[$sortField], $b[$sortField]);
    });
}

// Get the total number of rows for pagination
$totalRows = count($data);
$totalPages = ceil($totalRows / $rowsPerPage);

// Slice the data for the current page
$data = array_slice($data, $offset, $rowsPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Boston Housing Prices</title>
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="logo">
            <h1>Boston Housing Prices</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="dataset.php">Dataset</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="resources.php">Resources</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h2>Explore Housing Prices in Boston's Neighborhoods</h2>
            <p>Discover the latest trends and pricing in various counties of Boston based on in-depth data analysis.</p>
            <a href="index.php" class="cta-button">Explore County Scores</a>
        </div>
    </section>

    <!-- Key Insights Section -->
    <section class="insights">
        <h3>Key Insights</h3>
        <div class="insight-cards">
            <div class="card">
                <h4>Interactive Map</h4>
                <a href="map.php"> click here </a>
                <p>Click on a county to see a score.</p>
            </div>
            <div class="card">
                <h4>Price Prediction</h4>
                <a href="prediction.php">click here</a>
                <p>View a prediction of a house's price given some variables.</p>
            </div>
        </div>
    </section>


    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 Boston Housing Prices</p>
        <nav>
            <ul>
                <li><a href="privacy.php">Privacy Policy</a></li>
                <li><a href="terms.php">Terms of Use</a></li>
            </ul>
        </nav>
    </footer>
</body>
</html>
