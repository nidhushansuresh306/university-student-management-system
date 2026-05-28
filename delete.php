<?php 
session_start();
?>


<?php 
include('conn.php');
$id = $_GET['id'];


$sel = mysqli_query($conn,"SELECT * FROM employees WHERE id = '$id' ");

 $del = mysqli_query($conn, "DELETE FROM employees WHERE id = '$id'");
     if($del)
     {
        echo ("<script> alert('deleted');window.location.replace('table1.php');</script>");
     }
     else
     {
        echo ("<script> alert('not deleted');</script>");
     }

  ?>

