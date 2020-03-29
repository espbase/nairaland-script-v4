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

	$page_title='My Classified Listing';
	$site_dsc=APPNAME." Website Setting  ";
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

##################### login form ########################

$error="";
?>

    <table>
      <tr>
        <th><h3>My Classified</h3></th>
      </tr>
</table>
<?php
if (isset($_GET['delete'])) {
  $did = $_GET['delete'];

  $db->query("DELETE FROM classified WHERE class_id='$did' ");
  echo "<script>alert('Classified Deleted Successfully') </script>";
}


$comQuery=$db->query("SELECT * FROM classified C, sub_cat S WHERE C.class_cat=S.sid AND C.user_fk=$ses_user_id GROUP BY C.class_cat ORDER BY rand() ");
$countR=$comQuery->num_rows;

if ($countR)
{
while($rowR=$comQuery->fetch_assoc())
{
  $class_name =($rowR['class_name']);
  $location =($rowR['class_location']);
  $class_info =($rowR['class_info']);
  $class_amt =($rowR['class_amt']);
  $sname =($rowR['sname']);

  $class_features =($rowR['class_features']);
  $class_id =($rowR['class_id']);
   $class_url =($rowR['class_url']);
  $clickcount=$rowR['class_clickcount']+0; //increament clicks by one 1

?>
  <table summary="search">
    <tbody>
      <tr>
        <td class="" style="text-align: left;">
          <b class="buz"><a href="item/<?php echo $class_url; ?>"><?php echo $class_name; ?></a> <br><span class="span"><?php echo $location; ?> | <?php echo $sname; ?></span></b>
          <p class="span"><?php echo $class_info; ?><br>More Info: <?php echo $class_features; ?></p>
          <p  class="span">Clicks (<?php echo $clickcount; ?>)| 
 |
          <b><a href="?delete=<?php echo $class_id; ?>" title="<?php echo $bname; ?>" target="_self">Delete</a></b></p>
          <small>Your account details is used along with each ad, phone numbers, email, address etc</small>
</td>
      </tr>
    </tbody>
  </table>
<?php } }  ?>
          
          

<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';

//load footer from footer.php
require_once ('footer.php');

?>

	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->

</body>
</html>
