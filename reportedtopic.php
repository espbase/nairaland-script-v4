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

	$page_title='List of Topics banned';
	$site_dsc="create your new awesome account";
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag
$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

echo '<a id="top" name="top"></a>'; // anchor
//delete or approved reported topic
if (isset($_GET['approve'])) {
	$approve=$_GET['approve'];

	$delapp=$db->query("DELETE FROM reporttopic WHERE repid='$approve' ");
}

##################### topics ########################
$queryPost=$db->query("SELECT * FROM topics T, reporttopic RT, users U
	WHERE U.uid=T.user_id_fk AND RT.topic_id_fk=T.topic_id ");
//count rows
$checktopic=$queryPost->num_rows; // check for existence

require 'incfiles/bbparser.php'; // phpbb code parser
?>
<h2>List of Reported Topic's!</h2>

<?php


if($checktopic)
{
while($tp=$queryPost->fetch_assoc())
{
$content=$tp['txtreason'];
$gender=$tp['gender'];
$pusername=$tp['username'];
$board_id=$tp['board_id_fk'];
$post_status=$tp['status'];
$topic_id=$tp['topic_id'];
$url=$tp['link'];
$dated=$tp['dated'];
$repid=$tp['repid'];

// switch gender
switch($gender)
{
	case '1':
	$gender='m';
	break;
	case '2':
	$gender='f';
	break;
	case '0':
	$gender='n/a';
	break;
}

?>
		<div class="holder"></div>
 <span id="legend2"></span>
<!-- post content -->
<table summary="posts">
	<tr>
		<td class="bold l pu"><a id="<?php echo $tp['topic_id']; ?>" name="<?php echo $tp['topic_id']; ?>"></a>
		<a id="msg<?php echo $tp['topic_id']; ?>" name="msg<?php echo $tp['topic_id']; ?>"></a><a id="4068803.0" name="4068803.0"></a>
		<a href="<?php echo WEBROOT."/$tp[topic_id]/$tp[link]"; ?>"><?php echo ucfirst($tp['title']); ?></a>
		by <a class="user" href="../u/<?php echo $tp['username']; ?>"><?php echo ucfirst($pusername)."($gender)"; ?></a>: <span class="s"><b><?php echo ucfirst($tp['created']); ?></b></span></td>
	</tr>
	<tr>
		<td id="402" class="w">
			<div class="narrow" style="text-align: left;">
				<h2>Reason's:</h2>
				<!-- topic contnet -->
				<?php

// topic content
	$TopicCleaned = badWordFilter($content);
	//echo $cleaned;
	 $bb = new bbParser(); echo $bb->getHtml($TopicCleaned); // topic content 

	 $checkRep=$db->query("SELECT * FROM users U, reporttopic RT 
	 	WHERE U.uid=RT.user_id_fk ");
	 $rep1=$checkRep->fetch_assoc();
	$repusername=$rep1['username']; // get access level
	 ?>
				<!-- end topic contnet --><br>
				<hr/><h4>Reported By: <?php echo "$repusername @ $dated "; ?></h4><hr/>
				<?php
				// if it is admin show banned topic link
				$checkAccesslevel=$db->query("SELECT * FROM users WHERE uid='$user_id' ");
				$do_exist=$checkAccesslevel->num_rows;

				if($do_exist) // if is admin
														{
					$data1=$checkAccesslevel->fetch_assoc();
					$access=$data1['access']; // get access level

					if($access==1 ) // get permission
					{
					echo '<small><a href="?approve='.$repid.'">(Approve)</a></small>.::';

					echo '<small><a href="'.WEBROOT.'/banned/'.$topic_id.'/'.$board_id.'/'.$url.'">(Ban Topic)</a></small>';
																// create admin post url
					echo '.:: <small><a href="'.WEBROOT.'/delete/'.$topic_id.'/'.$board_id.'/'.$url.'"> (Delete Topic)</a></small>';
					echo '.:: <small><a href="'.WEBROOT.'/edit/'.$topic_id.'/'.$url.'"> (Edit Topic )</a></small>';
																// create admin post url
					}
					elseif($access==2 ) // get permission
															{
					echo '<small><a href="?approve='.$repid.'">(Approve Report)</a></small>.::';
															}
														}

				?>


			</div>
		</td>
	</tr>
</table>
<?php } } else{ echo '<h1>No New Topic Reported!</h1>'; } ?>

<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

?>

	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->

</body>
</html>
