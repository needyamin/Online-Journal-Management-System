<?php 
require"function/database.php";
require"function/siteconfig.php";
require"index/header.php";?> 

<body>
        
<div class="container">
        
     
<!--start main body post code-->        
<div class="col-main">
<?php   
$sqlcount="SELECT COUNT(id) from opaar_blog;";
$stmt = $con->prepare($sqlcount);   
$stmt->execute();   
$journal = $stmt->fetch(); 
$limit_page= $journal[0];
$numpage='5';    
$count_page = ceil($limit_page/$numpage);
    
    
@$page = $_GET['page'];  
if (!$page) $page = 1;    
$start = ($page-1) * $numpage;?>    
    
    
<?php 
$sql="SELECT * from opaar_blog ORDER BY blog_title asc limit $start,$numpage;";
$stmt = $con->prepare($sql);   
$stmt->execute();   
 
if ($stmt->rowCount() > 0) {
// output data of each row
while ($blog = $stmt->fetch()) {;?>
    
    
  
<div class="col-card">
<div id="post">
    
<?php                                
if($cdn == '1'){;?><img src="https://cdnashbd.s3-ap-southeast-1.amazonaws.com/opaar/<?php echo''. $blog["blog_cover"].'';?>" id="img_cover" onerror="this.onerror=null; this.src='admin/assets/img/cover_180.png'"> <div id="break"> </div> <?php } else {;?>   
<img src="uploads/<?php echo''. $blog["blog_cover"].'';?>" id="img_cover" onerror="this.onerror=null; this.src='admin/assets/img/cover_180.png'"> <div id="break"> </div>    
<?php };?>
    
    
    
    
<div id="post_title"> 
<a href="blog_page.php?blog=<?php echo''. $blog["blog_slug"].'';?>">
<?php echo wordwrap(strip_tags(substr($blog["blog_title"],0,100)),50,"<br>", true);?>    
</a></div>
    
<table id="issue" style="margin-top:5px;"><tr> <td>
Posted by: <?php echo''. $blog["user_id"].'';?> | Date: <?php echo''. $blog["blog_date"].'';?>   </td></tr></table>    
    
           
<p><?php echo wordwrap(strip_tags(substr($blog["blog_description"],0,80),'<p>'),50,'<br>', false).'..';?> </p>    

<table>
<tr><td>   
    
<div id="issue"><a href="blog_page.php?blog=<?php echo''. $blog["blog_slug"].'';?>">Read More</a></div></td></tr>
</table>
           
     </div>
       </div>
    
<?php }} else {echo "<div class='col-card' style='padding:10%;'>0 results</div>";};?>

<div style="clear:both"></div> 
            
</div>
        
<!--stop main body post code-->       
    
    
<?php include"index/sidebar.php";?>
        
    
    
    
</div>
<div class="container">
<div class="pagination">
   
<?php if ($start > 0){;?>    
<a href="?page=<?php echo $page-1;?>">&laquo;</a>    
<?php };?>   
    
<?php for($i=1;$i<=$count_page;$i++){
if($i == $page){
 $active = "active";
}
else {
 $active ="";
}
;?>
    
<a href="?page=<?php echo $i;?>" class="<?php echo $active;?>"><?php echo $i;?> </a>
  <?php } ;?>       

<?php if ($page < $count_page - 1){;?>    
<a href="?page=<?php echo $page+1;?>">&raquo;</a> <br>
<?php } ;?>    
</div> </div>


    
    </body>
    
    
<?php require"index/footer.php";?>      
