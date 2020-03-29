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

	$page_title='Board Managment';
	$site_dsc="Board Managment";
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
	$cid=$_REQUEST['id'];
	if (isset($_GET['did'])) {
  $did=$_REQUEST['did'];

$deletCat=$db->query("DELETE FROM sub_cat WHERE sid='$did' ");

}
$queryBoard=$db->query("SELECT * FROM sub_cat WHERE cid_fk='$cid' ");
$countCat=mysqli_num_rows($queryBoard);




while ($clist=mysqli_fetch_assoc($queryBoard))
{
	 ?>
	<tr>
		<td><b><?php echo $clist['sname']; ?></b>:<a href="?id=<?php echo $cid; ?>&did=<?php echo $clist['sid']; ?>">Delete</a> : <a href="edit-sub-cat.php?id=<?php echo $clist['sid']; ?>">Edit</a></td>
	</tr>
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
