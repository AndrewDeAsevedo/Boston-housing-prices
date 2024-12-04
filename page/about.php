<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>About - Boston Housing Prices</title>
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

    <!-- About Section -->
    <div class="container">
        <h1>About Boston Housing Prices</h1>
        
        <section class="about-content">
            <h2>Our Mission</h2>
            <p>Boston Housing Prices is dedicated to providing transparent, comprehensive insights into the real estate market in the Boston metropolitan area. Our goal is to empower homebuyers, investors, and researchers with accurate and up-to-date housing information.</p>
            
            <h2>Data Source</h2>
            <p>Our dataset is compiled from official city records, providing a comprehensive view of housing properties across various Boston neighborhoods. The data includes detailed information such as:</p>
            <ul>
                <li>City and ZIP Code</li>
                <li>Building Types</li>
                <li>Land and Living Area</li>
                <li>Property Values</li>
                <li>Year Built</li>
            </ul>

            <h2>How We Help</h2>
            <div class="insight-cards">
                <div class="card">
                    <h3>For Homebuyers</h3>
                    <p>Explore property values, understand neighborhood trends, and make informed purchasing decisions.</p>
                </div>
                <div class="card">
                    <h3>For Investors</h3>
                    <p>Analyze historical data, identify emerging markets, and assess potential real estate investments.</p>
                </div>
                <div class="card">
                    <h3>For Researchers</h3>
                    <p>Access comprehensive housing data for academic and professional studies.</p>
                </div>
            </div>

            <h2>Data Disclaimer</h2>
            <p>All data is sourced from public records and is provided for informational purposes. While we strive for accuracy, users should verify information with official sources before making any decisions.</p>
        </section>
    </div>

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