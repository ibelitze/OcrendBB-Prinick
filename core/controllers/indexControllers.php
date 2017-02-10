<?php
$db= new PDO('mysql:host=localhost; dbname=ocrendbb', 'root', 'iz171089');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->exec('SET CHARACTER SET utf8');



include('html/index/index.php');



?>
