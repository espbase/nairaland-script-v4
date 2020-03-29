<table>
		<tbody>
		<tr>
		<th><b> Posts</b> / <a href="#">Most Views</a> / <a href="#">Newest</a></th>
	</tr>			

<!-- List of topic Found here -->
		<?php

$comQuery=$db->query("SELECT * FROM users U, profile P, topics TP,sub_cat S
  WHERE TP.board_id_fk='$sub_alias' 
  AND U.uid=TP.user_id_fk GROUP BY TP.topic_id ORDER BY TP.topic_id DESC

  ");

$countR=mysqli_num_rows($comQuery);
if ($countR) {
	# code...
while($rowR=mysqli_fetch_array($comQuery))
{
$author=$rowR['username'];
$authorId=$rowR['user_id_fk'];
$title=$rowR['title'];
$board=$rowR['sname'];
$link=$rowR['link'];
$topic_id=$rowR['topic_id'];
$created=$rowR['created'];
$topic_elaps=$rowR['time'];

$pageviews = $db->query("SELECT * FROM pageviews WHERE topic_id='$topic_id' ");
$total_pageviews = mysqli_num_rows($pageviews);
$row=mysqli_fetch_array($pageviews);
$views=$row['views'];

$userpost = $db->query("SELECT * FROM topics WHERE user_id_fk='$authorId' ORDER BY RAND() LIMIT 0,15");
$authorpost = mysqli_num_rows($userpost);
$sql_topicTotal= $db->query("SELECT * FROM topic_comments WHERE  topic_id='$topic_id' ");

$lastCommenter = $db->query("SELECT * FROM topic_comments T, users U WHERE T.topic_id='$topic_id' AND T.user_id=U.uid ");
$countC = mysqli_num_rows($lastCommenter);
$row1=mysqli_fetch_array($lastCommenter);
if ($countC) {
	$fk_username=$row1['username'];
}
else
{
	$fk_username=$author;
}


echo '<tr>	
		<td id="top519" '.(($c = !$c)?' class="w"':'').'"><a name="519"></a> <img src="http://www.rivroom.com/images/normal_post.gif"> <b><a href="topic/'.$link.'">'.$title.'</a> </b><br>';
		if ($topic_elaps>=$elaps) {
			echo '<img src="http://www.rivroom.com/images/new.gif">';
		}
		else
		{

		}
		echo '<span class="s">by <b><a href="m/'.$author.'">'.$author.'</a></b>. <b>'.number_format($authorpost).'</b> Post &amp; <b>'.number_format($views).'</b> Views. '.$created.' (<b><a href="m/'.$fk_username.'">'.$fk_username.'</a></b>)</span></td>
	
	</tr>';

}
}
else
{
	echo '<tr>
				<td class="w">
			<h2>Oops! Start A New Topic!</h2>
						<p>
						There is currently no topic on this board. You can be the first to 
						create topic on this board. <br>
						<span style="text-decoration: underline">
						<a href="newtopic">Click here to start a new topic</a></span> →<br><br>
						→ <a href="'.$site_address.'">Click here to return back to forum home</a>
						</p>		</td>
</tr>';
}

?>
 <!--END CONTAINER SEARCH TOPICS-->
</tbody>
</table>
