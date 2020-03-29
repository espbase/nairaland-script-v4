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
/*
NOTE: Don't remove this line of code
this serve as the developer property
that exist between the app and the third party
*/
$site_title=APPNAME;
if (DEVELOPER==='Marshall')
{
############################################### site content
//$siteinfo = new site();
//echo $siteinfo->discription(APPINFO);
$page_title='Newest topics';
$site_dsc='Newest topics';
require_once 'incfiles/theme/head_open.php';
############################### page title #######################
require_once 'incfiles/theme/blog_page_title.php';
require_once 'incfiles/theme/metatag.php';
// open body tag
require_once 'incfiles/theme/body_open.php';
################################# include files ##########################
require 'incfiles/bbparser.php'; // phpbb code parser
//load header.php -->
require_once ('header.php');
/*
developer credit
Don't temper or try to edit and modify
*/
/////////////////////////////////////////////////
echo '<a id="top" name="top"></a>';
$sid='index';
?>
<h2>Newest Topics</h2>
<p><a href="./"><?php echo APPNAME; ?> </a> / Newest Topics </p>
<?php
include ('ads.php');
?>
<div class="list-wrapper">
	<!--
	pagination
	-->
	<table class="boards" style="font-size:10px !mportant;">
		<tbody>
			<?php
			require_once ('incfiles/topicCount.php'); // count page view function
			// perpage on functions
			if(isset($_GET['page']) & !empty($_GET['page'])){
			$curpage = $_GET['page'];
			}else{
			$curpage = 1;
			}
			$perpage  = 35;
			//echo $_GET['link'];
			$start = ($curpage * $perpage) - $perpage;
			$PageSql = "SELECT * FROM topics T, users U, sub_cat S
			WHERE T.board_id_fk=S.sid AND T.user_id_fk=U.uid ORDER BY T.topic_id DESC";
			$pageres = $db->query($PageSql);

			$totalres = mysqli_num_rows($pageres);
			$endpage = ceil($totalres/$perpage);
			$startpage = 1;
			$nextpage = $curpage + 1;
			$previouspage = $curpage - 1;

			$ReadSql = "SELECT * FROM topics T, users U, sub_cat S
			WHERE T.board_id_fk=S.sid AND T.user_id_fk=U.uid ORDER BY T.topic_id DESC LIMIT $start, $perpage";
			$res = $db->query($ReadSql);
			?>
			<table class="boards">
				<tbody>
					<!--  pagination -->
					<?php 
					if ($totalres) {
						?>
					<tr>
						<td>
							<?php if($curpage >= 2){ ?>
							<a class="" href="<?php echo WEBROOT; ?>/newest?page=1">(First)</a>
							<?php } ?>
							<?php if($curpage >= 2){ ?>
							<a class="" href="<?php echo WEBROOT; ?>/newest?page=<?php echo $previouspage ?>">(<?php echo $previouspage ?>)</a>
							<?php } ?>
							<a class="" href="<?php echo WEBROOT; ?>/newest?page=<?php echo $curpage ?>" style="font-weight: bold;">(<?php echo $curpage ?>)</a>
							<?php if($curpage != $endpage){ ?>
							<a class="" href="<?php echo WEBROOT; ?>/newest?page=<?php echo $nextpage ?>">(<?php echo $nextpage ?>)</a>
							<a class="" href="<?php echo WEBROOT; ?>/newest?page=<?php echo $endpage ?>">(Last Page)</a>
							<?php } ?>
							(<span style="font-weight: bold"><?php echo $curpage ?></span> of <?php echo $endpage; ?> pages)
						</td>
					</tr>
					<!-- end pagination link -->
					
							<?php
						}
							while($data = mysqli_fetch_assoc($res))
							{
							$id=$data['topic_id'];
							$title=$data['title'];
							$link=$data['link'];
							$username=$data['username'];
							$created=$data['created'];
							$board_id=$data['board_id_fk'];
							$slink=$data['surl'];
							$sname=$data['sname'];

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
							// Sub category block title
							echo '<tr><td  class="featured '.$w.'">
								<img src="'.WEBROOT.'/icons/normal_post.gif"> <b>
								<a href="'.WEBROOT.'/forum/'.$slink.'">'.ucfirst($sname).'</a> /
								<a href="'.WEBROOT.'/'.$id.'/'.$link.'">'.$title.'</a></b> <br>
								<span class="s">by <b><a href="u/'.$username.'">'.$username.'</a></b>
							<b>'.topicCount($db,$id).'</b> Views. '.$created.' '.$lastcomment.'</span>
							</td></tr>';
						} 

						if ($totalres) {
						?>

				<!--  pagination -->
				<tr>
					<td>
							<?php if($curpage >= 2){ ?>
							<a class="" href="<?php echo WEBROOT; ?>/newest?page=1">(First)</a>
							<?php } ?>
							<?php if($curpage >= 2){ ?>
							<a class="" href="<?php echo WEBROOT; ?>/newest?page=<?php echo $previouspage ?>">(<?php echo $previouspage ?>)</a>
							<?php } ?>
							<a class="" href="<?php echo WEBROOT; ?>/newest?page=<?php echo $curpage ?>" style="font-weight: bold;">(<?php echo $curpage ?>)</a>
							<?php if($curpage != $endpage){ ?>
							<a class="" href="<?php echo WEBROOT; ?>/newest?page=<?php echo $nextpage ?>">(<?php echo $nextpage ?>)</a>
							<a class="" href="<?php echo WEBROOT; ?>/newest?page=<?php echo $endpage ?>">(Last Page)</a>
							<?php } ?>
							(<span style="font-weight: bold"><?php echo $curpage ?></span> of <?php echo $endpage; ?> pages)
						</td>
				</tr>
			<?php } ?>
				<!-- end pagination link -->
			</tbody>
		</table>

<?php
//load system header ads template
include ('ads.php');
//load footer statistic from footer_stat.php
//require_once ('footer_stat.php');
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';
//load footer from footer.php
require_once ('footer.php');
?>
</body>
</html>
<?php
}
else
{
/*
deactivate and redirect website
*/
echo '<h2>Warning!</h2>
<table>
<tr>
<td class="w">========================= Instruction =========================<br>
- You have tempered with the soruce code, please refer to the documentation or Contact developer...
</td>
</tr>
</table>';
/*
deactivate and redirect website
*/
}
?>