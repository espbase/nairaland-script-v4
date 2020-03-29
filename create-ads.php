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

$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.
echo checkUser(); // authenticate logged in users
require_once 'incfiles/theme/head_open.php';
############################### page title #######################

	$page_title='create Ads';
	$site_dsc="create your new awesome ads";
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

echo '<a id="top" name="top"></a>'; // anchor

##################### registration form ########################



?>

 
                <!-------Including PHP Script here------>
<?php 
$checkTr=$db->query("SELECT user_id_fk FROM tranfer_request WHERE user_id_fk='$user_id' ");

$countExist=mysqli_num_rows($checkTr);
//if ($countExist) {
include 'incfiles/uploadAdsImg.php'; 

?>

<div class="main_box">
    <div class="light_box">
         <h2>Create New Ads | <a href="adsstat.php">Ads Statistics</a> </h2>
</div>

  <div class="light_box" style="font-size: 13px">
    
<form enctype="multipart/form-data" action="" method="post">
  <label><b>Ads name</b>: <input name="adsName" required="" type="text"></label><br>
  <label><b>Ads Category</b>:</label> <br>
    <select name="catId" required=""> 
    <option>Select Category</option> 
     <option value="index">Front Page</option> 
    <?php
    $queryBoard=$db->query("SELECT * FROM sub_cat group by sname");
//fetch rows
/*
Define topics, category, and sub cat details and variables
*/
while($bdata=$queryBoard->fetch_assoc()){
$sname=$bdata['sname'];
$sid=$bdata['sid'];
$clink=$bdata['url'];
echo '<option value="'.$sid.'">'.$sname.'</option> ';
}
?>
    </select><br>
  <label><b>Base Url</b>: <input name="baseUrl" required="" type="url"></label><br>
  <label><b>Ads Image (318px X 106px)</b>:</label><br>
                    <div id="filediv"><input name="file[]" required="" type="file"  id="file"/></div> <br>                
    <button type="submit" name="submit" id="upload">Upload File</button>
    
</form>
  </div>
  <div class="dark_box" style="border: none;">
  <p class="small">(<a href="#up"><b>Go Up</b></a>)</p>
</div>
</div>

<?php


//load footer from footer.php
require_once ('footer.php');

?>

	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->

</body>
</html>
