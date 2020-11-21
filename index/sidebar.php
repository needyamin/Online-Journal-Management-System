<?php require"function/siteconfig.php" ;?>        
        


<!-- 2nd layout sidebar start-->    
<div class="col-lg-4">
        
    
 <div class="card">
 <div class="card-header">
  Most Viewed Post
   </div>
     
     <?php 
     $sql_blog = "SELECT * from opaar_blog INNER JOIN opaar_users ON opaar_users.id = opaar_blog.user_id ORDER BY opaar_blog.blog_title DESC limit 0,4;";
     $stmt = $con->prepare($sql_blog);   
     $stmt->execute();   
     if ($stmt->rowCount() > 0) {
     while ($blog = $stmt->fetch()) {;?>
     
<ul class="list-group list-group-flush" style="text-align:justify">

    

  
<li class="list-group-item">
    
<h5><p>  
        
<?php                                
if($cdn == '1'){;?><img src="https://cdnashbd.s3-ap-southeast-1.amazonaws.com/opaar/<?php echo''. $blog["blog_cover"].'';?>" width="240" height="300" role="img" onerror="this.onerror=null; this.src='admin/assets/img/cover_180.png'" class="rounded mx-auto d-block"> <?php } else {;?>   
<img src="uploads/<?php echo''. $blog["blog_cover"].'';?>" width="240" height="300" role="img" onerror="this.onerror=null; this.src='admin/assets/img/cover_180.png'" class="rounded mx-auto d-block">   
<?php };?>
        
    
<a href="main_reading.php?blog=<?php echo''. $blog["blog_slug"].'';?>"><?php echo wordwrap(strip_tags($blog['blog_title']),220,"<br>", false);?> </a></p> </h5>
    
    
 <div class="mb-1 text-muted">
     <div class="float-left">Author: <?php echo $blog['username'];?></div>
     <div class="float-right"> <?php echo''. $blog["blog_date"].'';?> </div>
           </div> <br> 
    
    
<p class="card-text mb-auto">
<?php echo''. wordwrap(strip_tags(substr($blog["blog_description"],0,100),''),400,'<p>', false).'..';?> 
    </p>
       </li>

          </ul>
             <?php }};?>
     
     
</div>
        
</div>
<!-- 2nd layout sidebar end-->      
