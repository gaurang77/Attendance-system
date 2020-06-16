<?php 
if(isset($_POST['submit'])){
 include '../model/config.php';
 $config = new Config;
 $conn = $config->connect();
 $r = $_POST['roll_no'];
 $c = $_POST['class'];

function query_generate(){
 session_start();
 $_SESSION['name']  = $_POST['name'];
 $_SESSION['roll_no'] = $_POST['roll_no'];
 $_SESSION['dob'] = $_POST['dob'];
 $_SESSION['class'] = $_POST['class'];
}

    function roll_check($r,$c){
        $sql = "SELECT * FROM students WHERE class='$c' AND roll_no='$r' ";
        global $conn;
        $result = $conn->query($sql);
        if($result->num_rows>0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

 if(roll_check($r,$c)){
    query_generate();
    header('location:../index.php?key=error_in_adding');
   }else{
    query_generate();   
    header('location:../index.php?key=added');
    }
}

?>
<?php if(isset($error)){
    session_start();
    echo "<p class='error'>".$error."</p>";
} ?>


<form action="<?php echo 'view/addStudent.php';?>" 
method="POST">
    <label for="name">Enter student name:</label>
    <input type="text" id ="name" name="name" 
    value="<?php echo isset($_SESSION['name'])?$_SESSION['name']:''; ?>" 
    required> <br>

    <label for="roll_no">Enter roll number</label>
    <input type='number' name='roll_no' id="roll_no" required> <br>
    
    <label for="class">Enter class</label>
    <input type="number" min="1" max="12" name="class" id="class" 
    value="<?php echo isset($_SESSION['class'])?$_SESSION['class']:''; ?>" 
    required> <br>

    <label for="dob">Enter birth date</label> 
    <input type="date" name="dob" id="dob" 
    value="<?php echo isset($_SESSION['dob'])?$_SESSION['dob']:''; ?>"
    required> <br>
    
    <button type="submit" name="submit">SUBMIT</button>
</form>

