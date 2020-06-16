<h1 class='head'>Welcome To Attendance System</h1>

<div class="select">
    <label for="select">SELECT CLASS</label>
    <select name="select" id="select">
    <option value="All">ALL</option>
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


<table>
<tr>
 <th>Name </th>
 <th>Roll No</th>
 <th>Date Of Birth</th>
 <th>Class</th>
 <th>Action</th>
</tr>
<!-- the value $row comes from the controller class --> 
<?php foreach($rows as $row): ?>
<tr>
 <td><?php echo $row['name'] ?></td>
 <td><?php echo $row['roll_no'] ?></td>
 <td><?php echo $row['DOB'] ?></td>
 <td><?php echo $row['class'] ?></td>
 <td> action </td>
</tr>
<?php endforeach; ?>

</table>

<script src="model/js/main.js"></script>