
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
$busid = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)); //Get last word from URL after a slash in PHP
//$lastWord = substr($url, strrpos($url, '/') + 1);

	$page_title='Upload New Ad - '.APPNAME;
	$site_dsc="Upload New Ad - ".APPNAME;
	
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');
?>
<h2 align="center">Publish Your Business Free</h2>

   <?php


if (isset($_POST['add'])) {
    $j = 0; //Variable for indexing uploaded image 
  $bname =addslashes($_POST['bname']);
  $location =addslashes($_POST['location']);
  $desc =addslashes($_POST['desc']);
  $address =addslashes($_POST['address']);
  $phone =addslashes($_POST['phone']);
  $email =addslashes($_POST['email']);
  $site =addslashes($_POST['site']);
  $cat =addslashes($_POST['cat']);

  

	$target_path = "images/bus/"; //Declaring Path for uploaded images
    for ($i = 0; $i < count($_FILES['file']['name']); $i++) {//loop to get individual element from the array

        $validextensions = array("jpg", "png", "gif");  //Extensions which are allowed
        $ext = explode('.', basename($_FILES['file']['name'][$i]));//explode file name from dot(.) 
        $file_extension = end($ext); //store extensions in the variable
        $filename=$_FILES['file']['name'][$i];
        $file_size=$_FILES['file']['size'][$i];
        
        $vpb_code=rand(99999,5);
        $today=time();
        
       
        
		//$target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];//set the target path with a new name of image
		$imgurl = md5(uniqid()) . "." . $ext[count($ext) - 1];//set the target path with a new name of image
		
        $j = $j + 1;//increment the number of uploaded images according to the files in array       
      
	  if (($_FILES["file"]["size"][$i] < 1024*8068) //Approx. 100kb files can be uploaded.
                && in_array($file_extension, $validextensions)) {
            if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path.$imgurl)) {//if file moved to uploads folder
                    // save to databse
                    
            	$mtk = $db->query("UPDATE directory SET bname='$bname', buzlogo='$imgurl', location='$location', bdesc='$desc', baddress='$address', bphone='$phone', bemail='$email', bsite='$site', bcat='$cat' 
            	WHERE dir_id='$busid' ");
    
                if($mtk)
                {
                   echo '<hr><h2 style="color:green; font-weight:bolder;">Your Business Info are updated</h2>'; 
                }
                else
                {
                    echo "error";
                }


// Enable TLS encryption, `ssl` also accepted

$mail->addAddress($ses_email);               // Name is optional;
$mail->isHTML(true);
$mail->Subject ='Kenyans247 Direrctory';
$mail->Body = '<div class="email--background">
  
  <div class="email--container">
    <div class="email--inner-container">
    <img src="'.URL.'/images/logo.png" width="200"/>
    <p>Dear '.$ses_username.',<br>

Your business are updated and added to google search engine directory.<br>
IP Address: '.$user_ip.'<br>
<h3>Business : '.$bname.'</h3>
<h3>Business Location : '.$location.'</h3>
<h3>About Business : '.$desc.'</h3>
</p>
<p style="color:red;">Get premium service to see more analysis on your business</p>

<p><a title="Kenyans247 Forum" href="'.URL.'" target="_blank" rel="noopener"><strong>KENYANS247 FORUM.</strong></a><br />Westlands Nairobi Kenya.</p>
<p><em>P. O. BOX 4469-00100</em></p>
<p>Cell Phone: <em>0791890826</em></p>
<p style="text-align: justify;"><strong>DISCLAIMER:</strong> Information in this message and its attachments are privileged and confidential. It is for the exclusive use of the intended recipient(s). If you are not one of the intended recipients, you are hereby informed that any use, disclosure, distribution, and/or copying of this information is strictly prohibited. If you receive this message in error, please notify the sender immediately. We cannot accept responsibility for any transmitted viruses.</p>

  <hr>
    <h3>Best Regards</h3>
    <p>'.APPNAME.' Team <br> < <a href="'.URL.'" class="cta">Website</a> ></p>
    </div>
  </div>
</div>';
if (!$mail->send()) {
 echo '<div style="width:100%;text-align:center; color:#C5110BCC; font-weight:bold">Oops! an unknow error occured</div>';
}
            } else {//if file was not moved.
                echo '<hr><span id="error">please try again!.</span>';
            }
        } else {//if file size and file type was incorrect.
            echo '<hr><span id="error">***Invalid file Size or Type***</span>';
        }
    }
}

