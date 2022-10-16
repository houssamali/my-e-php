<?php
session_start();
include('init.php');

if(isset($_GET['profile_id']))
{
    $id=$_GET['profile_id'];
   



   $stmt1=$con->prepare("SELECT  *FROM customers WHERE Customer_id=? ");
   $stmt1->execute(array($id));
   $rows=$stmt1->fetchAll();
   $count1 =$stmt1->rowCount();
   
    if($count1 == 1)
    {
      foreach($rows as $row)
      {
       
        

        ?>
        <div class="container login-customer add-customer-form">
            <h1 class="h1-sign-up">Edit Information</h1>
            <div class="row ">
        <form class="form-size-input-customer" action="?edit" method="post" enctype="multipart/form-data">
        
        <div class="input-group diiv-content-customer  flex-nowrap">
          <span class="input-group-text spaan-content-customer" id="addon-wrapping">Name</span>
          <input type="hidden" name="id" class="form-control" value="<?php echo $row['Customer_id']?>">
          <input type="text" name="name" class="form-control" value="<?php echo $row['Customer_Name']?>">
        </div>
        
        <div class="input-group diiv-content-customer  flex-nowrap">
          <span class="input-group-text spaan-content-customer" id="addon-wrapping">Email</span>
          <input type="email" name="email" class="form-control" value="<?php echo $row['Customer_Email']?>">
        </div>


        <div class="input-group diiv-content-customer  flex-nowrap">
          <span class="input-group-text spaan-content-customer" id="addon-wrapping">Image</span>
          <input type="hidden" name="old_image" class="form-control" 
          value="<?php echo "../all_image/".$row['Customer_Image']?>">

          <input type="file" name="image" class="form-control" >
         
        </div>
        
        
        <div class="input-group diiv-content-customer  flex-nowrap">
          <span class="input-group-text spaan-content-customer" id="addon-wrapping">password</span>
          <input type="hidden" name="old_password" class="form-control"value="<?php echo $row['Customer_Password']?>"  >
          <input type="password" name="new_password" class="form-control" placeholder="change password">
        </div>
        
        
        <div class="input-group diiv-content-customer  flex-nowrap">
          <input type="submit" name="Update" class=" form-control submit-input-customer" value="Edit Information">
         
        </div>
        
        
        </form>
        
        </div>
        
        </div>
        
<?php




      
      
      }
    }else{
        echo "<div class='container'><div class='btn btn-dark input-array'>login faild</div></div>";
    }

}

   if(isset($_GET['edit']))
   {
    if(isset($_POST['Update']))
    {
       $id= $_POST['id'];
       $name= $_POST['name'];
       $email= $_POST['email'];
       $old_password=$_POST['old_password'];
       $new_password=$_POST['new_password'];

       if(empty($new_password))
       {
        $pass=$old_password;
       }else{
        $pass=sha1($new_password);
       }
       

$old_image=$_POST['old_image'];
$image_name=$_FILES['image']['name'];
$image_tmp=$_FILES['image']['tmp_name'];
$image_type=$_FILES['image']['type'];
$image_size=$_FILES['image']['size'];

//echo $image_name."<br>".$image_tmp."<br>".$image_type."<br>".$image_size;


$image_array=array('jpg','png','gif','jpeg');
$x=explode('.',$image_name);
$image_extension=end($x);


$inputarray= array();
 if(empty($name))
 {
   $inputarray[]='SORRY:: Name can not be <strong>Empty</strong>';
  
 }
 
 if(empty($email))
 {
   $inputarray[]='SORRY:: Email can not be <strong>Empty</strong>';
 }
 if(strlen($name) < 3)
 {
   $inputarray[]='SORRY:: Name can not be lease than <strong>3 Character</strong>';
 }
 
 if(strlen($pass) < 3)
 {
   $inputarray[]="SORRY:: Password can not be lease than <strong>3 Character</strong>";
 }
 if(! empty($image_name) && ! in_array($image_extension,$image_array))
 {
   $inputarray[]= 'this extension is not  <strong>Allowed</strong>';
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
 
     $ext=rand(0,100000).'_'.$image_name;
     move_uploaded_file($image_tmp,"../all_image/".$ext);
 $stmt=$con->prepare("UPDATE customers SET Customer_Name=?,Customer_Email=?,
 Customer_Password=?,Customer_Image=? WHERE Customer_id=?");

 $stmt->execute(array($name,$email,$pass,$ext,$id));
 $rows=$stmt->fetchAll();
 $count=$stmt->rowCount();
 if($count > 0)
 {
    echo "<div class='container'><div class='btn btn-dark input-array'>Update Successfully</div></div>";
 }else{
    echo "<div class='container'><div class='btn btn-dark input-array'>Update Faild</div></div>";
 }
}
       
    }
   }
//////////////////////////////////end of edit profile///////////////////////////



////////////////////////////////////start of adding ads /////////////////////////////////////////////////
elseif(isset($_GET['add_ads']))
{

$id=$_GET['add_ads'];

?>

    <div class="container add-user-form">
    <div class="row ">
<form class="form-size-input" action="?insert" method="post" enctype="multipart/form-data">

<div class="input-group  diiv-content  flex-nowrap">
  <span class="input-group-text  spaan-content " id="addon-wrapping">Name</span>
  <input type="hidden" name="id" class="form-control" value="<?php echo $id?>">
  <input type="text" name="name" class="form-control" placeholder="Item Name">
</div>

<div class="input-group diiv-content  flex-nowrap">
  <span class="input-group-text spaan-content" id="addon-wrapping">Image</span>
  <input type="file" name="image" class="form-control" placeholder="Item Image">
</div>


<div class="input-group diiv-content  flex-nowrap">
  <span class="input-group-text spaan-content" id="addon-wrapping">Price</span>
  <input type="text" name="price" class="form-control" placeholder="Item Price">
</div>

<div class="input-group diiv-content  flex-nowrap">
  <span class="input-group-text spaan-content" id="addon-wrapping">Description</span>
  <input type="text" name="description" class="form-control" placeholder="Item Descrption">
</div>



<div class="input-group diiv-content  flex-nowrap">
<span class="input-group-text spaan-content" id="addon-wrapping">category</span>
  <select  name="category" class="form-control">
    <option value=""></option>
    <?php
    $stmt2=$con->prepare("SELECT *FROM category");
    $stmt2->execute();
    $categories=$stmt2->fetchAll();
    $count2 =$stmt2->rowCount();
    if($count2 > 0)
    {
      foreach($categories as $category)
      {
        ?>
        <option value="<?php echo $category['category_id']?>"><?php echo $category['Name']?></option>
        <?php
      }
    }
    ?>
    
</select>
</div>


<div class="input-group diiv-content  flex-nowrap">
  <input type="submit" class=" form-control submit-input"value="Add ads">
</div>

</form>
</div>
</div>
<?php
}
 //////////////////////////////////////////////////////end item add section/////////////////////////////

 //////////////////////////////////////////////////////start item insert section/////////////////////////////
 
 elseif(isset($_GET['insert']))
{
  if($_SERVER['REQUEST_METHOD']=="POST")
  {
$id              =$_POST['id'];
$name            = $_POST['name'];
$price           = $_POST['price'];
$description     = $_POST['description'];
$category        = $_POST['category'];





$image_name=$_FILES['image']['name'];
$image_type=$_FILES['image']['type'];
$image_size=$_FILES['image']['size'];
$image_temp=$_FILES['image']['tmp_name'];

$image_array=array('jpg','png','gif','jpeg');
$x=explode('.',$image_name);
$image_ext=end($x);




$inputarray= array();
if(empty($name))
{
  $inputarray[]='SORRY:: Name can not be <strong>Empty</strong>';
}
if(empty($price))
{
  $inputarray[]='SORRY:: price can not be <strong>Empty</strong>';
}
if(empty($description))
{
  $inputarray[]='SORRY:: Description can not be <strong>Empty</strong>';
}

if(strlen($name) < 3)
{
  $inputarray[]='SORRY:: Name can not be lease than <strong>3 Character</strong>';
}
if(strlen($price) <= 0)
{
  $inputarray[]='SORRY:: LastName can not be lease than <strong> 1 Character</srtong>';
}
if(strlen($description) < 5)
{
  $inputarray[]="SORRY:: descrption can not be lease than <strong>10 Character</strong>";
}
if(! empty($image_name) && ! in_array($image_ext,$image_array))
        {
            $inputarray[]= 'this extension is not  <strong>Allowed</strong>';
        }
if(empty($image_name))
{
  $inputarray[]="SORRY:: Image can not be  <strong>empty</strong>";
}
if($image_size >4194304)
{
  $inputarray[]="SORRY:: Image Size Can Not BE More Than <strong>4094304</strong>";
}

foreach($inputarray as $input)
{
  echo "<div class='btn btn-dark input-array'>$input</div>";
}

if(empty($input))
{
    $ext=rand(0,1000000).'_'.$image_name;
    move_uploaded_file($image_temp,'../all_image/'.$ext);
  
  /*$checkuser = check('Name','Description','items',$name,$description);
  if($checkuser > 0)
  {
  $msg= "<div class='btn btn-dark input-array'>Sorry:: This Item Is Already Exists</div>";
  redirect2($msg);*/

//}else{*/

    
$stmt2=$con->prepare("INSERT INTO items (Name,Image,Price,Description,Date,customer_id,Cat_id,Ads)
VALUES(:zname,:zimage,:zprice,:zdesc,now(),:zcustomer,:zcat,0)");
$stmt2->execute(array(
'zname' => $name,
'zimage' => $ext,
'zprice' => $price,
'zdesc'  => $description,
'zcustomer' => $id,
'zcat' => $category

));
$count3=$stmt2->rowCount();
if($count3 > 0)
{
  echo "<div class='btn btn-dark input-array'>Success ads Added Successfully</div>";
 // $msg="<div class='btn btn-dark input-array'>Success ads Added Successfully</div>";
  //redirect2($msg);
}else{
  echo "<div class='btn btn-dark input-array'> Ads Failed To Add </div>";
}
}

}else{
  echo '<div class="btn btn-dark input-array">SORRY:: you can not access this page directly</div>';
}


}

////////////////////////////////////start edit Ads ///////////////////////////////////////////////

elseif(isset($_GET['edit_id']))
{
    $id=$_GET['edit_id'];
    

    $stmt=$con->prepare("SELECT items.*,customers.Customer_Name, 
    category.Name as Category_name 
    FROM items 
    INNER JOIN customers ON
    customers.Customer_id=items.customer_id
    INNER JOIN category ON
    category.category_id=items.Cat_id
    WHERE Id=?
    ");
    
    $stmt->execute(array($id));
    $row=$stmt->fetchAll();
    $count=$stmt->rowCount();
    if($count > 0)
    {
       
        foreach($row as $rows)
        {
       
        ?>

<div class="container add-user-form">
    <div class="row ">
<form class="form-size-input" action="?update" method="post" enctype="multipart/form-data">

<div class="input-group  diiv-content  flex-nowrap">
    <input type="hidden" name="id" value="<?php echo $rows['Id']?>">
    
  <span class="input-group-text  spaan-content " id="addon-wrapping">Name</span>
  <input type="text" name="name" value="<?php echo $rows['Name']?>" class="form-control" placeholder="Item Name">
</div>



<div class="input-group diiv-content  flex-nowrap">
  <span class="input-group-text spaan-content" id="addon-wrapping">Image</span>
  <input type="file" name="image"  class="form-control" placeholder="Item Image">
  <input type="hidden" name="old_image" value="<?php echo $rows['Image'];?>">
  
</div>



<div class="input-group diiv-content  flex-nowrap">
  <span class="input-group-text spaan-content" id="addon-wrapping">Price</span>
  <input type="text" name="price" value="<?php echo $rows['Price']?>" class="form-control" placeholder="Item Price">
</div>

<div class="input-group diiv-content  flex-nowrap">
  <span class="input-group-text spaan-content" id="addon-wrapping">Description</span>
  <input type="text" name="description" value="<?php echo $rows['Description']?>" class="form-control" placeholder="Item Descrption">
</div>





<div class="input-group diiv-content  flex-nowrap">
<span class="input-group-text spaan-content" id="addon-wrapping">Customer</span>
  <select  name="customer" class="form-control">
 
        <option value="<?php echo $rows['customer_id']?>"><?php echo $rows['Customer_Name']?></option>
  
</select>
</div>



<div class="input-group diiv-content  flex-nowrap">
<span class="input-group-text spaan-content" id="addon-wrapping">category</span>
  <select  name="category" class="form-control">
    <?php
    $stmt=$con->prepare("SELECT *FROM category");
    $stmt->execute();
    $rows=$stmt->fetchAll();
    $count=$stmt->rowCount();
    if($count > 0)
    {
        foreach($rows as $row)
        {
            ?>
<option value="<?php echo  $row['category_id']?>"><?php echo $row['Name']?></option>
            <?php

        }
    }

    ?>
    
        
</select>
</div>

<div class="input-group diiv-content  flex-nowrap">
  <input type="submit" class=" form-control submit-input"value="Update Ads">
</div>

</form>
</div>
</div>


        <?php
        
      
    }
    }
}


//////////////////////////////////////////////////////end item edit section/////////////////////////////


//////////////////////////////////////////////////////start item update section/////////////////////////////

elseif(isset($_GET['update']))
{
    
    
        
        $id     = $_POST['id'];
        $name   = $_POST['name'];
        $price  = $_POST['price'];
        $desc   = $_POST['description'];
        $old_image=$_POST['old_image'];
        $customer =$_POST['customer'];
        $category =$_POST['category'];

        //echo $id.'<br>'.$name.'<br>'.$price."<br>".$desc."<br>".$old_image.'<br>'.$customer.'<br>',$category;
    
      

 $image_name=$_FILES['image']['name'];
$image_type=$_FILES['image']['type'];
$image_size=$_FILES['image']['size'];
$image_temp=$_FILES['image']['tmp_name'];

$image_array=array('jpg','png','gif','jpeg');
$x=explode('.',$image_name);
$image_ext=end($x);




$inputarray= array();
if(empty($name))
{
  $inputarray[]='SORRY:: Name can not be <strong>Empty</strong>';
}
if(empty($price))
{
  $inputarray[]='SORRY:: price can not be <strong>Empty</strong>';
}
if(empty($desc))
{
  $inputarray[]='SORRY:: Description can not be <strong>Empty</strong>';
}

if(strlen($name) < 3)
{
  $inputarray[]='SORRY:: Name can not be lease than <strong>3 Character</strong>';
}
if(strlen($price) <= 0)
{
  $inputarray[]='SORRY:: LastName can not be lease than <strong> 1 Character</srtong>';
}
if(strlen($desc) < 10)
{
  $inputarray[]="SORRY:: Description can not be lease than <strong>10 Character</strong>";
}
if(! empty($image_name) && ! in_array($image_ext,$image_array))
        {
            $inputarray[]= 'this extension is not  <strong>Allowed</strong>';
        }

if($image_size >4194304)
{
  $inputarray[]="SORRY:: Image Size Can Not BE More Than <strong>4094304</strong>";
}

foreach($inputarray as $input)
{
  echo "<div class='btn btn-dark input-array'>$input</div>";
}

if(empty($input))
{
 
    $ext=rand(0,1000000).'_'.$image_name;
    move_uploaded_file($image_temp,'../all_image/'.$ext);
   
    if(!empty($ext))
    {
      $imag= $ext;
      unlink("../all_image/".$old_image); 
    }else{
      $imag=$old_image;
    }
  //echo $imag;
  $stmt=$con->prepare("UPDATE items SET  Name=?, Image=?, Price=?, Description=? ,customer_id=?, Cat_id=? 
  WHERE Id=?");
  $stmt->execute(array($name,$imag,$price,$desc,$customer,$category,$id));
  $count=$stmt->rowCount();
 
if($count > 0)
{
  $msg="<div class='btn btn-dark input-array'>Success Item Update Successfully</div>";
 // redirect2($msg);



}else{
  echo '<div class="btn btn-dark input-array">SORRY:: Faild To Update Image</div>';
}


}else{
  echo '<div class="btn btn-dark input-array">SORRY:: you can not access this page directly</div>';
}

}
    

////////////////////////////////end edit Ads/////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////startdelete Ads///////////////////////////////////

if(isset($_GET['delete_id']))
{
$id=$_GET['delete_id'];

$image=$_GET['image'];

    
    $stmt=$con->prepare("DELETE FROM items WHERE Id=:zid");
    $stmt->bindparam(':zid',$id);
    $stmt->execute();
    $count=$stmt->rowCount();
    if($count)
    {

       unlink("../all_image\\".$image);
        echo 'Item Is Delete';
    }

}

/////////////////////////////////////////////////startdelete Ads///////////////////////////////////





























