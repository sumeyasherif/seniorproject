package com.example.tour.activities;

import android.os.Bundle;
import android.widget.Toast;
import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import com.example.tour.R;
import com.example.tour.adapters.CarAdapter;
import com.example.tour.adapters.EventAdapter;
import com.example.tour.adapters.HotelAdapter;
import com.example.tour.api.RetrofitClient;
import com.example.tour.models.BaseResponse;
import com.example.tour.models.Car;
import com.example.tour.models.Event;
import com.example.tour.models.Hotel;
import com.google.android.material.bottomnavigation.BottomNavigationView;
import java.util.List;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class HomeActivity extends AppCompatActivity {
    private RecyclerView rvContent;
    private BottomNavigationView bottomNav;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);

        rvContent = findViewById(R.id.rvHotels);
        rvContent.setLayoutManager(new LinearLayoutManager(this));
        
        bottomNav = findViewById(R.id.bottom_navigation);
        
        // Load default (Hotels)
        loadHotels();

        bottomNav.setOnItemSelectedListener(item -> {
            int itemId = item.getItemId();
            if (itemId == R.id.nav_stays) {
                loadHotels();
                return true;
            } else if (itemId == R.id.nav_car_rental) {
                loadCars();
                return true;
            } else if (itemId == R.id.nav_attractions) {
                loadEvents();
                return true;
            }
            return false;
        });
    }

    private void loadHotels() {
        RetrofitClient.getService().getHotels().enqueue(new Callback<BaseResponse<List<Hotel>>>() {
            @Override
            public void onResponse(Call<BaseResponse<List<Hotel>>> call, Response<BaseResponse<List<Hotel>>> response) {
                if(response.isSuccessful() && response.body() != null && response.body().data != null) {
                    HotelAdapter adapter = new HotelAdapter(HomeActivity.this, response.body().data);
                    rvContent.setAdapter(adapter);
                }
            }
            @Override
            public void onFailure(Call<BaseResponse<List<Hotel>>> call, Throwable t) {
                Toast.makeText(HomeActivity.this, "Error: " + t.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });
    }

    private void loadCars() {
        RetrofitClient.getService().getCars().enqueue(new Callback<BaseResponse<List<Car>>>() {
            @Override
            public void onResponse(Call<BaseResponse<List<Car>>> call, Response<BaseResponse<List<Car>>> response) {
                if(response.isSuccessful() && response.body() != null && response.body().data != null) {
                    CarAdapter adapter = new CarAdapter(HomeActivity.this, response.body().data);
                    rvContent.setAdapter(adapter);
                }
            }
            @Override
            public void onFailure(Call<BaseResponse<List<Car>>> call, Throwable t) {
                Toast.makeText(HomeActivity.this, "Error: " + t.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });
    }

    private void loadEvents() {
        RetrofitClient.getService().getEvents().enqueue(new Callback<BaseResponse<List<Event>>>() {
            @Override
            public void onResponse(Call<BaseResponse<List<Event>>> call, Response<BaseResponse<List<Event>>> response) {
                if(response.isSuccessful() && response.body() != null && response.body().data != null) {
                    EventAdapter adapter = new EventAdapter(HomeActivity.this, response.body().data);
                    rvContent.setAdapter(adapter);
                }
            }
            @Override
            public void onFailure(Call<BaseResponse<List<Event>>> call, Throwable t) {
                Toast.makeText(HomeActivity.this, "Error: " + t.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });
    }
}
