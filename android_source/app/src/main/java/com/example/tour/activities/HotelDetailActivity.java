package com.example.tour.activities;

import android.content.Intent;
import android.os.Bundle;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import androidx.appcompat.app.AppCompatActivity;
import com.bumptech.glide.Glide;
import com.example.tour.R;

public class HotelDetailActivity extends AppCompatActivity {

    private TextView tvName, tvLocation, tvDesc, tvPrice;
    private ImageView ivImage;
    private Button btnBook;
    
    // Data placeholders
    private int hotelId;
    private String name, location, desc, imgUrl;
    private double price;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_hotel_detail);

        // Get Data from Intent
        hotelId = getIntent().getIntExtra("id", 0);
        name = getIntent().getStringExtra("name");
        location = getIntent().getStringExtra("location");
        desc = getIntent().getStringExtra("desc");
        imgUrl = getIntent().getStringExtra("img");
        price = getIntent().getDoubleExtra("price", 0.0);

        // Init Views
        tvName = findViewById(R.id.tvDetailName);
        tvLocation = findViewById(R.id.tvDetailLocation);
        tvDesc = findViewById(R.id.tvDetailDescription);
        tvPrice = findViewById(R.id.tvDetailPrice);
        ivImage = findViewById(R.id.ivHotelDetailImage);
        btnBook = findViewById(R.id.btnBookNow);

        // Set Data
        tvName.setText(name);
        tvLocation.setText(location);
        tvDesc.setText(desc);
        tvPrice.setText("ETB " + price);
        
        Glide.with(this)
            .load(imgUrl)
            .placeholder(R.drawable.ic_placeholder)
            .error(R.drawable.ic_placeholder)
            .into(ivImage);

        // Booking Action
        btnBook.setOnClickListener(v -> {
            Intent intent = new Intent(HotelDetailActivity.this, BookingActivity.class);
            intent.putExtra("hotel_id", hotelId);
            intent.putExtra("hotel_name", name);
            intent.putExtra("price", price);
            startActivity(intent);
        });
    }
}
