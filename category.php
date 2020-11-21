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

    

 

<div class="card mb-3" style="text-align:justify">

    
    
<div class="card-header bg-transparent">
<a href="index.php"> Home</a> / Catagory / <a href="category.php?category=<?php echo @$tags = $_GET['category'];?>"><?php echo @$tags = $_GET['category'];?></a></div>

    

    

<?php //post start fetch    
@$tags1 = $_GET['category']; 
$sqlcount="SELECT COUNT(id) from opaar_blog_tags WHERE Tags = '$tags1';";
$stmt = $con->prepare($sqlcount);   
$stmt->execute();   
$catagory = $stmt->fetch();
    
$limit_page= $catagory[0];
$numpage='5';    
$count_page = ceil($limit_page/$numpage);
    
    
@$page = $_GET['page'];  
if (!$page) $page = 1;    
$start = ($page-1) * $numpage;?>    
    
    
<?php 

$sql="SELECT * FROM `opaar_blog_tags` INNER JOIN opaar_blog ON opaar_blog_tags.blog_id = opaar_blog.id WHERE opaar_blog_tags.tags = '$tags1' limit $start,$numpage;";
$stmt = $con->prepare($sql);   
$stmt->execute();   
 
if ($stmt->rowCount() > 0) {
// output data of each row
while ($what = $stmt->fetch()) {;?>
    
    
    
    
<div class="card">   
<div class="card-body">
      
<h5 class="card-title"><?php echo wordwrap(strip_tags(substr($what["blog_title"],0,400)),400,"<br>", false);?><?php echo $what['blog_id'];?> </h5>
      
<div class="mb-1 text-muted">
    
     <div class="float-left">
    <?php if(!empty($what['firstname'])) {echo 'Author:'.$what['firstname']; $what['lastname'];} 
        else{ echo'Anonymous';}?>
    </div>
    
     <div class="float-right"> <?php echo''. $what["blog_date"].'';?> </div>
           </div>  <br>
   
<div class="card" style="background:#b7b7b7;">    
<?php                                
if($cdn == '1'){;?><img src="https://cdnashbd.s3-ap-southeast-1.amazonaws.com/opaar/<?php echo''. $what["blog_cover"].'';?>" width="240" height="300" role="img" onerror="this.onerror=null; this.src='admin/assets/img/cover_180.png'" class="rounded mx-auto d-block"> <?php } else {;?>   
    <img src="uploads/<?php echo''. $what["blog_cover"].'';?>" width="240" height="300" role="img" onerror="this.onerror=null; this.src='admin/assets/img/cover_180.png'" class="rounded mx-auto d-block">  </div>  <br>
<?php };?> 
      
    
      <p class="card-text">
 <?php echo wordwrap(strip_tags(substr($what["blog_description"],0,710),'<br>'),400,'<br>', false).'..';?> 
      </p>

         <a href="main_reading.php?blog=<?php echo''. $what["blog_slug"].'';?>" class="stretched-link"><h5>Read More..</h5></a>
      
    
          
  </div></div> 
       
    
  
<?php }} else {echo"<h1>Category '$tags' not found</h> "; };?> 
    
    
       
</div> 


  
  
</div>

<!-- 1st layout end-->        

    
    
<!--sidebar-->    
<?php include"index/sidebar.php";?>
<!-- sidebar-->      

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
    
<li class="page-item <?php echo $active;?>"><a class="page-link" href="category.php?category=<?php echo $tags;?>&page=<?php echo $i;?>"><?php echo $i;?> </a></li>

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
