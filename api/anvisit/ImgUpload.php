<?php
ini_set("display_errors",'1');
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/db_connect.php';
require '../../vendor/autoload.php';
use Aws\S3\S3Client;
// get database connection
include_once '../config/db_connect.php';

// Instantiate an Amazon S3 client.
$s3Client = new S3Client([
'version' => 'latest',
'region'  => 'ap-south-1',
'credentials' => [
'key'    => 'AKIAZ2VDDTFQLJUYBKPF',
'secret' => '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'
]
]);
// Check if the form was submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $picmeno = $_POST["picmeno"];
// Check if file was uploaded without errors
if(isset($_FILES["usgreport"]) && $_FILES["usgreport"]["error"] == 0){
$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
$filename = $_FILES["usgreport"]["name"];
$filetype = $_FILES["usgreport"]["type"];
$filesize = $_FILES["usgreport"]["size"];
// Validate file extension
$ext = pathinfo($filename, PATHINFO_EXTENSION);
if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
// Validate file size - 10MB maximum
$maxsize = 10 * 1024 * 1024;
if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
// Validate type of the file
//if(in_array($filetype, $allowed)){
// Check whether file exists before uploading it
if(file_exists("../../usgDocument/" . $filename)){
echo $filename . " is already exists.";
} else{
if(move_uploaded_file($_FILES["usgreport"]["tmp_name"], "../../usgDocument/" . $filename)){
$bucket = 'thaimaiyudan';
$file_Path = __DIR__ . '../../usgDocument/'. $filename;
$key = basename($file_Path);
$updateimgQ = mysqli_query($conn,"UPDATE antenatalvisit SET usgreport='$filename' WHERE picmeno='$picmeno'");
try {
$result = $s3Client->putObject([
'Bucket' => $bucket,
'Key'    => $key,
'Body'   => fopen($file_Path, 'r'),
'ACL'    => 'public-read', // make file 'public'
]);
echo "Image uploaded successfully. Image path is: ". $result->get('ObjectURL');
} catch (Aws\S3\Exception\S3Exception $e) {
echo "There was an error uploading the file.\n";
echo $e->getMessage();
}
echo "Your file was uploaded successfully.";
}else{
echo "File is not uploaded";
}
} 
// } else{
// echo "Error: There was a problem uploading your file. Please try again."; 
// }
} else{
echo "Error: " . $_FILES["usgreport"]["error"];
}
}
?>