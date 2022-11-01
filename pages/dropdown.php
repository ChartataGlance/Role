<?php
require 'zpmaPDO.php';
$_CAT = new Category();
$id = isset($_POST["id"]) ? $_POST["id"] : 0;
echo json_encode($_CAT->get($id))
?>