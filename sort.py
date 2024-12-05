import geopandas as gpd
import pandas as pd

# Load the GeoJSON file containing Boston neighborhoods
# Make sure the file path is correct
neighborhoods_gdf = gpd.read_file('page/Boston_Neighborhoods.geojson')  # Ensure the file path is correct

# Load the bike stations GeoJSON
bike_stations_gdf = gpd.read_file('blue_bike_stations.geojson')  # Ensure the file path is correct

# Ensure both are in the same CRS (Coordinate Reference System)
# Assuming both datasets are in EPSG:4326 (WGS 84)
bike_stations_gdf = bike_stations_gdf.to_crs(neighborhoods_gdf.crs)

# Perform a spatial join to assign each bike station to a neighborhood
# Use 'predicate' instead of 'op' for newer versions of GeoPandas
joined_gdf = gpd.sjoin(bike_stations_gdf, neighborhoods_gdf, how='left', predicate='within')

# Inspect the joined data to identify the correct neighborhood column
print(joined_gdf.head())  # Display the first few rows
print(joined_gdf.columns)  # List the column names

# You should see the column corresponding to the neighborhood, which could be something like 'Name_right' or 'Neighborhood_ID'

# Modify the groupby line based on the actual neighborhood column name
# Replace 'Name_right' with the correct neighborhood column name after inspecting the DataFrame
station_counts = joined_gdf.groupby('Name_right').size().reset_index(name='Bike_Station_Count')

# Save the output to a CSV file
station_counts.to_csv('bluebikes_in_neighborhoods.csv', index=False)
