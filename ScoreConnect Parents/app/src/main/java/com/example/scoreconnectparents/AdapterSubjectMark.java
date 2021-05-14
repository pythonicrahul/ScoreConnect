package com.example.scoreconnectparents;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import java.util.List;

public class AdapterSubjectMark extends RecyclerView.Adapter<AdapterSubjectMark.ViewHolder> {

    LayoutInflater layoutInflater;
    List<SubjectMark> subjectMarkList;

    public AdapterSubjectMark(Context ctx,List<SubjectMark> subjectMarks){
        this.layoutInflater = layoutInflater.from(ctx);
        this.subjectMarkList = subjectMarks;
    }

    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = layoutInflater.inflate(R.layout.subject_mark,parent,false);
        return new ViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull ViewHolder holder, int position) {
        holder.subject.setText(subjectMarkList.get(position).getSubject());
        holder.mark.setText(subjectMarkList.get(position).getMark());
    }

    @Override
    public int getItemCount() {
        return subjectMarkList.size();
    }

    public class ViewHolder extends RecyclerView.ViewHolder{

        TextView subject,mark;

        public ViewHolder(@NonNull View itemView) {
            super(itemView);
            subject = itemView.findViewById(R.id.subject);
            mark = itemView.findViewById(R.id.mark);
        }
    }

}
