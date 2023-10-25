<?php



require_once('inc/db.php');
require_once('function/function.php');

$pr = $_GET['pr'];
//$pr = 79;
$sql = 'SELECT count(works) FROM accounts WHERE id_proxy = ? AND useacc <> 0';
$args = [$pr];
$sel = select($sql, $args);

try {
    $json_data = json_encode($sel, JSON_THROW_ON_ERROR);
} catch (JsonException $e) {
}
print $json_data;
