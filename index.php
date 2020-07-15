<?php
include 'view/header.php';
include 'controller/Controller.php';

//echo $_GET['key'];
$control = new Controller;

$control->route();

include 'view/footer.php';
?>