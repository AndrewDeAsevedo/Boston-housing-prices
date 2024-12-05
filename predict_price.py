import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.ensemble import RandomForestRegressor
from sklearn.metrics import mean_squared_error
from sklearn.preprocessing import OneHotEncoder

# Load the dataset
data = pd.read_csv("data.csv")  # Ensure this file includes the Neighborhood column

# Clean the target variable by removing commas and converting to float
data['BLDG_VALUE'] = data['BLDG_VALUE'].str.replace(',', '').astype(float)

# One-hot encode the Neighborhood column
encoder = OneHotEncoder(sparse_output=False)  # Ensure sparse is set to False for a dense array
neighborhood_encoded = encoder.fit_transform(data[['Neighborhood']])

# Create a DataFrame for the encoded neighborhoods
neighborhood_df = pd.DataFrame(neighborhood_encoded, columns=encoder.get_feature_names_out(['Neighborhood']))

# Combine the original data with the encoded neighborhoods
data = pd.concat([data.reset_index(drop=True), neighborhood_df.reset_index(drop=True)], axis=1)

# Select relevant features and target variable
features = data[['LIVING_AREA', 'BED_RMS', 'FULL_BTH'] + list(neighborhood_df.columns)]
target = data['BLDG_VALUE']

# Split the dataset into training and testing sets
X_train, X_test, y_train, y_test = train_test_split(features, target, test_size=0.2, random_state=42)

# Initialize and train the model
model = RandomForestRegressor(n_estimators=100, random_state=42)
model.fit(X_train, y_train)

# Evaluate the model
predictions = model.predict(X_test)
mse = mean_squared_error(y_test, predictions)
print(f"Mean Squared Error: {mse}")

# Function to predict price based on user input
def predict_price(living_area, bedrooms, full_baths, neighborhood):
    # Encode the neighborhood input
    neighborhood_encoded = encoder.transform([[neighborhood]])
    input_data = pd.DataFrame([[living_area, bedrooms, full_baths] + neighborhood_encoded[0].tolist()],
                               columns=['LIVING_AREA', 'BED_RMS', 'FULL_BTH'] + list(neighborhood_df.columns))
    predicted_price = model.predict(input_data)
    return predicted_price[0]

# Example usage
if __name__ == "__main__":
    # Get user input
    living_area = float(input("Enter the square footage (LIVING_AREA): "))
    bedrooms = int(input("Enter the number of bedrooms (BED_RMS): "))
    full_baths = int(input("Enter the number of full baths (FULL_BTH): "))
    neighborhood = input("Enter the neighborhood: ")  # New input for neighborhood
    
    price = predict_price(living_area, bedrooms, full_baths, neighborhood)
    print(f"The predicted price of the house is: ${price:,.2f}") 