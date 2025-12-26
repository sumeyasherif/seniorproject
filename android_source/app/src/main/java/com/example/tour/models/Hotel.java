package com.example.tour.models;

import com.google.gson.annotations.SerializedName;

public class Hotel {
    @SerializedName("id")
    public int id;
    
    @SerializedName("name")
    public String name;
    
    @SerializedName("location")
    public String location;
    
    @SerializedName("description")
    public String description;
    
    @SerializedName("image_url")
    public String imageUrl;
    
    @SerializedName("price_per_night")
    public double pricePerNight;
}
