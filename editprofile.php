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
echo checkUser(); // authenticate logged in users
	$page_title='Edit - Profile';
	$site_dsc="Edit your awesome account";
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

echo '<a id="top" name="top"></a>'; // anchor

$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.
$username=$_SESSION['username']; //Storing USERNAME in SESSION variabl

$queryProfile=$db->query("SELECT * FROM users WHERE uid='$user_id' ");
$data=mysqli_fetch_assoc($queryProfile);

$signature=$data['signature'];
$location=$data['location'];
$personaltext=$data['personaltext'];
$fb=$data['fb'];
$twitter=$data['twitter'];
$pinterest=$data['pinterest'];
$youtube =$data['youtube'];
$instagram =$data['instagram'];
$linked =$data['linked'];
$email=$data['email'];
$name=$data['name'];

if(isset($_POST['update']))
{

$signature=trim($_POST['signature']);
$location=trim($_POST['location']);
$birthday=$_POST['birthday'];
$birthmonth=$_POST['birthmonth'];
$birthyear=$_POST['birthyear'];
$gender=$_POST['gender'];
$location=$_POST['location'];
$personaltext=$_POST['personaltext'];
$fb=$_POST['fb'];
$fname=$_POST['name'];
$twitter=addslashes($_POST['twitter']);
$pinterest=addslashes($_POST['pinterest']);
$youtube =addslashes($_POST['youtube']);
$instagram =addslashes($_POST['instagram']);
$linked =addslashes($_POST['linked']);

$createAcount=$db->query("UPDATE users
	SET name='$fname', gender='$gender', location='$location', personaltext='$personaltext', signature='$signature', fb='$fb', twitter='$twitter', linked='$linked', instagram='$instagram', youtube='$youtube', pinterest='$pinterest', birthday='$birthday', bmonth='$birthmonth', byear='$birthyear'
	WHERE uid='$user_id' ");

	// Simple PHP Upload Script:  http://coursesweb.net/php-mysql/

	$uploadpath = 'avatars/';      // directory to store the uploaded files
	$max_size = 2000;          // maximum file size, in KiloBytes
	$alwidth = 900;            // maximum allowed width, in pixels
	$alheight = 800;           // maximum allowed height, in pixels
	$allowtype = array('bmp', 'gif', 'jpg', 'jpe', 'png');        // allowed extensions

	if(isset($_FILES['avatar']) && strlen($_FILES['avatar']['name']) > 1) {
	  $uploadpath = $uploadpath . basename( $_FILES['avatar']['name']);       // gets the file name
	  $sepext = explode('.', strtolower($_FILES['avatar']['name']));
	  $type = end($sepext);       // gets extension
	  list($width, $height) = getimagesize($_FILES['avatar']['tmp_name']);     // gets image width and height
	  $err = '';         // to store the errors
		$avatar=strtolower($_FILES['avatar']['name']);

	  // Checks if the file has allowed type, size, width and height (for images)
	  if(!in_array($type, $allowtype)) $err .= 'The file: <b>'. $_FILES['avatar']['name']. '</b> not has the allowed extension type.';
	  if($_FILES['avatar']['size'] > $max_size*1000) $err .= '<br/>Maximum file size must be: '. $max_size. ' KB.';
	  if(isset($width) && isset($height) && ($width >= $alwidth || $height >= $alheight)) $err .= '<br/>The maximum Width x Height must be: '. $alwidth. ' x '. $alheight;

	  // If no errors, upload the image, else, output the errors
	  if($err == '') {
	    if(move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadpath)) {
				$db->query("UPDATE users
					SET avater='$avatar' WHERE uid='$user_id' ");

	      //echo 'File: <b>'. basename( $_FILES['avatar']['name']). '</b> successfully uploaded:';
	      //echo '<br/>File type: <b>'. $_FILES['avatar']['type'] .'</b>';
	      //echo '<br />Size: <b>'. number_format($_FILES['avatar']['size']/1024, 3, '.', '') .'</b> KB';
	     // if(isset($width) && isset($height)) echo '<br/>Image Width x Height: '. $width. ' x '. $height;
	      //echo '<br/><br/>Image address: <b>http://'.$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['REQUEST_URI']), '\\/').'/'.$uploadpath.'</b>';
	    }
	    else echo '<b>Unable to upload the file.</b>';
	  }
	  else echo $err;
	}
}
##################### registration form ########################
?>
<h2>Edit My Profile</h2>
<p> <a href="<?php echo WEBROOT ?>"><?php echo APPNAME ?></a> /
	<a href="u/<?php echo $username; ?>">My profile</a> / Edit My Profile</p>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
         <table summary="profile editing form">
         <tbody><tr><td><b>Email</b>: <?php echo $email; ?>&nbsp;<a href="<?php echo WEBROOT ?>/changeemail">Change Email</a>
         </td></tr>
         <tr><td valign="top" class="w"><b>Full Name</b>:
         <input type="text" style="width:40%" name="name" value="<?php echo $name; ?>" maxlength="255">
         </td></tr>
         <tr><td class="w"><b>Birthday</b>:
        <select name="birthday" size="1">
        <option value="" selected="">-- Day --</option>
				<?php
				for ($x = 1; $x <= 31; $x++) {
		echo "<option value='$x'>$x</option>";
}  ?>
</select>
        <select name="birthmonth" size="1">
        <option value="" selected="">-- Month --</option>
        <option value="1">January</option>
        <option value="2">February</option>
        <option value="3">March</option>
        <option value="4">April</option>
        <option value="5">May</option>
        <option value="6">June</option>
        <option value="7">July</option>
        <option value="8">August</option>
        <option value="9">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option></select>
        <select name="birthyear" size="1">
        <option value="" selected="">-- Year --</option>

				<?php
				for ($x = 1950; $x <= date('Y'); $x++) {
    		echo "<option value='$x'>$x</option>";
			}  ?>
        </select></td></tr><tr><td class=""><b>Gender</b>:
         <select name="gender" size="1">
         <option value="-"></option>
         <option value="1" selected="">Male</option>
         <option value="2">Female</option>
         </select>
         </td></tr><tr><td valign="top" class="w"><b>Personal text</b>:
         <input type="text" style="width:40%" name="personaltext" value="<?php echo $personaltext; ?>" maxlength="255">
         </td></tr><tr><td valign="top"><b>Signature</b>:
         <p>
             </p><div id="editbar" style="display: block;">
             <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[b]&quot;, &quot;[/b]&quot;)" title="Bold">
             <span class="eb"><img src="/icons/bold.gif"></span></a>
             <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[i]&quot;, &quot;[/i]&quot;)" title="Italic">
             <span class="eb"><img src="/icons/italicize.gif"></span></a>
             <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[s]&quot;, &quot;[/s]&quot;)" title="Strikethrough">
             <span class="eb"><img src="/icons/strike.gif"></span></a>
             <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[left]&quot;, &quot;[/left]&quot;)" title="Align Left">
             <span class="eb"><img src="/icons/left.gif"></span></a>
             <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[right]&quot;, &quot;[/right]&quot;)" title="Align Right">
             <span class="eb"><img src="/icons/right.gif"></span></a>
             <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[center]&quot;, &quot;[/center]&quot;)" title="Align Center">
             <span class="eb"><img src="/icons/center.gif"></span></a>
             <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot;[hr]&quot;)" title="Horizontal Rule">
             <span class="eb"><img src="/icons/hr.gif"></span></a>
             <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[size=8pt]&quot;, &quot;[/size]&quot;)" title="Font Size">
             <span class="eb"><img src="/icons/size.gif"></span></a>
             <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[font=Lucida Sans Unicode]&quot;, &quot;[/font]&quot;)" title="Font Face">
             <span class="eb"><img src="/icons/face.gif"></span></a>

             <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[img]&quot;, &quot;[/img]&quot;)" title="Insert Image/Picture">
             <span class="eb"><img src="/icons/img.gif"></span></a>
             <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[url]&quot;, &quot;[/url]&quot;)" title="Insert Hyperlink">
             <span class="eb"><img src="/icons/url.gif"></span></a>
             
             <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[youtube]&quot;, &quot;[/youtube]&quot;)" title="Insert Hyperlink">
            <span class="eb"><img src="<?php echo WEBROOT; ?>/icons/yt.png"></span>
            </a>

             <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[sub]&quot;, &quot;[/sub]&quot;)" title="Subscript">
             <span class="eb"><img src="/icons/sub.gif"></span></a>
             <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[sup]&quot;, &quot;[/sup]&quot;)" title="Superscript">
             <span class="eb"><img src="/icons/sup.gif"></span></a>
             <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[code]&quot;, &quot;[/code]&quot;)" title="Code">
             <span class="eb"><img src="/icons/code.gif"></span></a>
             <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[quote]&quot;, &quot;[/quote]&quot;)" title="Quote">
             <span class="eb"><img src="/icons/quote.gif"></span></a>
            
             <select onchange="wrapText('body', '[color='+this.options[this.selectedIndex].value+']', '[/color]'); this.selectedIndex = 0;" style="margin-bottom: 1ex;">
                <option value="" selected="selected">Change Color</option>
                <option value="red">Red</option>
                <option value="green">Green</option>
                <option value="blue">Blue</option>
                <option value="purle">Purple</option>
                <option value="brown">Brown</option>
                <option value="black">Black</option></select>
            </div>
            <script>document.getElementById("editbar").style.display = 'block';</script>
            
        <textarea rows="2" cols="50" name="signature" id="body" maxlength="2000"><?php echo $signature; ?></textarea><p>
         </td></tr><tr><td class="w"><b>Picture</b>:<input type="file" name="avatar">
    <p><input type="checkbox" name="removeavatar"> Remove this image
         </p></td></tr><tr><td><b>Location</b>: <input type="text" name="location" value="<?php echo $location; ?>">
         </td></tr>
         <tr><td class="w"><b>FB</b>: <input type="text" name="fb" value="<?php echo $fb; ?>">
         </td></tr>
         <tr><td><b>Twitter</b>: <input type="text" name="twitter" value="<?php echo $twitter; ?>">
         </td></tr>
         <tr><td class="w"><b>LinkedIn</b>: <input type="text" name="linked" value="<?php echo $linked; ?>">
         </td></tr>
         <tr><td class=""><b>Instagram </b>: <input type="text" name="instagram" value="<?php echo $instagram; ?>">
         </td></tr>
         <tr><td class="w"><b>Youtube  </b>: <input type="text" name="youtube" value="<?php echo $youtube; ?>">
         </td></tr>
         <tr><td class=""><b>Pinterest </b>: <input type="text" name="pinterest" value="<?php echo $pinterest; ?>">
         </td></tr>
         <tr><td class="w"><a href="send_confirmation_email_for_account_deactivation?session=">Deactivate Account</a>
         </td></tr></tbody></table>
         <p><input type="submit" name="update" value="Update Profile"></p></form>


<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

?>

	</div>
<script type="text/javascript" src="https://www.nairaland.com/static/nl2.js"></script>

</body>
</html>
