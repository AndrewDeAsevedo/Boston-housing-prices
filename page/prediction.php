<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>House Price Prediction</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel = "stylesheet" href = "styles.css">
</head>
<body>
    <h1>Predict House Price</h1>
    <form id="predictionForm">
        <input type="text" name="living_area" placeholder="Living Area" required>
        <input type="text" name="bedrooms" placeholder="Bedrooms" required>
        <input type="text" name="full_baths" placeholder="Full Baths" required>
   <label for="neighborhood">Neighborhood:</label>
    <select name="neighborhood" id="neighborhood" required>
        <option value="Allston">Allston</option>
        <option value="Back Bay">Back Bay</option>
        <option value="Bay Village">Bay Village</option>
        <option value="Beacon Hill">Beacon Hill</option>
        <option value="Brighton">Brighton</option>
        <option value="Charlestown">Charlestown</option>
        <option value="Chinatown">Chinatown</option>
        <option value="Dorchester">Dorchester</option>
        <option value="Downtown">Downtown</option>
        <option value="East Boston">East Boston</option>
        <option value="Fenway-Kenmore">Fenway-Kenmore</option>
        <option value="Hyde Park">Hyde Park</option>
        <option value="Jamaica Plain">Jamaica Plain</option>
        <option value="Leather District">Leather District</option>
        <option value="Longwood Medical Area">Longwood Medical Area</option>
        <option value="Mattapan">Mattapan</option>
        <option value="Mission Hill">Mission Hill</option>
        <option value="North End">North End</option>
        <option value="Roslindale">Roslindale</option>
        <option value="Roxbury">Roxbury</option>
        <option value="South Boston">South Boston</option>
        <option value="South End">South End</option>
        <option value="West End">West End</option>
        <option value="West Roxbury">West Roxbury</option>
    </select>
        <button type="submit">Predict</button>
    </form>
    <div id="loading" style="display:none;">Calculating...</div>
    <div id="result"></div>

    <script>
        $(document).ready(function() {
            $('#predictionForm').on('submit', function(event) {
                event.preventDefault(); // Prevent the form from submitting normally
                $('#loading').show(); // Show loading indicator
                $('#result').empty(); // Clear previous results

                $.ajax({
                    type: 'POST',
                    url: 'predict.php',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        $('#loading').hide(); // Hide loading indicator
                        $('#result').html('<h2>' + response.predicted_price + '</h2>');
                    },
                    error: function() {
                        $('#loading').hide(); // Hide loading indicator
                        $('#result').html('<h2>Error occurred while predicting.</h2>');
                    }
                });
            });
        });
    </script>
</body>
</html>