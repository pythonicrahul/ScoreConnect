package com.example.scoreconnectparents;
import androidx.appcompat.app.AppCompatActivity;

import android.app.Dialog;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.net.Uri;
import android.os.Bundle;
import android.view.View;
import android.widget.TextView;

public class ParentsOption extends AppCompatActivity {
private TextView textView;
private Dialog dialog;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_parents_option);
        textView = findViewById(R.id.ParentNameTextView);
        textView.setText("Welcome "+ SharedPrefManager.getInstance(this).getParentName());
        dialog = new Dialog(this);
    }

    public void viewnoticeboard(View view) {
        startActivity(new Intent(getApplicationContext(),VirtualNoticeBoard.class));
    }

    public void view_report(View view) {
        dialog.setContentView(R.layout.popup_main);
        dialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
        dialog.show();
    }


    public void unit1func(View view) {
        Intent intent = new Intent(getApplicationContext(),ResultActivity.class);
        intent.putExtra("exam_sno","1");
        startActivity(intent);
    }

    public void unit2func(View view) {
        Intent intent = new Intent(getApplicationContext(),ResultActivity.class);
        intent.putExtra("exam_sno","2");
        startActivity(intent);
    }

    public void term1func(View view) {
        Intent intent = new Intent(getApplicationContext(),ResultActivity.class);
        intent.putExtra("exam_sno","3");
        startActivity(intent);
    }

    public void unit4func(View view) {
        Intent intent = new Intent(getApplicationContext(),ResultActivity.class);
        intent.putExtra("exam_sno","5");
        startActivity(intent);
    }

    public void term2func(View view) {
        Intent intent = new Intent(getApplicationContext(),ResultActivity.class);
        intent.putExtra("exam_sno","6");
        startActivity(intent);
    }

    public void unit3func(View view) {
        Intent intent = new Intent(getApplicationContext(),ResultActivity.class);
        intent.putExtra("exam_sno","4");
        startActivity(intent);
    }
}
