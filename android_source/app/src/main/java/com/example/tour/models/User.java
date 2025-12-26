package com.example.tour.models;

import com.google.gson.annotations.SerializedName;

public class User {
    @SerializedName("id")
    public int id;
    
    @SerializedName("full_name")
    public String fullName;
    
    @SerializedName("email")
    public String email;
    
    @SerializedName("role_id")
    public int roleId;
}
