<?php
// PHP code can be used here to load or process data if needed, but this basic example will be served via JavaScript
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Boston Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    <link rel="stylesheet" href="styles.css">

</head>
<body>
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

    <h2>Boston Neighborhoods Interactive Map</h2>
    <div id="map"></div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-ajax/dist/leaflet.ajax.min.js"></script>
    <script>
        // Initialize the map
        var map = L.map('map').setView([42.3601, -71.0589], 12); // Coordinates for Boston

        // Add a base map layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19
        }).addTo(map);

        // Load GeoJSON data for neighborhoods
        var neighborhoodsLayer = L.geoJSON(null, {
            onEachFeature: function (feature, layer) {
                layer.on('click', function () {
                    var score = prompt('Enter a score for ' + feature.properties.name + ':', '0');
                    if (score !== null) {
                        alert('You entered a score of ' + score + ' for ' + feature.properties.name);
                        // Optionally, you could send this score to a PHP script to store in a database
                    }
                });
            }
        }).addTo(map);

        // Load the GeoJSON file (assuming it's in the same directory)
        fetch('boston-neighborhoods.geojson')
            .then(response => response.json())
            .then(data => {
                neighborhoodsLayer.addData(data);
            });

        // Set a style for the neighborhoods
        neighborhoodsLayer.setStyle({
            color: 'blue',
            weight: 2,
            opacity: 0.5,
            fillColor: 'blue',
            fillOpacity: 0.3
        });
    </script>
</body>
</html>
