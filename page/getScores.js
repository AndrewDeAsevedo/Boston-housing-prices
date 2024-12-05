// This function will retrieve the scores for each neighborhood
async function getNeighborhoodScores() {
    const response = await fetch('Neighborhood_Points.csv');
    const csvText = await response.text();

    // Parse CSV data
    const rows = csvText.split('\n').slice(1); // Skip the header row
    const scores = {};

    rows.forEach(row => {
        if (row.trim()) { // Skip empty lines
            const [neighborhood, , normalizedPoints] = row.split(',');
            scores[neighborhood.trim()] = parseFloat(normalizedPoints.trim());
        }
    });

    return scores;
}

// This function will be called when a neighborhood is clicked to get the score
function getScoreForNeighborhood(neighborhoodName) {
    const scores = getNeighborhoodScores();
    return scores[neighborhoodName] || 'No score available';
}
