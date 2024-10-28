import pandas as pd

# Load the neighborhood-ZIP map and main data files
hood_zip_map = pd.read_csv("hoodZipMap.csv")
data = pd.read_csv("data.csv")

# Expand rows with multiple ZIP codes in hoodZipMap.csv
hood_zip_map = hood_zip_map.assign(ZIP_Code=hood_zip_map['ZIP Code'].str.split(',')).explode('ZIP Code')
hood_zip_map['ZIP Code'] = hood_zip_map['ZIP Code'].str.strip()  # Remove extra spaces

# Set up a dictionary for ZIP code to neighborhood mapping
zip_to_neighborhood = dict(zip(hood_zip_map['ZIP Code'], hood_zip_map['Neighborhood']))

# Map the ZIP_CODE in data.csv to the corresponding neighborhood
data['Neighborhood'] = data['ZIP_CODE'].astype(str).apply(lambda x: zip_to_neighborhood.get(x.zfill(5), "Unknown"))

# Save the updated DataFrame to a new CSV file
output_file_path = "data_with_neighborhoods.csv"
data.to_csv(output_file_path, index=False)

print(f"Updated file saved as {output_file_path}")
