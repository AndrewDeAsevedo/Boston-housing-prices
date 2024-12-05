const fs = require('fs');
const path = require('path');
const csvParser = require('csv-parser');

// Path to your CSV file
const csvFilePath = path.join(__dirname, 'Neighborhood_Points.csv');

// Function to read the scores from the CSV file
function getNeighborhoodScores(callback) {
    const scores = {};

    fs.createReadStream(csvFilePath)
        .pipe(csvParser())
        .on('data', (row) => {
            // Assuming the CSV has columns "Neighborhood" and "Score"
            const neighborhood = row.Neighborhood;
            const score = parseInt(row.Score, 10);

            if (neighborhood && !isNaN(score)) {
                scores[neighborhood] = score;
            }
        })
        .on('end', () => {
            console.log('CSV file successfully processed');
            callback(null, scores); // Pass the scores object to the callback
        })
        .on('error', (err) => {
            console.error('Error reading CSV file:', err);
            callback(err);
        });
}

// Function to get the score for a specific neighborhood
function getScoreForNeighborhood(neighborhoodName, callback) {
    getNeighborhoodScores((err, scores) => {
        if (err) {
            callback(err, null);
        } else {
            const score = scores[neighborhoodName] || 'No score available';
            callback(null, score);
        }
    });
}

// Example usage: Get the score for "Back Bay"
getScoreForNeighborhood('Back Bay', (err, score) => {
    if (err) {
        console.error('Error retrieving score:', err);
    } else {
        console.log(`The score for Back Bay is: ${score}`);
    }
});
