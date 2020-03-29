<?php
	/*
	fetch board form database
	*/
	$geturl=$_GET['url'];
	$query_cat = $db->query("SELECT * FROM category C, sub_cat S WHERE C.url='$geturl' AND S.cid_fk=C.cid ");
	//count rows
	$check=$query_cat->num_rows;
?>
<h2><?php echo APPNAME; ?>/ <?php echo ucfirst($geturl); ?></h2>
<p class="bold"><a href="<?php echo WEBROOT; ?>"><?php echo APPNAME; ?></a> /  <b><?php echo ucfirst($geturl); ?></b></p>
<table summary="">
	<tbody>
		<?php
		if($check){
		/*
				loop categories
				*/
				$ii=0;
				while($data=$query_cat->fetch_assoc())
				{
				$cat_id=$data['cid'];
				$s_id=$data['sid'];
				$stitle=$data['sname'];
				$cat_alias=$data['surl'];
				$dsc=$data['dsc'];
				// fetch categories according to board id
		/*
		count all topic from topic database
		*/
		$queryTopic=$db->query("SELECT * FROM topics WHERE board_id_fk='$s_id'  ");
				//count rows
				$countTopic=$queryTopic->num_rows;
		/*
		End count all topic from topic database
		*/
			@$i = $i + 1;
					if($i%2 == 0)
					{ $w=''; }
					
					else
					{ $w='w'; }
					
					
// Sub category block title
echo '<tr>
	<td id="top519" class="'.$w.'">
		<a href="forum/'.$cat_alias.'"></a>
		<img src="'.WEBROOT.'/icons/normal_post.gif">
		<b><a href="../forum/'.$cat_alias.'">'.$stitle.'</a> </b>: '.$dsc.'('.number_format($countTopic).' topics)
	</td>
</tr>';
}
}
else
{
echo '<tr>
	<td class="w">
		<h2>Oops! page not found</h2>
		<p>
			This board has been removed or does not exist. <br>
			→ <a href="'.WEBROOT.'">Click here to return back to forum home</a>
		</p>		</td>
	</tr>';
	}
switch ($check) {
case 'value':
# code...
break;

default:
# code...
break;
}
@$sid=$cat_id;
//load system header ads template
include ('ads.php');
			?>
			<!--END CONTAINER SEARCH TOPICS-->
		</tbody></table>
		<!-- item container -->
		
		<?php
		require_once ('incfiles/topicCount.php'); // count page view function
		// query topic along with board id and user id
		// perpage on functions
		if(isset($_GET['pn']) & !empty($_GET['pn'])){
		$curpage = $_GET['pn'];
		}else{
		$curpage = 1;
		}
		$perpage  = 30;
		$start = ($curpage * $perpage) - $perpage;
		@$PageSql = "SELECT *  FROM topics T, users U, category C
			WHERE C.cid='$cat_id' AND T.user_id_fk=U.uid ORDER BY T.topic_id DESC";
		$pageres = $db->query($PageSql);
		$totalres = mysqli_num_rows($pageres);
		$endpage = ceil($totalres/$perpage);
		$startpage = 1;
		$nextpage = $curpage + 1;
		$previouspage = $curpage - 1;
		@$ReadSql = "SELECT *  FROM topics T, users U, category C
			WHERE C.cid='$cat_id' AND T.user_id_fk=U.uid ORDER BY T.topic_id DESC LIMIT $start, $perpage";
		$res = $db->query($ReadSql);
		if ($totalres) {
		?>
		<tr>
			<td>
			<?php if($curpage >= 2){ ?>
			<a class="" href="<?php echo URL.'/'.$geturl; ?>/1">(First)</a>
			<?php } if($curpage >= 2){ ?>
			<a class="" href="<?php echo URL.'/'.$geturl; ?>/<?php echo $previouspage ?>">(<?php echo $previouspage ?>)</a>
			<?php } ?>
			<a class="" href="<?php echo URL.'/'.$geturl; ?>/<?php echo $curpage ?>" style="font-weight: bold">(<?php echo $curpage ?>)</a>
			<?php if($curpage != $endpage){ ?>
			<a class="" href="<?php echo URL.'/'.$geturl; ?>/<?php echo $nextpage ?>">(<?php echo $nextpage ?>)</a>
			<a class="" href="<?php echo URL.'/'.$geturl; ?>/<?php echo $endpage ?>">(Last Page)</a>
			<?php } ?>
			(<span style="font-weight: bold"><?php echo $curpage ?></span> of <?php echo $endpage; ?> pages)
		</td>
		</tr>
		<table>
			<tbody>
				<?php
								
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
			?>
		</tbody>
	</table>
	<tr>
		<td>
			<?php if($curpage >= 2){ ?>
			<a class="" href="<?php echo URL.'/'.$geturl; ?>/1">(First)</a>
			<?php } if($curpage >= 2){ ?>
			<a class="" href="<?php echo URL.'/'.$geturl; ?>/<?php echo $previouspage ?>">(<?php echo $previouspage ?>)</a>
			<?php } ?>
			<a class="" href="<?php echo URL.'/'.$geturl; ?>/<?php echo $curpage ?>" style="font-weight: bold">(<?php echo $curpage ?>)</a>
			<?php if($curpage != $endpage){ ?>
			<a class="" href="<?php echo URL.'/'.$geturl; ?>/<?php echo $nextpage ?>">(<?php echo $nextpage ?>)</a>
			<a class="" href="<?php echo URL.'/'.$geturl; ?>/<?php echo $endpage ?>">(Last Page)</a>
			<?php } ?>
			(<span style="font-weight: bold"><?php echo $curpage ?></span> of <?php echo $endpage; ?> pages)
		</td>
	</tr>
	<?php
}
	//load system header ads template
	require ('ads.php');
	@$queryMod=$db->query("SELECT * FROM mods M, users U
	WHERE M.board_id_fk='$cat_id' AND M.user_id_fk=U.uid ");
	//count rows
	$checkM=$queryMod->num_rows; // check for existence
	while($rows1=$queryMod->fetch_assoc())
	{
	$name=$rows1['name'];
	$username=$rows1['name'];
	echo "<a href='".WEBROOT."/u/$username'>$name</a>,";
	}