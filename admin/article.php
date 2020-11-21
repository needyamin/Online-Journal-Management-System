<?php
print_r($_POST);
require"../function/database.php";
include"engine/function.php";
require"site/header.php"; ?>



<?php 
//if message empty
$message="";

//whether ip is from share internet
if (!empty($_SERVER['HTTP_CLIENT_IP']))   
  {$ip_address = $_SERVER['HTTP_CLIENT_IP'];}

//whether ip is from proxy
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
  {$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];}

//whether ip is from remote address
else{$ip_address = $_SERVER['REMOTE_ADDR'];}

global $id;    
//if click submit
if(isset($_POST['submit'])){     
$article_title = $_POST['article_title'];    
$summernote = $_POST['summernote'];
$journal_id = $_POST['journal_id'];
$users = $_SESSION['id'];        
$article_volume = $_POST['article_volume'];
$article_number = $_POST['article_number'];
$article_year = $_POST['article_year'];
$article_date = $_POST['date'];     
$date = date('Y-m-d H:i:s');    
$user_ip = $ip_address;
    
if($article_title =='' or $summernote=='' or $journal_id=='' or $article_date=='' ){
echo"<div class='alert alert-danger' role='alert' aria-label='Close'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Required all field</div>";}
    
else{   
$run_query="INSERT INTO `opaar_article` (`id`, `journal_id`, `user_id`, `article_title`, `article_description`,`article_volume`,`article_number`,`article_year`, `article_date`, `article_tags`, `article_status`, `article_trash`, `datetime`,`ip`) VALUES (NULL, '$journal_id', '$users', '$article_title', '$summernote','$article_volume','$article_number','$article_year', '$article_date', '0', '0','0', '$date','$user_ip')";
$stmt = $con->prepare($run_query);   
$stmt->execute();          
$id = $con->lastInsertId(); 
    
echo"<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Success!</strong> Your post have been published successfully!</div>";} 
   
//Below all query stop if journal_id not run    
if(empty($_POST['journal_id'])) { $message="<div class='alert alert-danger' role='alert' aria-label='Close'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Warning!</strong>journal not found</div>";}   
    
//insert article_users  
if(isset($_POST['article_author'])) { 
if(!empty($_POST['article_author'] && $id)){    
foreach($_POST['article_author'] as $i => $article_author) 
{ 
// Get values from post.
$author = $article_author;
$ip_address = $_SERVER['REMOTE_ADDR'];    
$Date = date('Y-m-d H:i:s');    

$sql_article_author ="INSERT INTO `opaar_article_users` (`id`, `article_id`, `article_author`, `article_editors`, `date`, `ip`) VALUES (NULL, '$id', '$author', '0', '$Date', '$ip_address') ";
$stmt = $con->prepare($sql_article_author);   
$stmt->execute();      

}
}
}     

    
//insert article_editors  
if(isset($_POST['article_editors'])) {    
if(!empty($_POST['article_editors'] && $id)){    
foreach($_POST['article_editors'] as $i => $article_editors) 
{ 
// Get values from post.
$editors = $article_editors;
$ip_address = $_SERVER['REMOTE_ADDR'];    
$Date = date('Y-m-d H:i:s');    

$sql_article_article_author ="INSERT INTO `opaar_article_users` (`id`, `article_id`, `article_author`, `article_editors`, `date`, `ip`) VALUES (NULL, '$id', '0', '$editors', '$Date', '$ip_address') ";
$stmt = $con->prepare($sql_article_article_author);   
$stmt->execute();      
}
}
}  
  
    
//insert tags   
if(!empty($_POST['article_tags'])){    
foreach($_POST['article_tags'] as $i => $article_editors) 
{ 
// Get values from post.
$editors =  implode(array($article_editors,','));
echo $editors;
}
}
    
    
//insert pdf   
if(isset($_FILES['fileUpload']['name'])) {     
if(!empty($_FILES['fileUpload']['name'] && $id)){    
foreach($_FILES['fileUpload']['name'] as $i => $fileUpload) 
{ 
// Get values from post.
$pdf = $fileUpload;
$ip_address = $_SERVER['REMOTE_ADDR'];        
$uploadDate = date('Y-m-d H:i:s');    

$sql_file ="INSERT INTO `opaar_article_pdf` (`id`, `article_id`, `article_pdf`, `datetime`, `ip`) VALUES (NULL, '$id', '$pdf', '$uploadDate','$ip_address')";
$stmt = $con->prepare($sql_file);   
$stmt->execute();      

}
} 
}
};?>



