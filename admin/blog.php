<?php

//print_r($_POST);
require"../function/database.php";
require"../function/siteconfig.php";
include"engine/function.php";    

if(isset($_POST['blog_slug_r'])){
 $blog_slug = $_POST['blog_slug_r'];

 // Check journal_slug_r
$sql = "select * from opaar_blog where blog_slug='$blog_slug'";
$stmt = $con->prepare($sql); 
$stmt->execute();
 $count = $stmt->fetchColumn();

 $response = "<span class='input-group-text' style='color: green;margin-left:5px;'>Available.</span>";
    
 if($count > 0){
 $response = "<span class='input-group-text' style='color: red;margin-left:5px;'>Not Available.</span>";
 }

 echo $response;
 exit; 
      
};?>








<?php require"site/header.php";?>



<?php  
//whether ip is from share internet
if (!empty($_SERVER['HTTP_CLIENT_IP']))   
  {$ip_address = $_SERVER['HTTP_CLIENT_IP'];}

//whether ip is from proxy
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
  {$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];}

//whether ip is from remote address
else{$ip_address = $_SERVER['REMOTE_ADDR'];}


if(isset($_POST['submit'])){
$users = $_SESSION['id'];            
$blog_title = $_POST['blog_title'];    
$blog_slug = format_slug($_POST['blog_slug']);
$summernote = $_POST['summernote'];
$date = $_POST['date'];
$blog_tags = $_POST['blog_tags'];
$create_date = date('Y-m-d H:i:s');    
$user_ip = $ip_address;
    
$check = "select * from opaar_blog where blog_slug='$blog_slug'";
$stmt = $con->prepare($check); 
$stmt->execute();
$count = $stmt->fetchColumn();

  

    
if($count > 0){
echo "<div class='alert alert-danger' role='alert' aria-label='Close'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>'$blog_slug'</strong> slug already exist</div>";} 

elseif ($blog_slug == ''){
echo "<div class='alert alert-danger' role='alert' aria-label='Close'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please create a SEO friendly permalink</div>";  
    
}    
    
    
    
else {
$run_query="INSERT INTO `opaar_blog` (`id`, `user_id`, `blog_title`, `blog_slug`, `blog_description`, `blog_cover`, `blog_date`, `blog_tags`, `blog_status`, `blog_trash`, `blog_creation`, `blog_last_update`, `ip`) VALUES (NULL, '$users', '$blog_title', '$blog_slug', '$summernote', '0', '$date', '0', '0', '0', '$create_date', '$create_date', '$user_ip')";
$stmt = $con->prepare($run_query);   
$stmt->execute();   
$id = $con->lastInsertId(); 
    
echo"<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Success!</strong> Your blog have been published successfully!</div>";     
    
 echo "<div class='p-3 mb-2 bg-info text-white'>Your Posted Blog ID is = $id</div>";   
     
    
      
//start insert tags  
if(isset($_POST['blog_tags'])) {    
if(!empty($_POST['blog_tags'] && $id)){    
foreach($_POST['blog_tags'] as $i => $opaar_blog_tags) 
{ 
// Get values from post.
$tags = $opaar_blog_tags;
if($tags == ''){} else {

$sql_tags ="INSERT INTO `opaar_blog_tags` (`id`, `blog_id`, `tags`) VALUES (NULL, '$id', '$tags')";
$stmt = $con->prepare($sql_tags);   
$stmt->execute();      
}
}
}
}
///end insert tags   
    
    
}   
        
}

;?>




<div class="row">
<div class="container-fluid">
<div class="col-12" style="margin-top:15px;">
<div class="card">
<div class="card-body">

    
    
<div class="row no-gutters">
    
<div class="col-12 col-sm-6 col-md-8">
  
<form method="POST" action="#" enctype="multipart/form-data"/> 
    
<div class="form-group">
<label for="company" class="form-control-label"> 
<small class="text-muted">Blog Title</small></label>
<input type="text" id="blog_title" name="blog_title" placeholder="Blog title.." class="form-control form-control-sm" value="<?php if(isset($blog_title)) {echo $blog_title; }?>" required>
</div> 

    
    
    
<!--test-->
<style>
#Permalink {
  display:none;
  margin-top: 10px;    
}
</style>

<div class="form-group">
<button type="button" onclick="Permalink()" class="btn btn-secondary">Permalink</button>

<div id="Permalink">  
<label for="basic-url"><small class="text-muted">Make Custom Permalink</small></label>
<div class="input-group mb-3">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon3">https://example.com/</span>
</div>
 <input type="text" class="form-control form-control-sm" name="blog_slug" id="blog_slug" placeholder="Permalink link" value="<?php if(isset($blog_slug)) {echo $blog_slug; }?>" size="40"/>   

<div id="blog_response"></div>

    
    
</div>   
    
    </div> </div>

<script>
function Permalink() {
  var x = document.getElementById("Permalink");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
    
}    
</script>
    
<script> 
//Live request to check blog slug//

$(document).ready(function(){
 $("#blog_slug").keyup(function(){
var blog_slug_r = $(this).val().trim();
if(blog_slug_r != ''){
    
$.ajax({
url: 'blog.php',
type: 'post',
data: {blog_slug_r:blog_slug_r},
success: function(response){
    
// Show response
$("#blog_response").html(response);
}
});
}else{
$("#blog_response").html("");
}
});
});  
</script>

<!--testend-->
    

    

