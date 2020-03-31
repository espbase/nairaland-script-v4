<table>
		<tbody>

<?php

/*
fetch board form database
*/
$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.

//echo "$user_id";

require_once ('incfiles/topicCount.php'); // count page view function

$QueryFT=$db->query("SELECT * FROM followed_topics FT, topics T, users U
	WHERE  FT.user_id_fk='$user_id' AND FT.topic_id_fk=T.topic_id AND FT.user_id_fk=U.uid AND T.post_type='topic'");
$countFT=mysqli_num_rows($QueryFT);


// category title block
echo '<tr>
		<th><b> <h2>Topic You Follwed .:: </h2></th>
	</tr>';

if($countFT){

		while($data=$QueryFT->fetch_assoc())
		{
		$id=$data['topic_id_fk'];
		$content=$data['content_text'];
		$gender=$data['gender'];
		$username=$data['username'];
		$board_id=$data['board_id_fk'];
		$post_status=$data['status'];
		$topic_id=$data['topic_id'];
		$link=$data['link'];
		$title=$data['title'];
		$topic_user=$data['user_id_fk'];
		$created=$data['created'];
		// fetch categories according to board id


$queryComment=$db->query("SELECT * FROM topic_comments C, users U
	WHERE C.topic_id='$topic_id' AND C.status='0' GROUP BY C.comment_id ");
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


$querytopic=$db->query("SELECT * FROM topics
	WHERE topic_id='$topic_id' AND user_id_fk='$topic_user' ");
//count rows
$checktopic=$querytopic->num_rows; // check for existence


// Sub category block title
echo '<tr>
<td id="top519" class="w" "="">
   <img src="'.WEBROOT.'/icons/smiley.gif"> <b>
	<a href="'.WEBROOT.'/'.$topic_id.'/'.$link.'">'.$title.'</a></b><br>
	<span class="s">by <b><a href="u/'.$username.'">'.$username.'</a></b>. <b>'.$checktopic.'</b> Post &amp;
		<b>'.topicCount($db,$id).'</b> Views. '.$created.' '.$lastcomment.'</span>
		</td>
	</tr>';
}

}
else
{
	echo '<tr>
				<td class="w">
			<h2>Oops! no topic yet</h2>
						<p>
						This board contain no topic. <br>
						→ <a href="'.WEBROOT.'">Click here to return back to forum home</a>
						</p>		</td>
</tr>';
}

?>
 <!--END CONTAINER SEARCH TOPICS-->
</tbody>
</table>
