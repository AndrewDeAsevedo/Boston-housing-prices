import pandas as pd

def clean_districts(input_file, output_file):
    # Define the valid districts
    valid_districts = [
        'Allston',
        'Back Bay',
        'Bay Village',
        'Beacon Hill',
        'Brighton',
        'Boston',
        'Charlestown',
        'Chinatown',
        'Dorchester',
        'Downtown',
        'East Boston',
        'Fenway-Kenmore',
        'Hyde Park',
        'Jamaica Plain',
        'Leather District',
        'Longwood Medical Area',
        'Mattapan',
        'Mission Hill',
        'North End',
        'Roslindale',
        'Roxbury',
        'South Boston',
        'South End',
        'West End',
        'West Roxbury'
    ]

    # Read the CSV file
    df = pd.read_csv(input_file)
    
    # Clean district names (remove extra spaces, standardize case)
    df['District'] = df['District'].str.strip()
    df['District'] = df['District'].str.title()
    
    # Keep only rows where District is in our valid districts list
    df = df[df['District'].isin(valid_districts)]
    
    # Sort by District name
    df = df.sort_values('District')
    
    # Remove duplicates
    df = df.drop_duplicates()
    
    # Save the cleaned data
    df.to_csv(output_file, index=False)

if __name__ == "__main__":
    input_file = "blue_bike_stations.csv"
    output_file = "cleaned_blue_bike_stations.csv"
    
    try:
        clean_districts(input_file, output_file)
        print("File cleaned successfully!")
    except Exception as e:
        print(f"An error occurred: {str(e)}")