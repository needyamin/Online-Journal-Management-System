<?php require"site/header.php"; ?>

        
        
<div class="row">
<div class="container-fluid">
<div class="col-12">

    
                                
    

  <div class="card" style="margin-top: 1%;">
    <div class="card-body">
      
  
                  
      
    


        
        
        
        
        
<ol class="breadcrumb mb-4" >                 
<!-- Button trigger modal start -->
<button type="button" class="btn-md btn-primary right" data-toggle="modal" data-target="#edit" >
 Add Journal</button></ol>

<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit">Add New Journal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

         <div class="dash">

            </div>
        
        
    </div>
  </div>
</div>                   
            
        
        
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
            
<!--  modal end -->

        
       
        
   
    
<!--data table start-->
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Journal Title</th>
                <th>UserName</th>
                <th>Date</th>
                <th>Status</th>
                <th>IP</th>
            </tr>
        </thead>
        <tbody>
            
    
                
<?php 

require"../function/database.php";
include"engine/function.php";
                
$sql="SELECT * FROM `opaar_users` INNER JOIN opaar_journal on opaar_users.id=opaar_journal.user_id ";
$stmt = $con->prepare($sql);   
$stmt->execute();   
 
if ($stmt->rowCount() > 0) {
// output data of each row
while ($journal = $stmt->fetch()) {;?>
           <tr>   
                <td><a data-whatever="<?php echo''. $journal["id"].'';?>" data-toggle="modal" data-target="#edit"><?php echo''. $journal["id"].'';?></a></td>
                <td><?php echo''. $journal["journal_title"].'';?></td>
                <td><?php echo''. $journal["username"].'';?></td>
                <td><?php echo''. $journal["journal_date"].'';?></td>
                <td><?php echo''. $journal["journal_status"].'';?></td>
                <td><?php echo''. $journal["user_ip"].'';?></td>
                
            </tr>
            <?php }} else {echo "<div class='col-card' style='padding:10%;'>0 results</div>";};?>


        </tbody>
       
    </table>
    
    
 
    <!--data table end-->
       
<script>
    $('#edit').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'id=' + recipient;

            $.ajax({
                type: "GET",
                url: "editdata.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    console.log(data);
                    modal.find('.dash').html(data);
                },
                error: function(err) {
                    console.log(err);
                }
            });
    })
</script>       
        
        
    
    
          
        
        
        
        
    

        
</div>

</div>





      </div> </div> </div>


<?php require"site/footer.php"; ?>
