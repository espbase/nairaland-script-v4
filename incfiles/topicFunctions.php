<style type="text/css">
/* mak images fill their container*/
img {
max-width: 100%;
}
/*img:hover {
opacity: 0.5;
cursor: pointer;
}
/* Bigger than Phones(tablet) */
@media only screen and (min-width: 750px) {
.img-grid {
width: 100%;
}
}
/* Bigger than Phones(laptop / desktop) */
@media only screen and (min-width: 970px) {
.img-grid {
width: 90%;
}
}
.video-container {
position: relative;
padding-bottom: 56.25%;
padding-top: 30px; height: 0; overflow: hidden;
}
.video-container iframe,
.video-container object,
.video-container embed {
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<?php
##########################################################################
																		## 																		##
															## 						post content									##
																		## 																		##
##########################################################################
function loadpost($db, $post_id, $link)
{
// To Insert Page View And Select Total Pageview
$user_ip=$_SERVER['REMOTE_ADDR']; // get user machine address code
$queryPost=$db->query("SELECT * FROM topics T, users U
	WHERE T.topic_id='$post_id' AND T.link='$link' AND T.status='0' AND U.uid=T.user_id_fk ");
//count rows
$checktopic=$queryPost->num_rows; // check for existence
if($checktopic)
{
$data=$queryPost->fetch_assoc();
$content=$data['content_text'];
$gender=$data['gender'];
$pusername=$data['username'];
$signature=$data['signature'];
$board_id=$data['board_id_fk'];
$user_id_cm=$data['user_id_fk'];
$post_status=$data['status'];
$topic_id=$data['topic_id'];
$url=$data['link'];
$title=$data['title'];
$raw_html=$data['raw_html'];
$file1=$data['file1'];
$file2=$data['file2'];
$file3=$data['file3'];
$file4=$data['file4'];
$location=$data['location'];
$thread_status=$data['thread_status'];
$post_type=$data['post_type'];
$created=$data['created'];
$time=$data['time'];
// define contnet variables
$paging_url = URL.'/'.$topic_id.'/'.$link;
$url2 =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
//$paging_url = htmlspecialchars( $newurl, ENT_QUOTES, 'UTF-8' );
//echo ltrim(strstr($paging_url, '?'), '?');
//echo '<hr>'.$pn;

$arr = explode("?", $url2);
@$pn = $arr[1];
######################## Comment pagin script ################################
// perpage on functions
if(isset($pn) & !empty($pn)){
	$curpage = $pn;
}else{
	$curpage = 1;
}
$perpage  = 30;
//echo $_GET['link'];
$start = ($curpage * $perpage) - $perpage;
$PageSql = "SELECT * FROM topic_comments C, users U
		WHERE C.topic_id='$post_id' AND C.status='0' AND U.uid=C.user_id";
$pageres = $db->query($PageSql);
$totalres = mysqli_num_rows($pageres);
$endpage = ceil($totalres/$perpage);
$startpage = 1;
$nextpage = $curpage + 1;
$previouspage = $curpage - 1;
$ReadSql = "SELECT * FROM topic_comments C, users U
		WHERE C.topic_id='$post_id' AND C.status='0' AND U.uid=C.user_id LIMIT $start, $perpage";
$res = $db->query($ReadSql);
######################## end Comment pagin script ################################
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
//echo $user_id_cm;
$queryBoard=$db->query("SELECT * FROM topics T, sub_cat S, category C
	WHERE S.sid='$board_id' AND S.cid_fk=C.cid  ");
//fetch rows
/*
Define topics, category, and sub cat details and variables
*/
@$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.
@$username=$_SESSION['username']; //Storing USERNAME in SESSION variabl
@$email=$_SESSION['email']; //Storing EMAIL in SESSION variable.
$bdata=$queryBoard->fetch_assoc();
$category_name=$bdata['name'];
$sname=$bdata['sname'];
$slink=$bdata['surl'];
$clink=$bdata['url'];
$db_ip_address=$bdata['ip_address'];
$sid=$board_id;
$countdays = date('m/d/Y', $time);
$countdays = addays($countdays);
//echo $perview;
//echo $post_type;
//echo $countdays;
############################## affiliate ###############################################################
if($user_id)
		{
			//$amtfit=$perview;
			//echo $perlogin;
		echo earnfx($topic_id, $user_id, $amtfit='3', $type='view', $user_ip,$db);
		}
		
if ($post_type=='featured' OR $post_type=='sponsored') {
	# code...
	if ($countdays >= 2) {
		$upEarn = $db->query("UPDATE topics SET earn_status=1 WHERE topic_id='$topic_id' ");
	}
//////////////////////////////////////////////////////////////////////////
	if ($countdays <= 2) {
		# code...
	
		

	}
	
//echo $earn_status;
	//echo addays($countdays);
	
}
?>
<h2><?php echo ucfirst($data['title']); ?></h2>
<p class="bold"><a href="/?"><a href="<?php echo WEBROOT; ?>"><?php echo APPNAME; ?></a> /
<a href="../<?php echo $clink; ?>"><?php echo $category_name; ?></a> /
<a href="../forum/<?php echo $slink; ?>"><?php echo $sname; ?></a> /
<a href="<?php echo WEBROOT."/$post_id/$link"; ?>"><?php echo ucfirst($data['title']) ?></a>  	
(<?php echo number_format(topicViews($db,$post_id)); ?> View's) </p>
<!-- ads here load google adsense ads template -->
<?php //require_once ('incfiles/googleads.html');
/*
display related topic
*/
############################################################################ 													display related topic  										
##########################################################################
	/*  @$titles=substr($title, 0, strpos($title, ' ', 5));
echo "<h3>Recommended:</h3>";
		$queryRelated=$db->query("SELECT * FROM topics
			WHERE title LIKE '%$titles%' AND title='$title' ");
			while ($rel=mysqli_fetch_assoc($queryRelated)) {
				# code...
				$title=$rel['title'];
				$tid=$rel['topic_id'];
				$ref=$rel['link'];
				echo "<b><a href='../$tid/$ref'>$title</a> </b> /<br>";
			}
	
	/*
	end display related topic
	*/
$array = str_split("$title", 7);
$array1 = $array[0];
@$array2 = $array[1];
@$array3 = $array[2];
// $array[1] = bb
	// $array[2] = cc  etc ...
$queryRelated=$db->query("SELECT * FROM topics
			WHERE title LIKE '%$array1%' OR title LIKE '%$array2%' ORDER BY RAND() LIMIT 4 ");
			while ($rel=mysqli_fetch_assoc($queryRelated)) {
				# code...
				$title=$rel['title'];
				$tid=$rel['topic_id'];
				$ref=$rel['link'];
				
				@$i = $i + 1;
			if($i%2 == 0)
			{ $color='#1ecbb8'; }
			
			else
			{ $color=''; }
				echo "<small><a href='../$tid/$ref'>".ucwords(strtolower($title))."</a> •</small> ";
			}
			
///////////////////////////////////////////
$qryConfig = $db->query("SELECT * FROM `site_config` ");			
$data1=mysqli_fetch_array($qryConfig);
  
  $adlinker = $data1['adlink'];
  $defaultadurl = $data1['adimg'];
  $adspace = $data1['adspace'];
  
	require ('ads.php');
	
	
	if($gender==1)
	{
	$genderc='f';
	}
	else
	{
	$genderc='m';
	}
	
	if($signature)
	{
	$classsign='';
	$bb1 = new bbParser();
				
	$signlot='<tr><td id="posig52331925" class="l pd sig  w">'.$bb1->getHtml($signature).'</td></tr>';
	}
	else
	{
	$classsign='pd';
	}


if ($totalres) {
?>
<?php if($curpage >= 2){ ?>
<a class="" href="<?php echo $paging_url; ?>?1">(First)</a>
<?php } ?>
<?php if($curpage >= 2){ ?>
<a class="" href="<?php echo $paging_url; ?>?<?php echo $previouspage ?>">(<?php echo $previouspage ?>)</a>
<?php } ?>
<a class="" href="<?php echo $paging_url; ?>?<?php echo $curpage ?>" style="font-weight: bold;">(<?php echo $curpage ?>)</a>
<?php if($curpage != $endpage){ ?>
<a class="" href="<?php echo $paging_url; ?>?<?php echo $nextpage ?>">(<?php echo $nextpage ?>)</a>
<a class="" href="<?php echo $paging_url; ?>?<?php echo $endpage ?>">(Last Page)</a>
<?php } ?>
| (<span style="font-weight: bold"><?php echo $curpage ?></span> of <?php echo $endpage; ?> pages)
<?php } ?>
<span style="font-weight: bold;"><a href="#down">(Go Down)</a> <?php if($thread_status=='0'){ ?>(<a href="<?php echo WEBROOT."/comment/$post_id/$board_id/$url"; ?>">» Reply topic</a>)<?php } ?>
</span>


<table summary="posts">
<tbody>
	<tr>
		<td class="bold l pu user">
			<a id="<?php echo $data['topic_id']; ?>" name="<?php echo $data['topic_id']; ?>"></a>
			<a id="msg<?php echo $data['topic_id']; ?>" name="msg<?php echo $data['topic_id']; ?>"></a>
			<a href="/<?php echo "$data[topic_id]/$data[link]"; ?>"><?php echo ucfirst($data['title']); ?></a>
			by <a class="user" href="../u/<?php echo $data['username']; ?>" title="Location: <?php echo $location; ?>"><?php echo ucfirst($pusername); ?></a>(<span class="<?php echo  $genderc; ?>"><?php echo  $gender; ?></span>):
			<span class="s"><b><?php echo ($data['created']); ?></b></span>
		</td>
	</tr>
	<tr>
		<td class="l w <?php echo $classsign; ?>" id="pb78631384">
			<div class="narrow" style="word-wrap: break-word;">
				<?php
				//$TopicCleaned = badWordFilter($content);
				$bb = new bbParser();
				echo $bb->getHtml($content);
				?>
			</div>
			
			<?php
				$sql_relation= $db->query("SELECT * FROM likes WHERE uid_fk='$user_id' AND topic_id_fk='{$topic_id}' AND comment_type='topic' ");
			$checkCount=$sql_relation->num_rows;
			$sqllikes= $db->query("SELECT  *  FROM likes WHERE topic_id_fk='{$topic_id}' AND comment_type='topic' ");
			$likesCount=$sqllikes->num_rows; //count post likes
			//if ($user_id) {//loggged in
			?>
			<p class="s">
				<?php
				if ($user_id) {//loggged in
				if($thread_status==0)
				{
				?>
				(<a href="<?php echo WEBROOT; ?>/quotereply?url=<?php echo $url; ?>&amp;board=<?php echo $board_id; ?>&amp;topic=<?php echo $topic_id; ?>&amp;creator=<?php echo $user_id_cm; ?>&amp;quote_id=<?php echo $topic_id; ?>&amp;commentid=0">Quote</a>)
				<?php } ?>
				<!--(<a href="<?php echo "/report/$post_id/$board_id/$url"; ?>">Report</a>)-->
				(<a href="<?php echo WEBROOT; ?>/makereport?redirect=<?php echo $url; ?>&amp;topic=<?php echo $post_id; ?>">Report</a>)
				<?php
				}//
				
				if ($likesCount==1) {
				echo "$likesCount Like";
				}
				elseif ($likesCount>1)
				{
					echo "$likesCount Likes";
				}
				else
				{}
				?>
				<?php
				if ($user_id) {//loggged in
					
				if ($checkCount) { // check if already liked
				?>
				<span class="btn btn-default btn-xs liked loved m" id="loved<?php echo $topic_id; ?>" name="<?php echo $topic_id; ?>" style="cursor: pointer; text-decoration:underline">
				(Unlike)</span>
				<small id="showpanel<?php echo $topic_id; ?>">.</small>
				<?php } // if not please display like button
				else { ?>
				<span class="btn btn-default btn-xs love m" id="love<?php echo $topic_id; ?>" name="<?php echo $topic_id; ?>" style="cursor: pointer;  text-decoration:underline"> (Like)</span>
				<small id="showpanel<?php echo $topic_id; ?>">.</small>
				<?php }
				##########################################################################
																		## 																		##
												## 			topic like reactions end									##
																		## 																		##
				##########################################################################
				/*
				shares
				*/
				$sql_relationShared= $db->query("SELECT * FROM shares WHERE uid_fk='$user_id' AND topic_id_fk='$topic_id' ");
				$countShared=mysqli_num_rows($sql_relationShared);
				//echo $checkCountShared;
				if ($countShared) { // check if already shared
				?>
				<span class="btn btn-default btn-xs sharereact shared" id="sharereact<?php echo $topic_id; ?>" name="<?php echo $topic_id; ?>" style="cursor: pointer;  text-decoration:underline">
				(Un-Share)</span>
				<small id="showpanel<?php echo $topic_id; ?>">.</small>
				<?php } // if not please display share button
				else { ?>
				<span class="btn btn-default btn-xs share" id="share<?php echo $topic_id; ?>" name="<?php echo $topic_id; ?>" style="cursor: pointer;   text-decoration:underline"> (Share)</span>
				<small id="showpanel<?php echo $topic_id; ?>">.</small>
				<?php } }
				##########################################################################
																		## 																		##
													## 			ADMIN CONTROL MANAGE										##
																		## 																		##
				##########################################################################
				// if it is admin show banned topic link
				$checkAccesslevel=$db->query("SELECT * FROM users WHERE uid='$user_id' ");
				$do_exist=$checkAccesslevel->num_rows;
				
				if($do_exist) // if is admin
				{
				$data1=$checkAccesslevel->fetch_assoc();
				$access=$data1['access']; // get access level

				if ($user_id===$user_id_cm OR $access=='admin' OR $access=='mod') {
					echo '<a href="'.WEBROOT.'/do_edit_topic.php?id='.$post_id.'"> (Modify) </a>';
				}

				if ($user_id===$user_id_cm OR $access=='admin') {
					echo '<a href="'.WEBROOT.'/delete-topic/'.$topic_id.'/'.$board_id.'/'.$url.'"> (Delete) </a> ';
				}

				if($access=='admin' OR $access=='mod') // get permission
				{
				echo '<a href="'.WEBROOT.'/move-topic?id='.$topic_id.'"> (Move topic) </a> ';
					echo '<a href="'.WEBROOT.'/banned/'.$post_id.'/'.$board_id.'/'.$url.'"> (Ban) </a>';
				// create admin post url
				
				if($thread_status=='0')
				{
				echo '<a href="'.WEBROOT.'/close-thread.php?topic='.$topic_id.'&link='.$url.'">(Close Thread)</a>';
				}
				else
				{
				echo '<a href="'.WEBROOT.'/open-thread.php?topic='.$topic_id.'&link='.$url.'"> (Open Thread) </a>';
				}
				///
				}

				}
				//user level access token
				// /do_edit_topic.php?id=23
				
				
			?></p>
			
			<p><?php
				if($file1)
				{
				echo '<img src="'.WEBROOT.'/'.$file1.'" id="img-" alt="Topic image 1"/> ';
				}
				if($file2)
				{
				echo ' <img src="'.WEBROOT.'/'.$file2.'" id="img-" alt="Topic image 2"/>';
				}
				if($file3)
				{
				echo ' <img src="'.WEBROOT.'/'.$file3.'" id="img-" alt="Topic image 3"/> ';
				}
				if($file4)
				{
				echo ' <img src="'.WEBROOT.'/'.$file4.'" id="img-" alt="Topic image 4"/>';
				}
			?></p>
		</td>
	</tr>
	<?php echo @$signlot; ?>
	
	
	
	<!--
	######################### comment
	-->
	<?php
	while($rows = mysqli_fetch_array($res)){
	$reply=$rows['comment'];
	$gender=$rows['gender'];
	$dated=$rows['commentedOn'];
	$comment_id=$rows['comment_id'];
	$comment_uid=$rows['user_id'];
	$comment_user=$rows['username'];
	$signaturecomment=$rows['signature'];
	$cgender=$rows['gender'];
	$comment_id_fk=$rows['comment_id_fk'];
	$comment_creator=$rows['creator'];
	$topic_quote=$rows['quote_id'];
	$com_file1=$rows['file1'];
	$com_file2=$rows['file2'];
	$com_file3=$rows['file3'];
	$com_file4=$rows['file4'];
	//echo "$topic_quote";
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
	if($signaturecomment)
	{
	$classsign1='';
	$bb2 = new bbParser();
		
	$signcomment='<tr><td id="posig52331925" class="l pd sig  w">'.$bb2->getHtml($signaturecomment).'</td></tr>';
	}
	else
	{
	$classsign1='pd';
	}
	
	?>
	
	<tr>
		<td class="bold l pu">
			<b><a href="../<?php echo "$data[topic_id]/$data[link]"; ?>">RE: <?php echo ($data['title']); ?></a></b>
			by <a class="user" href="../u/<?php echo $comment_user; ?>"><?php echo ucfirst($comment_user)."<span class='m'>($cgender)</span>"; ?></a>: <span class="s"><b><?php echo $dated; ?></b></span>
		</td>
	</tr>
	<tr>
		<td class="l w <?php echo $classsign1; ?>" id="pb78631427">
			<div class="narrow">
				<?php $bb = new bbParser();
				$comQuery=$db->query("SELECT * FROM topic_comments TC, users U, profile P, topics TP
				WHERE TP.topic_id='$topic_id'
				AND TC.comment_id_fk='$comment_id_fk'
				AND U.uid=TC.user_id
				AND TP.board_id_fk='$board_id'
				");
				$checkcomment1=$comQuery->num_rows;
				if($checkcomment1)
				{
				$rowR=mysqli_fetch_array($comQuery);
				$comment_user=$rowR['username'];
				$commentReply=$rowR['comment'];
				$comment_id_fk=$rowR['comment_id_fk'];
				$user_id_fk=$rowR['user_id'];
				$avater=$rowR['avater'];
				$comment_creator=$rowR['creator'];
				$qfile1=$rowR['file1'];
				$quote_file1=$rowR['file1'];
				$quote_file2=$rowR['file2'];
				$quote_file3=$rowR['file3'];
				$quote_file4=$rowR['file4'];
				if ($comment_creator)
				{
				if ($comment_id_fk) {
				//echo $comment_id_fk.'---------------------';
				echo "<blockquote><a href='".WEBROOT."/u/$comment_user'><b>$comment_user</b> Said</a>:<br>".$bb->getHtml($commentReply)."</blockquote>";
				}
				}
				}
				
				
				if ($topic_quote) { // if user quote topic
				$queryQuoteTopic=$db->query("SELECT * FROM topics T, users U
				WHERE T.topic_id='$topic_quote' AND U.uid=T.user_id_fk  ");
				//fetch rows
				$rowQuote=mysqli_fetch_array($queryQuoteTopic);
				$topic_content2=$rowQuote['content_text'];
				$topic_user=$rowQuote['username'];
				$topic_k=$rowQuote['topic_id'];
				$avater=$rowQuote['avater'];
				$topic_file1=$rowQuote['file1'];
				$topic_file2=$rowQuote['file2'];
				$topic_file3=$rowQuote['file3'];
				$topic_file4=$rowQuote['file4'];
				echo "<blockquote class='w'> <a href='".WEBROOT."/u/$topic_user'><b>$topic_user</b></a>:<br>".$bb->getHtml($topic_content2);
				if($topic_file1)
				{
				echo '<br><img src="'.WEBROOT.'/'.$topic_file1.'" id="img-" alt="comment image 1"/>';
				}
				if($topic_file2)
				{
				echo '<br><img src="'.WEBROOT.'/'.$topic_file2.'" id="img-" alt="comment image 1"/>';
				}
				if($topic_file3)
				{
				echo '<br><img src="'.WEBROOT.'/'.$topic_file3.'" id="img-" alt="comment image 1"/>';
				}
				if($topic_file4)
				{
				echo '<br><img src="'.WEBROOT.'/'.$topic_file4.'" id="img-" alt="comment image 1"/>';
				}
			echo "</blockquote>";
			}
			// topic content
			echo $bb->getHtml($reply); //quote comment content
			
			
			
			
			///////////////////////////////////////////////////////////////
			?>
			<p class="s">
				<?php
				############################### Comment likes ############################
						$sql_relationComments= $db->query("SELECT * FROM likes WHERE uid_fk='$user_id' AND topic_id_fk='{$comment_id}' AND comment_type='comment'");
								$checkCountComments=$sql_relationComments->num_rows;
								
								$sqlCommentlikes= $db->query("SELECT * FROM likes WHERE topic_id_fk='{$comment_id}' AND comment_type='comment'");
								$likesCountComment=$sqlCommentlikes->num_rows;
								//count post likes
				if ($user_id) {//loggged in
									if($thread_status==0)
									{
				?>
				(<a href="<?php echo WEBROOT; ?>/quotereply?url=<?php echo $url; ?>&amp;board=<?php echo $board_id; ?>&amp;topic=<?php echo $topic_id; ?>&amp;creator=<?php echo $comment_uid; ?>&amp;commentid=<?php echo $comment_id; ?>">Quote</a>)
				<?php } ?>
				(<a href="<?php echo WEBROOT; ?>/makereport?redirect=<?php echo $url; ?>&amp;topic=<?php echo $post_id; ?>">Report</a>)
				<?php
				}//logged in
				if ($likesCountComment==1) {
				echo "$likesCountComment Like";
				}
				elseif ($likesCountComment>1)
				{
					echo "$likesCountComment Likes";
				}
				else
				{}
				
				if ($user_id) {//loggged in
				if ($checkCountComments) { // check if already liked
				?>
				<span class="btn btn-default btn-xs cliked cloved" id="cloved<?php echo $comment_id; ?>" name="<?php echo $comment_id; ?>" style="cursor: pointer; text-decoration:underline">
				(Unlike)</span>
				<small id="cshowpanel<?php echo $comment_id; ?>">.</small>
				<?php } // if not please display like button
				else { ?>
				<span class="btn btn-default btn-xs clove" id="clove<?php echo $comment_id; ?>" name="<?php echo $comment_id; ?>" style="cursor: pointer; text-decoration:underline"> (Like)</span>
				<small id="cshowpanel<?php echo $comment_id; ?>">.</small>
				<?php } }
				
				//user level access token
				//echo "$comment_uid/ $user_id";
				if ($user_id===$comment_uid OR $access=='admin' OR $access=='mod') {
					echo '<a href="'.WEBROOT.'/edit-comment.php?commentid='.$comment_id.'&topic='.$topic_id.'&link='.$url.'">(Modify)</a>';
				}

				if ($user_id===$comment_uid OR $access=='admin') {
					echo '<a href="'.WEBROOT.'/delete-comment.php?deletecomment='.$comment_id.'&topic='.$topic_id.'&link='.$url.'">(Delete)</a>';
				}
				
				
				/////////////////////////////////////////////////////////
				echo "<br/>";
				if($com_file1)
				{
				echo '<a href="'.WEBROOT.'/'.$com_file1.'" target="_blank" title="Enlarge Photo"><img src="'.WEBROOT.'/'.$com_file1.'"  id="img-"  alt="comment image 1"/></a> ';
				}
				if($com_file2)
				{
				echo '<a href="'.WEBROOT.'/'.$com_file2.'" target="_blank" title="Enlarge Photo"><img src="'.WEBROOT.'/'.$com_file2.'"  id="img-"  alt="comment image 1"/></a> ';
				}
				if($com_file3)
				{
				echo '<a href="'.WEBROOT.'/'.$com_file3.'" target="_blank" title="Enlarge Photo"><img src="'.WEBROOT.'/'.$com_file3.'"  id="img-"  alt="comment image 1"/></a> ';
				}
				if($com_file4)
				{
				echo '<a href="'.WEBROOT.'/'.$com_file4.'" target="_blank" title="Enlarge Photo"><img src="'.WEBROOT.'/'.$com_file4.'"  id="img-"  alt="comment image 1"/></a> ';
				}
				?>
				
				
			</td>
		</tr>
		<?php
		echo $signcomment;
			}
			
		?>
	</tbody>
</table>

<?php if($thread_status=='0'){ 
if ($totalres) {
	?>
<?php if($curpage >= 2){ ?>
<a class="" href="<?php echo $paging_url; ?>?1">(First)</a>
<?php } ?>
<?php if($curpage >= 2){ ?>
<a class="" href="<?php echo $paging_url; ?>?<?php echo $previouspage ?>">(<?php echo $previouspage ?>)</a>
<?php } ?>
<a class="" href="<?php echo $paging_url; ?>?<?php echo $curpage ?>" style="font-weight: bold;">(<?php echo $curpage ?>)</a>
<?php if($curpage != $endpage){ ?>
<a class="" href="<?php echo $paging_url; ?>?<?php echo $nextpage ?>">(<?php echo $nextpage ?>)</a>
<a class="" href="<?php echo $paging_url; ?>?<?php echo $endpage ?>">(Last Page)</a>
<?php } ?>
| (<span style="font-weight: bold"><?php echo $curpage ?></span> of <?php echo $endpage; ?> pages)
<?php } ?>
(<a href="<?php echo URL."/comment/$post_id/$board_id/$url"; ?>"><b>» Reply topic</b></a>)
<span style="font-weight: bold;"><a href="#up">(» Go Up)</a></span>

<?php } ?>
<?php
if ($user_id)
{
}

else
{
// echo '<span class="s">Please <a href="'.URL.'/k=kenyans247" title="create account">register</a> or <a href="'.URL.'/login" title="login">login</a> to post a comment</span>';
}
?>
<?php
##########################################################################
																	## 																		##
												## 			Comment pagination ajax										##
																	## 																		##
##########################################################################
?>

<table class="boards">
			<tbody>
					<tr>
							<td class="featured w">
									<div id="box"></div>
				<div class="sharethis-inline-reaction-buttons"></div>
									
							</td>
					</tr>
				
			</tbody>
</table>

<table class="boards">
	<tbody>
		<tr>
			<td class="w">
			    
                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_inline_share_toolbox"></div>
            
			<!--<div style="display:inline-block">
				<a data-pin-do="buttonBookmark" data-pin-tall="true" data-pin-lang="en" href="https://www.pinterest.com/pin/create/button/"></a>
			</div>-->
		</td>
	</tr>
	
	
</tbody>
</table>

<h4>Recommended for you</h4>
<?php
// related post

	// $array[2] = cc  etc ...
$queryRelated1=$db->query("SELECT * FROM topics
			WHERE title LIKE '%$array1%' OR title LIKE '%$array2%' ORDER BY RAND() LIMIT 4 ");
			while ($rel=mysqli_fetch_assoc($queryRelated1)) {
				# code...
				$title=$rel['title'];
				$tid=$rel['topic_id'];
				$ref=$rel['link'];
				
				@$i = $i + 1;
			if($i%2 == 0)
			{ $color='#1ecbb8'; }
			
			else
			{ $color=''; }
				echo "<small>» <a href='../$tid/$ref'>".ucwords(strtolower($title))."</a> </small>";
			}
			///////////////////////////////////////////////////
//load system header ads template
require ('ads.php');
?>
<!-- navigation holder
<div class="holder">
</div>
generated comment link -->
<style type="text/css">
li
{
cursor: pointer;
display: inline-block;
font-size: 30px;
list-style-type: none;
}
.star,
.rating:not(.vote-cast):hover .star:hover ~ .star,
.rating.vote-cast .star.selected ~ .star
{
/* normal state */
color: black;
}
.rating:hover .star,
.rating.vote-cast .star
{
/* highlighted state */
color: red;
}
</style>
<?php
	}
	else
	{
		if ($link) {
			echo '
	<h1>Oops! error 404, this topic has been flagged or banned</h1>';
			echo '<h3><a href="'.WEBROOT.'/appeal/'.$post_id.'/'.$link.'">Appeal for re-publication</a></h3>
	<table>
<tr>
	<td class="w"><p>If this was an error, please send a message to the site admin to fix it, thank you for making our forum a better place.</p>
</td>
</tr>
</table>';
		}
		else
		{
		echo '<h1>Oops! page not found</h1>';
	echo '<table>
<tr>
<td class="w"><p>If this was an error, please send a message to the site admin to fix it, thank you for making '.APPNAME.' a better place.</a></p>
</td>
</tr>
</table>';
		}
	

	
	}
}


?>
<script type="text/javascript">
$(document).ready(function(){
$("#example-four").on("click", function() {
$(this).toggleClass("like");
//$("#td_id").toggleClass('change_me newClass');
});
});
</script>
<style type="text/css">
#example-four {
position: relative;
}
#example-four.on:after {
content: "(Like)";
position: absolute;
top: 0;
left: 0;
right: 0;
bottom: 0;
background: white;
text-decoration: underline;
}
#example-five {
position: relative;
}
#example-five-checkbox {
display: none;
}
#example-five-checkbox:checked + #example-five:after {
content: "(Unlike)";
position: absolute;
top: 0;
left: 0;
right: 0;
bottom: 0;
background: white;
}
</style>

