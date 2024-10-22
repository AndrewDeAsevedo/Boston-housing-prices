import csv
import re

def clean_csv(input_file, output_file):
    with open(input_file, 'r', newline='', encoding='utf-8') as infile, \
         open(output_file, 'w', newline='', encoding='utf-8') as outfile:
        reader = csv.reader(infile)
        writer = csv.writer(outfile, quoting=csv.QUOTE_ALL)

        for row in reader:
            cleaned_row = [clean_field(field) for field in row]
            writer.writerow(cleaned_row)

def clean_field(field):
    # Remove any unescaped double quotes
    field = re.sub(r'(?<!\\)"', '', field)
    # Remove any backslashes used for escaping
    field = field.replace('\\', '')
    return field.strip()

if __name__ == "__main__":
    input_file = "crime.csv"
    output_file = "crime1.csv"
    clean_csv(input_file, output_file)
    print(f"Cleaned CSV file has been saved as {output_file}")