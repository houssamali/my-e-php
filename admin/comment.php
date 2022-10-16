<?php
session_start();
if(isset($_SESSION['user']))
{
include('init.php');

$do='';
if($_GET['do'])
{
    $do=$_GET['do'];
}else{
    $do='manage';
}

if($do=='manage'){

 ?>

<div class="container text-center user-table bg-dark">
    <div class="row">

<table class="table text-light">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Comment</th>
      <th scope="col">Date</th>
      <th scope="col">Action</th>
      </tr>
  </thead>

<?php

    $stmt=$con->prepare("SELECT *FROM Comments");
    $stmt->execute();
    $rows=$stmt->fetchAll();
    $count=$stmt->rowCount();
    if($count > 0)
    {
       foreach($rows as $row)
       {

        ?>

<th scope="row"><?php echo $row['Id']?></th>
      <td><?php echo $row['Comment']?></td>
      <td><?php echo $row['Date']?></td>
      <td>
      
      <a href="comment.php?do=delete&id=<?php echo $row['Id']?>" class="btn btn-primary">
      <i class="fa-solid fa-trash-can font-awesome"></i>Delete</a>
      
     </td>
    </tr>
  
  </tbody>
  <?php
}
}
?>

</table>
</div>
</div>

        <?php
       }

elseif($do=='delete')
{
    if(isset($_SERVER['HTTP_REFERER']))
    {
    $id=$_GET['id'];

    $stmt=$con->prepare("DELETE FROM Comments WHERE Id=:zid");
    $stmt->bindparam(':zid',$id);
    $stmt->execute();
    $count=$stmt->rowCount();
    if($count)
    {
        echo "<div class='btn btn-dark input-array'>Comment Had Been Deleted Successfully</div>";
    }else{
        echo "<div class='btn btn-dark input-array'>Faild To Deleted Comment</div>";
    }
}
else{
    echo "<div class='btn btn-dark input-array'>Sorry:: Can Not Browser This Page Directly</div>";  
}
}

    }







