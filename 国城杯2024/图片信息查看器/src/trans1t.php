<?php
error_reporting(0);
include 'class.php';

if(isset($_POST['name'])){
    $name = $_POST['name'];
    $exception=new B($name);
    $exception->greet();
}