<?php 


//########## Start journal_title fetchAll ##########  //
function journal_title (){
require"database.php";
    
$sql="SELECT * from opaar_journal;";
    
$stmt = $con->prepare($sql);   
$stmt->execute();   
 
if ($stmt->rowCount() > 0) {
// output data of each row
while ($row = $stmt->fetch()) {
    echo"". $row["journal_title"]."</td><td>";
        }
    
} else {
  echo "0 results";
}
}
//########## End journal_title fetchAll ##########  //



//########## Start homepage_posts fetchAll ##########  //
function journal_title (){
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
//########## End homepage_id fetchAll ##########  //




;?>