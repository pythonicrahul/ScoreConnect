package com.example.scoreconnect;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.os.Bundle;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.lang.reflect.Method;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class TaskActivity extends AppCompatActivity {
    private RecyclerView recyclerView;
    List<Task> taskList;
    AdapterTask adapterTask;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_task);
        recyclerView = findViewById(R.id.taskrecycler);
        taskList = new ArrayList<>();
        extractTask();
    }

    private void extractTask() {
        final Integer teacher_sno = SharedPrefManager.getInstance(this).getsno();
        StringRequest stringRequest = new StringRequest(
                Request.Method.POST,
                Constants.URL_ALL_TASK,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            JSONArray array = new JSONArray(response);
                            for(int i=0; i<array.length(); i++) {
                                JSONObject taskobj = array.getJSONObject(i);
                                Task task = new Task();
                                task.setTask(taskobj.getString("task"));
                                task.setDate(taskobj.getString("date"));
                                taskList.add(task);
                            }

                            recyclerView.setLayoutManager(new LinearLayoutManager(getApplicationContext()));
                            adapterTask = new AdapterTask(getApplicationContext(),taskList);
                            recyclerView.setAdapter(adapterTask);
                        } catch (JSONException e) {
                            e.printStackTrace();
                            Toast.makeText(TaskActivity.this, "Try me error hai", Toast.LENGTH_SHORT).show();
                        }

                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(TaskActivity.this, "Response me error hai", Toast.LENGTH_SHORT).show();
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
