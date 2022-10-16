
<?php include ('connect.php')   ?>

<?php include ('function.php')   ?>

<?php include ('header.php')   ?>


<?php

if(isset($usernavbar) )
{
  
include ('user-navbar.php') ;

}
if(!isset($navbar) )
{
  
include ('navbar.php') ;

}?>

 
  <?php include ('footer.php')   

  //////////////////////////////*  end of admin section *///////////////////////////////////////////////////////////

  ?>