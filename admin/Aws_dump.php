

<?php

//if dir exiest then not excute
if (!is_dir('test')){
mkdir('test');}

require 'AWS/vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
$bucket = 'cdnashbd';


// Instantiate the client.
$s3 = new Aws\S3\S3Client([
'region'  => 'ap-southeast-1',
'version' => 'latest',
'credentials' => [
'key'    => "AKIA3FJYYGHXRKKR26NB",
'secret' => "vgjyfRuGFzfAOWuKdkwpCG9xnF5kOE9/WrzskdLy",
]]);		


// Use the high-level (returns ALL of your objects).
try {
    $results = $s3->getPaginator('ListObjects', [
        'Bucket' => $bucket
    ]);

    foreach ($results as $result) {
        foreach ($result['Contents'] as $object) {
            //echo 'https://cdnashbd.s3-ap-southeast-1.amazonaws.com/'.$object['Key'] . PHP_EOL.'<br>';
            
             echo 
            "<img src='https://cdnashbd.s3-ap-southeast-1.amazonaws.com/".$object['Key']. PHP_EOL."' width='40%'>/</img><br>";
        }
    }
} catch (S3Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}

;?>



<?php echo'<hr>';?>



<?php
// Use the plain API (returns ONLY up to 1000 of your objects).
try {
    $objects = $s3->listObjects([
        'Bucket' => $bucket
    ]);
    foreach ($objects['Contents']  as $object) {
        echo $object['Key'] . PHP_EOL;
    }
} catch (S3Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
// Use the plain API (returns ONLY up to 1000 of your objects).


;?>
