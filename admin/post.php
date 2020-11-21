
<?php
//print_r($_POST);    

require"../function/database.php";
include"engine/function.php";

if(isset($_POST['journal_slug_r'])){
 $journal_slug_r = $_POST['journal_slug_r'];

 // Check journal_slug_r
$sql = "select * from opaar_journal where journal_slug='$journal_slug_r'";
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
  {
    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
  }
//whether ip is from proxy
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
  {
    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
//whether ip is from remote address
else
  {
    $ip_address = $_SERVER['REMOTE_ADDR'];
  }
?>
  
<p id='demo'></p>
<p id='demo1'></p>
<p id='demodate'></p>
    
<?php
if(isset($_POST['submit'])){    
$journal_author = $_SESSION['id'];    
$journal_title = $_POST['journal_title'];
$journal_slug = format_slug($_POST['journal_slug_name']);
$journal_cover =  basename($_FILES["fileToUpload"]["name"]);
$journal_online_issn = $_POST['online_issn'];    
$journal_print_issn = $_POST['print_issn'];    
$journal_discription = $_POST['summernote'];
$journal_date = $_POST['date']; 
$journal_meta = $_POST['metaTags'];
$journal_status = "0"; 
$journal_trash="0";    
$user_ip = $ip_address;
    
    
$check = "select * from opaar_journal where journal_slug='$journal_slug'";
$stmt = $con->prepare($check); 
$stmt->execute();
$count = $stmt->fetchColumn();

    
if($count > 0){
echo "<div class='alert alert-danger' role='alert' aria-label='Close'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>'$journal_slug'</strong> slug already exist</div>";} 


    
else {

$sql = "INSERT INTO `opaar_journal` (`id`, `user_id`, `journal_title`, `journal_slug`, `journal_cover`, `online_issn`, `print_issn`, `journal_description`, `journal_date`, `journal_meta`, `journal_status`, `journal_trash`, `user_ip`) VALUES (NULL, '$journal_author', '$journal_title', '$journal_slug', '$journal_cover', '$journal_online_issn', '$journal_print_issn', '$journal_discription', '$journal_date', '$journal_meta', '$journal_status', '$journal_trash', '$user_ip') ";
    
$stmt = $con->prepare($sql);   
$stmt->execute();   
    
echo"<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Success!</strong> Your Journal have been published successfully!</div>";    
    
}      
    
}
?> 
   


<div class="row">
<div class="container-fluid">
<div class="col-12">

<div class="card">
<div class="card-body">
 

    
    
    
    

<!--start menu Tabs-->
 
<ul class="nav nav-tabs" id="myTab" role="tablist">
<li class="nav-item">
<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Journal</a>
</li>

<li class="nav-item">
<a class="nav-link btnNext" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
</li>

<li class="nav-item">
<a class="nav-link btnNextee" id="meta_tags-tab" data-toggle="tab" href="#meta_tags" role="tab" aria-controls="meta_tags" aria-selected="false" onclick="datenext()">Meta Tags</a>
</li>

 </ul>

    
    
    
<form method="POST" action="post.php"  enctype="multipart/form-data"> 
<div class="tab-content pl-3 p-1" id="myTabContent">
<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
 


 <div class="row" style="margin-top: 5px;">
<div class="col">



<div class="form-group"><label for="company" class=" form-control-label"> <small class="text-muted">Journal Title</small></label><input type="text" id="journal_title" name="journal_title" placeholder="Enter Journal Title Here.." class="form-control" required>
    
    </div> 


<label for="company" class=" form-control-label">
<small class="text-muted">Journal Discription</small></label>


<!--cms box-->
<textarea id="summernote" name="summernote" minlength="20"></textarea>

<script>
 $('#summernote').summernote({
placeholder: 'Write your journal here..',
tabsize: 2,
height: 200
 });</script> 


</div>


<div class="col">

<label for="basic-url"><small class="text-muted">Journal Link</small></label>
<div class="input-group mb-3">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon3">https://example.com/</span>
</div>

 <input type="text" class="form-control form-control-sm" id="txt_journal_slug_r" name="journal_slug_name" id="journal_slug_name" placeholder="Journal-link" required/> 
    
<div id="uname_response"></div>

</div>

<label for="company" class=" form-control-label">
<small class="text-muted">Journal Cover</small></label>


<!--image priview box-->
    
<div class="card">
<div class="card-body" align="center">
    <label for="company" class=" form-control-label">
        <table align='center' border='0'> <tr> <td> 
        <img id="blah" src="assets/img/cover_180.png" name="fileToUpload" width="180" /> </td>  </tr><tr><td> 
        <input type='file' onchange="readURL(this);" name="fileToUpload" id="fileToUpload"/></td></tr></table>
            </label></div> </div>

    
   
<?php
$target_dir = "temp/";
echo $mess="";
@$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  @$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    $mess= "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    $mess= "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  $mess= "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if (@$_FILES["fileToUpload"]["size"] > 500000) {
 $mess= "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
 $mess= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  $mess= "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      
      
    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
      
      
  } else {
    $mess= "Sorry, there was an error uploading your file.";
  }
}
    
