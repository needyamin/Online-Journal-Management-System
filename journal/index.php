<?php 
require"../function/database.php"; 
include"index/header.php";
?>
    

<body>
<div class="container">
        
     
<!--start main body post code-->        
<div class="col-main">
<?php 
   
$sqlcount="SELECT COUNT(id) from opaar_journal;";
$stmt = $con->prepare($sqlcount);   
$stmt->execute();   
$journal = $stmt->fetch(); 
$limit_page= $journal[0];
$numpage='5';    
$count_page = ceil($limit_page/$numpage);
    
    
@$page = $_GET['page'];  
if (!$page) $page = 0;    
$start = $page * $numpage;?>    
    
    
<?php 
$sql="SELECT * from opaar_journal limit $start,$numpage;";
$stmt = $con->prepare($sql);   
$stmt->execute();   
 
if ($stmt->rowCount() > 0) {
// output data of each row
while ($journal = $stmt->fetch()) {;?>
    
    
  
<div class="col-card">
       <div id="post"> 
            <img src="../assets/img/cover.jpg" id="img_cover"> <div id="break"> </div>    

<div id="post_title"> 
<a href="journal_page.php?journal=<?php echo''. $journal["journal_slug"].'';?>">
<?php echo''. $journal["journal_title"].'';?></a></div>
           
<p><?php echo''. substr($journal["journal_description"],0,25).'..';?></p> 

<table><tr><td>
<div id="issue">view journal</div> </td> <td>    
<div id="issue">current issue</div></td></tr></table>
           
           
<div id="rating">          
<span class="heading">User Rating</span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star"></span> </div> 
           
            </div></div>
      <?php }} else {
  echo "<div class='col-card' style='padding:10%;'>0 results</div>";
};?>
  <div style="clear:both"></div> 
            
</div>
        
        
<!--stop main body post code-->       
        
        
        <div class="col-sidebar">
            
            
            <h3>Sidebar </h3><hr style="border: 5px solid green;">
            
      <table border="1px" align="center" width="50%"> <th> Login Forum</th> 
          <tr><td width="100%" ><input type="email" name="email" placeholder="enter email" ></td></tr>
          <tr><td width="100%"><input type="password" name="password" placeholder="enter password"></td></tr>
          
           <tr><td align="center"><input type="submit" value="Login"></td></tr>
            </table>
    
    </div>
        
    
    
    
        </div>
<div class="container">
<div class="pagination">
    


    
<a href="?page=<?php echo $page-1;?>">&laquo;</a>    
   
 <?php for($i=1;$i<=$count_page;$i++){;?>
  <a href="?page=<?php echo $i;?> "><?php echo $i;?> </a>
  <?php } ;?>       
    
<a href="?page=<?php echo $page+1;?>">&raquo;</a> <br>
  <?php echo "start page from ".$start.'<br>';?>    

    
</div> </div>


    
    </body>
    
    
 <div style="clear:both"></div> 
    
    
<div id="istyle" style="margin-top: 3px;"> </div>
<div class="footer"> 
    
    <div id="footer_left"> ISSN xxxx-xxxx (Online), ISSN xxxx-xxxx (Print) </div> 
    <div id="footer_right">     <img src="../assets/img/logo.png" style="width: 100px;"> 
</div> 
    
    </div>  
    
<div id="footer_end">© 2020 Yamin Hossain Shohan |  All rights reserved.</div>

</html>

