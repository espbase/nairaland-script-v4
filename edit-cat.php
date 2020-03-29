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

	$page_title='Manage Category';
	$site_dsc="Manage Forum Category";
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

echo '<a id="top" name="top"></a>'; // anchor

##################### registration form ########################
?>
<h2>Creat And Edit Boards</h2>

<table>
	<?php
	if(isset($_REQUEST['id']) AND ($_REQUEST['id']!='') )
	{
		$cid=$_REQUEST['id'];
$queryBoard=$db->query("SELECT name,url,des,cid FROM category WHERE cid='$cid' ");
$countCat=mysqli_num_rows($queryBoard);
$clist=mysqli_fetch_assoc($queryBoard);

// update table
if (isset($_REQUEST['title'])) {
	# code...
	$title=$_REQUEST['title'];
	$link=clean($title);
	$queryUpdate=$db->query("UPDATE category SET name='$title', url='$link' WHERE cid='$cid' ");
	echo "<h3>Updated!...</h3>";
}

	 ?>
	 <form action="" method="POST">
	 	<table>
	 		<tr>
	 			<td class="w"><?php echo $clist['name']; ?></td>
	 		</tr>


	 		<tr>
	 			<td><label><b>New Title</b>: <input name="title" type="text"></label> <input type="submit" value="Rename"></td>
	 		</tr>
	 	</table>
	 </form>
<?php } ?>
</table>

<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

?>

	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->

</body>
</html>
