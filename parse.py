from ydata_profiling import ProfileReport
import pandas as pd
import streamlit as st
import geopandas as gpd
import matplotlib.pyplot as plt

property_data = pd.read_csv("data.csv")

# map Zip code to Census Bureau geographies
zip_tract_data = pd.read_csv('ZIP_TRACT_062024.csv')
# Clean ZIP_CODE and ZIP columns
property_data['ZIP_CODE'] = property_data['ZIP_CODE'].astype(str).str.zfill(5)
zip_tract_data['ZIP'] = zip_tract_data['ZIP'].astype(str).str.zfill(5)

# Merge datasets
merged_data = pd.merge(property_data, zip_tract_data, left_on='ZIP_CODE', right_on='ZIP', how='left')

# Load the census tract shapefile
tracts = gpd.read_file('tl_2024_25_tract.shp')  # Example for Massachusetts

# Ensure the data types match for merging
merged_data['TRACT'] = merged_data['TRACT'].astype(str).str.zfill(11)
tracts['GEOID'] = tracts['GEOID'].astype(str)

# Merge the merged data with the shapefile
geo_data = tracts.merge(merged_data, left_on='GEOID', right_on='TRACT', how='inner')

# Save to GeoJSON
geo_data.to_file("property_data.geojson", driver="GeoJSON")

