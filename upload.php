<?php
$target_dir = "SongOrganizer/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
$SongToAdd="";
if (isset($_POST['submit'])){
    $SongToAdd = stripslashes($_POST['SongName']) . "\n";
    $check = getimagesize($_FILES["fileToUpload"][$SongToAdd]);

}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}


else{
    if(!file_exists("SongOrganizer")){mkdir("SongOrganizer");}
    $SongFile=fopen("SongOrganizer/songs.txt","wb");
    if($SongFile===false){
        echo "There was an error saving your message!\n";
    }else{
        fwrite($SongFile,$SongToAdd);
        fclose($SongFile);
        echo "Your song has been added to the list. \n";
    }
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    $ExistingSongs = array();
    // if file exist and the file is not empty, store songs in songs.txt in $ExistingSongs as an array
    // if user input $SongToAdd is in the array existing songs, return error message.
    // else if the file is available, write the new song to the file songs.txt
    if(file_exists("SongOrganizer/songs.txt") && filesize("SongOrganizer/songs.txt")>0){
        $ExistingSongs = file("SongOrganizer/songs.txt");

        if(in_array($SongToAdd,$ExistingSongs)){
            echo "<p>The song you entered already exists!</br>";
            echo "Your song was not added to the list.</p>";
        }
        else{
            $SongFile=fopen("SongOrganizer/songs.txt","ab");

            if($SongFile===false){
                echo "There was an error saving your message!\n";
            }else{
                fwrite($SongFile,$SongToAdd."\n");

                echo "Your song has been added to the list. \n";
            }
            fclose($SongFile);
        }
    }
    else{
        if(!file_exists("SongOrganizer")){mkdir("SongOrganizer");}
        $SongFile=fopen("SongOrganizer/songs.txt","wb");
        if($SongFile===false){
            echo "There was an error saving your message!\n";
        }else{
            if($SongFile===false){
                echo "There was an error saving your message!\n";
            }else{
                fwrite($SongFile,$SongToAdd."\n");
                fclose($SongFile);


                echo "Your song has been added to the list. \n";
            }
            echo "Your song has been added to the list. \n";
        }
    }

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $SongFile=fopen("SongOrganizer/songs.txt","wb");
        fwrite($SongFile,$_FILES["fileToUpload"]["name"]."\n");
        fclose($SongFile);
        echo "The file ". basename( $_FILES["fileToUpload"]["tmp_name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

}
?>