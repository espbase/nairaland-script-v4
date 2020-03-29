<?php
/*
Developer: Marshall Unduemi
Url: www.codexpresslabs.info
Contact: info@codexpresslabs.info

*/
//Enable Error Reporting

//error_reporting(0);
//remove the above comment to enable error reporting

require_once ('config.php');
require_once ('functions.php');

require_once 'incfiles/theme/head_open.php';
############################### page title #######################
echo checkUser();
	$page_title='Upgrade';
	$site_dsc="Upgrade ".APPNAME." account";
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

echo '<a id="top" name="top"></a>'; // anchor
?>


<?php
##################### login form ########################
$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.
$checkAccesslevel=$db->query("SELECT * FROM users WHERE uid='$user_id' AND access='1'");
$dataUser=mysqli_fetch_assoc($checkAccesslevel);
$service_status=$dataUser['service_status'];
$do_exist=$checkAccesslevel->num_rows;

if($do_exist) // if is admin
            {

/* gets the data from a URL */
//echo get_data('http://labsolution.000webhostapp.com/upgrade.php?upgrade');


    // maximum execution time in seconds
    set_time_limit (24 * 60 * 60);

    if (!isset($_POST['submit']))
      {}
    else{;

    // folder to save downloaded files to. must end with slash
    $destination_folder = getcwd() . "/";

    if (isset($_POST['submit'])) {
      $url = $_POST['url'];
    $newfname = $destination_folder . basename($url);

    $file = fopen ($url, "rb");
    if ($file) {
      $newf = fopen ($newfname, "wb");

      if ($newf)
      while(!feof($file)) {
        fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );

      }
  $fileName = basename($url);
  $fileNameNoExtension = preg_replace("/\.[^.]+$/", "", $fileName.'.zip');

            echo '<div style="width:100%;text-align:center; color:#68a834; font-size:12px">Update downloaded successfully!</div>';
      // assuming file.zip is in the same directory as the executing script.
$unzip = new ZipArchive;
$out = $unzip->open($fileNameNoExtension);
if ($out === TRUE) {
  $unzip->extractTo(getcwd());
  $unzip->close();
  echo '<div style="width:100%;text-align:center; color:#68a834; font-size:12px">Finished installing upgrade</div>';
##############################################
  

} else {
 echo '<div style="width:100%;text-align:center; color:#A60808; font-size:12px">Oops! an error occured during installing upgrade, try again later</div>';
}

    }


    }
   

    if ($file) {
      fclose($file);
    }

    if (@$newf) {
      fclose($newf);
    }
  }

}
else
{
  echo '<div style="width:100%;text-align:center; color:#A60808; font-size:12px">Oops! Access Denied</div>'; 
}
?>

<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

?>

	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->

</body>
</html>
