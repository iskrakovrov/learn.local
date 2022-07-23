<?php
$name = $_GET['server'];
$sql = "SELECT * FROM servers where name_server = '$name'";
$query = select($sql);
