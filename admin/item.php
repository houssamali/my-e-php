<?php
session_start();

if(isset($_SESSION['user']))
{
include ('init.php');


///////////////////////////////////////////////start search item section///////////////////////////

if(isset($_POST['search']))
{
   
    $search=$_POST['name'];
    



    $stmt=$con->prepare("SELECT items.*,customers.Customer_Name FROM items 
    INNER JOIN customers ON
    customers.Customer_id=items.customer_id
    WHERE Name=?");
    $stmt->execute(array($search));
    $items = $stmt->fetchAll();
    $count2=$stmt->rowCount();
    ?>
  <div class="container card-main-class">
    <h1 class="text-center manage-items">
    
    </h1>
  <div class="row my-3 card-center">
    <?php
if($count2 > 0)
{
  ?>
  <div class="container">
 <div class='btn btn-dark input-array search-bg-391'>Your Search Is 
    <?php echo '<div class="btn text-light text-center search-bg-390">'.$search.'</div>'; ?></div>
  </div>
  <?php
foreach($items as $item)
{
    ?>
<div class="col-12 col-sm-6 col-md-3">
    <hr class="padding-botton">
  <div class="card card-100" style="width: 16rem;">
  <span class="card-price"><?php echo '$'. $item['Price']?></span>
  
  <img src="<?php echo "images/".$item['Image']?>" class='card-img-top card-image'> 
 
  <div class="card-body">
    <h5 class="card-title"><?php echo $item['Name'] ?></h5>
    <p class="card-text card-200"><?php echo $item['Description']?>.</p>
    <h5>Added By :<a href="user.php?name=<?php echo $item['Customer_Name']?>"><?php echo $item['Customer_Name']?></ad></h5>
    <span class="card-date">Date:<?php echo $item['Date']?></span>
    <div class="card-link-3">
    <a href="item.php?do=edit&id=<?php echo $item['Id'] ?>?&image=<?php echo $item['Image']?>" class="btn btn-primary">Edit</a>
    <a href="item.php?do=delete&id=<?php echo $item['Id'] ?>?&image=<?php echo $item['Image']?>" class="btn btn-primary">Delete</a>
    <a href="item.php?do=confirm&id=<?php echo $item['Id'] ?>" class="btn btn-primary">confirm</a>
  </div>
  

</div>
</div>
</div>
<?php      
}
}
else{
    echo"<div class='btn btn-dark input-array'>Sorry:: Item In your Searching Not Found</div>";
    
  
}



}


///////////////////////////////////////////////end search item section///////////////////////////

$do='';
if(isset($_GET['do']))
{
$do=$_GET['do'];
}else{
$do='manage';
}



/////////////////////////////////////////////start item display section ////////////////////////////

if($do=='manage')
{
    

    $stmt=$con->prepare("SELECT  items.*,customers.Customer_Name,category.Name as Category_Name FROM items
    
    INNER JOIN customers ON
    customers.Customer_id=items.customer_id

    INNER JOIN category ON
    category.category_id=items.Cat_id
    
    ");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    $count=$stmt->rowCount();
    

    ?>
  <div class="container card-main-class">
    <h1 class="text-center manage-items">Manage Item</h1>
  <div class="row my-3 card-center">
    <?php
if($count > 0)
{
foreach($rows as $row)
{
   

    ?>
    
<div class="col-12 col-sm-6 col-md-3">
    <hr class="padding-botton">


  <div class="card card-100" style="width: 16rem;">
  <span class="card-price"><?php echo '$'. $row['Price']?></span>
  
  <img src="<?php echo "../all_image/".$row['Image']?>" class='card-img-top card-image'>

  <div class="card-body">
    <h5 class="card-title"><?php echo $row['Name'] ?></h5>
    <p class="card-text card-200"><?php echo $row['Description']?>.</p>
    <h5>Added By :<a href="user.php?name=<?php echo $row['Customer_Name']?>"><?php echo $row['Customer_Name']?></ad></h5>
    <span class="card-date">Date:<?php echo $row['Date']?></span>
    <div class="card-link-3">
    <a href="item.php?do=edit&id=<?php echo $row['Id'] ?>?&image=<?php echo $row['Image']?>" class="btn btn-primary">Edit</a>
    <a href="item.php?do=delete&id=<?php echo $row['Id'] ?>?&image=<?php echo $row['Image']?>" class="btn btn-primary">Delete</a>
  
  <?php
    if($row['Ads']==0)
    {
      ?>
      <a href="item.php?do=confirm&id=<?php echo $row['Id'] ?>" class="btn btn-primary">confirm</a> 
    <?php
    }
    ?>
    
  </div>
  

</div>
</div>
</div>

<?php      
}
}
?>
<a href="item.php?do=add" class="btn btn-primary">Add Item</a>

  </div>
  
</div>  

  <?php
    
}

/////////////////////////////////////////////end  item display section start////////////////////////////




//////////////////////////////////////////////////////start item add section/////////////////////////////

if($do=='add')
{
  ?>

<div class="container add-user-form">
    <div class="row ">
<form class="form-size-input" action="item.php?do=insert" method="post" enctype="multipart/form-data">

<div class="input-group  diiv-content  flex-nowrap">
  <span class="input-group-text  spaan-content " id="addon-wrapping">Name</span>
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
<span class="input-group-text spaan-content" id="addon-wrapping">Customer</span>
  <select  name="customer" class="form-control">
  <option value="">.....</option>
    <?php
    $stmt1=$con->prepare("SELECT *FROM customers");
    $stmt1->execute();
    $customers=$stmt1->fetchAll();
    $count1 =$stmt1->rowCount();
    if($count1 > 0)
    {
      foreach($customers as $customer)
      {
        ?>
        <option value="<?php echo $customer['Customer_id']?>"><?php echo $customer['Customer_Name']?></option>
        <?php
      }
    }
    ?>
    
</select>
</div>



<div class="input-group diiv-content  flex-nowrap">
<span class="input-group-text spaan-content" id="addon-wrapping">category</span>
  <select  name="category" class="form-control">
    <option value="">.....</option>
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
  <input type="submit" class=" form-control submit-input"value="Add Item">
</div>

</form>
</div>
</div>
<?php
}
 //////////////////////////////////////////////////////end item add section/////////////////////////////

 //////////////////////////////////////////////////////start item insert section/////////////////////////////
 elseif($do=="insert")
{
  if($_SERVER['REQUEST_METHOD']=="POST")
  {
$name            = $_POST['name'];
$price           = $_POST['price'];
$description     = $_POST['description'];
$customer        = $_POST['customer'];
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
if(strlen($description) < 10)
{
  $inputarray[]="SORRY:: Password can not be lease than <strong>10 Character</strong>";
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

//}else{
$stmt2=$con->prepare("INSERT INTO items (Name,Image,Price,Description,Date,customer_id,Cat_id)
VALUES(:zname,:zimage,:zprice,:zdesc,now(),:zcustomer,:zcat)");
$stmt2->execute(array(
'zname' => $name,
'zimage' => $ext,
'zprice' => $price,
'zdesc'  => $description,
'zcustomer' => $customer,
'zcat' => $category

));

  $msg="<div class='btn btn-dark input-array'>Success Item Added Successfully</div>";
  redirect2($msg);

//}

}

}else{
  echo '<div class="btn btn-dark input-array">SORRY:: you can not access this page directly</div>';
}


}

//////////////////////////////////////////////////////end item insert section/////////////////////////////


//////////////////////////////////////////////////////start item edit section/////////////////////////////
 
elseif($do=='edit')
{
    if(isset($_SERVER['HTTP_REFERER']))
    {
    $id=$_GET['id'];
    //$image=$_GET['image'];
    
    $stmt=$con->prepare("SELECT items.*,customers.Customer_Name,category.Name as Category_name 
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
<form class="form-size-input" action="item.php?do=update" method="post" enctype="multipart/form-data">

<div class="input-group  diiv-content  flex-nowrap">
    <input type="hidden" name="id" value="<?php echo $rows['Id']?>">
    
  <span class="input-group-text  spaan-content " id="addon-wrapping">Name</span>
  <input type="text" name="name" value="<?php echo $rows['Name']?>" class="form-control" placeholder="Item Name">
</div>



<div class="input-group diiv-content  flex-nowrap">
  <span class="input-group-text spaan-content" id="addon-wrapping">Image</span>
  <input type="file" name="image"  class="form-control" placeholder="Item Image">
  <input type="hidden" name="old_image" value="<?php echo $rows['Image'];?>">
  <img src="images/<?php echo $rows['Image'];?>" class="image-hidden1" width="100px" height="50px">
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
    
        <option value="<?php echo $rows['Cat_id']?>"><?php echo $rows['Category_name']?></option>
</select>
</div>

<div class="input-group diiv-content  flex-nowrap">
  <input type="submit" class=" form-control submit-input"value="Update Item">
</div>

</form>
</div>
</div>


        <?php
        
    }}
}else{
    $msg= '<div class="btn btn-dark input-array">SORRY:: you can not access this page directly</div>';
        redirect2($msg);
}
}

//////////////////////////////////////////////////////end item edit section/////////////////////////////


//////////////////////////////////////////////////////start item update section/////////////////////////////

elseif($do=='update')
{
    
    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        
        $id     = $_POST['id'];
        $name   = $_POST['name'];
        $price  = $_POST['price'];
        $desc   = $_POST['description'];
        $old_image=$_POST['old_image'];

        $customer =$_POST['customer'];
        $category =$_POST['category'];
       

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
    move_uploaded_file($image_temp,'images/'.$ext);
   
    if(!empty($ext))
    {
      $imag= $ext;
      unlink("../all_image/".$old_image); 
    }else{
      $imag=$old_image;
    }
  //echo $imag;
  $stmt=$con->prepare("UPDATE items SET  Name=?, Image=?, Price=?, Description=? ,customer_id=?, Cat_id=? WHERE Id=?");
  $stmt->execute(array($name,$imag,$price,$desc,$customer,$category,$id));
  $count=$stmt->rowCount();
 
if($count > 0)
{
  $msg="<div class='btn btn-dark input-array'>Success Item Update Successfully</div>";
  redirect2($msg);



}else{
  echo '<div class="btn btn-dark input-array">SORRY:: Faild To Update Image</div>';
}


}else{
  echo '<div class="btn btn-dark input-array">SORRY:: you can not access this page directly</div>';
}
    }


}

//////////////////////////////////////////////////////end item update section/////////////////////////////
        
        
    



//////////////////////////////////////////////////////start item delete section/////////////////////////////

elseif($do=='delete')
{
  $id=$_GET['id'];
  
  $image=$_GET['image'];

    if(isset($_SERVER['HTTP_REFERER']))
    {
    $id=$_GET['id'];
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
}else{
    $msg= '<div class="btn btn-dark input-array">SORRY:: you can not access this page directly</div>';
    redirect2($msg);
}
}







elseif($do=='confirm')
{
  $id=$_GET['id'];
  echo $id;
  //$image=$_GET['image'];
 
  
  
  
  $stmt=$con->prepare("UPDATE  items SET Ads=1 WHERE Id=:zid");
  $stmt->bindparam(':zid',$id);
  $stmt->execute();
  $count=$stmt->rowCount();
  if($count > 0)
  {
    echo "<div class='btn btn-dark input-array'>Item Has Been Confirm Successfully</div>";
}else{
  echo "<div class='btn btn-dark input-array'>Item Has Been Failed To Confirm</div>";
}
}



}else{
  header('location:login.php');
exit();
}


