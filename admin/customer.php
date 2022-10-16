<?php
session_start();
$navbar="";
$usernavbar='';
include('init.php');
if(isset($_SESSION['user'])AND ($_SESSION['groupid']==1))

{ 


    $do='';
if(isset($_GET['do']))
{
    $do=$_GET['do'];
}

////////////////////////////////////////////start edit section/////////////////////////////
if($do=='customer_edit')
{

$customer_id=$_GET['id'];
    $stmt=$con->prepare("SELECT *FROM customers WHERE  Customer_id=?");
    $stmt->execute(array($customer_id));
    $row=$stmt->fetch();
    $count=$stmt->rowCount();
    if($count > 0)
    {
      
    ?>
    
    
    
    <div class="container add-user-form">
        <div class="row ">
    <form class="form-size-input" action="customer.php?do=update" method="post" enctype="multipart/form-data">
    
    <div class="input-group  diiv-content  flex-nowrap">
      <span class="input-group-text  spaan-content " id="addon-wrapping">Name</span>
      <input type="hidden" name="id" class="form-control" value="<?php echo $row['Customer_id']?>">
      <input type="text" name="name" class="form-control" value="<?php echo $row['Customer_Name']?>">
    </div>
    
    <div class="input-group diiv-content  flex-nowrap">
      <span class="input-group-text spaan-content" id="addon-wrapping">Email</span>
      <input type="email" name="email" class="form-control" value="<?php echo $row['Customer_Email']?>">
    </div>
    
    
    <div class="input-group diiv-content  flex-nowrap">
      <span class="input-group-text spaan-content" id="addon-wrapping">Password</span>
      <input type="hidden" name="old_password" class="form-control" value="<?php echo $row['Customer_Password']?>">
      <input type="password" name="password" class="form-control" >
    </div>



    <div class="input-group diiv-content  flex-nowrap">
      <span class="input-group-text spaan-content" id="addon-wrapping">Image</span>
      <input type="hidden" name="old_image" class="form-control" value="<?php echo $row['Customer_Image']?>">
      <input type="file" name="image" class="form-control">
    </div>
    
    
    
    <div class="input-group diiv-content  flex-nowrap">
      <input type="submit" class=" form-control submit-input"value="Update Customer">
    </div>
    
    </form>
    </div>
    </div>


<?php
    }
}



elseif($do=="update")
{
  if($_SERVER['REQUEST_METHOD']=="POST")
  {
    $id           = $_POST['id'];
    $name         = $_POST['name'];
    $email        = $_POST['email'];
    $password2    =$_POST['old_password'];
    $password     = $_POST['password'];
    $hashpassword =sha1($password);

    $old_image=$_POST['old_image'];
    $image_name   = $_FILES['image']['name'];
    $image_tmp    = $_FILES['image']['tmp_name'];
    $image_type   = $_FILES['image']['type'];
    $image_size   = $_FILES['image']['size'];

   // echo $image_name.'<br>'.$image_tmp.'<br>'.$image_type.'<br>'.$image_size;
   // echo 'this is' .$old_image;

   $image_array=array('jpg','png','jpeg','gif');
   $x=explode('.',$image_name);
   $image_extension=end($x);
   

    if(empty($password))
    {
      $pass=$password2;
    }else{
      $pass=$hashpassword;
    }

    $inputarray= array();
    if(empty($name))
    {
      $inputarray[]='SORRY:: FisrtName can not be <strong>Empty</strong>';
    }
   
    if(empty($pass))
    {
      $inputarray[]='SORRY:: Password can not be <strong>Empty</strong>';
    }
    if(empty($email))
    {
      $inputarray[]='SORRY:: Email can not be <strong>Empty</strong>';
    }
    if(strlen($name) < 3)
    {
      $inputarray[]='SORRY:: FisrtName can not be lease than <strong>3 Character</strong>';
    }
    
    if(strlen($pass) < 3)
    {
      $inputarray[]="SORRY:: Password can not be lease than <strong>3 Character</strong>";
    }
    if(!empty($image_name) &&!in_array($image_extension,$image_array))
    {
      $inputarray[]="SORRY:: Sorry This Extension Is Not <strong>Allowed</strong>";
    }
    if(empty($image_name))
    {
      $inputarray[]="SORRY:: Sorry Image Can Not Be <strong>empty</strong>";
    }
    
    foreach($inputarray as $input)
    {
      echo "<div class='btn btn-dark input-array'>$input</div>";
    }
    
if(empty($inputarray))
{
  if(!empty($image_name))
  {
    unlink(rand(0,100000).'_'."../all_image/".$old_image);
  }
  $image_ext=rand(0,100000).'_'.$image_name;
  move_uploaded_file($image_tmp,"../all_image/".$image_ext);
  if(empty($image_ext))
  {
  $img=$old_image;
  }else{
    $img=$image_ext;
  }
  //echo $img;

  $stmt2=$con->prepare("UPDATE customers SET Customer_Name=?,Customer_Email=?,Customer_Password=?,Customer_Image=?
   WHERE Customer_id=?");
  $stmt2->execute(array($name,$email,$pass,$img,$id));
  $count2=$stmt2->rowcount();
  if($count2>0)
  {

    echo   "<div class='btn btn-dark input-array'> $count2  ' User Had Been Successfully'</div>";
    $msg="<div class='btn btn-dark input-array'>Success Customer Update Successfully</div>";
   // redirect($msg);
  }
}

  }else{
    $msg="<div class='btn btn-dark input-array'>SorrY:: Can Not Browser This Page Directly</div>";
    redirect($msg);
  }

  }

  /////////////////////////////////////////////////////end edit section/////////////////////////////////////


  ////////////////////////////////////////////////////start add section//////////////////////////////////

  elseif($do=='customer_Add')
  {
  ?>
  <div class="container add-user-form">
      <div class="row ">
  <form class="form-size-input" action="customer.php?do=insert" method="post" enctype="multipart/form-data">
  
  <div class="input-group  diiv-content  flex-nowrap">
    <span class="input-group-text  spaan-content " id="addon-wrapping">Name</span>
    <input type="text" name="name" class="form-control" placeholder="type customer name">
  </div>
  
  <div class="input-group diiv-content  flex-nowrap">
    <span class="input-group-text spaan-content" id="addon-wrapping">Email</span>
    <input type="email" name="email" class="form-control" placeholder="type customer email">
  </div>
  
  
  <div class="input-group diiv-content  flex-nowrap">
    <span class="input-group-text spaan-content" id="addon-wrapping">Password</span>
    <input type="password" name="password" class="form-control" placeholder="type customer password">
  </div>
  
  <div class="input-group diiv-content  flex-nowrap">
    <span class="input-group-text spaan-content" id="addon-wrapping">Image</span>
    <input type="file" name="image" class="form-control" placeholder="uplaod customer image">
  </div>
  
  <div class="input-group diiv-content  flex-nowrap">
    <input type="submit" class=" form-control submit-input"value="Add Customer">
  </div>
  
  </form>
  </div>
  </div>
  <?php
  
  }
  
  
  
  if($do=="insert")
  {
    if($_SERVER['REQUEST_METHOD']=="POST")
    {
  $name     = $_POST['name'];
  $email         = $_POST['email'];
  $password      = $_POST['password'];
  $hashpassword  = sha1($password);


  $image_name   = $_FILES['image']['name'];
  $image_tmp    = $_FILES['image']['tmp_name'];
  $image_type   = $_FILES['image']['type'];
  $image_size   = $_FILES['image']['size'];
 

  $image_array=array('jpg','png','jpeg','gif');
  $x=explode('.',$image_name);
  $image_extension=end($x);
  
  
  $inputarray= array();
  if(empty($name))
  {
    $inputarray[]='SORRY:: FisrtName can not be <strong>Empty</strong>';
  }
  
  if(empty($password))
  {
    $inputarray[]='SORRY:: Password can not be <strong>Empty</strong>';
  }
  if(empty($email))
  {
    $inputarray[]='SORRY:: Email can not be <strong>Empty</strong>';
  }
  if(strlen($name) < 3)
  {
    $inputarray[]='SORRY:: FisrtName can not be lease than <strong>3 Character</strong>';
  }
  
  if(strlen($password) < 3)
  {
    $inputarray[]="SORRY:: Password can not be lease than <strong>3 Character</strong>";
  }
  
  foreach($inputarray as $input)
  {
    echo "<div class='btn btn-dark input-array'>$input</div>";
  }
  
  if(empty($input))
  {
    $image_ext=rand(0,100000).'_'.$image_name;
    move_uploaded_file($image_tmp,"../all_image/".$image_ext);
    
    $checkuser = check('Customer_Name','Customer_Password','customers',$name,$hashpassword);
    if($checkuser > 0)
    {
    $msg= "<div class='btn btn-dark input-array'>Sorry:: This User Is Already Exists</div>";
    redirect($msg);
  
  }else{
  $stmt2=$con->prepare("INSERT INTO customers (Customer_Name,Customer_Email,Customer_Password,Date,Customer_Image)
  VALUES(:zname,:zemail,:zpass,now(),:zimage)");
  $stmt2->execute(array(
  'zname' => $name,
  'zemail' => $email,
  'zpass'  => $hashpassword,
  'zimage'  => $image_ext
  
  ));
  
    $msg="<div class='btn btn-dark input-array'>Success User Added Successfully</div>";
    redirect($msg);
  
  }
  
  }
  
  }
    else{
      $msg="<div class='btn btn-dark input-array'>SorrY:: Can Not Browse This Page Directly</div>";
      redirect($msg);
    }
  
  }
  


  /////////////////////////////////////////////////////end add section//////////////////////////////////////








//////////////////////////////start delete section/////////////////////////////////////////////////
  elseif($do=="customer_delete")
{
  if(isset($_SERVER['HTTP_REFERER']) AND $_SERVER['HTTP_REFERER']!=='')
  {
  if(isset($_GET['id']))
  {
  $id=$_GET['id'];
  $image=$_GET['image'];
  }else{
    $id=0;
  }
  
  
  
  $stmt=$con->prepare("DELETE FROM customers WHERE Customer_id=:zid");
  $stmt->bindparam(':zid',$id);
  $stmt->execute();
  $count=$stmt->rowCount();
  if($count)
  {
    echo   "<div class='btn btn-dark input-array'> $count  ' User Had Been Delete Successfully'</div>";
    $msg="<div class='btn btn-dark input-array'>Customer Deleted  Successfully</div>";
    unlink(rand(0,100000).'_'."../all_image/".$image);
   // redirect($msg);
  }
}else{
  $msg="<div class='btn btn-dark input-array'>SorrY:: Can Not Browse This Page Directly</div>";
 // redirect($msg);
}
}
///////////////////////////////end delete section//////////////////////////////////////////

}//this is session close end




