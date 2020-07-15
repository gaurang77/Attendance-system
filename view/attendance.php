<div id="atnbody">

    <h2> TAKE ATTENDANCE</h2>

    <div id="select-container">
      <div class="one">  
        <label for="atnmonth">Month:</label>
        <select name="atnmonth" id="atnmonth">
            <option value="jan">JAN</option>
            <option value="feb">FEB</option>
            <option value="mar">MAR</option>
            <option value="april">APRIL</option>
            <option value="may">MAY</option>
            <option value="june">JUNE</option>
        </select>
      </div>
      <div class="two">  
        <label for="atnclass">Class:</label>
        <select name="atnclass" id="atnclass">
            <option value="1">class 1</option>
            <option value="2">class 2</option>
            <option value="3">class 3</option>
            <option value="4">class 4</option>
            <option value="5">class 5</option>
            <option value="6">class 6</option>
            <option value="7">class 7</option>
            <option value="8">class 8</option>
            <option value="9">class 9</option>
            <option value="10">class 10</option>
            <option value="11">class 11</option>
            <option value="12">class 12</option>
        </select>
      </div> 
    </div>
    <div id="calender"></div>
    <div id = "loadAtn"></div>
</div>
<script>
//use of session storage to get the exact class/grade which 
//was used at the time of selection
let select = document.getElementById('atnclass');

if(sessionStorage.getItem('class_value')){
  select.value = sessionStorage.getItem('class_value');
}

select.addEventListener('change',sessionStore);
function sessionStore(){
  sessionStorage.setItem('class_value',select.value)
  //console.log(sessionStorage.getItem('class_value'));  
}

</script>
<script src="model/js/atn.js"></script>
