package com.example.scoreconnect;

public class Student {

    private Integer roll_no;
    private String Name;

    public Student(){

    }
    public Student(Integer roll_no, String Name){
        this.Name = Name;
        this.roll_no = roll_no;
    }

    public Integer getRoll_no() {
        return roll_no;
    }

    public void setRoll_no(Integer roll_no) {
        this.roll_no = roll_no;
    }

    public String getName() {
        return Name;
    }

    public void setName(String name) {
        Name = name;
    }
}
