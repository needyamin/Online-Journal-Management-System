
<?php
//print_r($_POST);    
require"../function/database.php";
include"engine/function.php";?>

<?php require"site/header.php";?>


<?php if(isset($_GET['welcome'])){;?>

<div class="alert alert-success" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Success!</strong> You have been signed in successfully!
</div>


<script>window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 2000);</script>
    
<?php };?>



<br>
    
<?php 
           
$sql="SELECT * FROM `opaar_users` INNER JOIN opaar_journal on opaar_users.id=opaar_journal.user_id ";
$stmt = $con->prepare($sql);   
$stmt->execute();   
 
if ($stmt->rowCount() > 0) {
// output data of each row
$journal = $stmt->fetch(); {;?>    

    
<div class="container">

<div class="card">
  <div class="card-header">
 Hi! <?php echo strtoupper($_SESSION['username']);?>
  </div>
  <div class="card-body">
    <h5 class="card-title">Welcome to Opaar.Com</h5>
    <p class="card-text">We see your are logged in with "<?php echo''. $journal["user_ip"].'';?>
" IP address. <br>We have save it for future security propose.<br> <br>Do you want to create you first post on opaar?</p> 
    
    
    <a href="blog.php" class="btn btn-primary">Create your first blog</a>
  </div>
</div>
</div>


<?php }};?>

<?php require"site/footer.php";?>



