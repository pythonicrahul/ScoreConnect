package com.example.scoreconnect;

import android.content.Context;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import java.util.List;

public class AdapterTask extends RecyclerView.Adapter<AdapterTask.ViewHolder> {

    LayoutInflater layoutInflater;
    List<Task> taskList;

    public AdapterTask(Context ctx,List<Task> taskList){
        this.layoutInflater = LayoutInflater.from(ctx);
        this.taskList = taskList;
    }

    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = layoutInflater.inflate(R.layout.one_task,parent,false);
        return new ViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull ViewHolder holder, int position) {
        holder.taskname.setText(taskList.get(position).getTask());
        holder.taskdate.setText(taskList.get(position).getDate());
    }

    @Override
    public int getItemCount() {
        return taskList.size();
    }


    public class ViewHolder extends RecyclerView.ViewHolder{
        TextView taskname;
        TextView taskdate;


        public ViewHolder(@NonNull View itemView) {
            super(itemView);
            taskname = itemView.findViewById(R.id.task_name);
            taskdate = itemView.findViewById(R.id.task_date);
        }
    }
}
