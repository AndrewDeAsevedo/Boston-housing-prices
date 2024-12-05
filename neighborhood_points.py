import pandas as pd
import os

# List of neighborhoods
neighborhoods = [
    "East Boston", "Charlestown", "North End", "West End", "Downtown", 
    "Beacon Hill", "Leather District", "Chinatown", "Bay Village", 
    "Back Bay", "South Boston Waterfront", "South End", "South Boston", 
    "Fenway", "Longwood", "Mission Hill", "Roxbury", "Dorchester", 
    "Jamaica Plain", "Allston", "Brighton", "Mattapan", "Roslindale", 
    "West Roxbury", "Hyde Park"
]

# Points mapping for each CSV
points_mapping = {
    "non_public_schools_in_neighborhoods.csv": 5,
    "hospitals.csv": 10,
    "bluebikes_in_neighborhoods.csv": 5,
    "Charging_spaces.csv": 1,
    "open_space_in_neighborhoods.csv": 10,
    "Pedestrian_Ramps.csv": 5,
    "Community_Centers.csv": 5,
    "Public_schools.csv": 5,
    "crimes_by_neighborhood.csv": -0.1

}

# Neighborhood population
neighborhood_pop = {
    "East Boston": 43066, "Charlestown": 19832, "North End": 10131, "West End": 4080,
    "Downtown": 16903, "Beacon Hill": 9500, "Leather District": 723, 
    "Chinatown": 150000, "Bay Village": 1312, "Back Bay": 18176, 
    "South Boston Waterfront": 5456, "South End": 36423, "South Boston": 33688, 
    "Fenway": 37733, "Longwood": 2885, "Mission Hill": 18722, "Roxbury": 59626, 
    "Dorchester": 122191, "Jamaica Plain": 41012, "Allston": 28621, "Brighton": 48248, 
    "Mattapan": 35325, "Roslindale": 31446, "West Roxbury": 33930, "Hyde Park": 35147
}

# Folder containing CSV files
input_folder = "cleaned_CSVs"

# Initialize total points for each neighborhood
total_points = {neighborhood: 0 for neighborhood in neighborhoods}

# Process each CSV
for filename, points in points_mapping.items():
    filepath = os.path.join(input_folder, filename)
    if os.path.exists(filepath):
        # Load CSV into a DataFrame
        df = pd.read_csv(filepath)

        # Ensure neighborhood names match the full list (fill in missing ones with 0 counts)
        df = df.set_index("Name").reindex(neighborhoods, fill_value=0).reset_index()

        # Add points for this metric to the total
        for _, row in df.iterrows():
            total_points[row["Name"]] += row[df.columns[1]] * points

# Normalize points by area
normalized_points = {neighborhood: total / neighborhood_pop[neighborhood] 
                     for neighborhood, total in total_points.items()}

# Create a DataFrame for the final results
final_df = pd.DataFrame({
    "Neighborhood": neighborhoods,
    "Total_Points": [total_points[neighborhood] for neighborhood in neighborhoods],
    "Normalized_Points": [normalized_points[neighborhood] for neighborhood in neighborhoods]
})

# Save the results to a CSV
final_df.to_csv("Neighborhood_Points.csv", index=False)

print("Processing complete. Results saved to 'Neighborhood_Points.csv'.")
