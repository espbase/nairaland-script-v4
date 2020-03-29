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

require_once 'incfiles/theme/head_open.php';
############################### page title #######################

	$page_title='Moderator Previlages';
	$site_dsc="create Moderator Previlages account";
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
<h2>Makes Users as Admin</h2>
 <?php

 if (isset($_GET['mod'])) {
$uid=($_GET['mod']); // get user id
if($uid)
{
$db->query("UPDATE users SET access='2' WHERE uid='$uid' ");
}
}

 if (isset($_GET['admin'])) {
$uid=($_GET['admin']); // get user id
if($uid)
{
$db->query("UPDATE users SET access='1' WHERE uid='$uid' ");
}
}


 if (isset($_GET['user'])) {
$uid=($_GET['user']); // get user id
if($uid)
{
$db->query("UPDATE users SET access='0' WHERE uid='$uid' ");
}
}


           $listusers=$db->query("SELECT * FROM users WHERE validcode='0' ORDER BY username ASC ") or die ('can not fetch users list!');

 // if it is admin show banned topic link
        $checkAccesslevel=$db->query("SELECT * FROM users WHERE uid='$user_id' ");
        $do_exist=$checkAccesslevel->num_rows;
if($do_exist) // if is admin
{
$data1=$checkAccesslevel->fetch_assoc();
$access=$data1['access']; // get access level

if($access==1 ) // get permission
{


          while($data=$listusers->fetch_assoc())
          { ?>
      <table>
        <tr>
          <td><label><b><a href="<?php echo WEBROOT.'/u/'.$data['username']; ?>"><?php echo $data['username']; ?></a></b>:</label>
            <?php
            if($data['access']=='1')
            {
            echo ' <a href="'.WEBROOT.'/create-admin?user='.$data['uid'].'" style="color:red"><span>Remove Admin</span></a>';
            }
            else{
            ?>
            <a href="<?php echo WEBROOT.'/create-admin?admin='.$data['uid']; ?>"><span>Make as admin</span></a>
            <?php } ?>

            <?php
            if($data['access']=='2')
            {
            echo ' <a href="'.WEBROOT.'/create-admin?user='.$data['uid'].'" style="color:red"><span>Remove Mod</span></a>';
            }
            else{
            ?>
            <a href="<?php echo WEBROOT.'/create-admin?mod='.$data['uid']; ?>"><span>Make as Mod</span></a>
            <?php } ?>

       </td>
        </tr>
      </table>
		<?php } } else {
			echo "<h1 style='color:red;'>Access Denied!</h1>";
		}} ?>


<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

?>

	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->

</body>
</html>
