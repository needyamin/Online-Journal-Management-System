<?php

$dir ='fuck'; //session_user

//check dir start   
if (!is_dir($dir))
{mkdir($dir, 0755);}
//check dir end     

include"engine/aws.php";   

if(isset($_FILES['image'])){
$file_name = $_FILES['image']['name'];   
$temp_file_location = $_FILES['image']['tmp_name']; 

    
    
$verifyimg = getimagesize($_FILES['image']['tmp_name']);
//'mimeTypes' => ['image/jpeg,', 'image/pjpeg', 'image/png', 'image/gif'],    
if($verifyimg['mime'] != 'image/png' && $verifyimg['mime'] != 'image/jpeg' && $verifyimg['mime'] != 'image/pjpeg' && $verifyimg['mime'] != 'image/jpeg' && $verifyimg['mime'] != 'image/gif') {
echo "Only PNG images are allowed!";
exit;
}
        
    
        //push s3 bucket
		$result = $s3->putObject([
			'Bucket' => 'cdnashbd',
			'Key'    =>  'opaar/'.$file_name,
			'SourceFile' => $temp_file_location			
		]);
    
        //print_r subbmited
        print($file_name);
	}

?>


<form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">         
	<input type="file" name="image" />
	<input type="submit"/>
</form>      
