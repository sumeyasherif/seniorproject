package com.example.tour.models;

import com.google.gson.annotations.SerializedName;

public class Car {
    @SerializedName("id")
    public int id;
    
    @SerializedName("company_name")
    public String companyName;
    
    @SerializedName("model")
    public String model;
    
    @SerializedName("price_per_day")
    public double pricePerDay;
    
    @SerializedName("image_url")
    public String imageUrl;
    
    @SerializedName("status")
    public String status;
}
