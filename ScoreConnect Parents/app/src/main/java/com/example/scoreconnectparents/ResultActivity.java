package com.example.scoreconnectparents;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.app.Dialog;
import android.app.ProgressDialog;
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

public class ResultActivity extends AppCompatActivity {

    RecyclerView recyclerView;
    AdapterSubjectMark adapterSubjectMark;
    List<SubjectMark> subjectMarkList;
    private TextView percentage;
    private TextView result;
    ProgressDialog dialog;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_result);
        recyclerView = findViewById(R.id.recyclerView2);
        percentage = findViewById(R.id.percentage_text);
        result = findViewById(R.id.result_text);
        subjectMarkList = new ArrayList<>();
        dialog = new ProgressDialog(this);
        dialog.setMessage("Fetching Result ... ");
        dialog.show();
        extractResult();
    }

    private void extractResult() {

        final SharedPrefManager sharedPrefManager = SharedPrefManager.getInstance(this);
        StringRequest stringRequest = new StringRequest(
                Request.Method.POST,
                Constants.URL_GET_RESULT,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        Log.d("RJ", "onResponse: "+response);
                        try {
                            JSONObject mainobj = new JSONObject(response);
                            JSONArray marks = mainobj.getJSONArray("0");
                            percentage.setText(mainobj.getString("Percentage"));
                            result.setText(mainobj.getString("Result"));

                            for(int i=0;  i<marks.length(); i++){
                                JSONObject mark = marks.getJSONObject(i);
                                SubjectMark subjectMark = new SubjectMark();
                                subjectMark.setMark(mark.getString("Marks"));
                                subjectMark.setSubject(mark.getString("Subject_Name"));
                                subjectMarkList.add(subjectMark);
                            }
                            recyclerView.setLayoutManager(new LinearLayoutManager(getApplicationContext()));
                            adapterSubjectMark = new AdapterSubjectMark(getApplicationContext(),subjectMarkList);
                            recyclerView.setAdapter(adapterSubjectMark);
                            dialog.dismiss();
                        } catch (JSONException e) {
                            Toast.makeText(ResultActivity.this, "Try me error"+ e.getMessage(), Toast.LENGTH_SHORT).show();
                            e.printStackTrace();
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(ResultActivity.this, "Response Me error", Toast.LENGTH_SHORT).show();
                    }
                }
        ){
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("sec_sno", sharedPrefManager.getSecSno().toString());
                params.put("rollno", sharedPrefManager.getRollNo().toString());
                params.put("exam_sno",getIntent().getStringExtra("exam_sno").toString());
                return params;
            }
        };

        RequestHandler.getInstance(this).addToRequestQueue(stringRequest);
    }


}
