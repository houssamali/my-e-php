
<?php 

session_start();
$navbar="";
$usernavbar='';
include('init.php');
if(isset($_SESSION['user'])AND ($_SESSION['groupid']==1))

{ 

/////////////////////////////////////////search customer name start///////////////////////////////////
   if(isset($_POST['search']) OR isset($_GET['name']))
   {
      
       //$search=$_POST['name'];
  // start customer search page
  //$search=''; 
  if($_POST)
  {
    $search=$_POST['name'];
  }
  else
  {
    $search=$_GET['name'];
  }



  $stmt3=$con->prepare("SELECT  *FROM customers WHERE Customer_Name=?");
  $stmt3->execute(array($search));
  $customers = $stmt3->fetchAll();
  $count3=$stmt3->rowCount();
  
  if($count3 > 0)
  {


   

  ?>
  <div class="container">
 <div class='btn btn-dark input-array search-bg-391'>Your Search Is 
    <?php echo '<div class="btn text-light text-center search-bg-390">'.$search.'</div>'; ?></div>
  </div>

  
<div class="container text-center user-table customer-table-bg ">
<div class="row">
<h1  class="text-center text-dark">Customers Table</h1>
<table class="table text-dark">
<thead>
<tr>
  <th scope="col">ID</th>
  <th>Image</th>
  <th scope="col">Name</th>
  <th scope="col">Email</th>
  <th scope="col">Date</th>
  <th scope="col">Actions</th>
  </tr>
</thead>
<?php

foreach($customers as $customer)
{



?>

<tbody>
<tr>
  <th scope="row"><?php echo $customer['Customer_id']?></th>
  <td>
    <?php
    if(empty($customer['Customer_Image']))
    {
  echo 'No Image';
    }else{
      ?>
    <img class="customer_image_backend_display" src="../all_image/<?php echo $customer['Customer_Image']?>"  alt="">
    <?php
    }
    ?>
  </td>
  <td><?php echo $customer['Customer_Name']?></td>
  <td><?php echo $customer['Customer_Email']?></td>
  <td><?php echo $customer['Date']?></td>
  <td>
  <a href="customer.php?do=customer_edit&id=<?php echo $customer['Customer_id']?>" class="btn btn-primary">
  <i class="fa-solid fa-pen-to-square font-awesome"></i>Edit</a>
  <a href="customer.php?do=customer_delete&id=<?php echo $customer['Customer_id']?>" class="btn btn-primary">
  <i class="fa-solid fa-trash-can font-awesome"></i>Delete</a>
  <?php
 /* if($user['group_id']==0)
  {
   echo '<a href="user.php?do=confirm&id='.$customer['Customer_Id'].'" class="btn btn-primary">Confirm</a>';
  }*/
  ?>
 </td>
</tr>

</tbody>
<?php
}
  }
else{
echo"<div class='container'><div class='btn btn-dark input-array'>
Sorry:: Customer In your Searching Is Not Found</div></div>";
}

?>


</table>

</div>



</div>
<?php


   
  
  }

    /////////////////////////////////////////search customer name start///////////////////////////////////    
  
 
  



$do='';
if(isset($_GET['do']))
{
    $do=$_GET['do'];
}else{
    $do='user';
}

//////////////////////////////////////////////////////Dispay admin section//////////////////////////////
if($do=='user')
{
  
  
  //start admin page
  //this page display all admin had been register


$stmt=$con->prepare("SELECT *FROM users");
$stmt->execute();
$rows =$stmt->fetchAll();
$count = $stmt->rowCount();


?>




<div class="container text-center user-table bg-dark">
    <div class="row">
    <h1  class="text-center text-light">Admin Table</h1>
<table class="table text-light">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">FirstName</th>
      <th scope="col">Email</th>
      <th scope="col">LastName</th>
      <th scope="col">Date</th>
      <th scope="col">Actions</th>
      </tr>
  </thead>
<?php
if($count >0)
{
foreach($rows as $row){
    


   ?>
   
  <tbody>
    <tr>
      <th scope="row"><?php echo $row['user_id']?></th>
      <td><?php echo $row['First_Name']?></td>
      <td><?php echo $row['Email']?></td>
      <td><?php echo $row['Last_Name']?></td>
      <td><?php echo $row['Date']?></td>
      <td>
      <a href="user.php?do=edit&id=<?php echo $row['user_id']?>" class="btn btn-primary">
      <i class="fa-solid fa-pen-to-square font-awesome"></i>Edit</a>
      <a href="user.php?do=delete&id=<?php echo $row['user_id']?>" class="btn btn-primary">
      <i class="fa-solid fa-trash-can font-awesome"></i>Delete</a>
      <?php
      if($row['group_id']==0)
      {
       echo '<a href="user.php?do=confirm&id='.$row['user_id'].'" class="btn btn-primary">
       <i class="fa-regular fa-square-check font-awesome"></i>Confirm</a>';
      }
      ?>
     </td>
    </tr>
  
  </tbody>
  <?php
}}
?>


</table>
</div>
<a href="user.php?do=Add_Admin" class="btn btn-primary add-admin">
<i class="fa-solid fa-user-plus font-awesome"></i>
Add Admin</a>
</div>




<?php
//////////////////////////////////////////////////////end Dispay admin section//////////////////////////////


 
/////////////////////////////////////////start customer page diaplay custmoer register/////////////////////




$stmt=$con->prepare("SELECT *FROM customers");
$stmt->execute();
$customers =$stmt->fetchAll();
$count2 = $stmt->rowCount();


?>




<div class="container  text-center user-table customer-table-bg">
    <div class="row">
    <h1  class="text-center text-dark">Customers Table</h1>
<table class="table text-dark">

  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Image</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Date</th>
      <th scope="col">Actions</th>
      </tr>
  </thead>
<?php
if($count2 >0)
{
foreach($customers as $customer){
    


   ?>
   
  <tbody>
    <tr>
      <th scope="row"><?php echo $customer['Customer_id']?></th>
      <td>
        <?php
        if(empty($customer['Customer_Image']))
        {
          echo 'Img Not Found';
        }else{
          ?>
          <img class="customer_image_backend_display" src="../all_image/<?php echo $customer['Customer_Image']?>" alt="">
          <?php
        }

        ?>
      </td>
      <td><?php echo $customer['Customer_Name']?></td>
      <td><?php echo $customer['Customer_Email']?></td>
      <td><?php echo $customer['Date']?></td>
      
      <td>
      <a href="customer.php?do=customer_edit&id=<?php echo $customer['Customer_id']?>" class="btn btn-primary">
      <i class="fa-solid fa-pen-to-square font-awesome"></i>Edit</a>
      <a href="customer.php?do=customer_delete&id=<?php echo $customer['Customer_id']?>?&image=<?php echo $customer['Customer_Image']?>" class="btn btn-primary">
      <i class="fa-solid fa-trash-can font-awesome"></i>Delete</a>
      <?php
      /*if($row['group_id']==0)
      {
       echo '<a href="user.php?do=confirm&id='.$row['user_id'].'" class="btn btn-primary">
       <i class="fa-regular fa-square-check font-awesome"></i>Confirm</a>';
      }*/
      ?>
     </td>
    </tr>
  
  </tbody>
  <?php
}}
?>


</table>
</div>
<a href="customer.php?do=customer_Add" class="btn btn-primary add-admin">
<i class="fa-solid fa-user-plus font-awesome"></i> Add Customer</a>
</div>

<?php


/////////////////////////////////////////end customer page diaplay custmoer register/////////////////////

}


elseif($do=='Add_Admin')
{
?>
<div class="container add-user-form">
    <div class="row ">
<form class="form-size-input" action="user.php?do=insert" method="post">

<div class="input-group  diiv-content  flex-nowrap">
  <span class="input-group-text  spaan-content " id="addon-wrapping">FirstName</span>
  <input type="text" name="firstname" class="form-control" placeholder="firstname">
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
  <span class="input-group-text spaan-content" id="addon-wrapping">LastName</span>
  <input type="text" name="lastname" class="form-control" placeholder="lastname">
</div>

<div class="input-group diiv-content  flex-nowrap">
  <input type="submit" class=" form-control submit-input"value="Add Admin">
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
$firstname     = $_POST['firstname'];
$email         = $_POST['email'];
$password      = $_POST['password'];
$hashpassword  = sha1($password);
$lastname    = $_POST['lastname'];

$inputarray= array();
if(empty($firstname))
{
  $inputarray[]='SORRY:: FisrtName can not be <strong>Empty</strong>';
}
if(empty($lastname))
{
  $inputarray[]='SORRY:: LastName can not be <strong>Empty</strong>';
}
if(empty($password))
{
  $inputarray[]='SORRY:: Password can not be <strong>Empty</strong>';
}
if(empty($email))
{
  $inputarray[]='SORRY:: Email can not be <strong>Empty</strong>';
}
if(strlen($firstname) < 6)
{
  $inputarray[]='SORRY:: FisrtName can not be lease than <strong>8 Character</strong>';
}
if(strlen($lastname) < 6)
{
  $inputarray[]='SORRY:: LastName can not be lease than <strong>8 Character</srtong>';
}
if(strlen($password) < 6)
{
  $inputarray[]="SORRY:: Password can not be lease than <strong>6 Character</strong>";
}

foreach($inputarray as $input)
{
  echo "<div class='btn btn-dark input-array'>$input</div>";
}

if(empty($input))
{
  
  $checkuser = check('First_Name','Password','users',$firstname,$hashpassword);
  if($checkuser > 0)
  {
  $msg= "<div class='btn btn-dark input-array'>Sorry:: This User Is Already Exists</div>";
  redirect($msg);

}else{
$stmt2=$con->prepare("INSERT INTO users (First_Name,Email,Password,Last_Name,Date)
VALUES(:zfirst,:zemail,:zpass,:zlast,now())");
$stmt2->execute(array(
'zfirst' => $firstname,
'zemail' => $email,
'zpass'  => $hashpassword,
'zlast'  => $lastname
));

  $msg="<div class='btn btn-dark input-array'>Success User Added Successfully</div>";
  redirect($msg);

}

}

}else{
  echo '<div class="btn btn-dark input-array">SORRY:: you can not access this page directly</div>';
}
}

elseif($do=="edit")
{
  if(isset($_SERVER['HTTP_REFERER'])AND $_SERVER['HTTP_REFERER']!=='')
  {
  if(isset($_GET['id']))
  {
$id=$_GET['id'];
  }else{
    $id=0;
  }
 
$stmt=$con->prepare("SELECT *FROM users WHERE user_id=?");
$stmt->execute(array($id));
$row=$stmt->fetch();
$count=$stmt->rowCount();
if($count > 0)
{
  
?>



<div class="container add-user-form">
    <div class="row ">
<form class="form-size-input" action="user.php?do=update" method="post">

<div class="input-group  diiv-content  flex-nowrap">
  <span class="input-group-text  spaan-content " id="addon-wrapping">FirstName</span>
  <input type="hidden" name="id" class="form-control" value="<?php echo $row['user_id']?>">
  <input type="text" name="firstname" class="form-control" value="<?php echo $row['First_Name']?>">
</div>

<div class="input-group diiv-content  flex-nowrap">
  <span class="input-group-text spaan-content" id="addon-wrapping">Email</span>
  <input type="email" name="email" class="form-control" value="<?php echo $row['Email']?>">
</div>


<div class="input-group diiv-content  flex-nowrap">
  <span class="input-group-text spaan-content" id="addon-wrapping">Password</span>
  <input type="hidden" name="old_password" class="form-control" value="<?php echo $row['Password']?>">
  <input type="password" name="password" class="form-control" >
</div>

<div class="input-group diiv-content  flex-nowrap">
  <span class="input-group-text spaan-content" id="addon-wrapping">LastName</span>
  <input type="text" name="lastname" class="form-control" value="<?php echo $row['Last_Name']?>">
</div>

<div class="input-group diiv-content  flex-nowrap">
  <input type="submit" class=" form-control submit-input"value="Add Admin">
</div>

</form>
</div>
</div>
<?php

}
  }
    else{
      $url='user.php';
      $msg= "<div class='btn btn-dark input-array'> Sorry:: Can Not Access This Page Directly</div>";
      redirect($msg);
    }
  

}


elseif($do=="update")
{
  if($_SERVER['REQUEST_METHOD']=="POST")
  {
    $id           = $_POST['id'];
    $firstname    = $_POST['firstname'];
    $email        = $_POST['email'];
    $password2    =$_POST['old_password'];
    $password     = $_POST['password'];
    $hashpassword =sha1($password);
    $lastname     = $_POST['lastname'];

    if(!empty($password))
    {
      $pass=$hashpassword;
    }else{
      $pass=$password2;
    }

    $inputarray= array();
    if(empty($firstname))
    {
      $inputarray[]='SORRY:: FisrtName can not be <strong>Empty</strong>';
    }
    if(empty($lastname))
    {
      $inputarray[]='SORRY:: LastName can not be <strong>Empty</strong>';
    }
    if(empty($pass))
    {
      $inputarray[]='SORRY:: Password can not be <strong>Empty</strong>';
    }
    if(empty($email))
    {
      $inputarray[]='SORRY:: Email can not be <strong>Empty</strong>';
    }
    if(strlen($firstname) < 6)
    {
      $inputarray[]='SORRY:: FisrtName can not be lease than <strong>8 Character</strong>';
    }
    if(strlen($lastname) < 6)
    {
      $inputarray[]='SORRY:: LastName can not be lease than <strong>8 Character</srtong>';
    }
    if(strlen($pass) < 6)
    {
      $inputarray[]="SORRY:: Password can not be lease than <strong>6 Character</strong>";
    }
    
    foreach($inputarray as $input)
    {
      echo "<div class='btn btn-dark input-array'>$input</div>";
    }
    
if(empty($inputarray))
{

  $stmt2=$con->prepare("UPDATE users SET First_Name=?,Email=?,Password=?,Last_Name=? WHERE user_id=?");
  $stmt2->execute(array($firstname,$email,$pass,$lastname,$id));
  $count2=$stmt2->rowcount();
  if($count2>0)
  {
    echo   "<div class='btn btn-dark input-array'> $count2  ' User Had Been Successfully'</div>";
  }
}

  }else{
    $msg= "<div class='btn btn-dark input-array'>Sorry:: Can Not Browser This Page Directly</div>";
    redirect($msg);
  }
}



elseif($do=="delete")
{
  if(isset($_SERVER['HTTP_REFERER']) AND $_SERVER['HTTP_REFERER']!=='')
  {
  if(isset($_GET['id']))
  {
  $id=$_GET['id'];
  }else{
    $id=0;
  }
  $stmt=$con->prepare("DELETE FROM users WHERE user_id=:zid");
  $stmt->bindparam(':zid',$id);
  $stmt->execute();
  $count=$stmt->rowCount();
  if($count)
  {
    echo   "<div class='btn btn-dark input-array'> $count  ' User Had Been Delete Successfully'</div>";
  }
}else{
  $msg= "<div class='btn btn-dark input-array'> Sorry:: Can Not Access This Page Directly</div>";
  redirect($msg);
}
}



if($do=='confirm')
{
  if(isset($_SERVER['HTTP_REFERER'])AND $_SERVER['HTTP_REFERER']!=='')
  {
  $id=$_GET['id'];
  $stmt=$con->prepare("UPDATE users SET group_id=1 WHERE user_id=?");
  $stmt->execute(array($id));
  $count=$stmt->rowCount();
  if($count)
  {
    echo   "<div class='btn btn-dark input-array'> $count  ' User Had Been Delete Successfully'</div>";
  }
}else{
  $msg = "<div class='btn btn-dark input-array'> Sorry1:: Can Not Access This Page Directly</div>";
  redirect($msg);
}
}
}
else{
  header('location:login.php');
exit();
}

?>
