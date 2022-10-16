<?php
session_start();
include ('init.php');

//////////////////////////////////////////start search item////////////////////////////////////////
if(isset($_POST['search']))
{
  $search=$_POST['name'];




  $stmt=$con->prepare("SELECT  items.*,customers.Customer_Name FROM items
  INNER JOIN customers ON
customers.Customer_id=items.customer_id



   WHERE Name=?");
  $stmt->execute(array($search));
  $rows = $stmt->fetchAll();
  $count=$stmt->rowCount();
  if($count > 0)
  {
  ?>
  <div class="container">
 <div class='btn btn-dark input-array search-bg-391'>Your Search Is 
    <?php echo '<div class="btn text-light text-center search-bg-390">'.$search.'</div>'; ?></div>
  </div>
  
          <div class="container card-main-class">
          <h1 class="text-center manage-items">Manage Category</h1>
        <div class="row my-3 card-center">
          <?php
     
      
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
          <h5>Added By :<a href="#?name=<?php echo $row['Customer_Name']?>"><?php echo $row['Customer_Name']?></ad></h5>
          <span class="card-date">Date:<?php echo $row['Date']?></span>
          <div class="text-center  card-link-3">
          <a  href="item.php?do=edit&id=<?php echo $row['Id'] ?>?&image=<?php echo $row['Image']?>" 
          class="btn btn-primary ">
          <i class="fa-solid fa-cart-shopping font-awesome"></i> Buy Now</a>
          
        </div>
        
      
      </div>
      </div>
      </div>
      <?php      
      }
      }else{
        echo"<div class='container'><div class='btn btn-dark input-array'>
        Sorry:: Customer In your Searching Is Not Found</div></div>";
      }
      ?>
      
        </div>
        
      </div>  
<?php

}

//////////////////////////////////////////end search item////////////////////////////////////////


if(isset($_GET['id']))
{
$id=$_GET['id'];

$stmt=$con->prepare("SELECT  items.*,customers.Customer_Name,category.Name as Category_Name FROM items
    
INNER JOIN customers ON
customers.Customer_id=items.customer_id

INNER JOIN category ON
category.category_id=items.Cat_id
WHERE Cat_id=? AND Ads=1
");
$stmt->execute(array($id));
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
        <h5>Added By :<a href="#?name=<?php echo $row['Customer_Name']?>"><?php echo $row['Customer_Name']?></ad></h5>
        <span class="card-date">Date:<?php echo $row['Date']?></span>
        <div class="text-center  card-link-3">
        <a  href="item.php?do=edit&id=<?php echo $row['Id'] ?>?&image=<?php echo $row['Image']?>" 
        class="btn btn-primary ">
        <i class="fa-solid fa-cart-shopping font-awesome"></i> Buy Now</a>
        
      </div>
      
    
    </div>
    </div>
    </div>
    <?php      
    }
    }else{
        echo 'not found';
    }
    ?>
    
      </div>
      
    </div>  
    
      <?php
        
    
    
}
























  
