<?php

session_start();
include('init.php');


$stmt=$con->prepare("SELECT *FROM customers WHERE Customer_id=?");
$stmt->execute(array($_SESSION['username_id']));
$rows=$stmt->fetchAll();
$count=$stmt->rowCount();

if($count > 0)
{
    foreach($rows as $row)
    ?>
 <div class="container ">
    <h1 class="text-center my-profile-h1 text-success">My Profile</h1>
    <div class="my-profile-container text-center">
        <h3 class="my-profile-h3">My Informations</h3>
        <img class="profile-image" src="<?php echo "../all_image/". $row['Customer_Image']?>" alt="image not added">
        <h3>UserName : <span><?php echo $row['Customer_Name']?></span></h3>
        <h3>Email ID :<span><?php echo $row['Customer_Email']?></span></h3>
        <h3>Sign Up  : <span><?php echo $row['Date']?></span></h3>
        <a href="edit_profile.php?profile_id=<?php echo $row['Customer_id']?>" class="btn btn-primary">Edit Profile</a>
    </div>
 </div>


 <!---- //////////////////////////start dispaly ads///////////////////////////////////////////////--->

<?php

 $stmt=$con->prepare("SELECT  items.*,customers.Customer_id,customers.Customer_Name,category.Name as Category_Name
  FROM items
    
    INNER JOIN customers ON
    customers.Customer_id=items.customer_id

    INNER JOIN category ON
    category.category_id=items.Cat_id
    WHERE items.customer_id=? AND Ads=1
    ");
    $stmt->execute(array($_SESSION['username_id']));
    $ads = $stmt->fetchAll();
    $count2=$stmt->rowCount();
    

    ?>
  <div class="container card-main-class  my-profile-container">
    <h1 class="text-center manage-items">Manage Ads</h1>
  <div class="row my-3 card-center  ">
    <?php
if($count2 > 0)
{
foreach($ads as $ad)
{
    
    ?>
    

<div class="col-12 col-sm-6 col-md-3">
    <hr class="padding-botton">



  <div class="card card-100" style="width: 16rem;">
  <span class="card-price"><?php echo '$'. $ad['Price']?></span>
  
  <img src="<?php echo "../all_image/".$ad['Image']?>" class='card-img-top card-image'>

  <div class="card-body">
    <h5 class="card-title"><?php echo $ad['Name'] ?></h5>
    <p class="card-text card-200"><?php echo $ad['Description']?>.</p>
    <h5>Added By :<?php echo $ad['Customer_Name']?></h5>
    <span class="card-date">Date:<?php echo $ad['Date']?></span>
    <div class="card-link-3 text-center">
    <a href="edit_profile.php?edit_id=<?php echo $ad['Id'] ?>" class="btn btn-primary ">Edit</a>
    <a href="edit_profile.php?delete_id=<?php echo $ad['Id'] ?>&image=<?php echo $ad['Image']?>" class="btn btn-primary">Delete</a>  
  </div>
  

</div>
</div>
</div>
<?php 
 

                 
     
}


?>  

<a href="edit_profile.php?add_ads=<?php echo $row['Customer_id']?>" class="btn btn-primary ">Add ads</a>
<?php


}

else{
    ?>
    
    <h1 class="text-center">You Dont Have Any Ads</h1>
<a href="edit_profile.php?add_ads=<?php echo $row['Customer_id']?>" class="btn btn-primary add-ads">Add ads</a>
    <?php
}
?>

  
</div>
</div> 
<?php


?>












 <div class="container ">
    
    <div class="my-profile-container text-center">
        <h3 class="my-profile-h3">my interest</h3>
        show my interest
    </div>
 </div>

<?php
}