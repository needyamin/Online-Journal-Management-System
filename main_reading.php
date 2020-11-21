<?php 
require"function/database.php"; 
require"function/siteconfig.php";
require"index/header.php";?> 
    
    
    
<body style="background: #ddd; font-size: 15px;">
<div class="container">
    
<div class="card" style="padding: 15px;">
<div class="row">
    
<!-- 1st layout start-->        
<div class="col-lg-8">
   
<?php //start
@$blog_page = $_GET['blog'];     
$sql="SELECT * FROM opaar_blog WHERE blog_slug='$blog_page'";
$stmt = $con->prepare($sql);   
$stmt->execute();   
 
if ($stmt->rowCount() > 0) {
// output data of each row
while ($blog_page = $stmt->fetch()) { $blog_page_id_get = $blog_page["id"]; $user_id = ''. $blog_page["user_id"].'' ?>    

<?php  $tags_array[$blog_page_id_get] = $blog_page;?>    
    

<div class="card mb-3" style="text-align:justify">
    
    
<div class="card-header bg-transparent">
  <a href=""> Home</a> / Post / <a href="main_reading.php?blog=<?php echo''. $blog_page["blog_slug"].'';?>"><?php echo wordwrap(strip_tags($blog_page["blog_title"],'<p><a><br>'),300,'<br>', false);?> </a></div>
  
   
    
    
<div class="card-body">
      
<h5 class="card-title">
<?php echo wordwrap(strip_tags($blog_page["blog_title"],'<p><a><br>'),300,'<br>', false);?> 
      </h5>
      
      
<?php 
$sql1="SELECT * FROM opaar_users WHERE id='$user_id'";
$stmt = $con->prepare($sql1);   
$stmt->execute(); 
$row = $stmt->fetch();?> 
    
    <div class="mb-1 text-muted">
     <div class="float-left">
       <?php if(!empty($row['firstname'])) {echo 'Author:'.$row['firstname']; $row['lastname'];} 
        else{ echo'Anonymous';}?>
        
        </div>
     <div class="float-right"> <?php echo $blog_page["blog_date"];?> </div>
           </div> <br>  
    

<div class="card" style="background:#b7b7b7;">    
<?php                                
if($cdn == '1'){;?><img src="https://cdnashbd.s3-ap-southeast-1.amazonaws.com/opaar/<?php echo''. $blog_page["blog_cover"].'';?>" width="240" height="300" role="img" onerror="this.onerror=null; this.src='admin/assets/img/cover_180.png'" class="rounded mx-auto d-block"> <?php } else {;?>   
    <img src="uploads/<?php echo''. $blog_page["blog_cover"].'';?>" width="240" height="300" role="img" onerror="this.onerror=null; this.src='admin/assets/img/cover_180.png'" class="rounded mx-auto d-block">  </div>  <br>
<?php };?> 
      
    

      <p class="card-text">
      <?php echo wordwrap(strip_tags($blog_page["blog_description"],'<p><a><br><img>'),400,'<br>', false);?>
      </p>
        
      
  </div>
  
       
       
<div class="card-footer bg-transparent"><b>Tags: </b>
    
<?php     
//slug start    
foreach ($tags_array as $tags_blog_id => $meet_slug) 
{ 
$sqlslug="SELECT * FROM `opaar_blog_tags` WHERE blog_id = '$tags_blog_id';";
$stmt = $con->prepare($sqlslug);   
$stmt->execute(); 
$meet_array = array();
while ($what = $stmt->fetch()) {
$mkdid = $what['tags'];    
echo "<a href='category.php?category=$mkdid'>".$what['tags'].", ","</a>"; 
} 

    
}   
;?>    
       
</div>
       
</div> 

<?php }} else {echo "<div class='col-card' style='padding:10%;'>No post found..</div>";};?>
  
    
    
    
  <div class="form-group">
  <label for="comment">Comment:</label>
  <textarea class="form-control" rows="5" id="comment"></textarea>
</div>    
    
    
    
    
        
  
    </div>
<!-- 1st layout end-->        

    
    
<!--sidebar-->    
<?php include"index/sidebar.php";?>
<!-- sidebar-->      

    
    


</div></div>
    
    
<div id="istyle" style="margin-bottom: 3px;"> </div>    
    
    
</div> 
    
    
 <?php require"index/footer.php";?>

        
    
</body>
