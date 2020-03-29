<?php
/*
Developer: Marshall Unduemi
Url: www.codexpresslabs.info
Contact: info@codexpresslabs.info

*/
//Enable Error Reporting

error_reporting(0);
//remove the above comment to enable error reporting

require_once ('config.php');
require_once ('functions.php');
echo checkUser();
require_once 'incfiles/theme/head_open.php';
############################### page title #######################

	$page_title='Website Setting';
	$site_dsc=APPNAME." Website Setting  ";
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

echo '<a id="top" name="top"></a>'; // anchor

##################### login form ########################

$error="";
$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.
$username=$_SESSION['username']; //Storing USERNAME in SESSION variabl
$useremail=$_SESSION['email']; //Storing EMAIL in SESSION variable.
##################### verify EMAIL form ########################
if (isset($_REQUEST['code']) && ($_REQUEST['code'])!='') 
{
  # code...
 $VerifyCode=$_REQUEST['code']; 
 //check databse if correct
$match = $db->query("SELECT * FROM users WHERE emailreset='$VerifyCode'");
$data = mysqli_fetch_array($match);
$nlreset= $data['emailreset'];

          if ($VerifyCode==$nlreset) {

if (isset($_POST['email'])) {
          $email=$_POST['email'];
            # if true go ahead
          $to = $email;
          $appurl=URL;
          $subject = "Email Reset Successful";
          $body = "Hello $username.  This is an automatic mail please don't reply to this message.
          Your email was successfully changed new mail is(".$email.")\r\n" ."
          Rgards: TEAM ";

          $db->query("UPDATE users SET email ='$email', emailreset='' WHERE uid='$user_id'");
          mail($to,$subject,$body);

          echo '<div style="width:100%;text-align:center; color:#0BC5B7; font-weight:bold">Howdy '.$username.', Your email was successfully changed</div>';
          echo '<script type="text/javascript">window.location = "'.WEBROOT.'/login"; </script>';
  }
  ?>
   <h2>Enter New Email Address</h2>


<form action="" method="POST">
       <table summary="email changing form">
       <tbody><tr><td class="m"><b>Note:</b> this will update the manner you receive updates from us.
       </td></tr><tr><td>New Email:<input type="email" id="qsearch" size="40" name="email">
       <button type="submit">Submit</button>
       </td></tr></tbody></table>
       </form>
  <?php
  }
          else
          {
            echo '<div style="width:100%;text-align:center; color:red; font-weight:bold">Oops! an error couured, try again later or <a href="mailto:'.EMAIL.'&subject=Email reset error">Report to us!</a></div>';
          }

}


##################### CHANGE EMAIL form ########################
  $mail_verify= mt_rand();
if (isset($_POST['codegen'])) {
  $codegen=$_POST['codegen'];
//validate email address
  if ($useremail) {
    # if true go ahead
  $to = $useremail;
  $appurl=URL;
  $subject = "Email Reset Link";
  $body = "Hello $username.  This is an automatic mail please don't reply to this message.
  Click the link below to change your email  or copy url to your browser
  
  $appurl/changeemail?code=$codegen". "\r\n" ."
  Rgards: TEAM ";

  $db->query("UPDATE users SET emailreset ='$codegen' WHERE email = '$useremail'");
  mail($to,$subject,$body);

  echo '<div style="width:100%;text-align:center; color:#0BC5B7; font-weight:bold">A reset link have been sent to your email during registration, check your inbox</div>';
  }
  
//
}
?>
<h2>Request Email Change</h2>

<form action="" method="POST">
       <table summary="email changing form">
       <tbody><tr><td class="w">Current Email: <?php echo "<b><span class='m'>$useremail</span></b>"; ?>
       </td></tr><tr><td><input type="hidden" value="<?php echo $mail_verify; ?>" name="codegen">
       <button type="submit">Request Email Change</button>
       </td></tr></tbody></table>
       </form>

<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

?>

	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->

</body>
</html>
