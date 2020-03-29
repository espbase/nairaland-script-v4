<?php
if (isset($_POST['post'])) {
    $j = 0; //Variable for indexing uploaded image 
    
    $target_path = "uploads/"; //Declaring Path for uploaded images
   // for ($i = 0; $i < count($_FILES['file']['name']); $i++) {//loop to get individual element from the array

        $validextensions = array("jpg", "png", "gif","JPG", "PNG", "GIF");  //Extensions which are allowed
        $ext = explode('.', basename($_FILES['file2']['name']));//explode file name from dot(.) 
        $file_extension = end($ext); //store extensions in the variable
        $filename=$_FILES['file2']['name'];
        $vpb_code=rand(99999,5);
        
        $target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];//set the target path with a new name of image
        //$j = $j + 1;//increment the number of uploaded images according to the files in array       
      
      if (($_FILES["file2"]["size"] < 1024*5120) //Approx. 5MB files can be uploaded.
                && in_array($file_extension, $validextensions)) {
            if (move_uploaded_file($_FILES['file2']['tmp_name'], $target_path)) {//if file moved to uploads folder
                // save to databse
    $db->query("UPDATE topic_comments 
        SET file2='$target_path'
            WHERE comment_id='$comment_id_fk' 
            ");

               // echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
            } else {//if file was not moved.
                //echo $j. ').<span id="error">please try again!.</span><br/><br/>';
            }
        } else {//if file size and file type was incorrect.
            //echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
        }
    //}
}
?>