<?php
session_start();
//check if the form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //check if the file was uploaded without errors
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];

        //verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

        //verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

        //Verify MYME type of the file
            if(in_array($filetype, $allowed)){
                //check whether file exists before uploading it 
                if(file_exists("upload/" . $filename)){
                    echo $filename . " is already exists.";
                } else{
                    move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/" . $filename);
                    echo "Your file was uploaded successfully.";
                    //set a session var indicating successful upload
                    
                    $_SESSION["upload_success"] = TRUE;
                    //redirect to the previous page
                    header("Location: http://localhost:10080/322/ResAddProdForm.php");
                    exit();
                }
            } else{
                echo "Error: There was a problem uploading your file. Please try again.";
            }

    } else{
        echo "Error: " . $_FILES["photo"]["error"];
    }

}

?>