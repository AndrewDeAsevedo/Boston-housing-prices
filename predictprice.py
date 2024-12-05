import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.ensemble import RandomForestRegressor
from sklearn.metrics import mean_squared_error

# Load the dataset
data = pd.read_csv("data.csv")

# Select relevant features and target variable
features = data[['LIVING_AREA', 'BED_RMS', 'FULL_BTH']]
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
def predict_price(living_area, bedrooms, full_baths):
    input_data = pd.DataFrame([[living_area, bedrooms, full_baths]], columns=['LIVING_AREA', 'BED_RMS', 'FULL_BTH'])
    predicted_price = model.predict(input_data)
    return predicted_price[0]

# Example usage
if __name__ == "__main__":
    # Get user input
    living_area = float(input("Enter the square footage (LIVING_AREA): "))
    bedrooms = int(input("Enter the number of bedrooms (BED_RMS): "))
    full_baths = int(input("Enter the number of full baths (FULL_BTH): "))
    
    price = predict_price(living_area, bedrooms, full_baths)
    print(f"The predicted price of the house is: ${price:,.2f}")