import pandas as pd

# Load the CSV file
df = pd.read_csv('data.csv')

# Remove rows where the neighborhood is 'Unknown'
df = df[df['Neighborhood'] != 'Unknown']

# Save the updated DataFrame back to a CSV file
df.to_csv('data_cleaned.csv', index=False)