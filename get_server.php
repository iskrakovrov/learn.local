<?php
$name = $_GET['server'];
$sql = "SELECT * FROM servers WHERE name_server = ?";
$args = [$name];
$query = select($sql, $args);
