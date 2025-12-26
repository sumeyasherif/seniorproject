package com.example.tour.activities;

import android.os.Bundle;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;
import androidx.appcompat.app.AppCompatActivity;
import com.example.tour.R;

public class BookingActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_booking);

        String hotelName = getIntent().getStringExtra("hotel_name");
        double price = getIntent().getDoubleExtra("price", 0.0);

        TextView tvName = findViewById(R.id.tvBookingHotelName);
        TextView tvPrice = findViewById(R.id.tvBookingPrice);
        Button btnConfirm = findViewById(R.id.btnConfirmBooking);

        tvName.setText("Hotel: " + hotelName);
        tvPrice.setText("Total: ETB " + price);

        btnConfirm.setOnClickListener(v -> {
            // Here you would call the Booking API
            // For demo purposes:
            Toast.makeText(this, "Booking Successful! Notification sent.", Toast.LENGTH_LONG).show();
            finish(); 
        });
    }
}
