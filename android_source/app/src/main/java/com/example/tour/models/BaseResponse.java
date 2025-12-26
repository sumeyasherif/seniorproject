package com.example.tour.models;

import com.google.gson.annotations.SerializedName;

public class BaseResponse<T> {
    @SerializedName("status")
    public boolean status;
    
    @SerializedName("message")
    public String message;
    
    @SerializedName("data")
    public T data;
    
    @SerializedName("user")
    public T user; // For login response where key is 'user'
}
