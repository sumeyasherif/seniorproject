package com.example.tour.api;

import com.example.tour.models.BaseResponse;
import com.example.tour.models.Hotel;
import com.example.tour.models.User;
import com.example.tour.models.LoginRequest;
import com.example.tour.models.Car;
import com.example.tour.models.Event;

import java.util.List;
import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.GET;
import retrofit2.http.POST;
import retrofit2.http.Query;

public interface ApiService {
    @POST("index.php?action=login")
    Call<BaseResponse<User>> login(@Body LoginRequest request);

    @GET("index.php?action=hotels")
    Call<BaseResponse<List<Hotel>>> getHotels();
    
    @GET("index.php?action=cars")
    Call<BaseResponse<List<Car>>> getCars();
    
    @GET("index.php?action=events")
    Call<BaseResponse<List<Event>>> getEvents();
}
