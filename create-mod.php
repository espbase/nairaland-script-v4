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

	$page_title='Create Moderator';
	$site_dsc="create new moderators";
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
<h2>Create New Mod | <a href="mod-access.php">Mod Access</a> </h2>
 
<!-------Including PHP Script here------>
<?php 
$checkAccesslevel=$db->query("SELECT * FROM users WHERE uid='$user_id' AND access='1' ");
$dataUser=mysqli_fetch_assoc($checkAccesslevel);
$service_status=$dataUser['service_status'];
$do_exist=$checkAccesslevel->num_rows;

if($do_exist) // if is admin
{
$dataUser=$db->query("SELECT * FROM users WHERE username!='' ");

// insert moderators
if (isset($_POST['mod'])) {
  # code...
  $userId=$_POST['userid'];
  $catId=$_POST['catId'];
  if($_POST['type'])
  {
     $type=$_POST['type'];   
  }
//
   $createMod=$db->query("INSERT INTO mods (user_id_fk, board_id_fk, mod_type, created) VALUES ('$userId', '$catId', '$type', NOW()) ");

   if ($createMod) {
     # code...
    echo '<p style="font-size: 2.05em; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-left: 10px; border-left: 3px solid green; color: green;text-align: justify;">Access granted!</p>';
   }

}

?>
<form enctype="multipart/form-data" action="" method="post">
  <table>
    <tr>
      <td class="w">Create board moderators here</td>
    </tr>
    <tr>
    <td>
        <input type="checkbox" name="type" value="super"> Super Moderator
        <select name="userid" required="" id="qsearch"> 
    <option value="">Select User Name</option> 
<?php
//fetch rows
/*
Define topics, category, and sub cat details and variables
*/
while($bdata=$dataUser->fetch_assoc()){
$username=$bdata['username'];
$name=$bdata['name'];
$uid=$bdata['uid'];
echo '<option value="'.$uid.'">'.$name.' ('.$username.')</option> ';
}
?>
    </select></td>
    </tr>
    <tr>
    <td>
    <select name="catId" required="" id="qsearch"> 
    <option>Select Category</option> 
     
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
    </select>
  </td>
    </tr>
      <tr>
  <td>   <button type="submit" name="mod" id="upload">Set Moderator</button></td>
    </tr>
  </table>
</form>
<?php                   // create admin post url
}
else
{
echo '<p style="font-size: 2.05em; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-left: 10px; border-left: 3px solid red; color: red;text-align: justify;">Access denied!</p>';
}

//end ads form
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

?>

	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->

</body>
</html>
