<?php 

// showing post //
function post (){

$fullname ="Y";
$email ="";
$pass="Yamin143";
$pass= md5($pass);
$roll = "0";
$status = "0";
    
$sql="insert into users (fullname, email, pass, roll, status) values('$fullname','$email','$pass','$roll','$status')";
$stmt = $con->prepare($sql);   
$stmt->execute();   
}
 


// login //
function login ($con){
include"../config.php";   
$pass = $_POST['pass'];
$pas = md5($pass);    
    
if(isset($_POST['submit'])){
$sql = "SELECT * FROM users where email ='$email' && pass='$pass' ";
$stmt = $con->prepare($sql);
$stmt->execute(); 
}
}



;?>