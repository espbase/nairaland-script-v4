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
echo Checkuser();

require_once 'incfiles/theme/head_open.php';
############################### page title #######################
	$user=$_GET['user'];
	$page_title=$user.'My Liked Post';
	$site_dsc=$user.'My Liked Post';

require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

################################# include files ##########################

//load header.php
require_once ('header.php');

require_once ('incfiles/topicCount.php'); // count page view function
require 'incfiles/bbparser.php'; // phpbb code parser

echo '<a id="top" name="top"></a>'; // anchor
?>
<div class="">
	<div class="">
	<div class="dark_box" style="border: none; text-align:center">
		<h2><?php echo ucfirst($ses_username); ?>'s Post Liked</h2>

<p> <a href="<?php echo WEBROOT ?>"> <?php echo APPNAME; ?></a> /
	<a href="<?php echo WEBROOT."/u/$ses_username"; ?>"><?php echo "$ses_username"; ?>'s Profile</a></p>
</div>
</div>


	</div>
<table>
		<tbody>
<?php

	// query topic along with board id and user id
	$query_topic = $db->query("SELECT * FROM topics T, users U, sub_cat S, likes L
		WHERE T.board_id_fk=S.sid AND T.user_id_fk=U.uid AND T.topic_id=L.topic_id_fk AND L.comment_type='topic' AND L.uid_fk='$ses_user_id' ORDER BY L.topic_id_fk DESC  ");

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
				$content=$data['content_text'];
			// fetch categories according to board id
			
			// topic content
	$TopicCleaned = badWordFilter($content);



$queryComment=$db->query("SELECT * FROM topic_comments C, users U
		WHERE C.topic_id='$id' AND U.uid=C.user_id GROUP BY C.comment_id ");
	//count rows
	$checkcomment=$queryComment->num_rows; // check for existence

	$rows=$queryComment->fetch_assoc(); // populate results
	$gender=$rows['gender'];
	$commetusesr=$rows['username'];

	//check for last comment on this topic
	if($checkcomment)
	{
		$lastcomment="(<b><a href='../u/$rows[username]'>$commetusesr</a></b>)";
	}
	else
	{
	$lastcomment='- No comment yet';
	}

	// Sub category block title
	echo '<tr>
				<td class="bold l pu">
	   <img src="'.WEBROOT.'/icons/xx.gif"> <b>
		<a href="'.WEBROOT.'/'.$id.'/'.$link.'">'.$title.'</a></b><br>
		<span class="s">by <b><a href="u/'.$username.'">'.$username.'</a></b>. <b>'.@$checktopic.'</b> Post &amp;
			<b>'.topicCount($db,$id).'</b> Views. '.$created.' '.$lastcomment.'</span>
			</td>
			</tr>';
				?>
				<tr>
				<td class="l w pd" id="pb72884735">
					<div class="narrow">
				<?php $bb = new bbParser(); echo $bb->getHtml($TopicCleaned); // topic content ?>
				</div>
				</td>
			</tr>
				<?php
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

?>
</tbody>
	</table>


<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

?>

</body>
</html>
