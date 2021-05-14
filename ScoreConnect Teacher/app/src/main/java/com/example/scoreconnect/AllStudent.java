package com.example.scoreconnect;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.annotation.SuppressLint;
import android.os.Bundle;
import android.util.Log;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class AllStudent extends AppCompatActivity {
    TextView textView;
    private RecyclerView recyclerView;
    List<Student> students;
    Adapter adapter;

    @SuppressLint("SetTextI18n")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_all_student);
        textView = findViewById(R.id.textView);
        recyclerView = findViewById(R.id.recyclerView);
        students = new ArrayList<>();
        String teacherName = SharedPrefManager.getInstance(this).getname();
        textView.setText("Class Teacher : "+teacherName);
        extractStudents();


    }

    private void extractStudents() {
        final Integer teacher_sno = SharedPrefManager.getInstance(this).getsno();
        StringRequest  stringRequest = new StringRequest(Request.Method.POST, Constants.URL_ALL_STUDENTS, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONArray array = new JSONArray(response);
                    for(int i=0; i<array.length(); i++) {
                        JSONObject studentobj = array.getJSONObject(i);
                        Student student = new Student();
                        student.setName(studentobj.getString("Name").toString());
                        student.setRoll_no(studentobj.getInt("rollno"));
                        students.add(student);
                    }

                    recyclerView.setLayoutManager(new LinearLayoutManager(getApplicationContext()));
                    adapter = new Adapter(getApplicationContext(),students);
                    recyclerView.setAdapter(adapter);

                } catch (JSONException e)
                {
                    e.printStackTrace();
                    Toast.makeText(AllStudent.this, "JSON Error", Toast.LENGTH_SHORT).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(AllStudent.this, "Respnse Error"+ error.getMessage(), Toast.LENGTH_SHORT).show();
            }
        }
        ){
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("teacher_sno", teacher_sno.toString());
                return params;
            }
        };
        RequestHandler.getInstance(this).addToRequestQueue(stringRequest);
    }
}