if($user_id)
{
?>
<?php
$comQueryCheck=$db->query("SELECT * FROM directory WHERE dir_id='$busid'");
$countBuz=$comQueryCheck->num_rows;
$rowR=$comQueryCheck->fetch_assoc();

   $bname =($rowR['bname']);
  $location =($rowR['location']);
  $desc =($rowR['bdesc']);
  $address =($rowR['baddress']);
  $phone =($rowR['bphone']);
  $site =($rowR['bsite']);
  $cat =($rowR['bcat']);
  $sname =($rowR['sname']);
  $buzlogo =($rowR['buzlogo']);
  $dir_id =($rowR['dir_id']);
  $bemail =($rowR['bemail']);
?>
<form enctype="multipart/form-data" action="" method="post">
 	<table>
		<tbody><tr>
				<td class="w"><b>Business Name:</b><input class="expansible_input" name="bname" value="<?php echo $bname; ?>" required="" type="text"><br>
				(Used to identify your brand)</td>
			</tr>
			<tr>
				<td class="w"><b>Category</b>:
	<select name="cat" required=""> 
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
				<td><b>Business Logo</b>: <div id="filediv"><input name="file[]" required="" type="file" id="file"/></div><br>
				Business Logo should be <b>100 pixels</b> wide, <b>100 pixels</b>, <b>less than 30KB</b> in size,and in the <b>JPG</b> or <b>PNG</b> format.<br>
				They should have <b>a clear message</b>, <b>legible text</b>, your <b>name</b>/<b>brand</b>/<b>logo</b>/<b>url</b>, <b>good design</b> and <b>no border</b>.</td>
			</tr>
			<tr>
				<td class="w"><b>Location</b>: <input class="expansible_input" id="baseUrl" value="<?php echo $location; ?>" required='' name="location" type="text"><br>
				(Where your business is located)</td>
			</tr>
			<tr>
				<td class=""><b>Description</b>: <input class="expansible_input" id="baseUrl" required='' value="<?php echo $desc; ?>" name="desc" type="text" ><br>
				(Short Note About your business, what you do and your services)</td>
			</tr>
			<tr>
				<td class="w"><b>Address</b>: <input class="expansible_input" id="baseUrl" required='' value="<?php echo $address; ?>" name="address" type="text" ><br>
				(Your Business Physical Address - landMark )</td>
			</tr>
			<tr>
				<td class=""><b>Phone No</b>: <input class="expansible_input" id="baseUrl" required='' value="<?php echo $phone; ?>" name="phone" type="text" ><br>
				(Your Business Phone Number, pleasae include country code )</td>
			</tr>
			<tr>
				<td class="w"><b>Business Email</b>: <input class="expansible_input" id="baseUrl" required='' value="<?php echo $email; ?>" name="email" type="email" ><br>
				(Your Business Phone Number, pleasae include country code )</td>
			</tr>
			<tr>
				<td class=""><b>Website(opt)</b>: <input class="expansible_input" id="baseUrl" required='' name="site" type="text" value="<?php echo $site; ?>"><br>
				(the website or webpage that your business should lead to when anyone clicks on it)</td>
			</tr>
			<td>
			<input type="submit" name="add" value="Update Info" id="Publish"></td>
			</tr>
		</tbody>
	</table> 
</form>
  <?php } else{?>
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
