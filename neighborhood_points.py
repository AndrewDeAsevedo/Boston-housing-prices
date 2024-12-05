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
    "Public_schools.csv": 5
}

# Neighborhood areas in square miles
neighborhood_areas = {
    "East Boston": 4.7, "Charlestown": 1.4, "North End": 0.36, "West End": 0.5,
    "Downtown": 1.5, "Beacon Hill": 0.6, "Leather District": 0.019, 
    "Chinatown": 0.21, "Bay Village": 0.0625, "Back Bay": 1.6, 
    "South Boston Waterfront": 3.1, "South End": 0.71, "South Boston": 3.1, 
    "Fenway": 1.24, "Longwood": 0.125, "Mission Hill": 0.75, "Roxbury": 2.5, 
    "Dorchester": 6.0, "Jamaica Plain": 4.4, "Allston": 4.12, "Brighton": 2.78, 
    "Mattapan": 2.8, "Roslindale": 3.7, "West Roxbury": 4.61, "Hyde Park": 4.4
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
normalized_points = {neighborhood: total / neighborhood_areas[neighborhood] 
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
