package com.example.scoreconnect;
import android.app.Dialog;
import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.TextView;
import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;
import java.util.List;

public class AdapterStudentWithSubject extends RecyclerView.Adapter<AdapterStudentWithSubject.ViewHolder> {

    LayoutInflater layoutInflater;
    List<Student> studentList;
    Context ctx;
    private String section_sno;
    private String subject_sno;
    private String exam_sno;

    public AdapterStudentWithSubject(Context ctx, List<Student> studentList) {

        this.layoutInflater = LayoutInflater.from(ctx);
        this.studentList = studentList;
        this.ctx = ctx;

    }

    public AdapterStudentWithSubject(Context ctx, List<Student> studentList, String section_sno,String subject_sno, String exam_sno) {

        this.layoutInflater = LayoutInflater.from(ctx);
        this.studentList = studentList;
        this.ctx = ctx;
        this.section_sno = section_sno;
        this.subject_sno = subject_sno;
        this.exam_sno = exam_sno;

    }

    @NonNull
    @Override
    public AdapterStudentWithSubject.ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {

        View view = layoutInflater.inflate(R.layout.student_with_subject_list,parent,false);
        return new ViewHolder(view);

    }

    @Override
    public void onBindViewHolder(@NonNull AdapterStudentWithSubject.ViewHolder holder, final int position) {

        String name_roll = studentList.get(position).getRoll_no() + " " + studentList.get(position).getName();
        holder.student_name.setText(name_roll);
        holder.btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(ctx,StudentMarksEnter.class);
                intent.putExtra("section_sno",section_sno);
                intent.putExtra("subject_sno",subject_sno);
                intent.putExtra("exam_sno",exam_sno);
                intent.putExtra("roll_no",studentList.get(position).getRoll_no().toString());

                intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                ctx.startActivity(intent);
            }
        });
    }

    @Override
    public int getItemCount() {

        return studentList.size();

    }

    public class ViewHolder extends RecyclerView.ViewHolder{
        TextView student_name;
        Button btn;
        public ViewHolder(@NonNull View itemView) {
            super(itemView);
            student_name = itemView.findViewById(R.id.student_name);
            btn = itemView.findViewById(R.id.setmarkbtn);
        }
    }
}
