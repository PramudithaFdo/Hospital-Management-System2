<?php
// Include the database configuration file
require('db.php');
$statusMsg = '';

// File upload path
$targetDir = "uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $app_no = stripslashes($_REQUEST['app_no']);
            $comment = stripslashes($_REQUEST['comments']);

            $select = "SELECT * FROM appointments where app_no = $app_no";
            $result_select = mysqli_query($con, $select) or die($mysqli->error());
            $rows_select = $result_select->fetch_assoc();

            $insert = $con->query("INSERT into prescriptions (app_id, p_email, d_id, comments, upload_path, create_datetime) VALUES ('$app_no', '".$rows_select['p_email']."' , '".$rows_select['d_id']."', '$comment', '".$fileName."', NOW())");
            $update = $con->query("UPDATE appointments SET done = '1' where app_no = '".$app_no."'");
            if($insert){
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
            }else{
                $statusMsg = "File upload failed, please try again.";
            } 
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}

// Display status message
header("Location: prescription_management.php");
?>