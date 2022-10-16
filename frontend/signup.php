<?php
session_start();
include('init.php');

if($_SERVER['REQUEST_METHOD']=="POST")
{

   $name     = $_POST['name'];
   $email    = $_POST['email'];
   $password = $_POST['password'];
   $hashpass = sha1($password);

   $image_name=$_FILES['image']['name'];
   $image_tmp=$_FILES['image']['tmp_name'];
   $image_type=$_FILES['image']['type'];
   $image_size=$_FILES['image']['size'];
   

   $image_array=array('jpg','png','gif','jpeg');
   $x=explode('.',$image_name);
   $image_extension=end($x);


   $inputarray= array();
    if(empty($name))
    {
      $inputarray[]='SORRY:: Name can not be <strong>Empty</strong>';
     
    }
    
    if(empty($password))
    {
      $inputarray[]='SORRY:: Password can not be <strong>Empty</strong>';
      
    }
    if(empty($email))
    {
      $inputarray[]='SORRY:: Email can not be <strong>Empty</strong>';
    }
    if(strlen($name) < 4)
    {
      $inputarray[]='SORRY:: Name can not be lease than <strong>4 Character</strong>';
    }
    
    if(strlen($password) < 3)
    {
      $inputarray[]="SORRY:: Password can not be lease than <strong>3 Character</strong>";
    }
    if(! empty($image_name) && ! in_array($image_extension,$image_array))
    {
      $inputarray[]= 'this extension is not  <strong>Allowed</strong>';
    }
if(empty($image_name))
{
  $inputarray[]="SORRY:: Image can not be  <strong>Epmty</strong>";
}
if($image_size >4194304)
{
  $inputarray[]="SORRY:: Image Size Can Not BE More Than <strong>4094304</strong>";
}
foreach($inputarray as $input)
{
  
  echo "<div class='container'><div class='btn btn-dark input-array'>$input</div></div>";
} 
    
if(empty($inputarray))
{
    $check=check('Customer_Name','Customer_Password','customers',$name,$hashpass);
    if($check == 0)
    {
        $ext=rand(0,100000).'_'.$image_name;
        move_uploaded_file($image_tmp,"../all_image/".$ext);
    $stmt=$con->prepare("INSERT INTO customers (Customer_Name,Customer_Email,Customer_Password,Date,Customer_Image)
    VALUES(:zname,:zemail,:zpass,now(),:zimage)");
    $stmt->execute(array(
  ':zname'  =>$name,
  ':zemail' =>$email,
  ':zpass'  =>$hashpass,
  ':zimage'  =>$ext
    ));
    $rows=$stmt->fetchAll();
    $count=$stmt->rowCount();
    
    if($count ==1)
    {
      foreach($rows as $row)
      {
      $_SESSION['username']=$name;
      $_SESSION['username_id']=$row['Customer_id'];
      }
      
        echo "<div class='container'><div class='btn btn-dark input-array'>Sign Up Successfully</div></div>";
   header('location:category.php');
   exit();
      
    }
}else{
    
    echo "<div class='container'><div class='btn btn-dark input-array'>Sorry:: This User Already Exists</div></div>";
}}
}






?>
<div class="container login-customer add-customer-form">
    <h1 class="h1-sign-up">Sign Up</h1>
    <div class="row ">
<form class="form-size-input-customer" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">

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
  <span class="input-group-text spaan-content-customer" id="addon-wrapping">Image</span>
  <input type="file" name="image" class="form-control" placeholder="Upload your Image">
</div>



<div class="input-group diiv-content-customer  flex-nowrap">
  <input type="submit" name="signup" class=" form-control submit-input-customer"value="Sign Up">
</div>


</form>
<div class="container">
<?php

?>
</div>

</div>


</div>


















    
