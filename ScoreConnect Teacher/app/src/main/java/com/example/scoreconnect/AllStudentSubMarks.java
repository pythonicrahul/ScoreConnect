package com.example.scoreconnect;
import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.os.Bundle;
import android.view.View;
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


public class AllStudentSubMarks extends AppCompatActivity {

    private TextView textView;
    List<Student> studentList;
    AdapterStudentWithSubject adapterStudentWithSubject;
    RecyclerView recyclerView;
    private String subject_sno ;
    private String section_sno ;
    private String exam_sno ;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_all_student_sub_marks);
        recyclerView = findViewById(R.id.stusubmarkrecycler);
        studentList = new ArrayList<>();
        subject_sno = getIntent().getStringExtra("Subject_sno");
        exam_sno = getIntent().getStringExtra("exam_sno");
        section_sno = getIntent().getStringExtra("Section_sno");
        extractStudent();

    }

    private void extractStudent() {

        StringRequest stringRequest= new StringRequest(
                Request.Method.POST,
                Constants.URL_ALL_STUDENTS_WITH_SEC_SNO,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            JSONArray array = new JSONArray(response);
                            for(int i=0; i<array.length();i++){
                                JSONObject studentobj = array.getJSONObject(i);
                                Student student = new Student();
                                student.setName(studentobj.getString("Name"));
                                student.setRoll_no(studentobj.getInt("rollno"));
                                studentList.add(student);
                            }
                            recyclerView.setLayoutManager(new LinearLayoutManager(getApplicationContext()));
                            adapterStudentWithSubject = new AdapterStudentWithSubject(getApplicationContext(),studentList,section_sno,subject_sno, exam_sno);
                            recyclerView.setAdapter(adapterStudentWithSubject);
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }

                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {

                    }
                }
        ){
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String,String> params = new HashMap<>();
                params.put("section_sno",section_sno.toString());
                return params;
            }
        };
        RequestHandler.getInstance(this).addToRequestQueue(stringRequest);
    }

    public void verify(View view) {

        StringRequest checkrequest = new StringRequest(
                Request.Method.POST,
                Constants.URL_VERIFY_MARKS,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            JSONObject verifyMsgobj = new JSONObject(response);
                            Toast.makeText(AllStudentSubMarks.this, verifyMsgobj.getString("Message"), Toast.LENGTH_SHORT).show();
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }

                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {

                    }
                }
        ){
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String,String> params = new HashMap<>();
                params.put("exam_sno",exam_sno);
                params.put("subject_sno",subject_sno);
                params.put("sec_sno",section_sno);
                return params;
            }
        };

        RequestHandler.getInstance(this).addToRequestQueue(checkrequest);
    }
}