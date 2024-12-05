import geopandas as gpd
import pandas as pd

# Load the GeoJSON file containing Boston neighborhoods
neighborhoods_gdf = gpd.read_file('page/Boston_Neighborhoods.geojson')

# Load the new GeoJSON file for non-public schools
non_public_schools_gdf = gpd.read_file('public_schools.geojson')

# Ensure both are in the same CRS (Coordinate Reference System)
non_public_schools_gdf = non_public_schools_gdf.to_crs(neighborhoods_gdf.crs)

# Perform a spatial join to assign each school to a neighborhood
joined_gdf = gpd.sjoin(non_public_schools_gdf, neighborhoods_gdf, how='left', predicate='within')

# Inspect the joined data to identify the correct neighborhood column
print(joined_gdf.head())  # Display the first few rows
print(joined_gdf.columns)  # List the column names

# Modify the groupby line based on the actual neighborhood column name
# Replace 'Name' with the correct neighborhood column name if different
station_counts = joined_gdf.groupby('Name').size().reset_index(name='Public_schools_Count')

# Save the output to a CSV file
station_counts.to_csv('Public_schools.csv', index=False)