<!--<div class="alert alert-danger" role="alert" aria-label="Close">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
    <strong>Warning!</strong> $message;?>
</div>-->



<!--<div class="alert alert-success" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Success!</strong> You have been signed in successfully!
</div>-->


<script>window.setTimeout(function() {
$(".alert").fadeTo(500, 0).slideUp(500, function(){
$(this).remove(); });
}, 2000);</script>




<div class="row">
<div class="container-fluid">
<div class="col-12">

<div class="card">
<div class="card-body">
 

<!--start menu Tabs-->
<ul class="nav nav-tabs" id="myTab" role="tablist">
<li class="nav-item">
<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Article</a>
</li>

<li class="nav-item">
<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Media</a>
</li>

<li class="nav-item">
<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Request</a>
</li>
</ul>

    
    
    
<form method="POST" action="article.php"  enctype="multipart/form-data"> 


<div class="tab-content pl-3 p-1" id="myTabContent">
<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
<div class="row" style="margin-top: 5px;">
<div class="col">


<div class="form-group"><label for="company" class="form-control-label"> <small class="text-muted">Article Title</small></label><input type="text" id="company" name="article_title" placeholder="Enter Article Title Here.." class="form-control form-control-sm"></div> 


<label for="company" class=" form-control-label">
<small class="text-muted">Article Discription</small></label>


<!--cms box-->
<textarea id="summernote" name="summernote" minlength="20"></textarea>
<script>
$('#summernote').summernote({
placeholder: 'Write your journal here..',
tabsize: 2,
height: 150
});</script> 

</div>


<div class="col">
    

<label for="basic-url"><small class="text-muted">Article Part</small></label>
<div class="input-group mb-3">
<div class="input-group-prepend ">
<span class="input-group-text" id="basic-addon3">Select Journal</span>
</div>

<select name="journal_id" required>   
<option value="">--</option>     
<?php 
$sql="SELECT * from opaar_journal;";
$stmt = $con->prepare($sql);   
$stmt->execute();   
if ($stmt->rowCount() > 0) {
// output data of each row
while ($journal = $stmt->fetch()) {;?>
<option value="<?php echo''. $journal["id"].'';?>"><?php echo''. $journal["journal_slug"].'';?></option>  
<?php }};?>
</select>  
     
</div>
    

   
<div class="form-group"><label for="company" class="form-control-label"> <small class="text-muted">Identification</small></label>    
<!-- identification-->   
<div class="card">
<div class="card-body">     
<div class="container">
<div class="row">

<div class="col-sm">
<input type="text" id="company" name="article_volume" placeholder="Enter Volume" class="form-control form-control-sm">   
</div>

<div class="col-sm">   
<input type="text" id="company" name="article_number" placeholder="Enter Number" class="form-control form-control-sm">   
</div>

<div class="col-sm"> 
<input type="text" id="company" name="article_year" placeholder="Enter Year" class="form-control form-control-sm">   
</div>
      
</div></div></div></div>


</div>
    
    
    
<label for="company" class=" form-control-label">
<small class="text-muted">Article Tags</small></label>
<div class="card">
<div class="card-body" >
<label for="company" class=" form-control-label">    
    
<select multiple data-role="tagsinput" name="article_tags[]">
<?php 
$sql="SELECT * FROM article_tags";
$stmt = $con->prepare($sql);   
$stmt->execute();   
if ($stmt->rowCount() > 0) {
// output data of each row
while ($journal = $stmt->fetch()) {;?>
<option value="<?php echo''. $journal["tags"].'';?>"></option>  
<?php }};?> 
</select>
   
</label></div> </div>        
 
    
</div> 
</div>
    
    
<div class="card-body" style="float:right; color:white;">
<a class="btn btn-primary btnNext">Next</a></div>    
    
    
</div>


