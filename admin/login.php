
<?php 
session_start();
require"../function/database.php";

$message = ""; 
$error ="";

if(isset($_POST['submit'])){
   
$username = $_POST['username'];
$password = $_POST['password'];
    
$sql = "select * from opaar_users where username='$username' and password = '$password' ";    
$stmt = $con->prepare($sql);   
$stmt->execute();       
    
if(($username == '') or ($password == '')){
    $message = "Please fill up all field";
}    

    
$row = $stmt->fetch(); //for count
    
if($row > 0) {    
$_SESSION['username'] = $_POST['username'];
$_SESSION['id'] = $row['id']; 
    
header('location: dashboard.php?welcome=login');    
} 

 else{
 $error ="Incorrect info"; 
 }   
    
}
;?>   





<!DOCTYPE html>
<html lang="en">
<head>
    
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Opaar Control</title>

  

    <!--Start-->
    <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
     <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!--End Boostrap-->

  <link href="assets/css/login.css" rel="stylesheet">

 
    
 
</head>
    
    
<section class="login-block">
    <div class="container">
	<div class="row">
		<div class="col-md-4 login-sec">
		    <h2 class="text-center">Login Now</h2>

              
            
<form class="login-form" method="POST" action="login.php">
  <div class="form-group">
    <label for="exampleInputEmail1" class="text-uppercase">Username</label>
    <input type="text" name="username" class="form-control" placeholder="">
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1" class="text-uppercase">Password</label>
    <input type="password" name="password" class="form-control" placeholder="">
  </div>
  
  
    <div class="form-check">
    <label class="form-check-label">
      <input type="checkbox" name="checkbox" class="form-check-input">
      <small>Remember Me</small>
    </label>
    <button type="submit" name="submit" class="btn btn-login float-right">Submit</button>
  </div>

<?php echo $message; echo $error;?>
</form>
            
            
            
<div class="copy-text">Opaar Admin Panel</div>
		</div>
		<div class="col-md-8 banner-sec">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                 <ol class="carousel-indicators">
                    <li data-tarPOST="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-tarPOST="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-tarPOST="#carouselExampleIndicators" data-slide-to="2"></li>
                  </ol>
            <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <img class="d-block img-fluid" src="https://static.pexels.com/photos/33972/pexels-photo.jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <div class="banner-text">
            <h2>This is Heaven</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
        </div>	
  </div>
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="https://images.pexels.com/photos/7097/people-coffee-tea-meeting.jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <div class="banner-text">
            <h2>This is Heaven</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
        </div>	
    </div>
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="https://images.pexels.com/photos/872957/pexels-photo-872957.jpeg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <div class="banner-text">
            <h2>This is Heaven</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
        </div>	
    </div>
  </div>
            </div>	   
		    
		</div>
	</div>
</div>
</section>
    
        
            
    
    
    
    </section></html>

