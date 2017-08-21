<?php
require_once 'class/lession.class.php';
$id = $_GET['id'];
(new Lession())->delete($id);
header('Location:index.php');
?>