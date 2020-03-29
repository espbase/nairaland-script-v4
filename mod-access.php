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
         <h2>List Moderators | <a href="create-mod.php">Create New Mod</a> </h2>
 
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
if (isset($_GET['catId'])) {
  # code...
  $bid=$_GET['catId'];

  if (isset($_GET['deleteid'])) {
    $deleteid=$_GET['deleteid'];
    $Qdelete=$db->query("DELETE FROM mods WHERE user_id_fk='$deleteid' ");
    echo "<h3>User Successfully removed as moderator</h3>";
  }

 $queryBoard=$db->query("SELECT * FROM users U, mods M, sub_cat S 
  WHERE U.uid=M.user_id_fk AND M.board_id_fk='$bid' AND S.sid=M.board_id_fk "); 
$vali=mysqli_num_rows($queryBoard);
if ($vali) {
  # code...
while($bdata=$queryBoard->fetch_assoc()){
$username=$bdata['username'];
$uid=$bdata['uid'];
$name=$bdata['name'];
$sname=$bdata['sname'];

echo "<hr><a href='u/$username'><img src='images/advertising.png'/> $name ($username) - $sname </a>
 - <a href='?deleteid=$uid&catId=$bid'>Remove</a>";
}
}
else
{
  echo '  <table>
    <tbody>
    <tr>
        <td class="w">
      <h2>Oops! No user Assigned</h2>
            <p style="font-size: 1.05em; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-left: 10px; border-left: 3px solid red; color: red;text-align: justify;">
            This board has no moderator assigned. <br>
            → <a href="create-mod">Click here to create new moderator</a>
            </p>    </td>
</tr> <!--END CONTAINER SEARCH TOPICS-->
</tbody>
</table>';
}
}
?>
<form enctype="multipart/form-data" action="" method="get">
  <table>
    <tr>
      <td class="w">List board Moderators</td>
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
  <td>   <button type="submit" name="mod" id="upload">List Moderator</button></td>
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
