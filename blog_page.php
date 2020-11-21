<?php 
require"function/database.php"; 
require"function/siteconfig.php";
require"index/header.php";?> 


<body>
<div class="container">
        
<!--start main body post code-->        
<div class="col-main">

    
    
<?php 
$blog_page = $_GET['blog'];     
$sql="SELECT * FROM opaar_blog WHERE blog_slug='$blog_page'";
$stmt = $con->prepare($sql);   
$stmt->execute();   
 
if ($stmt->rowCount() > 0) {
// output data of each row
while ($blog_page = $stmt->fetch()) { $blog_page_id_get = $blog_page["id"]; $user_id = ''. $blog_page["user_id"].'' ?>    

<?php  $tags_array[$blog_page_id_get] = $blog_page;;?>    
    
<div class="col-card">
<div id="post"> 

<?php                                
if($cdn == '1'){;?><img src="https://cdnashbd.s3-ap-southeast-1.amazonaws.com/opaar/<?php echo''. $blog_page["blog_cover"].'';?>" id="img_cover" onerror="this.onerror=null; this.src='admin/assets/img/cover_180.png'"> <div id="break"> </div> <?php } else {;?>   
<img src="uploads/<?php echo''. $blog_page["blog_cover"].'';?>" id="img_cover" onerror="this.onerror=null; this.src='admin/assets/img/cover_180.png'"> <div id="break"> </div>    
<?php };?>  
    
<H3> <?php echo wordwrap(strip_tags($blog_page["blog_title"],'<p><a><br>'),40,'<br>', true);?></H3>
    
<?php 
$sql1="SELECT * FROM opaar_users WHERE id='$user_id'";
$stmt = $con->prepare($sql1);   
$stmt->execute(); 
$row = $stmt->fetch();
echo 'Posted by: <b> '.$row['1'].'</b>';?>
                                

<p> <?php echo wordwrap(strip_tags($blog_page["blog_description"],'<p><a><br><img>'),78,'<br>', true);?></p> 
 
    
    
 
    
     
<div style="clear:both"></div> 

<b>Tags:</b> 
    
    
<?php     
//for opaar_title loop end    

//slug start    
foreach ($tags_array as $tags_blog_id => $meet_slug) 
{ 
$sqlslug="SELECT * FROM `opaar_blog_tags` WHERE blog_id = '$tags_blog_id';";
$stmt = $con->prepare($sqlslug);   
$stmt->execute(); 
$meet_array = array();
while ($what = $stmt->fetch()) {

echo ''.wordwrap($what['tags'].',',17,'<br>', true);  
}  
}
    
//slug end   
;?>    
    
    
    
    
    
    
    
    
    
    
    
<!--tags arrey end-->    

    
     
<?php }} else {echo "<div class='col-card' style='padding:10%;'>No Journals Found..</div>";};?>
    
     
<div style="clear:both"></div> 
    
    
    
          
</div></div>           

<div style="clear:both"></div> 
    
    
    
    
<div class="col-card">   
<h3> <div class="sep">Blog Comments</div></h3> 


     

          
   
    
     
</div>
            
    
    
    
</div>
        
    
    
        
<!--stop main body post code-->       
<?php include"index/sidebar.php";?>
        

    
        </div>
    
      

    </body>
   
<?php require"index/footer.php";?>
