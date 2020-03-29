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
echo checkUser(); // authenticate logged in users
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

?>
<h2>List of Topics!</h2>


<div class="holder"></div>
<p id="legend2"></p>
<!-- item container -->
<div id="itemContainer">
	<?php
if (isset($_REQUEST['id'])) {
	# code...
	$bid=$_REQUEST['id'];

$queryPost=$db->query("SELECT * FROM topics T, users U, mods M
WHERE T.status='0' AND M.user_id_fk='$user_id' AND U.uid=T.user_id_fk AND T.board_id_fk='$bid' GROUP BY T.topic_id ORDER BY  RAND() ");
//count rows
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
				echo '<small><a href="'.WEBROOT.'/move-topic?id='.$topic_id.'">Move topic</a></small>';

				echo '.:: <small><a href="'.WEBROOT.'/edit/'.$topic_id.'/'.$url.'"> Edit Topic</a></small>';
				// create admin post url
				
				?>

			</div>
		</td>
	</tr>
</table>
<?php }  } } ?>

</div>
<!-- navigation holder -->
<div class="holder">
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
