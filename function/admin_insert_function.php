<?php 

//########## User registration ##########  //
function users_signup (){
require"database.php";    
$username= $_POST['username'];
$password= $_POST['password'];
$firstnamee= $_POST['firstname'];
$lastname= $_POST['lastname'];
$email= $_POST['email'];
$mobile= $_POST['mobile'];
$homemobile= $_POST['homemobile'];
$address= $_POST['address'];
$status= $_POST['status'];
$role= $_POST['role'];
$time= $_POST['time'];
    
$sql="INSERT INTO opaar_users (id, username, password, firstname, lastname, email, mobile, homemobile, address, status, role, time) VALUES (NULL, '$username', '$password', '$firstnamee', '$lastname', '$email', '$mobile', '$homemobile', '$address', '$status', '$role', '$time')";
    
$stmt = $con->prepare($sql);   
$stmt->execute();   
}
 
;?>