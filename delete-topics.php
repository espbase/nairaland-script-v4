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
	$page_title='List of Topics';
	$site_dsc="List of Topics";
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag
$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

echo '<a id="top" name="top"></a>'; // anchor

##################### topics ########################
$queryPost=$db->query("SELECT * FROM topics T, users U
	WHERE U.uid=T.user_id_fk ");
//count rows
$checktopic=$queryPost->num_rows; // check for existence

require 'incfiles/bbparser.php'; // phpbb code parser

if (isset($_GET['makepost'])) {
	$id=($_GET['makepost']);

	$queryMove=$db->query("UPDATE topics SET post_type='post' WHERE topic_id='$id'  ") or die(mysqli_error());
	echo "<script>alert('Successfull marked as Post.'); </script>";
}

if (isset($_GET['maketopic'])) {
	$id=($_GET['maketopic']);

	$queryMove=$db->query("UPDATE topics SET post_type='topic' WHERE topic_id='$id'  ") or die(mysqli_error());
	echo "<script>alert('Successfull marked as Topic.'); </script>";
}
?>
<h2>List of Topics!</h2>


 <div id="wrapper">
          <div class="contents">
	<?php
	$queryPost=$db->query("SELECT * FROM topics T, users U
	WHERE T.status='0' AND U.uid=T.user_id_fk ORDER BY T.topic_id DESC ");
//count rows
$checktopic=$queryPost->num_rows; // check for existence
if($checktopic)
{

while($data=$queryPost->fetch_assoc())
{
$content=$data['content_text'];
$gender=$data['gender'];
$pusername=$data['username'];
$board_id=$data['board_id_fk'];
$post_status=$data['status'];
$topic_id=$data['topic_id'];
$post_type=$data['post_type'];
$url=$data['link'];
// define contnet variables
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
$queryBoard=$db->query("SELECT * FROM topics T, sub_cat S, category C
	WHERE S.sid='$board_id' AND S.cid_fk=C.cid  ");
//fetch rows
/*
Define topics, category, and sub cat details and variables
*/
@$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.

$bdata=$queryBoard->fetch_assoc();
$category_name=$bdata['name'];
$sname=$bdata['sname'];
$slink=$bdata['surl'];
$clink=$bdata['url'];


//ads here load google adsense ads template

 //require_once ('incfiles/googleads.html');

// topic content
	$TopicCleaned = badWordFilter($content);
	//echo $cleaned;

?>

<table summary="posts">
	<tr>
		<td class="bold l pu">

		<a href="<?php echo WEBROOT."/$data[topic_id]/$data[link]"; ?>">
			<?php echo ucfirst($data['title']); ?></a>
		by <a class="user" href="../u/<?php echo $data['username']; ?>"><?php echo ucfirst($pusername)."($gender)"; ?></a>: <span class="s"><b><?php echo ucfirst($data['created']); ?></b></span></td>
	</tr>
	<tr>
		<td id="402" class="w">
			<div class="narrow" style="text-align: left;">
				<!-- topic contnet -->
				<?php $bb = new bbParser(); echo $bb->getHtml($TopicCleaned); // topic content ?>
				<!-- end topic contnet --><br>

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
				echo '<small><a href="'.WEBROOT.'/banned/'.$topic_id.'/'.$board_id.'/'.$url.'">Ban topic</a></small>';
				// create admin post url
				echo '.:: <small><a href="'.WEBROOT.'/delete/'.$topic_id.'/'.$board_id.'/'.$url.'"> Delete Topic</a> .:: <a href="'.WEBROOT.'/move-topic?id='.$topic_id.'">(Move topic)</a>  </small>';

				//move to home page function
				if ($post_type=="topic") {
					echo ' <small><a href="?makepost='.$topic_id.'">(Make Post)</a> </small>';
				}
				else
				{
					echo ' <small><a href="?maketopic='.$topic_id.'">(Make Topic)</a> </small>';
				}

				// create admin post url
				}
				elseif($access==2 ) // get permission
				{
					//echo 'Ordinary user';
					echo '<small><a href="'.WEBROOT.'/report/'.$topic_id.'/'.$board_id.'/'.$url.'">Report topic to admin</a></small>';
				}
				else
				{
				//echo 'Ordinary user';
				echo '<small><a href="'.WEBROOT.'/report/'.$topic_id.'/'.$board_id.'/'.$url.'">Report topic to admin</a></small>';
				}
				}
				?>

			</div>
		</td>
	</tr>
</table>
<?php }  }?>

</div>
    </div>

<!-- item container -->

<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

?>

	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->

</body>
</html>
