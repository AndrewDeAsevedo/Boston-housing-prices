import csv
import sys

def csv_to_sql(csv_file, sql_file, table_name):
    with open(csv_file, 'r', newline='', encoding='utf-8') as csvfile:
        reader = csv.reader(csvfile)
        headers = next(reader)

        with open(sql_file, 'w', encoding='utf-8') as sqlfile:
            for row in reader:
                # Create a tuple of values for the SQL insert
                values = ', '.join(f"'{value}'" if value else 'NULL' for value in row)
                sqlfile.write(f"INSERT INTO {table_name} ({', '.join(headers)}) VALUES ({values});\n")

if __name__ == "__main__":
    if len(sys.argv) != 4:
        print("Usage: python csv_to_sql.py <csv_file> <sql_file> <table_name>")
    else:
        csv_file = sys.argv[1]
        sql_file = sys.argv[2]
        table_name = sys.argv[3]
        csv_to_sql(csv_file, sql_file, table_name)
        print(f"Converted {csv_file} to {sql_file} with table name {table_name}.")