<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    
    

    
<div class="card">
<div class="card-body">    
<div class="row">
<div class="col">
         
<label for="company" class=" form-control-label">
<small class="text-muted">Article Author</small></label>  
<div class="card">
<div class="card-body" >             
<select class="chosen-select" tabindex="8" multiple="" name="article_author[]" style="width:350px;" data-placeholder="Enter Author Name value">
<option value=""></option>      
<?php 
$sql="SELECT * FROM opaar_users";
$stmt = $con->prepare($sql);   
$stmt->execute();   
if ($stmt->rowCount() > 0) {
// output data of each row
while ($journal = $stmt->fetch()) {;?>
<option value="<?php echo''. $journal["id"].'';?>"><?php echo''. $journal["username"].'';?></option>  
<?php }};?>
</select>      
</div></div> 
        
      
        
<label for="company" class=" form-control-label">
<small class="text-muted">Article Editors</small></label>        
<div class="card">
<div class="card-body" >
<select class="chosen-select" tabindex="8" multiple="" name="article_editors[]" style="width:350px;" data-placeholder="Enter Editors Name">
<option value=""></option>
<?php 
$sql="SELECT * FROM opaar_users";
$stmt = $con->prepare($sql);   
$stmt->execute();   
if ($stmt->rowCount() > 0) {
// output data of each row
while ($journal = $stmt->fetch()) {;?>
<option value="<?php echo''. $journal["id"].'';?>"><?php echo''. $journal["username"].'';?></option>  
<?php }};?>
</select>     
</div></div>
        
        
</div>
         
        
<div class="col">  
<label for="company" class=" form-control-label">
<small class="text-muted">Article Documents (PDF)</small></label>

<!--image priview box-->
<div class="card">
<div class="card-body" >
<label for="company" class=" form-control-label">

   
<!--xxx-->
<input type="file" name="fileUpload[]"  accept=".xls,.xlsx,.pdf,.dotx,.doc" multiple>
<!--xxx--> </label>
</div> </div>
        
    
<label for="company" class=" form-control-label">
<small class="text-muted">Article Publishing Date</small></label>

<!--image priview box-->
<div class="card">
<div class="card-body" >
<label for="company" class=" form-control-label">
   
<!--date input start-->
<input type="date" name="date"> 
<!--date input end--> 
</label>
    
</div></div>    
        
    
</div>
</div>
    
            
<center><label for="company" class=" form-control-label">
<small class="text-muted">Article Page Numbers</small></label>
<div class="card">
<div class="card-body" >
<label for="company" class=" form-control-label">    
<input type="text" name="page_number" id="tbNum" onkeyup="addHyphen(this)" placeholder="01-07" >  
</label></div></div> 
    

<script>
function addHyphen (element) {    
let ele = document.getElementById(element.id);
ele = ele.value.split('-').join('');    // Remove dash (-) if mistakenly entered.
let finalVal = ele.match(/.{1,2}/g).join('-');
document.getElementById(element.id).value = finalVal;
}
</script>   
    
    
    
    
</center>
    
    
    
    
</div>
</div>
    
    
<div class="card-body" style="float:right; color:white;">
<a class="btn btn-danger btnPrevious">Previous</a>
<a class="btn btn-primary btnNext">Next</a></div>
    
    
</div>

    
<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
<h3>Do you read our terms and condition?</h3>
<p>Warning text and document here</p>
    
    
<div class="card-body" style="float:right; color:white;">
<a class="btn btn-danger btnPrevious">Previous</a>
<input type="submit" value="submit" name="submit" class="btn btn-primary btnNext" > 
</div>       
</div> 
    
</div>
</form>
</div>
<!--end menu Tabs-->

</div>
</div>
</div>
</div>
<!-- /#page-content-wrapper -->


<script> //next privew tabs 
$(document).ready(function() {
$('.btnNext').click(function() {
$('.nav-tabs .active').parent().next('li').find('a').trigger('click');});

$('.btnPrevious').click(function() {
$('.nav-tabs .active').parent().prev('li').find('a').trigger('click');});
});
</script>

<?php require"site/footer.php";?>

