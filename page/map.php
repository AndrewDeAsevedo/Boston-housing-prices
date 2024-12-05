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
    <div id="map" style="height: 600px;"></div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-ajax/dist/leaflet.ajax.min.js"></script>
    <script src="getScores.js"></script> <!-- Include the external JS file -->

    <script>
        // Initialize the map centered on Boston with an appropriate zoom level
        var map = L.map('map').setView([42.3601, -71.0589], 12);

        // Add a CartoDB Positron tile layer for a light, Apple Maps-like appearance
        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.carto.com/attributions">CARTO</a>',
            maxZoom: 19
        }).addTo(map);

        // Set the map's max bounds to restrict it to the Boston area
        var bounds = [[42.227, -71.191], [42.491, -70.885]]; // Adjust bounds as needed
        map.setMaxBounds(bounds);

        // Define a GeoJSON layer with a function for adding custom interactions
        var neighborhoodsLayer = L.geoJSON(null, {
            style: function (feature) {
                return {
                    color: '#333', // Border color
                    weight: 2, // Border thickness
                    fillColor: '#f4a261', // Fill color
                    fillOpacity: 0.5 // Transparency of the fill
                };
            },
            onEachFeature: function (feature, layer) {
                // Extract the neighborhood name from the feature properties
                var neighborhoodName = feature.properties.Name; // Case-sensitive property name

                // Fetch the score asynchronously
                getScoreForNeighborhood(neighborhoodName).then(score => {
                    var popupContent = `
                        <div style="text-align: center;">
                            <h4>${neighborhoodName}</h4>
                            <p>Score: ${score}</p>
                        </div>
                    `;

                    layer.bindPopup(popupContent);
                });

                layer.on('click', function () {
                    layer.openPopup();
                });
            }
        }).addTo(map);

        // Load GeoJSON data (assumes the file is in the same directory as this PHP file)
        fetch('Boston_Neighborhoods.geojson')
            .then(response => response.json())
            .then(data => {
                neighborhoodsLayer.addData(data);
            });
    </script>
</body>
</html>
