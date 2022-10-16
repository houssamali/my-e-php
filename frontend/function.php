<?php
include ('connect.php');
function check($element,$pass,$table,$value1,$value2)
{
    global $con;
$stmt1=$con->prepare("SELECT $element,$pass FROM $table WHERE $element=? AND $pass=?");
$stmt1->execute(array($value1,$value2));
$stmt1->fetch();
$count1 =$stmt1->rowCount();
return $count1;
}



//redirect user function
function redirect($msg,$second=5){
    
    if(isset($_SERVER['HTTP_REFERER'])&& $_SERVER['HTTP_REFERER'] !=='')
    {
        $url='user.php';

    }else{
        
          $url='login.php';
    }
    
    
    echo $msg.'<br>';
    echo '<div class="btn btn-dark input-array">You Will Be Redirect To User Page';
    header("refresh:$second;$url");
    exit();
    }

//redirect items function

function redirect2($msg,$second=5){
    
    if(isset($_SERVER['HTTP_REFERER'])&& $_SERVER['HTTP_REFERER'] !=='')
    {
        $url='item.php';

    }else{
        
          $url='login.php';
    }
    
    
    echo $msg.'<br>';
    echo '<div class="btn btn-dark input-array">You Will Be Redirect To Items Page';
    header("refresh:$second;$url");
    exit();
    }