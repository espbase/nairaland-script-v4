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
	$user=$_GET['user'];
	$page_title=$user.' Posts and Topics';
	$site_dsc=$user.' Posts and Topics';

require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

################################# include files ##########################

//load header.php
require_once ('header.php');

require_once ('incfiles/topicCount.php'); // count page view function

echo '<a id="top" name="top"></a>'; // anchor
$user=$_GET['user'];
##################### user details ########################
$userD=$db->query("SELECT * FROM users U, topics T
	WHERE U.username='$user' AND T.user_id_fk=U.uid AND post_type='topic' ");
$u=mysqli_fetch_assoc($userD);
$username=$u['username'];
$avater=$u['avater'];
$email=$u['email'];
$location=$u['location'];
$fb=$u['fb'];
$twitter=$u['twitter'];
$active=$u['activeSince'];
$gender=$u['gender'];
$registered_date=$u['registered_date'];

//count rows
//$counttopics=$userD->num_rows;

$type=$_GET['type'];
switch ($type) {
	case 'topics':
		# code...
		$type='Topics';
		break;
		case 'posts':
			# code...
			$type='Posts';
			break;

	default:
		# code...
		$type='Unddefind';
		break;
}
$username=$_GET['user'];

$userPost=$db->query("SELECT * FROM users U, topics T
  WHERE U.username='$user' AND T.user_id_fk=U.uid AND T.post_type='post' ");

//count rows
$countpost=$userPost->num_rows;

$userTopic=$db->query("SELECT * FROM users U, topics T
  WHERE U.username='$user' AND T.user_id_fk=U.uid AND T.post_type='topic' ");

//count rows
$counttopics=$userTopic->num_rows;
?>
<h2>My Posts</h2>
<a href="/"><?php echo APPNAME; ?></a> / <a href="<?php echo WEBROOT."/u/$username"; ?>"> My Profile</a> / <a href="<?php echo WEBROOT."/$username/topics"; ?>"> My Topics</a>

<table>
		<tbody>
			
<?php
if ($type=='Topics')
{
	// query topic along with board id and user id
	$query_topic = $db->query("SELECT * FROM topics T, users U, sub_cat S
		WHERE T.board_id_fk=S.sid AND U.username='$user' AND T.user_id_fk=U.uid AND T.post_type='topic' GROUP BY T.topic_id  ");

	//count rows
	@$checktopic=$query_topic->num_rows;

	/*
			loop categories
			*/
	if($checktopic){
			while($data=$query_topic->fetch_assoc())
			{
			$id=$data['topic_id'];
			$title=$data['title'];
			$link=$data['link'];
			$username=$data['username'];
			$sname=$data['sname'];
			$created=$data['created'];
			// fetch categories according to board id


	$queryComment=$db->query("SELECT * FROM topic_comments C, users U
		WHERE C.topic_id='$id' AND U.username='$user' AND C.status='0' GROUP BY C.comment_id ");
	//count rows
	$checkcomment=$queryComment->num_rows; // check for existence

	$rows=$queryComment->fetch_assoc(); // populate results
	$gender=$rows['gender'];

	//check for last comment on this topic
	if($checkcomment)
	{
		$lastcomment="(<b><a href='../u/$rows[username]'>$rows[username]</a></b>)";
	}
	else
	{
	$lastcomment='- No comment yet';
	}

@$i = $i + 1;
			if($i%2 == 0)
			{ $w='w'; } 
			
			else
			{ $w=''; }
			
	echo '<tr>
				<td class="'.$w.'" id="top3543104">
				 <img src="'.WEBROOT.'/icons/smiley.gif"> <b><a href="'.WEBROOT.'/'.$id.'/'.$link.'">'.$sname.'</a></b></b> /
				 <b><a href="'.WEBROOT.'/'.$id.'/'.$link.'">'.$title.'</a></b><br>
					<span class="s">by <b><a href="u/'.$username.'">'.$username.'</a></b>. <b>'.@$checktopic.'</b> Post &amp;
			<b>'.topicCount($db,$id).'</b> Views. '.$created.' '.$lastcomment.'</span>
				</td>
			</tr>';

	}
	}
	else // if there is no topic, display below message to users
	{
		echo '<tr>
					<td class="w">
				<h2>Oops! this user has no post!</h2>
							<p>
							There is currently no topic. You can be the first to
							create topic on this board. <br>
							<span style="text-decoration: underline">
							<br>
							→ <a href="'.WEBROOT.'">Click here to return back to forum home</a>
							</p>		</td>
	</tr>';
	}
}
?>
		</tbody>
	</table>
	
<table>
		<tbody>	
	<?php

///////////////////////////////
if ($type=='Posts')
{
	// query topic along with board id and user id
	$query_topic = $db->query("SELECT * FROM topics T, users U, sub_cat S
		WHERE T.board_id_fk=S.sid AND U.username='$user' AND T.user_id_fk=U.uid AND T.post_type='post' GROUP BY T.topic_id  ");

	//count rows
	@$checktopic=$query_topic->num_rows;

	/*
			loop categories
			*/
	if($checktopic){
			while($data=$query_topic->fetch_assoc())
			{
			$id=$data['topic_id'];
			$title=$data['title'];
			$link=$data['link'];
			$username=$data['username'];
			$created=$data['created'];
			// fetch categories according to board id


	$queryComment=$db->query("SELECT * FROM topic_comments C, users U
		WHERE C.topic_id='$id' AND U.username='$user' AND C.status='0' GROUP BY C.comment_id ");
	//count rows
	$checkcomment=$queryComment->num_rows; // check for existence

	$rows=$queryComment->fetch_assoc(); // populate results
	$gender=$rows['gender'];

	//check for last comment on this topic
	if($checkcomment)
	{
		$lastcomment="(<b><a href='../u/$rows[username]'>$rows[username]</a></b>)";
	}
	else
	{
	$lastcomment='- No comment yet';
	}
	
	
@$i = $i + 1;
			if($i%2 == 0)
			{ $w='w'; } 
			
			else
			{ $w=''; }
echo '<tr>
				<td class="'.$w.'" id="top3543104">
				 <img src="'.WEBROOT.'/icons/smiley.gif"> <b><a href="'.WEBROOT.'/'.$id.'/'.$link.'">'.$sname.'</a></b></b> /
				 <b><a href="'.WEBROOT.'/'.$id.'/'.$link.'">'.$title.'</a></b><br>
					<span class="s">by <b><a href="u/'.$username.'">'.$username.'</a></b>. <b>'.@$checktopic.'</b> Post &amp;
			<b>'.topicCount($db,$id).'</b> Views. '.$created.' '.$lastcomment.'</span>
				</td>
			</tr>';

	}

	}
	else // if there is no topic, display below message to users
	{
		echo '<tr>
					<td class="w">
				<h2>Oops! this user has no post!</h2>
							<p>
							There is currently no topic. You can be the first to
							create topic on this board. <br>
							<span style="text-decoration: underline">
							<br>
							→ <a href="'.WEBROOT.'">Click here to return back to forum home</a>
							</p>		</td>
	</tr>';
	}
}
?>
	</tbody>
	</table>
	
	<?php
//////////////////////

//////////////////////////////////////////////// post  ////////////////////////////////////
if ($type=='comment')
{
	require 'incfiles/bbparser.php'; // phpbb code parser
	?>
	<!-- item container -->
	 <div id="wrapper">
      <div class="contents">

	<!-- comment here -->
	<?php
	$queryComment=$db->query("SELECT * FROM topic_comments C, users U, sub_cat S, topics T
		WHERE T.topic_id=C.topic_id AND U.username='$user' AND S.sid=C.board_id_fk AND C.status='0' AND U.uid=C.user_id ");
	//count rows
	$checkcomment=$queryComment->num_rows; // check for existence
	if($checkcomment)
	{
	while($rows=$queryComment->fetch_assoc())
	{
	$reply=$rows['comment'];
	$gender=$rows['gender'];
	$dated=$rows['commentedOn'];
	$comment_id=$rows['comment_id'];
	$comment_user=$rows['username'];
	$cgender=$rows['gender'];
	$sname=$rows['sname'];
	$surl=$rows['surl'];
	$topic_id=$rows['topic_id'];

	// switch gender
	switch($cgender)
	{
		case '1':
		$cgender='m';
		break;
		case '2':
		$cgender='f';
		break;
		case '0':
		$cgender='n/a';
		break;

	}
	$reply = badWordFilter($reply);
	// filteer bad words from comments
	?>

<div class="main_box">
	<div class="light_box">
		<a href="<?php echo WEBROOT."/$rows[topic_id]/$rows[link]"; ?>"><?php echo ucfirst($sname); ?>/<?php echo ucfirst($rows['title']); ?></a>

			by <a class="user" href="../u/<?php echo $comment_user; ?>"><?php echo ucfirst($comment_user)."($cgender)"; ?></a>: <span class="s"><b><?php echo $dated; ?></b></span>
	</div>
	<div class="dark_box" style="border: none;">
		<div class="narrow" style="text-align: left;">
					<!-- topic contnet -->
					<?php $bb = new bbParser(); echo $bb->getHtml($reply); // topic content ?>
					<!-- end topic contnet -->
				</div>
			</div>
</div>


<?php  } } ?>

<!-- navigation holder -->
</div></div>
<?php  } ?>



<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';

//load footer from footer.php
require_once ('footer.php');

?>

	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->

</body>
</html>
