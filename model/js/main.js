var selectOption = document.querySelector("select");
//console.log(selectOption);
let deleteRecord = document.querySelectorAll(".delete");
var editScreen = document.querySelectorAll(".edit");
var tableData = document.querySelector("table");
let jumbo = document.getElementById("jumbo");

deleteRecord.forEach((del) => {
  del.addEventListener("click", (e) => {
    jumbo.style.visibility = "visible";
    let arr = [];
    let row = del.parentElement.parentElement;
    for (i = 0; i < row.childElementCount - 1; i++) {
      arr.push(row.children[i].textContent);
    }
    sessionStorage.setItem("deleteStudent", arr[0]);
    sessionStorage.setItem("deleteStuRoll", arr[1]);
    sessionStorage.setItem("deleteStuClass", arr[3]);
    let screen = document.getElementById("screen");
    screen.innerHTML = `<h2> DELETE </h2>
    <div class='deleteS'>
      <h3> DELETE RECORD OF ${arr[0]} ??</h3>
    </div>
    <div id="btnsDel">
    <button class="buttonDel"> DELETE </button>
    <button class="cancel"> CANCEL </button>
    </div>
    `;
    let deleteSt = document.querySelector(".buttonDel");
    deleteSt.addEventListener("click", deleteData);
    let cancel = document.querySelector(".cancel");
    cancel.addEventListener("click", cancelDelete);
  });
});

function cancelDelete() {
  jumbo.style.visibility = "hidden";
}

function deleteData() {
  delete_data().then((data) => {
    console.log(data);
    location.reload();
  });
}

async function delete_data() {
  let url = "model/Operation.php";
  let form = new FormData();
  let delRollNo = sessionStorage.getItem("deleteStuRoll");
  let delClass = sessionStorage.getItem("deleteStuClass");
  form.append("rollNumber", delRollNo);
  form.append("classNumber", delClass);
  form.append("delete", "delete");
  //console.log(form.get("name"));
  let deleted = await fetch(url, {
    method: "POST",
    body: form,
  });
  return deleted.text();
}

editScreen.forEach((edit) => {
  edit.addEventListener(
    "click",
    (e) => {
      jumbo.style.visibility = "visible";
      let arr = [];
      let row = edit.parentElement.parentElement;
      for (i = 0; i < row.childElementCount - 1; i++) {
        arr.push(row.children[i].textContent);
      }
      //console.log(arr);
      let screen = document.getElementById("screen");
      screen.innerHTML = `<h2> EDIT </h2>
    <div class='editS'>
      <h3>NAME</h3>
      <h3>ROLL NO</h3>
      <h3>D.O.B</h3>
      <h3>CLASS</h3>
      <input type="text" value="${arr[0]}" id="uname">
      <p class="box" id="uroll">${arr[1]}</p>
      <input type="date" value="${arr[2]}" id="udate">
      <p class="box" id="uclass">${arr[3]}</p>
    </div>
    <div id="btns">
    <button class="button"> UPDATE </button>
    <button class="cancel"> CANCEL </button>
    </div>
    `;
      let update = document.querySelector(".button");
      update.addEventListener("click", updateData);
      let cancel = document.querySelector(".cancel");
      cancel.addEventListener("click", cancelData);
    },
    true
  );
});

function cancelData() {
  jumbo.style.visibility = "hidden";
  let hideInput = document.querySelector(".editS");
  hideInput.style.visibility = "hidden";
}
function updateData() {
  let name = document.getElementById("uname");
  let dob = document.getElementById("udate");
  let id_roll = document.getElementById("uroll");
  let grade = document.getElementById("uclass");
  sessionStorage.setItem("roll_no", id_roll.textContent);
  sessionStorage.setItem("class_no", grade.textContent);
  //console.log(name.value, dob.value);
  update_data(name.value, dob.value).then((data) => {
    let check = data.toString().trim();
    if (check == "true") {
      location.reload();
    } else {
      console.log("update failed");
    }
  });
}

async function update_data(name, dob) {
  let url = "model/Operation.php";
  let form = new FormData();
  let rollNumber = sessionStorage.getItem("roll_no");
  let classNumber = sessionStorage.getItem("class_no");
  form.append("name", name);
  form.append("DOB", dob);
  form.append("rollNumber", rollNumber);
  form.append("classNumber", classNumber);
  form.append("update", "update");
  console.log(form.get("name"));
  let updateF = await fetch(url, {
    method: "POST",
    body: form,
  });
  return updateF.text();
}

selectOption.addEventListener("change", (e) => {
  let optionValue = e.target.value;
  getData(optionValue).then((data) => {
    //console.log(data);
    let info = JSON.parse(data);
    //console.log(info);
    tableData.innerHTML = `<tr>
    <th>Name </th>
    <th>Roll No</th>
    <th>Date Of Birth</th>
    <th>Class</th>
    <th>Action</th>
    </tr>`;
    let textData = " ";
    info.forEach((i) => {
      textData += `<tr>
        <td>${i.name}</td>
        <td>${i.roll_no}</td>
        <td>${i.DOB}</td>
        <td>${i.class}</td>
        <td> 
        <i class="fa fa-pencil-square edit" aria-hidden="true"></i> 
        <i class="fa fa-trash delete" aria-hidden="true"></i>
        </td>
        </tr>`;
    });
    tableData.innerHTML += textData;
    // console.log(textData);
  });
});

async function getData(value) {
  let url = "model/Operation.php";
  var formdata = new FormData();
  formdata.append("class", value);
  // console.log(formdata);
  let response = await fetch(url, {
    method: "POST",
    body: formdata,
  });
  return response.text();
}
