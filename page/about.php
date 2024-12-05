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
            <p>Boston Housing Prices aims to provide an interactive, data-driven exploration of Boston's neighborhoods, helping users make well-informed decisions about housing and real estate trends. By combining geospatial analysis with property data, we present insights that benefit buyers, investors, and researchers alike.</p>
            
            <h2>Interactive Map</h2>
            <p>Our project features an interactive map that visualizes Boston neighborhoods and allows users to explore normalized scores, trends, and characteristics of each area. Users can click on neighborhoods to view detailed insights, including housing statistics and calculated scores derived from real data.</p>

            <h2>Data Highlights</h2>
            <p>The data powering our platform is sourced from official public records and additional curated datasets, such as:</p>
            <ul>
                <li>Neighborhood-specific property scores</li>
                <li>Land and living area details</li>
                <li>Property values and market trends</li>
                <li>Geospatial data, including GeoJSON and CSV files</li>
                <li>Interactive visualizations powered by Leaflet.js</li>
            </ul>

            <h2>Who We Help</h2>
            <div class="insight-cards">
                <div class="card">
                    <h3>For Homebuyers</h3>
                    <p>Understand the affordability and characteristics of Boston neighborhoods to find the right home for your needs.</p>
                </div>
                <div class="card">
                    <h3>For Investors</h3>
                    <p>Evaluate potential investment opportunities by comparing scores and analyzing historical data trends.</p>
                </div>
                <div class="card">
                    <h3>For Researchers</h3>
                    <p>Access a wealth of geospatial and statistical data for urban studies, housing policies, and market research.</p>
                </div>
            </div>

            <h2>How It Works</h2>
            <p>We combine several data processing tools and frameworks to deliver actionable insights:</p>
            <ul>
                <li><strong>Data Processing:</strong> Using Python and Pandas for cleaning and analyzing CSV files.</li>
                <li><strong>GeoJSON Integration:</strong> Mapping Boston's neighborhoods for spatial exploration.</li>
                <li><strong>Dynamic Scores:</strong> Normalized housing scores are calculated and displayed as percentages for clarity.</li>
                <li><strong>Visualization:</strong> An interactive map built with Leaflet.js, providing users with detailed visual insights.</li>
            </ul>

            <h2>Data Disclaimer</h2>
            <p>All data used in this project is publicly available and for informational purposes only. While we strive for accuracy, users are advised to cross-reference information with official sources before making critical decisions.</p>
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
