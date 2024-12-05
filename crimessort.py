import csv
from collections import defaultdict

# Input and output file paths
input_file = "crime1.csv"
output_file = "crimes_by_neighborhood.csv"

# Dictionary to count crimes by neighborhood
crime_counts = defaultdict(int)

# Read the input CSV and count crimes
with open(input_file, "r", newline='', encoding='utf-8') as csvfile:
    reader = csv.DictReader(csvfile)
    for row in reader:
        neighborhood = row["Neighborhood"].strip()
        if neighborhood:  # Ensure the neighborhood column is not empty
            crime_counts[neighborhood] += 1

# Write the results to a new CSV file
with open(output_file, "w", newline='', encoding='utf-8') as csvfile:
    writer = csv.writer(csvfile)
    writer.writerow(["Neighborhood", "Crime Count"])
    for neighborhood, count in sorted(crime_counts.items()):
        writer.writerow([neighborhood, count])

print(f"Crime counts by neighborhood have been written to {output_file}.")
