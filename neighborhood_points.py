import pandas as pd
import os

# List of neighborhoods
neighborhoods = [
    "East Boston", "Charleston", "North End", "West End", "Downtown", 
    "Beacon Hill", "Leather District", "Chinatown", "Bay Village", 
    "Back Bay", "South Boston Waterfront", "South End", "South Boston", 
    "Fenway", "Longwood", "Mission Hill", "Roxbury", "Dorchester", 
    "Jamaica Plain", "Allston", "Brighton", "Mattapan", "Roslindale", 
    "West Roxbury", "Hyde Park"
]

# Points mapping for each CSV
points_mapping = {
    "non_Public_Schools.csv": 5,
    "hospitals.csv": 10,
    "bluebikes_in_neighborhoods.csv": 5,
    "Charging_spaces.csv": 1,
    "open_space_in_neighborhoods.csv": 10,
    "Pedestrian_Ramps.csv": 5,
    "Community_Centers.csv": 5,
    "Public_schools.csv": 5
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

# Create a DataFrame for the final results
final_df = pd.DataFrame(list(total_points.items()), columns=["Neighborhood", "Total_Points"])

# Save the results to a CSV
final_df.to_csv("Neighborhood_Points.csv", index=False)

print("Processing complete. Results saved to 'Neighborhood_Points.csv'.")
