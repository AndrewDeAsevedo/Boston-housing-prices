import csv
from io import StringIO

def clean_csv(file_path):
    cleaned_data = []
    with open('data.csv', 'r') as csvfile:
        reader = csv.reader(csvfile)
        
        # Read header row
        header = next(reader)
        
        for row in reader:
            cleaned_row = []
            for cell in row:
                # Handle newlines within quoted fields
                if '"' in cell:
                    cleaned_cell = cell.replace('"', '').replace('\n', '"\n"')
                    cleaned_row.append(f'"{cleaned_cell}"')
                else:
                    cleaned_row.append(cell)
            
            cleaned_data.append(cleaned_row)
    
    return cleaned_data

# Input file path
input_file = 'data.csv'

# Output file path
output_file = 'out.csv'

# Clean the entire file
with open(input_file, 'r') as infile, open(output_file, 'w', newline='') as outfile:
    reader = csv.reader(infile)
    writer = csv.writer(outfile)
    
    # Write header
    header = next(reader)
    writer.writerow(header)
    
    # Clean and write rows
    for row in reader:
        cleaned_row = clean_csv(StringIO(' '.join(row)))
        writer.writerow(cleaned_row)

print(f"Cleaning completed. Output saved to {output_file}")
