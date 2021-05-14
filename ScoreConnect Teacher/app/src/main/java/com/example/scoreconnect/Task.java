package com.example.scoreconnect;

public class Task {

    private String date;
    private String task;

    public Task(){

    }
    public Task(String date, String task){
        this.date = date;
        this.task = task;
    }

    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public String getTask() {
        return task;
    }

    public void setTask(String task) {
        this.task = task;
    }
}
