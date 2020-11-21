//windows-alert hidden future needyamin
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 2000);




//chosen article option
$(".chosen-select").chosen({no_results_text: "Oops, nothing found!"}); 





//image_cover upload//
function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }



//Live request to check journal slug//

$(document).ready(function(){

 $("#txt_journal_slug_r").keyup(function(){

var journal_slug_r = $(this).val().trim();

if(journal_slug_r != ''){

$.ajax({
url: 'post.php',
type: 'post',
data: {journal_slug_r:journal_slug_r},
success: function(response){

// Show response
$("#uname_response").html(response);

}
});
}else{
$("#uname_response").html("");
}

});

});






