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
    <title>Resources - Boston Housing Prices</title>
    <style>
        .resource-list {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .resource-list h2 {
            border-bottom: 2px solid #FF7E5F;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .resource-list ul {
            list-style-type: none;
            padding: 0;
        }
        .resource-list li {
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        .resource-list a {
            color: #FF7E5F;
            text-decoration: none;
            font-weight: bold;
        }
        .resource-list a:hover {
            text-decoration: underline;
        }
    </style>
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

    <div class="container">
        <h1>Housing Resources</h1>
        
        <div class="resource-list">
            <h2>Research and Analysis</h2>
            <ul>
                <li>
                    <a href="https://www.bostonplans.org/housing" target="_blank">Boston Housing Authority</a>
                    <p>Official resource for housing policies and programs in Boston</p>
                </li>
                <li>
                    <a href="https://www.zillow.com/boston-ma/home-values/" target="_blank">Zillow Boston Housing Market</a>
                    <p>Comprehensive housing market data and trends</p>
                </li>
                <li>
                    <a href="https://www.massachusetts.gov/housing-resources" target="_blank">Massachusetts Housing Resources</a>
                    <p>State-level housing information and support</p>
                </li>
            </ul>

            <h2>Real Estate Tools</h2>
            <ul>
                <li>
                    <a href="https://www.redfin.com/city/2431/MA/Boston/housing-market" target="_blank">Boston Real Estate Market Reports</a>
                    <p>Market analysis and property insights</p>
                </li>
                <li>
                    <a href="https://www.realtor.com/local/boston-ma" target="_blank">Realtor.com Boston Market Data</a>
                    <p>Comprehensive real estate listings and market trends</p>
                </li>
            </ul>

            <h2>Financial Resources</h2>
            <ul>
                <li>
                    <a href="https://www.bankrate.com/real-estate/massachusetts-first-time-homebuyer-programs/" target="_blank">First-Time Homebuyer Programs</a>
                    <p>Financial assistance and mortgage resources</p>
                </li>
                <li>
                    <a href="https://www.freddiemac.com/home-owners" target="_blank">Freddie Mac Housing Resources</a>
                    <p>Mortgage and homeownership support</p>
                </li>
            </ul>
        </div>
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