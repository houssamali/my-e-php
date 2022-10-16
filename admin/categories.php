<?php
session_start();
if(isset($_SESSION['user']))
{
include ('init.php');




    













/*$do='';
if(isset($_GET['do']))
{
$do=$_GET['do'];
}else{
$do='manage';
}

if($do=='manage')
{
    
}*/




}

else
{
    header('location:login.php');
    exit();
}