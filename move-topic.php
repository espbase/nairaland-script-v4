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

	$page_title='Move topic';
	$site_dsc="easily move topics to other category";
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

echo '<a id="top" name="top"></a>'; // anchor

##################### registration form ########################

$checkAccesslevel=$db->query("SELECT * FROM users WHERE uid='$user_id' AND access='admin' OR access='mod' ");
$dataUser=mysqli_fetch_assoc($checkAccesslevel);
$service_status=$dataUser['service_status'];
$do_exist=$checkAccesslevel->num_rows;

if($do_exist) // if is admin
{
// insert moderators
if (isset($_REQUEST['id'])) {
  # code...
  $topic_id=$_REQUEST['id'];
//
  $dataTopic=$db->query("SELECT * FROM topics WHERE topic_id='$topic_id' ");
  $data=mysqli_fetch_assoc($dataTopic);

  echo "<h2>Move Topic: $data[title]; </h2>";
  if (isset($_POST['catId'])) {
    # code...
    $catId=$_POST['catId'];
  $update=$db->query("UPDATE topics SET board_id_fk='$catId' WHERE topic_id='$topic_id' ");

  echo '<p style="font-size: 1.05em; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-left: 10px; border-left: 3px solid green; color: green;text-align: justify;">Topic Successfully moved!</p>';
  }

}

?>
<form enctype="multipart/form-data" action="" method="post">
  <table>
    <tr>
    <td>
    <select name="catId" required="" id="qsearch"> 
    <option>Select Category To Move Topic</option> 
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
  <td>  
  <input name="mod" type="submit" value="Move"> 
</td>
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
