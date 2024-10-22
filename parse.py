from ydata_profiling import ProfileReport
import pandas as pd
import streamlit as st


df = pd.read_csv("data.csv")
profile = ProfileReport(df, title="Pandas Profiling Report")
profile.to_notebook_iframe()
with open("report.html", "w") as f:
   f.write(profile.to_html())

# Remove commas and convert to numeric
df["LAND_SF"] = df["LAND_SF"].str.replace(',', '').astype(float)
df["TOTAL_VALUE"] = df["TOTAL_VALUE"].str.replace(',', '').astype(float)

# Now calculate the correlation
correlation = df["LAND_SF"].corr(df["TOTAL_VALUE"])
print(f"Correlation between LAND_SF and TOTAL_VALUE: {correlation}")
