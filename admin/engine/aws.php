<?php   
    //connect s3 accounts    
		require 'AWS/vendor/autoload.php';
		$s3 = new Aws\S3\S3Client([
			'region'  => 'ap-southeast-1',
			'version' => 'latest',
			'credentials' => [
				'key'    => "AKIA3F******************",
				'secret' => "vgjyfRuGF***********************",
			]
		]);	
    
    
        //push s3 bucket
		//$result = $s3->putObject([
			//'Bucket' => 'cdnashbd',
			//'Key'    =>  'opaar/'.$file_name,
			//'SourceFile' => $temp_file_location			
		//])
		
	;?>
