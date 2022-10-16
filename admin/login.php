
<?php
session_start();
$navbar='';

include 'init.php';




if($_SERVER['REQUEST_METHOD']=='POST')
{

 $name      = $_POST['name'];
$email      = $_POST['email'];
$password   = $_POST['password'];
//$hashpass   = sha1($password);

$stmt=$con->prepare("SELECT Email,Password,First_Name,group_id,user_id FROM users WHERE Email=? AND Password=? AND First_Name=?");
$stmt->execute(array($email, $password,$name));
$rows=$stmt->fetch();
$count =$stmt->rowCount();


if($count > 0)
{
   $_SESSION['user']=$name;
   $_SESSION['groupid']=$rows['group_id'];
   $_SESSION['id']=$rows['user_id'];
  
    header('location:user.php');
    exit();
}
}


?>

<div class="container login-admin add-user-form">
    <div class="row ">
<form class="form-size-input" action="<?php echo  $_SERVER['PHP_SELF']?>" method="post">

<div class="input-group diiv-content  flex-nowrap">
  <span class="input-group-text spaan-content" id="addon-wrapping">Name</span>
  <input type="text" name="name" class="form-control" placeholder="Name">
</div>

<div class="input-group diiv-content  flex-nowrap">
  <span class="input-group-text spaan-content" id="addon-wrapping">Email</span>
  <input type="email" name="email" class="form-control" placeholder="email">
</div>


<div class="input-group diiv-content  flex-nowrap">
  <span class="input-group-text spaan-content" id="addon-wrapping">Password</span>
  <input type="password" name="password" class="form-control" placeholder="password">
</div>



<div class="input-group diiv-content  flex-nowrap">
  <input type="submit" class=" form-control submit-input"value="Log In">
</div>


</form>
<?php

?>
</div>

</div>

<?php

/*
if($count==0){
   echo  '<div class="btn btn-danger exist-user">User Is Not Exists</div>';
}*/

/*else{
    echo  '<div class="btn btn-danger exist-user">Sorry:: can not access this Page dirctly</div>';
}*/