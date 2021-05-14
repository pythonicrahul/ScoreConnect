package com.example.scoreconnect;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.os.Bundle;
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

public class SubjectsToStandards extends AppCompatActivity {

    private RecyclerView recyclerView;
    AdapterSubStan adapterSubStan;
    List<SubStan> subStanList;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_subjects_to_standards);
        recyclerView = findViewById(R.id.substanrecycler);
        subStanList = new ArrayList<>();
        extractSubjectStandard();
    }

    private void extractSubjectStandard() {
        final String Exam_sno = getIntent().getStringExtra("Exam_sno");
        final Integer teacher_sno = SharedPrefManager.getInstance(this).getsno();
        StringRequest stringRequest = new StringRequest(
                Request.Method.POST,
                Constants.URL_ALL_SUBTOSTN,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            JSONArray array = new JSONArray(response);
                            for(int i=0; i<array.length(); i++){
                                JSONObject substanobj = array.getJSONObject(i);
                                SubStan subStan = new SubStan();
                                subStan.setSection(substanobj.getString("Section"));
                                subStan.setSection_sno(substanobj.getString("sno_sec"));
                                subStan.setSubject_name(substanobj.getString("Subject_Name"));
                                subStan.setSubject_sno(substanobj.getString("Subject_sno"));
                                subStan.setStandard(substanobj.getString("Standard"));
                                subStan.setStandard_sno(substanobj.getString("Standard_Sno"));
                                subStanList.add(subStan);
                            }
                            recyclerView.setLayoutManager(new LinearLayoutManager(getApplicationContext()));
                            adapterSubStan = new AdapterSubStan(getApplicationContext(),subStanList, Exam_sno);
                            recyclerView.setAdapter(adapterSubStan);
                        } catch (JSONException e) {
                            e.printStackTrace();
                            Toast.makeText(SubjectsToStandards.this, "Try me error", Toast.LENGTH_SHORT).show();
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(SubjectsToStandards.this, "Response me error", Toast.LENGTH_SHORT).show();
                    }
                }
        ){
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String,String> params = new HashMap<>();
                params.put("teacher_sno",teacher_sno.toString());
                return params;
            }
        };

        RequestHandler.getInstance(this).addToRequestQueue(stringRequest);
    }
}
