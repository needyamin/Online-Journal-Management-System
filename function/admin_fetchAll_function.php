<?php 

//########## Start Users fetchAll ##########  //
function users (){
require"database.php";

$sql="SELECT * from opaar_users;";
    
$stmt = $con->prepare($sql);   
$stmt->execute();   
 
if ($stmt->rowCount() > 0) {
// output data of each row
while ($row = $stmt->fetch()) {
    echo"<tr><td>"
        . $row["id"]. "</td><td>"
        . $row["username"]. "</td><td>"
        . $row["mobile"]."</td><td>"
        . $row["email"]."</td><td>"
        . $row["address"]."</td> <td>"
        . $row["status"]."</td></tr>";
        }
    
} else {
  echo "0 results";
}
}

//########## End Users fetchAll ##########  //



//########## Start all_posts admin fetchAll ##########  //
function posts_all (){
require"database.php";

$sql="SELECT * from opaar_journal;";
    
$stmt = $con->prepare($sql);   
$stmt->execute();   
 
if ($stmt->rowCount() > 0) {
// output data of each row
while ($row = $stmt->fetch()) {
    echo"<tr><td>"
        . $row["id"]. "</td><td>"
        . $row["user_id"]. "</td><td>"
        . $row["journal_title"]."</td><td>"
        . $row["journal_slug"]."</td><td>"
        . $row["journal_author"]."</td> <td>"
        . $row["journal_description"]."</td></tr>";
        }
    
} else {
  echo "0 results";
}
}
//########## End all_posts admin fetchAll ##########  //


;?>