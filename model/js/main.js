console.log("hello");

var selectOption = document.querySelector("select");
//console.log(selectOption);

var tableData = document.querySelector("table");

selectOption.addEventListener("change", (e) => {
  let optionValue = e.target.value;
  getData(optionValue).then((data) => {
    //console.log(data);
    let info = JSON.parse(data);
    console.log(info);
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
        <td> action </td>
        </tr>`;
    });
    tableData.innerHTML += textData;
    // console.log(textData);
  });
});

async function getData(value) {
  let url = "model/Operation.php";
  var formdata = new FormData();
  //formdata.songID=trackID;
  formdata.append("class", value);
  // console.log(formdata);
  let response = await fetch(url, {
    method: "POST",
    body: formdata,
  });
  return response.text();
}
