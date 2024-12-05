import geopandas as gpd
import json

def count_stations_in_neighborhoods(neighborhoods_file, stations_file, output_file):
    # Read GeoJSON files
    neighborhoods = gpd.read_file(neighborhoods_file)
    stations = gpd.read_file(stations_file)
    
    # Ensure we're working with the same coordinate system
    # Both files appear to use WGS 84 (EPSG:4326) based on the coordinates
    neighborhoods = neighborhoods.set_crs('EPSG:4326', allow_override=True)
    stations = stations.set_crs('EPSG:4326', allow_override=True)
    
    # Spatial join to count stations in each neighborhood
    joined = gpd.sjoin(neighborhoods, stations, how='left', predicate='contains')
    
    # Count stations per neighborhood
    station_counts = joined.groupby('Name')['Number'].count().reset_index()
    station_counts.columns = ['Neighborhood', 'Station_Count']
    
    # Merge counts back to neighborhoods
    neighborhoods = neighborhoods.merge(
        station_counts, 
        left_on='Name', 
        right_on='Neighborhood', 
        how='left'
    )
    
    # Fill any neighborhoods with no stations with 0
    neighborhoods['Station_Count'] = neighborhoods['Station_Count'].fillna(0)
    
    # Create a summary dictionary for easy reading
    summary = neighborhoods[['Name', 'Station_Count', 'Acres']].to_dict('records')
    
    # Save the result with the new station counts
    neighborhoods.to_file(output_file, driver='GeoJSON')
    
    return summary

if __name__ == "__main__":
    neighborhoods_file = "page/Boston_Neighborhoods.geojson"
    stations_file = "blue_bike_stations.geojson"
    output_file = "neighborhoods_with_stations.geojson"
    
    try:
        summary = count_stations_in_neighborhoods(
            neighborhoods_file, 
            stations_file, 
            output_file
        )
        
        print("\nStation Count Summary:")
        print("-" * 50)
        for area in summary:
            print(f"Neighborhood: {area['Name']}")
            print(f"Station Count: {area['Station_Count']}")
            print(f"Area (acres): {area['Acres']:.2f}")
            print("-" * 50)
            
    except Exception as e:
        print(f"An error occurred: {str(e)}")