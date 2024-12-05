const fs = require('fs');
const path = require('path');
const csvParser = require('csv-parser');

// This function will retrieve the scores for each neighborhood
function getNeighborhoodScores() {
    // Example scores data; you could replace this with an API call or a more complex data retrieval logic
    return {
        "Back Bay": 85,
        "South End": 20,
        "Dorchester": 72,
        "Cambridge": 92,
        "Jamaica Plain": 80
    };
}

// This function will be called when a neighborhood is clicked to get the score
function getScoreForNeighborhood(neighborhoodName) {
    const scores = getNeighborhoodScores();
    return scores[neighborhoodName] || 'No score available';
}
