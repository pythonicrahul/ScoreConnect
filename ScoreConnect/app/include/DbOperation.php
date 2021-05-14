<?php

    class DbOperation{
        private $con;

        function __construct(){
            require_once dirname(__FILE__).'/DbConnect.php';
            $db = new DbConnect();
            $this->con = $db->connect();
        }
        
        public function teacherLogin($email,$password){
            $stmt = $this->con->prepare("SELECT Sno FROM teachers WHERE Email = ? and Password = ?");
            $stmt->bind_param("ss",$email,$password);
            $stmt->execute();
            $stmt->store_result();
            return $stmt->num_rows > 0;
        }
        

        public function getUserByEmail($email){
            $stmt = $this->con->prepare("SELECT * FROM teachers WHERE Email = ?");
            $stmt->bind_param("s",$email);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        }

        public function parentLogin($phone, $password){
            $stmt = $this->con->prepare("SELECT Sno FROM student WHERE p_phone = ? and p_password = ?");
            $stmt->bind_param("ss",$phone,$password);
            $stmt->execute();
            $stmt->store_result();
            return $stmt->num_rows > 0;
        }

        public function getStudentByParentNumber($phone){
            $stmt = $this->con->prepare("SELECT * FROM student WHERE p_phone = ?");
            $stmt->bind_param("s",$phone);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        }

        public function clearNoticeBoard($password_clear){
            if($password_clear == "hVBDhsg/wsr*qNsT"){
                $stmt = $this->con->prepare("DELETE FROM notice");
                if($stmt->execute()){
                    return true;     
                }
            }else{
                return false;
            }
            
        }

        public function addNotice($notice, $teacher_sno){
            $stmt = $this->con->prepare("INSERT INTO notice (Notice,TIME,Writer) VALUES (?, CURRENT_TIMESTAMP, ?)");
            $stmt->bind_param("ss",$notice,$teacher_sno);
            if($stmt->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        public function check($sec_sno,$rollno,$exam_sno,$subject_sno){
            $stmt = $this->con->prepare(" SELECT * FROM marks Where Sec_sno='$sec_sno' and Roll_no='$rollno' and Exam_sno='$exam_sno' and Subject_sno='$subject_sno' ");
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows > 0){
                return false;
            }
            else{
                return true;
            }
            
        }

        public function checkAllMarks($sec_sno, $exam_sno, $subject_sno){
            $stmt = $this->con->prepare("SELECT Sno FROM marks Where Sec_sno='$sec_sno' and Exam_sno='$exam_sno' and Subject_sno='$subject_sno' ");
            $stmt->execute();
            $number_of_rows_marks = count($stmt->get_result()->fetch_all());
            $stmt->close();
            $stmt_2 = $this->con->prepare("SELECT Sno FROM student Where Section_sno='$sec_sno' ");
            $stmt_2->execute();
            $number_of_student = count($stmt_2->get_result()->fetch_all());
            if($number_of_rows_marks == $number_of_student){
                return true;
            }
            else{
                return false;
            }
        }

        public function addMarks($sec_sno, $rollno, $exam_sno, $subject_sno, $marks){
            $var = $this->check($sec_sno,$rollno,$exam_sno,$subject_sno);
            if($var){
                $stmt = $this->con->prepare("INSERT INTO marks (Sec_sno, Roll_no, Exam_sno, Subject_sno, Marks) VALUES ('$sec_sno', '$rollno', '$exam_sno', '$subject_sno', '$marks')");
            }
            else{
                $stmt = $this->con->prepare("UPDATE marks SET Marks='$marks' WHERE Sec_sno='$sec_sno' and Roll_no='$rollno' and Exam_sno='$exam_sno'and Subject_sno='$subject_sno'");
            }
                if($stmt->execute()){
                    return true;
                }
                else{
                    return false;
                }
        }

        public function getStudentBySection($teacher_sno){
            $stmt = $this->con->prepare("SELECT * FROM section WHERE Class_Teacher= ? ");
            $stmt->bind_param("s", $teacher_sno);
            $stmt->execute();
            $section = $stmt->get_result()->fetch_assoc();
            $section_sno = $section['Sno'];
            $stmt = $this->con->prepare("SELECT rollno,fname,lname FROM student Where Section_sno = $section_sno ORDER BY rollno");
            $stmt->execute();
            $stmt->bind_result($rollno,$fname,$lname);
            $students = array();
            while ($stmt->fetch()){
                $temp = array();
                $temp['rollno'] = $rollno;
                $temp['Name'] = $fname . " " . $lname;

                array_push($students,$temp);
            }
            return $students;
        }

        
        public function getMarksByRollnoAndSecSno($sec_sno, $rollno, $exam_sno){

            $stmt = $this->con->prepare("SELECT Subject_sno,Marks,exam_sno FROM marks Where Sec_sno= $sec_sno and Roll_no = $rollno and Exam_sno = $exam_sno");
            $stmt->execute();
            $stmt->bind_result($Subject_sno,$Marks,$exam_sno);
            $marks = array();

            while($stmt->fetch()){
                
                $temp = array();
                $temp['Marks']= $Marks;    
                $temp['Subject_Sno']= $Subject_sno;
                $temp['Exam_sno'] = $exam_sno;
                array_push($marks,$temp);
                
            }

            $send = array();
            $marksobtain = 0;
            $pass = true;
            
            $Standard = $this->getStandardSnoBySectionSno($sec_sno);
            if($Standard<5){
                $division = 1;
            }
            else if ($Standard < 8){
                $division = 2;
            }
            else{
                $division = 3;
            }

            $totalMarksOfSubjects = $this->getTotalMarksByExamSoAndDivisionSno($exam_sno, $division);
            $passing = round($totalMarksOfSubjects * 0.35); 

            foreach($marks as $mark){
                if($mark['Marks'] < $passing){
                    $pass = false;
                }
                $marksobtain = $marksobtain + $mark['Marks'];
                $mark['Subject_Name'] = $this->getSubjectBySno($mark['Subject_Sno']);
                array_push($send,$mark);
            }

            $totalMarks = $totalMarksOfSubjects * count($send);
            // $totalMarks = 1100;
            $percentage = ($marksobtain/$totalMarks) * 100 ;
            $sendFinal = array();
            array_push($sendFinal,$send);
            $sendFinal['Percentage'] = round($percentage);
            if($pass){
                $sendFinal['Result'] = "Passed";
            }
            else{
                $sendFinal['Result'] = "Failed";
            }
            return $sendFinal;

        }

        

        public function getTaskByTeacherSno($teacher_sno){
            $stmt = $this->con->prepare("SELECT Task,Date FROM task Where Teacher_sno='$teacher_sno' or Teacher_sno= 0");
            $stmt->execute();
            $stmt->bind_result($Task,$Date);
            $tasks = array();
            while($stmt->fetch()){
                $temp = array();
                $temp['task'] = $Task;
                $temp['date'] = $Date;
                array_push($tasks,$temp);
            }

            return $tasks;
        }

        public function getSubjectsByTeacherSno($teacher_sno){
            $stmt = $this->con->prepare("SELECT sno_sec,Subject FROM teaches Where Teacher='$teacher_sno'");
            $stmt->execute();
            $stmt->bind_result($sno_sec,$Subject);
            $subject_array = array();
            $send = array();
            while($stmt->fetch()){
                $temp = array();
                $temp['Subject_sno'] = $Subject;
                $temp['sno_sec'] = $sno_sec;
                array_push($subject_array,$temp);
            }
            
            foreach($subject_array as $Subject){

                $Subject['Subject_Name'] = $this->getSubjectBySno($Subject['Subject_sno']);
                $Subject['Section'] = $this->getSectionBySno($Subject['sno_sec']);
                $Subject['Standard'] = $this->getStandardBySectionSno($Subject['sno_sec']);
                $Subject['Standard_Sno'] = $this->getStandardSnoBySectionSno($Subject['sno_sec']);
                array_push($send,$Subject);

            }

            return $send;
        }
        
        
        public function getSubjectBySno($Subject_sno){
            $stmt = $this->con->prepare("SELECT * FROM `subject` WHERE Sno= ? ");
            if(!$stmt){
                return "Prepare failed: (". $this->con->errno.") ".$this->con->error;
             }        
            $stmt->bind_param("s",$Subject_sno);
            $stmt->execute();
            $stmt_data = $stmt->get_result()->fetch_assoc();
            return $stmt_data['Name'];
        }
        
        public function getSectionBySno($sec_sno){
            $stmt = $this->con->prepare("SELECT * FROM `Section` WHERE Sno='$sec_sno'");
            $stmt->execute();
            // $stmt->bind_result($Name);
            $stmt_data = $stmt->get_result()->fetch_assoc();
            return $stmt_data['Section'];
        }

        public function getTotalMarksByExamSoAndDivisionSno($exam_sno, $division_sno){
            $stmt = $this->con->prepare("SELECT * FROM `totalmarks` Where division_sno='$division_sno' and exams_sno='$exam_sno'");
            $stmt->execute();
            $stmt_data = $stmt->get_result()->fetch_assoc();
            return $stmt_data['totalMark'];
        }

        public function getStandardSnoBySectionSno($sec_sno){
            $stmt = $this->con->prepare("SELECT * FROM Section WHERE Sno='$sec_sno'");
            $stmt->execute();
            $stmt_data = $stmt->get_result()->fetch_assoc();
            return $stmt_data['Standard'];
        }

        public function getStandardBySectionSno($sec_sno){
            $store = $this->getStandardSnoBySectionSno($sec_sno);
            $stmt = $this->con->prepare("SELECT * FROM Standards WHERE Sno='$store'");
            $stmt->execute();
            $stmt_data = $stmt->get_result()->fetch_assoc();
            return $stmt_data['Standard'];         
        }

        public function getStudentsBySectionSno($Sec_sno){
            $stmt = $this->con->prepare("SELECT rollno,fname,lname FROM student WHERE Section_sno='$Sec_sno'");
            $stmt->execute();
            $stmt->bind_result($rollno,$fname,$lname);
            $students = array();

            while($stmt->fetch()){

                $temp = array();
                $temp['rollno'] = $rollno;
                $temp['Name'] = $fname ." ". $lname;

                array_push($students,$temp);
            }
            return $students;
        }
    }
 ?>