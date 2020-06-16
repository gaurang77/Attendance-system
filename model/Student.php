<?php
include 'model/config.php';
class Student{
    public $name;
    public $roll_no;
    public $DOB;
    public $cls;
    public $conn;
    
    public function __construct(){
        $config = new Config;
        $this->conn = $config->connect();
    }
    
    public function load(){
        $sql = "SELECT * FROM students ";
        $result = $this->conn->query($sql);
        if($result->num_rows>0){
         $row = $result->fetch_all(MYSQLI_ASSOC);
         return $row;
        } 
    }
    

    public function add_to_db($n,$r,$d,$c){
        $this->name=$n;
        $this->roll_no = $r;
        $this->DOB=$d;
        $this->cls=$c;
        
        $sql = " INSERT INTO students (name, roll_no, DOB,class)
        VALUES ('$this->name', '$this->roll_no', '$this->DOB','$this->cls')";
        $this->conn->query($sql);
        // if ($this->conn->query($sql) === TRUE) {
        // echo "New record created successfully";
        // } else {
        // echo "Error: " . $sql . "
        // " . $this->conn->error;
        // }
    }

    public function loadByClass($c){
        $sql = "SELECT * FROM students WHERE class='$c' ";
        $result = $this->conn->query($sql);
        if($result->num_rows>0){
         $row = $result->fetch_all(MYSQLI_ASSOC);
         return $row;
        }else {
            return false;
        }
    }
}
?>