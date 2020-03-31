<?php
/*
fetch board form database
*/
$query_cat = $db->query("SELECT * FROM sub_cat WHERE surl='$geturl' ");
//count rows
$check=$query_cat->num_rows;
$data=$query_cat->fetch_assoc();
$sid=$data['sid'];
$cid=$data['cid_fk'];
$sname=$data['sname'];
$dsc=$data['dsc'];
$ads_dsc=$data['ad_dsc'];
//echo $sid;
if($check){
// related board -->
$query_rel = $db->query("SELECT * FROM sub_cat WHERE sname LIKE '%$sname%' ");
//count rows
$checkrel=$query_rel->num_rows;
if ($checkrel) {
$dat=$query_rel->fetch_assoc();
$sidr=$dat['sid'];
$snamer=$dat['sname'];
$surlr=$dat['surl'];
$dscr=$dat['dsc'];
$query_topic1 = $db->query("SELECT * FROM topics WHERE board_id_fk='$sidr' ");
//count rows
$checktopicrel=$query_topic1->num_rows;
?>
<table summary=""><tbody><tr><td>
	<b><a href="<?php echo $pageurl; ?>"><?php echo "$snamer"; ?></a></b>: <?php echo "$dscr <b>($checktopicrel topics)</b>"; ?>
</td></tr></tbody></table>
<?php } ?>
<!-- end related board -->
<p><?php echo "<b><a href=''> $sname:</a></b> <b>Ad Rate:</b> <a href='".URL."/adrates'> $ads_dsc</a>"; ?></p>
<?php
	//load footer from ads.php
require ('ads.php');
	
?>
<b>(<a href="<?php echo WEBROOT.'/newtopic/'.$sid; ?>">Create New Topic</a> )
<?php
@$checkmat=$db->query("SELECT * FROM followed_boards WHERE user_id_fk='$user_id' AND board_id_fk='$sid' ");
$val=mysqli_num_rows($checkmat);
if ($val) {
// already followed_board
echo '(<a class="unft"  href="'.WEBROOT.'/do_unfollowboard?board='.$sid.'&amp;session='. session_id().'&amp;redirect='.$geturl.'">Un-Follow</a>)';
}
else
{
echo '(<a class="unft"  href="'.WEBROOT.'/do_followboard?board='.$sid.'&amp;session='. session_id().'&amp;redirect='.$geturl.'">Follow</a>)';
}
?>
(<a href="<?php echo WEBROOT."/mailmods?board=$sid"; ?>">Mail Mods</a>) </b></p>


<?php
// query topic along with board id and user id
// perpage on functions
if(isset($_GET['pn']) & !empty($_GET['pn'])){
    $curpage = $_GET['pn'];
}else{
    $curpage = 1;
}
$perpage  = 30;
$start = ($curpage * $perpage) - $perpage;
$PageSql = "SELECT * FROM topics T, users U
	WHERE T.board_id_fk='$sid' AND T.user_id_fk=U.uid ORDER BY T.topic_id DESC";
$pageres = $db->query($PageSql);
$totalres = mysqli_num_rows($pageres);

$endpage = ceil($totalres/$perpage);
$startpage = 1;
$nextpage = $curpage + 1;
$previouspage = $curpage - 1;

$ReadSql = "SELECT * FROM topics T, users U
	WHERE T.board_id_fk='$sid' AND T.user_id_fk=U.uid ORDER BY T.topic_id DESC LIMIT $start, $perpage";
$res = $db->query($ReadSql);
if ($totalres) {

?>
<table>
	<tbody>
		<?php
		if ($totalres) {
			?>
		<tr>
    <td>
        <?php if($curpage >= 2){ ?>
        <a class="" href="<?php echo URL.'/forum/'.$geturl; ?>/1">(First)</a>
        <?php } if($curpage >= 2){ ?>
        <a class="" href="<?php echo URL.'/forum/'.$geturl; ?>/<?php echo $previouspage ?>">(<?php echo $previouspage ?>)</a>
        <?php } ?>
        <a class="" href="<?php echo URL.'/forum/'.$geturl; ?>/<?php echo $curpage ?>" style="font-weight: bold">(<?php echo $curpage ?>)</a>
        <?php if($curpage != $endpage){ ?>
        <a class="" href="<?php echo URL.'/forum/'.$geturl; ?>/<?php echo $nextpage ?>">(<?php echo $nextpage ?>)</a>
        <a class="" href="<?php echo URL.'/forum/'.$geturl; ?>/<?php echo $endpage ?>">(Last Page)</a>
        <?php } ?>
       (<span style="font-weight: bold"><?php echo $curpage ?></span> of <?php echo $endpage; ?> pages)
    </td>
</tr>
<?php	
}	
while($data = mysqli_fetch_array($res)){
$id=$data['topic_id'];
$title=$data['title'];
$link=$data['link'];
$username=$data['username'];
$created=$data['created'];

$queryComment=$db->query("SELECT * FROM topic_comments C, users U
WHERE C.topic_id='$id' AND C.status='0' GROUP BY C.comment_id ");
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
$lastcomment='';
}
@$i = $i + 1;
if($i%2 == 0)
{ $w=''; }

else
{ $w='w'; }

echo '<tr>
	<td id="top519" class="'.$w.'">
		<img src="'.WEBROOT.'/icons/sticky.gif"> <b>
		<a href="'.WEBROOT.'/'.$id.'/'.$link.'">'.$title.'</a></b><br>
		<span class="s">by <b><a href="../u/'.$username.'">'.$username.'</a></b>. <b>'.@$checktopic.'</b> Post &amp;
	<b>'.topicCount($db,$id).'</b> Views. '.$created.' '.$lastcomment.'</span>
</td>
</tr>';
}
}
else
{
echo '<tr>
	<td class="w">
		<h2>Oops! No Post</h2>
		<p>
			This board seems quiet, please be the first to publish post. <br>
			→ <a href="'.URL.'/newtopic/'.$sid.'">Click here to start</a>
		</p>		</td>
	</tr>';
	}
}
else
{
echo '<tr>
	<td class="w">
		<h2>Oops! 404 Page not Found</h2>
		<p>
			You might have misspelled or enter a wrong URL<br>
			→ <a href="'.URL.'">Click here to return back to forum home</a>
		</p>		</td>
	</tr>';
	}

	if ($totalres) {
			?>
		<tr>
    <td>
        <?php if($curpage >= 2){ ?>
        <a class="" href="<?php echo URL.'/forum/'.$geturl; ?>/1">(First)</a>
        <?php } if($curpage >= 2){ ?>
        <a class="" href="<?php echo URL.'/forum/'.$geturl; ?>/<?php echo $previouspage ?>">(<?php echo $previouspage ?>)</a>
        <?php } ?>
        <a class="" href="<?php echo URL.'/forum/'.$geturl; ?>/<?php echo $curpage ?>" style="font-weight: bold">(<?php echo $curpage ?>)</a>
        <?php if($curpage != $endpage){ ?>
        <a class="" href="<?php echo URL.'/forum/'.$geturl; ?>/<?php echo $nextpage ?>">(<?php echo $nextpage ?>)</a>
        <a class="" href="<?php echo URL.'/forum/'.$geturl; ?>/<?php echo $endpage ?>">(Last Page)</a>
        <?php } ?>
       (<span style="font-weight: bold"><?php echo $curpage ?></span> of <?php echo $endpage; ?> pages)
    </td>
</tr>
<?php } ?>
</tbody>
</table>


<?php
	//load footer from ads.php
require ('ads.php');
	
?>