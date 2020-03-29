
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

$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.
echo checkUser(); // authenticate logged in users
require_once 'incfiles/theme/head_open.php';
############################### page title #######################

	$page_title='Publish Classified- '.APPNAME;
	$site_dsc="Publish New Classified - ".APPNAME;
	
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');
?>
<style type="text/css">

/* mak images fill their container*/
img {
  max-width: 98%;
}
img:hover {
  opacity: 0.5;
  cursor: pointer;
}

/* Bigger than Phones(tablet) */
@media only screen and (min-width: 750px) {
  .img-grid {
    width: 80%;
  }
}

/* Bigger than Phones(laptop / desktop) */
@media only screen and (min-width: 970px) {
  .img-grid {
   width: 90%;
  }
}

</style>	

   <?php
$succ='';

if (isset($_POST['add'])) {
  $bname =addslashes($_POST['name']);
  $location =addslashes($_POST['location']);
  $desc =addslashes($_POST['desc']);
  $features =addslashes($_POST['features']);
  $cat =addslashes($_POST['cat']);
  $amt =addslashes($_POST['amt']);
  
  $classcode = mt_rand(100,100000);
  
  $newtitle=clean($bname).'-'.$classcode;
  $url=strtolower($newtitle).".html"; //."-".$newtitle.".html";
  

            $mtk = $db->query("INSERT INTO classified (user_fk, class_name, class_info, class_cat, class_features, class_location, class_status, class_code, class_amt, class_url, class_date) 
    VALUES('$user_id', '$bname', '$desc', '$cat', '$features', '$location', '1', '$classcode', '$amt', '$url', NOW())");
    
    $comQuery1=$db->query("SELECT * FROM classified ORDER BY class_id DESC ");

$rowR1=$comQuery1->fetch_assoc();
  $class_id =($rowR1['class_id']);
  
  $mtk = $db->query("INSERT INTO class_img (class_fk) VALUES('$class_id')");
    

   echo '<script type="text/javascript">window.location = "'.URL.'/add-item/?id='.$class_id.'"; </script>'; 
}


if($user_id)
{

////////////////////// upload image script
if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $comQuery1=$db->query("SELECT * FROM classified C, sub_cat S WHERE C.class_cat=S.sid AND C.class_id='$id' GROUP BY C.class_url ");
$countR=$comQuery1->num_rows;

if(isset($_POST['upload']))
{
require_once 'inc.class_img1.php';
require_once 'inc.class_img2.php';
//require_once 'inc.class_img2.php';
//require_once 'inc.class_img2.php';

echo '<h3 style="color:green;">Images are uploaded success, your item is live now!</h3>';
}



if ($countR)
{
$rowR1=$comQuery1->fetch_assoc();
  $bname =($rowR1['class_name']);
 ?>
 <form enctype="multipart/form-data" action="" method="post">
     <h3><?php echo $bname; ?></h3>
 	<table>
		<tbody>
				<tr>
				<td><b>Item Images</b>: 
				<div id="filediv"><input name="file1" required="" type="file" id="file"/></div><br>
				<div id="filediv"><input name="file2" required="" type="file" id="file"/></div><br>
				
				Item Logo should be <b>50 pixels</b> wide, <b>50 pixels</b>, <b>less than 30KB</b> in size,and in the <b>JPG</b> or <b>PNG</b> format.<br>
				They should have <b>a clear message</b>, <b>legible text</b>, your <b>name</b>/<b>brand</b>/<b>logo</b>/<b>url</b>, <b>good design</b> and <b>no border</b>.</td>
			</tr>
			<tr>
			<td class="w">
			<input type="submit" name="upload" value="Upload Ad" id="Publish"></td>
			</tr>
		</tbody>
	</table> 
</form>
 
<?php
}
else
{
    echo "<h3>Oops! error occured, no item found!</h3>";
}
}
else
{
?>
<form enctype="multipart/form-data" action="" method="post">
 	<table>
		<tbody><tr>
				<td class="w"><b>Item Name:</b><input class="expansible_input" name="name" required="" type="text"><br>
				(Used to identify your brand)</td>
			</tr>
			<tr>
				<td class="w"><b>Item Amt:</b><input class="expansible_input" name="amt" required="" type="number"><br>
				(Amount in figure)</td>
			</tr>
			<tr>
				<td class=""><b>Category</b>:
	<select name="cat" required="" class="expansible_input"> 
    <option value=''>Select Category</option> 
    <?php
$queryBoard=$db->query("SELECT * FROM category C, sub_cat S WHERE C.cid=S.cid_fk group by S.sname ORDER BY S.sid");
//fetch rows
/*
Define topics, category, and sub cat details and variables
*/
while($bdata=$queryBoard->fetch_assoc()){
$sname=$bdata['sname'];
$sid=$bdata['sid'];
$cid=$bdata['cid'];
$catcost=$bdata['catcost'];
if($sname=='Homepage')
{
//echo '<option value="index|0|'.$catcost.'">'.$sname.'</option>';
}
else
{
echo '<option value="'.$sid.'">'.$sname.'</option>';
}
}
?>
    </select></td>
			</tr>
			<tr>
				<td class="w"><b>Description</b>: <input class="expansible_input" id="baseUrl" required='' name="desc" type="text" ><br>
				(Short Note About your item)</td>
			</tr>
			<tr>
				<td class=""><b>Features</b>: <input class="expansible_input" id="baseUrl" required='' name="features" type="text" ><br>
				(Your Unqiue item, features )</td>
			</tr>
				<tr>
				<td class="w"><b>Location</b>: <input class="expansible_input" id="baseUrl" required='' name="location" type="text"><br>
				(Where your business is located)</td>
			</tr>
			<tr>
			<td class="w">
			<input type="submit" name="add" value="Upload Ad" id="Publish"></td>
			</tr>
		</tbody>
	</table> 
</form>
  <?php } } else{?>
<table><tbody><tr><th>Publish Your Business Free
    </th></tr><tr><td class="w">
      <h3 style="color: red">Please <a title="login" href="login?redirect=<?php echo $redirect; ?>">Login</a> or create <a title="login" href="<?php echo URL; ?>?k=kenyans247&?redirect=<?php echo $redirect; ?>">an account</a> to add your business with us</h3>

      <hr>
   </td></tr></tbody></table>
  <?php } ?>
          <div>
          Having trouble? <a href="mailto:<?php echo EMAIL; ?>" class="login-linkbutton js-contact-support">Contact Support &rsaquo;&rsaquo;</a>
        </div>

  <div class="dark_box" style="border: none;">
  <p class="small">(<a href="#up"><b>Go Up</b></a>)</p>
</div>


<?php


//load footer from footer.php
require_once ('footer.php');

?>



</body>
</html>
