
<?php 
$edit = $_GET['id'];  
require"../function/database.php";
    
$sql="SELECT * from opaar_journal where id='$edit';";
$stmt = $con->prepare($sql);   
$stmt->execute();   
 
if ($stmt->rowCount() > 0) {
// output data of each row
$journal = $stmt->fetch();{;?>  




<form method="POST" action="editdata.php" role="form">

<div class="modal-body">
    
      
<div class="form-group"><label for="company" class=" form-control-label"> <small class="text-muted">Journal Title</small></label><input type="text" id="company" name="journal_title" placeholder="Enter Journal Title Here.." value="<?php echo''. $journal["journal_title"].'';?>" class="form-control">
</div>


    
    
    

<label for="company" class=" form-control-label">
<small class="text-muted">Journal Discription</small></label>


<!--cms box-->
<textarea id="summernote" name="summernote" minlength="20" ><?php echo''. $journal["journal_description"].'';?></textarea>

<script>
 $('#summernote').summernote({
placeholder: 'Write your journal here..',     
tabsize: 2,
height: 200
 });</script> 
          
<label for="basic-url"><small class="text-muted">Journal Link</small></label>
<div class="input-group mb-3">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon3">https://example.com/</span>
</div>

 <input type="text" class="textbox" id="txt_journal_slug_r" name="journal_slug_name" value="<?php echo''. $journal["journal_slug"].'';?>"  placeholder="Journal-link"/> 
    
<span class="input-group-text" id="basic-addon3"><div id="uname_response"></div>
</span>
    
    

</div>

<label for="company" class=" form-control-label">
<small class="text-muted">Journal Cover</small></label>


<!--image priview box-->
    
<div class="card">
<div class="card-body" align="center">
    <label for="company" class=" form-control-label">
        <img id="blah" src="assets/img/cover_180.png" width="180" /></label>
    <label for="company" class="form-control-label"> <input type='file' onchange="readURL(this);" name="fileToUpload" id="fileToUpload" />   </label></div> </div>  

          
      </div>
      <div class="modal-footer">
          <a type="button" href="deletedata.php?id=<?php echo''. $journal["id"].'';?>" class="btn btn-secondary btn-success sweet-12" onclick="delete();" >Delete</a>


          
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           <button class="btn btn-secondary btn-success sweet-12" onclick="success();"  data-dismiss="modal" >Add</button>     
      </div>
</form>

        
 <script> document.querySelector('.sweet-12').onclick = function success(){
        swal({
          title: "Added",
          text: "New user has been added successfully",
          type: "success",
          showCancelButton: true,
          confirmButtonClass: 'btn-success',
          confirmButtonText: 'done!'
        });
      };
    </script>    



<script> document.querySelector('.sweet-12').onclick = function delete(){
   swal({
  title: "Are you sure?",
  text: "Your will not be able to recover this imaginary file!",
  type: "warning",
  showCancelButton: true,
  confirmButtonClass: "btn-danger",
  confirmButtonText: "Yes, delete it!",
  closeOnConfirm: false
},
function(){
  swal("Deleted!", "Your imaginary file has been deleted.", "success");
});
      };
    </script>    

<?php }}  ;?> 






