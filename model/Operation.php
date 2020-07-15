<?php
// AJAX calling
include 'config.php';
$config = new Config;
$conn = $config->connect();

function load(){
    $class = $_POST['class'];
    $sql = "SELECT * FROM students where class='$class' ORDER BY roll_no";
    global $conn;
    $result = $conn->query($sql);
    if($result->num_rows>0){
        $row = $result->fetch_all(MYSQLI_ASSOC);
        return $row;
    }else{
        return  Array(
        "0" => Array
        (
            "id" => "null",
            "name" => "null",
            "roll_no" => "null",
            "DOB" => "null",
            "class" => $class
        ));
    }
}

function createSession(){
    session_start();
    $_SESSION['class'] = $_POST['grade'];
    $_SESSION['date'] = $_POST['atnDate'];
}

function addAttendance(){
    $day = $_POST['day'];
    $grade = $_POST['level'];
    $sheet = $_POST['datestr'];
    $sql = "INSERT INTO attendance(date,class,date_sheet)
    VALUES('$day','$grade','$sheet')";
    global $conn;
    $result = $conn->query($sql);
    session_abort();
    if($result == TRUE){
        $s = "done";
        return $s;
    }else{
        $s = "notdone";
        return $s;
    }
}

function checkAttendance($xdate,$xclass){
    $d=$xdate;
    $g=$xclass;
    $sql = "SELECT * FROM attendance WHERE
    date='$d' AND class='$g'";
    global $conn;
    $result = $conn->query($sql);
    if($result->num_rows>0){
        $row = $result->fetch_all(MYSQLI_ASSOC);
        return json_encode($row);
    }else {
        return FALSE;
    }
}

function updateData(){
    $name = $_POST['name'];
    $dob = $_POST['DOB'];
    $roll_no = $_POST['rollNumber'];
    $class_no = $_POST['classNumber'];
    //echo $name." ".$dob." ".$roll_no." ".$class_no;
    $sql = "UPDATE students SET `DOB`='$dob',`name`='$name' 
    WHERE `roll_no`='$roll_no' AND `class`='$class_no' ";
    global $conn;
    if ($conn->query($sql) === TRUE) {
    echo "true";
    } else {
    echo "Error updating record: " . $conn->error;
    }
}

function deleteData(){
    $roll_no = $_POST['rollNumber'];
    $class_no = $_POST['classNumber'];
    //echo $name." ".$dob." ".$roll_no." ".$class_no;
    $sql = "DELETE FROM students WHERE roll_no='$roll_no' 
            AND class='$class_no' ";
    global $conn;
    if ($conn->query($sql) === TRUE) {
    echo "true";
    } else {
    echo "Error deleting record: " . $conn->error;
    }
}

if(isset($_POST['class'])){
    $rows = load();
    echo json_encode($rows);
}
else if(isset($_POST['routeDate'])){
    if(checkAttendance($_POST['atnDate'],$_POST['grade']) == FALSE){
        createSession();
        echo "take_attendance";
    }else{
        $rows = checkAttendance($_POST['atnDate'],$_POST['grade']);
        echo $rows;
    }
}
else if(isset($_POST['day'])){
   if(!checkAttendance($_POST['day'],$_POST['level'])){
       echo addAttendance();
    }else{
       echo 'cant take attendanace';   
    }
       
}
else if(isset($_POST['update'])){
    updateData();
}
else if(isset($_POST['delete'])){
    deleteData();
}
//print_r($rows);
?>

