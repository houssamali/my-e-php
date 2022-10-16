<body>
<nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid">
    
      <a class="navbar-brand text-light" href="#">SHRWA</a>
      <button class="navbar-toggler btn btn-light bg-primary w-25" type="button"
       data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
       aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon text-center">Menu</span>
      </button>
<?php
 if(isset($_SESSION['username']))
 {
include('connect.php');
$stmt4=$con->prepare("SELECT Customer_Image FROM customers WHERE Customer_Name=?");
$stmt4->execute(array($_SESSION['username']));
$row4=$stmt4->fetchAll();
$count4=$stmt4->rowCount();
if($count4 == 1)
{
  //echo '<h1 style="color:white;">Welcome</h1>';
  
foreach($row4 as $row3)
{
?>
<img class="customer_image_backend_display" src="../all_image/<?php echo $row3['Customer_Image']?>" > 

<?php
}
}}

?>

      <!--<img src="images/me-1.jpeg" width="50px" class="backend-image-profile" alt="not found">--->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
     
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
             <?php
             if(isset($_SESSION['username']))
             {
               echo "<span class='text-light'>". $_SESSION['username']."</span>";
             }else
             {
              echo '<sapn class="text-light">  Option</span';
             }
             ?>
            </a>
            
            <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
              <?php
               if(isset($_SESSION['username']))
               {
                ?>
                <?php
}
?>
              <li ><a class="dropdown-item text-success bg-dark" href="profile.php">My Profile</a></li>
              <li><a class="dropdown-item text-success bg-dark text-light" href="signup.php">Sign Up</a></li>
              <li><a class="dropdown-item text-success bg-dark text-light" href="login.php">Log In</a></li>
              <li><a class="dropdown-item text-success bg-dark text-light" href="logout.php">Log Out</a></li>
</ul>

</li>

            
            <?php
           
           include('connect.php');
           $stmt=$con->prepare("SELECT *FROM category");
           $stmt->execute();
           $rows=$stmt->fetchAll();
           
           foreach($rows as $row)
           {
           ?>


          


          <li class="nav-item list-backend">
            <a class="nav-link active text-light" aria-current="page" href="category.php?id=<?php echo $row['category_id']?>"><?php echo $row['Name']?></a>
          </li>
          
          <?php
           }
          ?>
      
          </ul>

       
<form  action="category.php" method="post" class="d-flex" role="search">
        
        <input class="form-control me-2"  type="text"  name="name"
        placeholder="Search" aria-label="Search">
        <input type="submit" name="search" value="search">
         
      

      </form>
       
      </div>
    </div>
  </nav>
