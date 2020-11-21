<?php 
require"../function/database.php";
require"../function/siteconfig.php";
require"index/header.php";?> 

    
<body style="background: #ddd; font-size: 15px;">
<div class="container">
    
    
<div class="card" style="padding: 15px;">
<div class="row">
    
<!-- 1st layout start-->        
<div class="col-lg-8">
   

<?php //post start fetch   
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
$sql="SELECT * from opaar_blog INNER JOIN opaar_users ON opaar_users.id = opaar_blog.user_id ORDER BY opaar_blog.blog_title asc limit $start,$numpage;";
$stmt = $con->prepare($sql);   
$stmt->execute();   
 
if ($stmt->rowCount() > 0) {
// output data of each row
while ($blog = $stmt->fetch()) { ;?>
    
    
    
    
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static" style="text-align:justify">
          <strong class="d-inline-block mb-2 text-success">
              POSTED BY @<?php echo strtoupper($blog['username']);?>
  
            
            </strong>
            
<h4 class="mb-0">
<a href="main_reading.php?blog=<?php echo''. $blog["blog_slug"].'';?>">    
<?php echo wordwrap(strip_tags(substr($blog["blog_title"],0,400)),400,"<br>", false);?> </a>
            </h4>
            
    <div class="mb-1 text-muted">
     <div class="float-left">
         <?php if(!empty($blog['firstname'])) {echo 'Author:'.$blog['firstname']; $blog['lastname'];} 
              else{ echo'Anonymous';}?>
        
        </div>
     <div class="float-right"> <?php echo''. $blog["blog_date"].'';?> </div>
           </div>  
            
     <p class="card-text mb-auto">
           <?php echo wordwrap(strip_tags(substr($blog["blog_description"],0,710),'<br>'),400,'<br>', false).'..';?> 
                 </p>
          
      <a href="main_reading.php?blog=<?php echo''. $blog["blog_slug"].'';?>" class="stretched-link"><h5>Read More..</h5></a>
        </div>
          

          
        <div class="col-auto d-none d-lg-block">
        
<?php                                
if($cdn == '1'){;?><img src="https://cdnashbd.s3-ap-southeast-1.amazonaws.com/opaar/<?php echo''. $blog["blog_cover"].'';?>" width="240" height="300" role="img" onerror="this.onerror=null; this.src='admin/assets/img/cover_180.png'"> <?php } else {;?>   
<img src="uploads/<?php echo''. $blog["blog_cover"].'';?>" width="240" height="300" role="img" onerror="this.onerror=null; this.src='admin/assets/img/cover_180.png'">    
<?php };?>
   
            

            
               </div>
                   </div>
    
<?php }} else {echo "<div class='col-card' style='padding:10%;'>0 results</div>";};?>

    
    
    

  
    </div>
<!-- 1st layout end-->        

    
<?php require"index/sidebar.php";?>
    
    
    
    
    

<!-- pagenation start-->
    
<nav aria-label="...">
<ul class="pagination" style="margin-top:10px; margin-left: 10px;">  
        
<?php if ($start > 0){;?>
    
<li class="page-item"><a class="page-link" href="?page=<?php echo $page-1;?>" tabindex="-1">&laquo;</a>  </li>   
<?php };?>   
    
<?php for($i=1;$i<=$count_page;$i++){
if($i == $page){
 $active = "active";
}
else {
$active ="";
}
;?>
    
<li class="page-item <?php echo $active;?>"><a class="page-link" href="?page=<?php echo $i;?>"><?php echo $i;?> </a></li>

<?php } ;?>       

<?php if ($page < $count_page - 1){;?>    
 <li class="page-item">  <a class="page-link" href="?page=<?php echo $page+1;?>">&raquo;</a> </li>
<?php } ;?> 
        

</ul>
</nav>    
<!-- pagenation end-->
 
    
    
    

</div></div>
    
    
<div id="istyle" style="margin-bottom: 3px;"> </div>    
    

    
</div> 
    
 <?php require"index/footer.php";?>
        
    
</body>
