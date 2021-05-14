package com.example.scoreconnect;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.app.VoiceInteractor;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.Display;
import android.view.View;
import android.view.WindowManager;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
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

public class VirtualNoticeBoard extends AppCompatActivity {
    private WebView webView;
    private ProgressDialog progressDialog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_virtual_notice_board);
        webView = (WebView)findViewById(R.id.webView);
        webView.setPadding(0,0,0,0);
        webView.setInitialScale(getScale());
        WebSettings webSettings = webView.getSettings();
        webSettings.setJavaScriptEnabled(true);
        webView.loadUrl(Constants.URL_NOTICEBOARD);
        webView.setWebViewClient(new WebViewClient());
        progressDialog = new ProgressDialog(this);
        progressDialog.setMessage("Clearing Virtual Notice Board");

    }

    private int getScale(){
        Display display = ((WindowManager) getSystemService(Context.WINDOW_SERVICE)).getDefaultDisplay();
        int width = display.getWidth();
        Double val = new Double(width)/new Double(600);
        val = val * 100d;
        return val.intValue();
    }

    public void addNotice(View view) {
        startActivity(new Intent(getApplicationContext(),AddNotice.class));
    }

    public void clearNotice(View view) {
        progressDialog.show();
        StringRequest stringRequest = new StringRequest(
                Request.Method.POST,
                Constants.URL_CLEAR_NOTICEBOARD,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        progressDialog.dismiss();
                        try {
                            JSONObject obj = new JSONObject(response);
                            if(!obj.getBoolean("error")){
                                Toast.makeText(VirtualNoticeBoard.this, obj.getString("Message"), Toast.LENGTH_SHORT).show();
                                startActivity(new Intent(getApplicationContext(),TeacherOptions.class));
                            }
                        }
                        catch (JSONException e) {
                            e.printStackTrace();
                            Toast.makeText(VirtualNoticeBoard.this, e.getMessage() , Toast.LENGTH_SHORT).show();
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(VirtualNoticeBoard.this, error.getMessage(), Toast.LENGTH_SHORT).show();
                    }
                }

        ){
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String,String> params = new HashMap<>();
                params.put("password_clear", "hVBDhsg/wsr*qNsT");
                return params;
            }
        };

        RequestHandler.getInstance(this).addToRequestQueue(stringRequest);
    }
}
