<?php 
include 'model/Student.php';
//echo $_GET['key'];
class Controller{
    public $student;
    
    public function __construct(){
        $this->student = new Student;
    }

    public function route(){
        if(!isset($_GET['key'])){
            //echo "ho";
            $rows=$this->student->load();
            //through this value $rows can be sent to table.php
            include 'view/table.php';
        }
        else if($_GET['key']=='add'){
            //echo "hello";
            $student = $this->student;
            include 'view/addStudent.php';
        }
        else if($_GET['key']=='error_in_adding'){
            $error = 'Roll number already exist for this class';
            include 'view/addStudent.php';
        }
        else if($_GET['key']=='added'){
            session_start();
            if(isset($_SESSION['name'])){
                echo $_SESSION['dob'];
                 $n = $_SESSION['name'];
                 $r = $_SESSION['roll_no'];
                 $d = $_SESSION['dob'];
                 $c = $_SESSION['class'];
                 $this->student->add_to_db($n,$r,$d,$c);
                 session_abort();
                 header('location:index.php');
            }
        }
        else if($_GET['key']=='atn'){
            include 'view/attendance.php';
        }else if($_GET['key']=='take'){
            $student = $this->student;
            include 'view/takeAtn.php';
        }else if($_GET['key']=='view'){
             $student = $this->student;
            include 'view/viewAtn.php';              
        }
    }
}