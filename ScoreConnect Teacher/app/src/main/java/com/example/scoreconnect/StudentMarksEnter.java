package com.example.scoreconnect;
import androidx.appcompat.app.AppCompatActivity;

import android.app.VoiceInteractor;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import org.json.JSONException;
import org.json.JSONObject;
import java.util.HashMap;
import java.util.Map;

public class StudentMarksEnter extends AppCompatActivity {

    private EditText marksedit;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_student_marks_enter);
        marksedit = findViewById(R.id.editTextMarks);

    }

    public void set_marks_btn(View view) {
        final String marks = String.valueOf(marksedit.getText());

        StringRequest stringRequest = new StringRequest(
                Request.Method.POST,
                Constants.URL_ADD_MARKS,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            JSONObject obj = new JSONObject(response);
                            Toast.makeText(StudentMarksEnter.this, obj.getString("Message"), Toast.LENGTH_SHORT).show();
                            finish();

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(StudentMarksEnter.this, "Error : "+error.getMessage(), Toast.LENGTH_SHORT).show();
                    }
                }
        ){
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String,String> params = new HashMap<>();
                params.put("sec_sno", getIntent().getStringExtra("section_sno"));
                params.put("rollno", getIntent().getStringExtra("roll_no"));
                params.put("exam_sno", getIntent().getStringExtra("exam_sno"));
                params.put("subject_sno", getIntent().getStringExtra("subject_sno"));
                params.put("marks", marks);
                return params;
            }
        };
        RequestHandler.getInstance(this).addToRequestQueue(stringRequest);
    }

}
