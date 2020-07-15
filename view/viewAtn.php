<h1 id="datE">DATE SHEET OF STUDENTS</h1>
<h4 id="showDate"></h4>
<h4 id="showClass"></h4>
<div id="showAtn">
<h3>STUDENT NAME</h3>
<h3>RECORD</h3>
</div>

<script>
let data = sessionStorage.getItem('atten_data');
let day = sessionStorage.getItem('atten_date');
let clas = sessionStorage.getItem('atten_class');
console.log(data,day,clas);
document.querySelector('#showDate').innerHTML=`DATE: ${day}`;
document.querySelector('#showClass').innerHTML=`CLASS: ${clas}`;
let show = document.querySelector('#showAtn');
data = JSON.parse(data);
let a = (Object.keys(data).length);
for(let b=0;b<a;b++){
let i = Object.keys(data)[b];    
console.log(i,data[i]);
show.innerHTML+= ` 
<p> ${i} </p>
<p class="${data[i]}"> ${data[i]} </p>
`;
}
</script>
