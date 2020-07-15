//window.location.href = "http://localhost/ATN/index.php?key=take";
let month = document.querySelector("#atnmonth");
let calender = document.querySelector("#calender");
let grade = document.querySelector("#atnclass");
let load = document.querySelector("#loadAtn");
let container = document.querySelector("#select-container");

function loadBlocks(x = 31) {
  for (let i = 1; i <= x; i++) {
    loadSheet(i);
    calender.insertAdjacentHTML(
      "beforeend",
      `<div class='block' day="${i}" id='block${i}'><p>${i}</p></div>`
    );
  }
}

loadBlocks();

function loadSheet(i) {
  retriveData(i).then((data) => {
    let bl = "block" + i;
    let ele = document.getElementById(bl);
    //console.log(ele);
    if (data) {
      //console.log(data[0].present);
      ele.innerHTML += `<pre>Present:${data[0].present}/${data[0].total}</pre>`;
      ele.innerHTML += `<pre>Absent:${data[0].absent}/${data[0].total}</pre>`;
    }
  });
}

async function retriveData(i) {
  let d = i;
  let m = month.value;
  let c = await grade.value;
  console.log(c);
  let arr = await postdata(d, m, c).then((data) => {
    let check = data.toString().trim();
    if (check != "take_attendance") {
      let p = 0;
      let ab = 0;
      let cn = JSON.parse(check);
      //console.log(cn);
      let kn = cn[0].date_sheet;
      kn.split('"').forEach((pr) => {
        if (pr == "present") {
          p++;
        } else if (pr == "absent") {
          ab++;
        }
      });
      let total = p + ab;
      //console.log("present:" + p, "absent:" + ab, "total:" + total);
      return [{ present: p, absent: ab, total: total }];
    } else {
      return false;
    }
  });
  return arr;
}

async function postdata(d, m, c) {
  let url = "model/Operation.php";
  let form = new FormData();
  let atnDate = d + "-" + m + "-2020";
  //console.log(atnDate, c);
  form.append("grade", c);
  form.append("atnDate", atnDate);
  form.append("routeDate", "routeDate");
  //  console.log(form.get("grade"));
  //  console.log(form.get("month"));
  //  console.log(form.get("day"));
  let done = await fetch(url, {
    method: "POST",
    body: form,
  });
  return done.text();
}

function blocksClick() {
  let block = document.querySelectorAll(".block");
  block.forEach((b) => {
    b.addEventListener("click", action);
  });
}

function action(e) {
  if (
    e.target.className == "block" ||
    e.target.parentElement.className == "block" ||
    e.target.parentElement.parentElement.className == "block"
  ) {
    let d = event.currentTarget.getAttribute("day");
    let m = month.value;
    let c = grade.value;
    console.log(d, m, c);
    postdata(d, m, c).then((data) => {
      let check = data.toString().trim();
      //console.log(check);
      if (check == "take_attendance") {
        console.log(check);
        window.location.href = "http://localhost/ATN/index.php?key=take";
      } else {
        let di = JSON.parse(data);
        //console.log(di);
        console.log(JSON.parse(di[0].date_sheet));
        let store = di[0].date_sheet;
        let dayte = di[0].date;
        let classy = di[0].class;
        sessionStorage.setItem("atten_date", dayte);
        sessionStorage.setItem("atten_class", classy);
        sessionStorage.setItem("atten_data", store);
        //console.log(sessionStorage.getItem("atten_data"));
        window.location.href = "http://localhost/ATN/index.php?key=view";
      }
    });
  }
}
month.addEventListener("change", (event) => {
  if (month.value == "jan" || month.value == "mar" || month.value == "may") {
    calender.innerHTML = "";
    loadBlocks();
  } else if (
    month.value == "feb" ||
    month.value == "april" ||
    month.value == "june"
  ) {
    calender.innerHTML = "";
    loadBlocks(30);
  }
  blocksClick();
});

grade.addEventListener("change", (event) => {
  if (month.value == "jan" || month.value == "mar" || month.value == "may") {
    calender.innerHTML = "";
    loadBlocks();
  } else if (
    month.value == "feb" ||
    month.value == "april" ||
    month.value == "june"
  ) {
    calender.innerHTML = "";
    loadBlocks(30);
  }
  blocksClick();
});

blocksClick();
