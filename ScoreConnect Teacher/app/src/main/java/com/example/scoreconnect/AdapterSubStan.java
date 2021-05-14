package com.example.scoreconnect;
import android.content.Context;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;
import java.util.List;

public class AdapterSubStan extends RecyclerView.Adapter<AdapterSubStan.ViewHolder> {

    LayoutInflater layoutInflater;
    List<SubStan> subStanList;
    Context ctx;
    private String exam_sno;

    public AdapterSubStan(Context ctx, List<SubStan> subStanList) {
        this.layoutInflater = layoutInflater.from(ctx);
        this.subStanList = subStanList;
        this.ctx = ctx;
    }

    public AdapterSubStan(Context ctx, List<SubStan> subStanList,String exam_sno) {
        this.layoutInflater = layoutInflater.from(ctx);
        this.subStanList = subStanList;
        this.ctx = ctx;
        this.exam_sno = exam_sno;
    }

    @NonNull
    @Override
    public AdapterSubStan.ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = layoutInflater.inflate(R.layout.subject_with_standard,parent,false);
        return new ViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull AdapterSubStan.ViewHolder holder, final int position) {
        String place = subStanList.get(position).getStandard() + " " + subStanList.get(position).getSection() + " " + subStanList.get(position).getSubject_name();
        holder.btn.setText(place);
        holder.btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(ctx, AllStudentSubMarks.class);
                intent.putExtra("Subject_sno",subStanList.get(position).getSubject_sno().toString());
                intent.putExtra("Section_sno",subStanList.get(position).getSection_sno().toString());
                intent.putExtra("Subject",subStanList.get(position).getSubject_name().toString());
                intent.putExtra("Section",subStanList.get(position).getSection().toString());
                intent.putExtra("exam_sno",exam_sno);
                intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                ctx.startActivity(intent);
            }
        });
    }

    @Override
    public int getItemCount() {
        return subStanList.size();
    }

    public class ViewHolder extends RecyclerView.ViewHolder{
        Button btn;
        public ViewHolder(@NonNull View itemView) {
            super(itemView);
            btn = itemView.findViewById(R.id.substan);

        }
    }
}
