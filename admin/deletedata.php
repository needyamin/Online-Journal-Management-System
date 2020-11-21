<?php 
$id = $_GET['id'];  
require"../function/database.php";

if(isset($_GET['id'])){    
$sql="DELETE from opaar_journal where id='$id';";
$stmt = $con->prepare($sql);   
$stmt->execute();   
 
// output data of each row
$journal = $stmt->fetch();{;?>  

<?php header("Location: all_post.php"); ?>

<?php }};?> 


