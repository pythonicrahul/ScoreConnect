package com.example.scoreconnect;
import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import java.util.List;

public class Adapter extends RecyclerView.Adapter<Adapter.ViewHolder> {

    LayoutInflater layoutInflater;
    List<Student> students;

    public Adapter(Context ctx,List<Student> students){
        this.layoutInflater = LayoutInflater.from(ctx);
        this.students = students;
    }

    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = layoutInflater.inflate(R.layout.student_info,parent,false);

        return new ViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull ViewHolder holder, int position) {
        holder.student_name.setText(students.get(position).getName());
        String roll_no = students.get(position).getRoll_no().toString();
        holder.student_roll.setText(roll_no);

    }

    @Override
    public int getItemCount() {
        return students.size();
    }

    public class ViewHolder extends RecyclerView.ViewHolder{
        TextView student_name;
        TextView student_roll;



        public ViewHolder(@NonNull View itemView) {
            super(itemView);
            student_name = itemView.findViewById(R.id.student_info_name);
            student_roll = itemView.findViewById(R.id.student_info_roll);
        }
    }

}
