<?php
/*
Developer: Marshall Unduemi
Url: www.codexpresslabs.info
Contact: info@codexpresslabs.info

*/
//Enable Error Reporting

//error_reporting(1);
//exit();
//remove the above comment to enable error reporting
require_once ('config.php');
require_once ('functions.php');
require 'mail.config.php';
$mail->From = REPLYEMAIL;
$mail->FromName = APPNAME;

##################### login form ########################
//echo $perlogin;

$error="";
if(isset($_POST['Logusers'])){
    
$username = trim($_POST['username']); //Storing username in $username variable.
$password = md5($_POST['password']); //Storing password in $password variable.

$match = $db->query("SELECT * FROM users WHERE username='$username' AND password='$password'");
$countlog=mysqli_num_rows($match);
$data = mysqli_fetch_array($match);
$user_id= $data['uid'];
$username = $data['username'];
$email = $data['email'];
$access = $data['access'];
$status = $data['status'];

if($countlog==0){ //if there is no such username and password.

$error="<small class='alert alert-danger'>Sorry, there is no username with the specified password.</small><br>";
// error message to display
//$_SESSION['AutenUsera']=0; //SET TO FALSE.
session_destroy();
//exit();
}
elseif
($status==0)
{

$error="<small class='alert alert-danger'>Sorry, you are banned!.</small><br>";
// error message to display
session_destroy();
}
else
{
 if(($_SESSION['username']=$username) and ($_SESSION['password']=$password)){
     
$_SESSION['AutenUsera']=1; //SET TO TRUE.
$_SESSION['user_id']=$user_id; //Storing user ID in SESSION variable.
$_SESSION['username']=$username; //Storing USERNAME in SESSION variable.
$_SESSION['email']=$email; //Storing EMAIL in SESSION variable.
$_SESSION['access']=$access; //Storing ACCESS in SESSION variable.


setcookie("username", $username, time()+(10*365*24*60*60));
setcookie("password", $password, time()+(10*365*24*60*60));


$logtime=date("h:ia");
$logdate=date("F d, Y");


// Enable TLS encryption, `ssl` also accepted

$mail->addAddress($email);               // Name is optional;
$mail->isHTML(true);
$mail->Subject ='Login Notification';
$mail->Body = '<div class="email--background">
  
  <div class="email--container">
    <div class="email--inner-container">
    <img src="'.URL.'/images/logo.png"/>
    <p>Dear '.$username.',<br>

You logged in at '.$logtime.' on '.$logdate.' from the following desktop device: 
User Agent: '.$user_agent.'
IP Address: '.$user_ip.'
</p>
       <hr>
    <h3>Best Regards</h3>
    <p>'.APPNAME.' Team <br> < <a href="'.URL.'" class="cta">Website</a> ></p>
    </div>
  </div>
</div>';
if (!$mail->send()) {
 echo '<div style="width:100%;text-align:center; color:#C5110BCC; font-weight:bold">Oops! an unknow error occured</div>';
}

$dailytime = date('d-m-Y');
$created=date('D M Y h:sa');


$lastlogin=time();

$db->query("UPDATE users SET activeSince ='$lastlogin', lastlogin='$created' WHERE uid = '$user_id'");
if(isset($_GET['redirect']) && ($_GET['redirect'])!='')
{
 $redirect=$_GET['redirect'];  
 echo '<script type="text/javascript">window.location = "'.$redirect.'"; </script>';
}
else
{
 echo '<script type="text/javascript">window.location = "'.WEBROOT.'"; </script>';   
}


//header("location: index"); //Redirect after successful login.
} 
}

}
require_once 'incfiles/theme/head_open.php';
############################### page title #######################

$page_title='Login To '. APPNAME;
$site_dsc='Login To '. APPNAME;
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

?>
<h2>Login To <?php echo APPNAME; ?></h2>

	<table>
		<tbody>
			<tr>
				<th>Login With Password:</th>
			</tr>
			<tr>
				<td class="w">
				      <span style="color: red; font-size: 17px;"><?php echo $error; ?></span>
					<form action="" method="post">
						User Name: <input name="username" type="text"> 
						&nbsp; Password: <input name="password" type="password"> 
						<input type="submit" name="Logusers" value="Login">
					</form>
				</td>
			</tr>
		</tbody>
	</table>
	
<p></p>	


 <?php
  if(isset($_POST['forget_pass'])){
$email = $_POST['email']; //Storing email in $username variable.

$match = $db->query("SELECT * FROM users WHERE email ='$email'"); 
$mysql_num_rows = mysqli_num_rows($match);
if(mysqli_num_rows($match)!=0)
{ 
$row=mysqli_fetch_assoc($match);
    $db_email = $row['email'];


if($email==$db_email)
{
  $code = rand(10000,1000000);
  $to = $db_email;
  $appname=URL;


// Enable TLS encryption, `ssl` also accepted

$mail->addAddress($email);               // Name is optional;
$mail->isHTML(true);
$mail->Subject ='Password Reset Link';
$mail->Body = '<div class="email--background">
  
  <div class="email--container">
    <div class="email--inner-container">
    <p>Hello '.$to .', This is an automatic mail please don\'t reply to this message. <br>
  Click the link below to reset your password  or copy to your browser
  <a href="'.URL.'/reset-password?code='.$code.'&email='.$email.'">Reset Password</a>
</p>
       <hr>
    <p><a title="'.APPNAME.'" href="'.URL.'" target="_blank" rel="noopener">'.APPNAME.'.</a><br /><em>Westlands Nairobi Kenya.</em></p>
<p>P. O. BOX 4469-00100</p>
<p>Cell Phone: 0791890826</p>
<p style="text-align: justify;">DISCLAIMER: Information in this message and its attachments are privileged and confidential. It is for the exclusive use of 
the intended recipient(s). If you are not one of the intended recipients, you are hereby informed that any use, disclosure, distribution, and/or copying of this information is 
strictly prohibited. If you receive this message in error, please notify the sender immediately. We cannot accept responsibility for any transmitted viruses.</p>
    </div>
  </div>
</div>';
if (!$mail->send()) {
 echo '<div style="width:100%;text-align:center; color:#C5110BCC; font-weight:bold">Oops! an unknow error occured</div>';
}
else
{

  $db->query("UPDATE users SET passreset ='$code' WHERE email = '$db_email'");

    echo '<div style="width:100%;text-align:center; color:#0BC5B7; font-weight:bold">A reset link have been sent to your email during registration, check your inbox</div>';
}



}else
{
  echo '<div style="width:100%;text-align:center; color:#A60808; font-weight:bold">Email address does not match with this username try again</div>';
}
}else
{
 echo '<div style="width:100%;text-align:center; color:#A60808; font-weight:bold">Email address does not match with any account</div>'; 
}
}

     
     if(!@$_GET['code'])
     {
     echo '
        <table><tbody><tr><th>Reset Your Password:
    </th></tr><tr><td class="w">Please enter your email address and a link allowing you to reset your password will be emailed to you.
    <p></p><form method="POST" action="">
    E-mail: <input name="email" type="text">
    <input type="submit" name="forget_pass" value="Submit">
    </form></td></tr></tbody></table>';
    
     }

?>
          <div>
          Still having trouble? <a href="mailto:info@kenyans247.com" class="login-linkbutton js-contact-support">Contact Admin &rsaquo;&rsaquo;</a>
        </div>


<?php
//load footer from footer.php
require_once ('footer.php');

?>


</body>
</html>
