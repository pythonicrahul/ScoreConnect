package com.example.scoreconnect;
import androidx.appcompat.app.AppCompatActivity;

import android.app.Dialog;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

public class TeacherOptions extends AppCompatActivity {
   private TextView teacherName;
   private Button marksbtn;
   Dialog dialog;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_teacher_options);

        if(!SharedPrefManager.getInstance(this).isLoggedIn()){
            startActivity(new Intent(getApplicationContext(),LoginActivity.class));
            finish();
        }
        marksbtn = findViewById(R.id.marksbtn);
        dialog = new Dialog(this);
        teacherName = (TextView)findViewById(R.id.teacher_name);
        teacherName.setText(SharedPrefManager.getInstance(this).getname());

    }

    public void virtualNoticeBoard(View view) {
        startActivity(new Intent(getApplicationContext(), VirtualNoticeBoard.class));
    }

    public void view_students(View view) {
        startActivity(new Intent(getApplicationContext(), AllStudent.class));
    }

    public void marks(View view) {
        dialog.setContentView(R.layout.popup_main);
        dialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
        dialog.show();
    }

    public void task(View view) {
        startActivity(new Intent(getApplicationContext(), TaskActivity.class));
    }

    public void unit1func(View view) {
        Intent intent = new Intent(getBaseContext(),SubjectsToStandards.class);
        intent.putExtra("Exam_sno","1");
        startActivity(intent);
    }

    public void unit2func(View view) {
        Intent intent = new Intent(getBaseContext(),SubjectsToStandards.class);
        intent.putExtra("Exam_sno","2");
        startActivity(intent);
    }

    public void term1func(View view) {
        Intent intent = new Intent(getBaseContext(),SubjectsToStandards.class);
        intent.putExtra("Exam_sno","3");
        startActivity(intent);
    }

    public void unit3func(View view) {
        Intent intent = new Intent(getBaseContext(),SubjectsToStandards.class);
        intent.putExtra("Exam_sno","4");
        startActivity(intent);
    }

    public void unit4func(View view) {
        Intent intent = new Intent(getBaseContext(),SubjectsToStandards.class);
        intent.putExtra("Exam_sno","5");
        startActivity(intent);
    }

    public void term2func(View view) {
        Intent intent = new Intent(getBaseContext(),SubjectsToStandards.class);
        intent.putExtra("Exam_sno","6");
        startActivity(intent);
    }
}
