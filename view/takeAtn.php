<?php session_start();
$c = $_SESSION['class'];
$stud = $student->loadByClass($c);
$dat = $_SESSION['date'];
//print_r($stud);
?>

<h1 id="loadatndate" value="<?php echo $dat;?>">
    DATE :<?php echo $dat; ?>
</h1>
<h3 id="loadatnclass" value="<?php echo $_SESSION['class'];?>">
    CLASS : <?php echo $_SESSION['class']; ?>
</h3>

<div id="atnload">
<h3>STUDENT NAME</h3>
<h3>PRESENT</h3>
<h3>ABSENT</h3>
<?php if($stud): ?>
  <?php foreach($stud as $s):?>
    <p><?php echo $s['name']; ?></p>
    <p><input type="radio" name="<?php echo $s['name']; ?>" 
    id="<?php echo $s['name']; ?>" 
    value = "present"> 
    </p>
    <p> <input type="radio" name="<?php echo $s['name']; ?>" 
    id="<?php echo $s['name']; ?>"
    value = "absent" > 
    </p>
  <?php endforeach; ?>
<?php endif; ?>
</div>
    <?php if(!$stud): ?>
    <p style="text-align:center">no students to display</p>
    <?php endif; ?> 
<div id="sub">
<button id="submit"> SUBMIT ATTENDANCE </button>
</div>

<script>
let day = document.querySelector('#loadatndate').getAttribute('value');
let grade = document.querySelector('#loadatnclass').getAttribute('value');
console.log(day,grade);
let sub = document.querySelector('#submit');
//console.log(sub);
let atn = new Object;
let radio = document.querySelectorAll('input');
radio.forEach( r=> {
    r.addEventListener('click', e =>{
        console.log(r.name,e.target.value);
        atn[r.name]=e.target.value;
        console.log(atn);
    });
});

sub.addEventListener('click',()=>{
    let names = radio.length/2;
    let atnValues = Object.keys(atn).length;
    console.log(names,atnValues);
    if(names!=atnValues){
        let remain = names-atnValues;
        let action = `attendance of ${remain} students left`;
        alert(action);
    }
    else if(names==0 & atnValues==0){
        alert('no students to submit, use the addstudents tab for adding students');
    }
    else{
        var str = JSON.stringify(atn);
        console.log(str);
        //JSON.parse;
        add_to_table(str).then(data => console.log(data));
        window.location.href = "http://localhost/ATN/index.php?key=atn";
    }
});

async function add_to_table(str){
    let url = 'model/Operation.php';
    let form = new FormData();
    form.append('day',day);
    form.append('level',grade);
    form.append('datestr',str);

    let res = await fetch(url,{
        method:'POST',
        body:form
    });

    return res.text()
}
</script>