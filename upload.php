<?php
include_once "inc/init.php";
require_once('inc/db.php');
require_once('function/function.php');
$sql = "SELECT ava FROM ava WHERE id_acc = 16";
$qw = select($sql);
$image = $qw['ava'];
//$image1 = 'img/16.png';
//$imageData = base64_encode($image);
$src = "'data:image/jpg'.';base64,'.$image";



echo "<img src=\"$src\" alt=\"\" />";
echo 1;
