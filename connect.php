<?php
$obj = new PDO('mysql:host=localhost;dbname=bookstorelody','root','');
$obj->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$obj->query('set names utf8');
?>