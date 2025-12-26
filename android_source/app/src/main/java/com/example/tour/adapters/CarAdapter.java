package com.example.tour.adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;
import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;
import com.bumptech.glide.Glide;
import com.example.tour.R;
import com.example.tour.models.Car;
import java.util.List;

public class CarAdapter extends RecyclerView.Adapter<CarAdapter.CarViewHolder> {
    private Context context;
    private List<Car> carList;

    public CarAdapter(Context context, List<Car> carList) {
        this.context = context;
        this.carList = carList;
    }

    @NonNull
    @Override
    public CarViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(context).inflate(R.layout.item_car, parent, false);
        return new CarViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull CarViewHolder holder, int position) {
        Car car = carList.get(position);
        holder.tvModel.setText(car.model);
        holder.tvCompany.setText(car.companyName);
        holder.tvPrice.setText("ETB " + car.pricePerDay + " / day");
        
        Glide.with(context).load(car.imageUrl).into(holder.ivImage);
        
        // Add click listener if needed
    }

    @Override
    public int getItemCount() {
        return carList.size();
    }

    public static class CarViewHolder extends RecyclerView.ViewHolder {
        TextView tvModel, tvCompany, tvPrice;
        ImageView ivImage;

        public CarViewHolder(@NonNull View itemView) {
            super(itemView);
            tvModel = itemView.findViewById(R.id.tvCarModel);
            tvCompany = itemView.findViewById(R.id.tvCarCompany);
            tvPrice = itemView.findViewById(R.id.tvCarPrice);
            ivImage = itemView.findViewById(R.id.ivCarImage);
        }
    }
}
