<?php
session_start();
include('init.php');


if($_SERVER['REQUEST_METHOD']=="POST")
{

   $name     = $_POST['name'];
   $email    = $_POST['email'];
   $password = $_POST['password'];
   $hashpass = sha1($password);


   $stmt1=$con->prepare("SELECT Customer_Email,Customer_Password,Customer_id  FROM customers WHERE Customer_Email=? 
   AND Customer_Password=?");
   $stmt1->execute(array($email,$hashpass));
   $rows=$stmt1->fetchAll();
   $count1 =$stmt1->rowCount();
   
    if($count1 == 1)
    {
      foreach($rows as $row)
      {
        $_SESSION['username']=$name;
        $_SESSION['username_id']=$row['Customer_id'];
        
      
       header('location:category.php');
        exit(); 
      }
    }else{
        echo "<div class='container'><div class='btn btn-dark input-array'>login faild</div></div>";
    }

}
   







?>
<div class="container login-customer add-customer-form">
    <h1 class="h1-sign-up">Log In</h1>
    <div class="row ">
<form class="form-size-input-customer" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">

<div class="input-group diiv-content-customer  flex-nowrap">
  <span class="input-group-text spaan-content-customer" id="addon-wrapping">Name</span>
  <input type="text" name="name" class="form-control" placeholder="type your Name">
</div>

<div class="input-group diiv-content-customer  flex-nowrap">
  <span class="input-group-text spaan-content-customer" id="addon-wrapping">Email</span>
  <input type="email" name="email" class="form-control" placeholder="enter your email">
</div>


<div class="input-group diiv-content-customer  flex-nowrap">
  <span class="input-group-text spaan-content-customer" id="addon-wrapping">Password</span>
  <input type="password" name="password" class="form-control" placeholder="type your password">
</div>


<div class="input-group diiv-content-customer  flex-nowrap">
  <input type="submit" name="login" class=" form-control submit-input-customer" value="Log In">
 
</div>


</form>

</div>

</div>








  




















