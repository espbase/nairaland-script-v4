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
	$page_title='Followerst';
	$site_dsc='Followers';

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
<h2>Followers</h2>
<a href="<?php echo URL; ?>"><?php echo APPNAME; ?></a>/ <a href="">Followers</a>
<table>
		<tbody>
			<tr>
				<th>My Followers:</th>
			</tr>
    <?php
// Friends List Data relations between users and friends tables for displaying user friends
$flist=$db->query("SELECT *
FROM users U, followers F
WHERE
CASE
WHEN F.friend_one = '{$user_id}' 
THEN F.friend_two = '{$user_id}'
END
AND 
F.status='1'");
$friendsList=mysqli_num_rows($flist); // count of total friends

  
echo $friendsList;
?>
			<tr>
				<td class="w">
					<b><a class="user" href="/kosmos95">kosmos95</a>(<span class="m">m</span>)</b>: <a href=
					"phones">Phones</a> (<a href=
					"https://www.nairaland.com/do_followmember?session=C249E6B9A3AB8EE0910E17FB66850EAF024461029DC0B2AFD7D9E0C771E58677&amp;redirect=%2Ffollowers&amp;member=1646829"><b>Follow
					Back</b></a>)
				</td>
			</tr>
		</tbody>
	</table>


<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

?>


<!-- GOOGLE ANALYSTIC GOES HERE -->

</body>
</html>