?>

    

    
<div class="card-body" style="float:right; color:white;">
      <a class="btn btn-primary btnNext">Next</a></div>

    
</div>
</div>
    
    

 </div>


<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
      
    
<div class="card">
<div class="card-body">    
<div class="row">
    <div class="col">

        
<label for="company" class="form-control-label"> <small class="text-muted">Date</small></label> 
<div class="card">
<div class="card-body">
<input type="date" name="date" id="date" value="<?php echo date('Y-m-d'); ?>" class="form-control form-control-sm" required>
    </div> </div>
      

    </div>
    <div class="col">
 
        
        
        
        
        
        
        
<div class="form-group"><label for="company" class="form-control-label"> <small class="text-muted">Identification</small></label>    
<!-- identification-->   
<div class="card">
<div class="card-body">
      
<div class="container">
  <div class="row">
 
    <div class="col-sm">
        
<input type="number" name="online_issn" placeholder="online issn" class="form-control form-control-sm">
        
        
    </div>
    <div class="col-sm">
        
<input type="number" name="print_issn" placeholder="print issn" class="form-control form-control-sm">
        
    </div>
  </div>
    </div> </div></div>
    </div>        
        
        
        
        
        
        
    </div>
  </div>
     </div>
  </div>
    
    <div class="card-body" style="float:right; color:white;">
    <a class="btn btn-danger btnPrevious">Previous</a>
      <a class="btn btn-primary btnNextee" href="javascript:void(0);" onclick="datenext()">Next</a></div>
    
 </div>
    
    

<div class="tab-pane fade" id="meta_tags" role="tabpanel" aria-labelledby="meta_tags-tab">

 <div class="col">
<div class="card">
<div class="card-body">   
     
     <div class="form-group">
    <label for="exampleFormControlTextarea1">
        <small class="text-muted"> Journal MetaTags For SEO</small></label>
    <textarea class="form-control" name="metaTags" rows="3"></textarea>
  </div>
     
    </div></div> </div>

    
    
  <!-- SSS -->
<div class="card-body" style="float:right; color:white;">

<input type="submit" name="submit" value="submit" class="btn btn-secondary btn-success">     
  
 
 </div>
 <!-- SSS -->     
    
   
    
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



<script> 
//next privew tabs 
$(document).ready(function() {
  $('.btnNext').click(function() {

//journal_title check      
var journal_title = $.trim($('#journal_title').val());
var date = $.trim($('#date').val());  
      
      
if (journal_title === '') {   
document.getElementById("demo").innerHTML = "<div class='alert alert-danger' role='alert' aria-label='Close'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Journal title can't be empty </div>";
return false;
  }         
         
       
                                       
else { 
    $('.nav-tabs .active').parent().next('li').find('a').trigger('click');
  }});

//journal_title end      
   
    
  $('.btnPrevious').click(function() {
    $('.nav-tabs .active').parent().prev('li').find('a').trigger('click');
  });
});
</script>








<script> 

    
//next date
$(document).ready(function datenext() {
  $('.btnNextee').click(function datenext() {

var date = $.trim($('#date').val());  
      
if (date === '') {   
document.getElementById("demodate").innerHTML = "<div class='alert alert-danger' role='alert' aria-label='Close'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Journal Date can't be empty </div>"; 
return false;
  }         
                                       
else { 
    $('.nav-tabs .active').parent().next('li').find('a').trigger('click');
  }});
    
  $('.btnPrevious').click(function() {
    $('.nav-tabs .active').parent().prev('li').find('a').trigger('click');
  }); 
});</script>





<?php require"site/footer.php";?>