<label for="company" class=" form-control-label">
<small class="text-muted">Blog Discription</small></label>    
    
    
<!--cms box-->
<textarea id="summernote" name="summernote" minlength="20"><?php if(isset($summernote)) {echo $summernote; }?></textarea>
   

<!-- summernote image upload start-->      
<script>
$('#summernote').summernote({
placeholder: 'Blog content...',
tabsize: 2,
height: 200
});
</script>


    

    
<?php 
    
$file_type = 'images';   
    
include"engine/aws.php";  
     
if ($cdn == '1'){;
              
if(isset($_FILES['image'])){
$file_name = $_FILES['image']['name'];   
$temp_file_location = $_FILES['image']['tmp_name']; 
    
    
@$verifyimg = getimagesize($_FILES['image']['tmp_name']);
//'mimeTypes' => ['image/jpeg,', 'image/pjpeg', 'image/png', 'image/gif'],    
if($verifyimg['mime'] != 'image/png' && $verifyimg['mime'] != 'image/jpeg' && $verifyimg['mime'] != 'image/pjpeg' && $verifyimg['mime'] != 'image/jpeg' && $verifyimg['mime'] != 'image/gif') {
echo "Note: Only PNG images are allowed!";

}

//get session username    
$user = $_SESSION['username'];    
    
    
  //push s3 bucket
	$result = $s3->putObject([
	'Bucket' => 'cdnashbd',
	'Key'    =>  'opaar/'.$user.'/'.$file_type.'/'.$file_name,
	'SourceFile' => $temp_file_location			
     ]);
    
//print_r insert
$img_full_link = $user.'/'.$file_type.'/'.$file_name;    
    
//insert media gallery    
$insert_blog_images="INSERT INTO `opaar_blog_images` (`id`, `blog_id`, `image_url`) VALUES (NULL, '$id', '$img_full_link')";
$stmt = $con->prepare($insert_blog_images);   
$stmt->execute();       
    
//insert blog_cover    
$insert_img="UPDATE `opaar_blog` SET `blog_cover` = '$img_full_link' WHERE `opaar_blog`.`id` = $id";     
$stmt = $con->prepare($insert_img);   
$stmt->execute();   
  
}}

    
    
else{
    
           
if(isset($_FILES['image'])) {

//check dir start   
if (@!is_dir('../uploads/'.$_SESSION['username'],$file_type))
{@ mkdir('../uploads/'.$_SESSION['username'].'/'.$file_type, 0777,true);}
//check dir end      
    
$file_name = $_FILES['image']['name'];   
$location = $_FILES['image']['tmp_name'];

//verifiation mime    
@$verifyimg = getimagesize($_FILES['image']['tmp_name']);
//'mimeTypes' => ['image/jpeg,', 'image/pjpeg', 'image/png', 'image/gif'],    
if($verifyimg['mime'] != 'image/png' && $verifyimg['mime'] != 'image/jpeg' && $verifyimg['mime'] != 'image/pjpeg' && $verifyimg['mime'] != 'image/jpeg' && $verifyimg['mime'] != 'image/gif') {
echo "Only PNG images are allowed!";

}    

//get session username    
$user = $_SESSION['username'];
    
 //move_folder_point
 $destination = '../uploads/'.$user.'/'.$file_type.'/'.$file_name; //change this directory
 move_uploaded_file($location, $destination);
 '../uploads/' . $file_name;//change this URL
     
//print_r insert
$img_full_link = $user.'/'.$file_type.'/'.$file_name;    
    
//insert media gallery    
@$insert_blog_images="INSERT INTO `opaar_blog_images` (`id`, `blog_id`, `image_url`) VALUES (NULL, '$id', '$img_full_link')";
$stmt = $con->prepare($insert_blog_images);   
$stmt->execute();       
    
//insert blog_cover    
@$insert_img="UPDATE `opaar_blog` SET `blog_cover` = '$img_full_link' WHERE `opaar_blog`.`id` = $id";     
$stmt = $con->prepare($insert_img);   
$stmt->execute();   
        
    
    
    
    
    
}};?>

<!-- summernote image upload end-->       

 </div> 
    
    
    

<div class="col-6 col-md-4" style="padding:10px;">
    

<div class="card-body" >
<label for="company" class=" form-control-label" align="center">
<input class="btn-primary" type="submit" name="submit" value="Published">    
    </label></div> 
    
<label for="company" class=" form-control-label">
<small class="text-muted">Publish Date</small></label>
<div class="card">
<div class="card-body" >
<label for="company" class=" form-control-label">    
<input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" />     
</label></div> </div>     
    
    
<!-- blog cover start-->    
<label for="company" class=" form-control-label">
<small class="text-muted">Blog Cover</small></label>    
<div class="card">
<div class="card-body" >
    
<div id="files">
<input type="file" name="image" />
</div>

    
    
<!--<script> 
$("#files").on("change", "input", function(event){
$('#files').append('<input type="file" name="image"/>')
});
</script>-->
    
</div> </div> 
<!-- blog cover end-->    
    
    
<label for="company" class=" form-control-label">
<small class="text-muted">Blog Tags</small></label>
<div class="card">
<div class="card-body" >
<label for="company" class=" form-control-label">    
    
<select multiple data-role="tagsinput" name="blog_tags[]" size="50">
<option value="">Tags</option>  
</select>
   
</label></div> </div>  
    
   
    
    
    </form>
 
    
    
    
</div>
    

</div>
    
    
    
</div></div></div></div></div>

<?php require"site/footer.php";?>

