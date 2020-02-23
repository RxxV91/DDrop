<?php
include 'files.php';

// checking if the folder uploads exists and if not to create it
if (!file_exists('uploads')) {
  mkdir('uploads', 0777);
}
 
//upload the archive
move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/'. $_FILES['file']['name']);


//open de archive in uploads folder.
$zipArchive = new ZipArchive();
$result = $zipArchive->open('uploads/'. $_FILES['file']['name']);

if ($result === TRUE) {
    $zipArchive ->extractTo("uploads");
    $zipArchive ->close();
    $fname = substr($_FILES['file']['name'], 0 , (strrpos($_FILES['file']['name'], ".")));
    read_all_files($fname);
    //echo  $_FILES['file']['name'] . " has been successfully uploaded.";
} else {
    echo "Something went wrong with " .$_FILES['file']['name'];
}


?>