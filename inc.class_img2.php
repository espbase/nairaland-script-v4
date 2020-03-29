<?php
if (isset($_POST['upload'])) {
####################################################################################################################
    $response = array(
            "type" => "error",
            "message" => ""
        ); 
    $target_path = "images/bus/"; //Declaring Path for uploaded images
   // for ($i = 0; $i < count($_FILES['file']['name']); $i++) {//loop to get individual element from the array

        $validextensions = array("jpg", "png", "gif","JPG", "PNG", "GIF");  //Extensions which are allowed
        $ext = explode('.', basename($_FILES['file2']['name']));//explode file name from dot(.) 
        $file_extension = end($ext); //store extensions in the variable
        $filename=$_FILES['file2']['name'];
        $vpb_code=rand(99999,5);
        
        //$target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];//set the target path with a new name of image 

         $imgurl =md5(uniqid()) . "." . $ext[count($ext) - 1];//set the target path with a new name of image 

      
      if (($_FILES["file1"]["size"] < 1024*5120) //Approx. 5MB files can be uploaded.
                && in_array($file_extension, $validextensions)) {
            if (move_uploaded_file($_FILES['file2']['tmp_name'], $target_path.$imgurl)) {//if file moved to uploads folder
                // save to databse
     $mtk = $db->query("UPDATE class_img SET class_img2='$imgurl' WHERE class_fk='$id' ");

               // echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
    $response = array(
                        "type" => "error",
                        "message" => "Image uploaded successfully!"
                                    );
            } else {//if file was not moved.
                //echo $j. ').<span id="error">please try again!.</span><br/><br/>';
                $response = array(
                        "type" => "error",
                        "message" => "Please try again!"
                                    );
            }
        } else {//if file size and file type was incorrect.
            //echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
            $response = array(
                        "type" => "error",
                        "message" => "***Invalid file Size or Type***"
                                    );
        }

}
