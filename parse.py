from ydata_profiling import ProfileReport
import pandas as pd
import streamlit as st


df = pd.read_csv("data.csv")
#profile = ProfileReport(df, title="Pandas Profiling Report")
# profile.to_notebook_iframe()
#with open("report.html", "w") as f:
   # f.write(profile.to_html())
pd.to_numeric(df["LAND_SF"], errors="coerce")
pd.to_numeric(df["TOTAL_VALUE"], errors="coerce")
df["LAND_SF"].corr(df["TOTAL_VALUE"])