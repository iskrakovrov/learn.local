<?php

require_once('inc/db.php');
require_once('function/function.php');

$sql = "CREATE TABLE `filter` (
  `id` int(11) NOT NULL,
  `setup` varchar(255) NOT NULL,
  `id_acc` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `filter`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `filter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;";
$s = create($sql);
echo $s;