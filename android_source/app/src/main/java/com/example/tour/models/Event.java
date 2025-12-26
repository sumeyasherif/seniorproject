package com.example.tour.models;

import com.google.gson.annotations.SerializedName;

public class Event {
    @SerializedName("id")
    public int id;
    
    @SerializedName("name")
    public String name;
    
    @SerializedName("location")
    public String location;
    
    @SerializedName("event_date")
    public String eventDate;
    
    @SerializedName("description")
    public String description;
    
    @SerializedName("image_url")
    public String imageUrl;
}
