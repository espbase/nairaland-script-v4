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

	$page_title='Manage Categories';
	$site_dsc="Manage Categories";
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
<h2>Create And Edit Boards</h2>

<table>
	<?php
	if(isset($_REQUEST['id']) AND ($_REQUEST['id']!='') )
	{
$cid=$_REQUEST['id'];
$queryBoard=$db->query("SELECT * FROM sub_cat WHERE sid='$cid' ");
$countCat=mysqli_num_rows($queryBoard);
$clist=mysqli_fetch_assoc($queryBoard);
    $sname=$clist['sname'];
	$ad_dsc=$clist['ad_dsc'];
	$desc=$clist['dsc'];
	$catcost=$clist['catcost'];

// update table
if (isset($_REQUEST['title'])) {
	# code...
	$title=$_REQUEST['title'];
	$ads=$_REQUEST['ads'];
	$desc=$_REQUEST['desc'];
	$amt=$_REQUEST['amt'];
	$link=clean($title);
	$queryUpdate=$db->query("UPDATE sub_cat SET sname='$title',  surl='$link', dsc='$desc', ad_dsc='$ads', catcost='$amt' WHERE sid='$cid' ");
	echo "<h3>Updated!...</h3>";
}

	 ?>
	 <form action="" method="POST">
	 	<table>
	 		<tr>
	 			<td class="w"><?php echo $clist['sname']; ?></td>
	 		</tr>


	 		<tr>
	 			<td><label><b>New Title</b>: <input name="title" value="<?php echo $sname; ?>" size="30" type="text"></label> 
	 				<label><b>Description</b>: <input name="desc" value="<?php echo $desc; ?>" type="text"></label> 
	 				<label><b>Ads Rate Description</b>: <input name="ads" value="<?php echo $ad_dsc; ?>" type="text"></label> 
	 					<label><b>Ads Rate Amount</b>: <input name="amt" value="<?php echo $catcost; ?>" type="text"></label>
	 				<input type="submit" value="Rename"></td>
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
