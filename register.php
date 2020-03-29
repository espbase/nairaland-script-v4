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
require 'mail.config.php';
$mail->From = REPLYEMAIL;
$mail->FromName = APPNAME;
require_once 'incfiles/theme/head_open.php';
############################### page title #######################

	$page_title='Create Account';
	$site_dsc="create your new awesome account";
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

echo '<a id="top" name="top"></a>'; // anchor


##################### registration script ########################
if(isset($_GET['next']))
{
	if(isset($_POST['username']))
	{

	$username=trim(strtolower($_POST['username']));
	$location=trim($_POST['location']);
	$email=trim(strtolower($_POST['email']));
	$password=trim(md5($_POST['password']));
	$birthday=$_POST['birthday'];
	$birthmonth=$_POST['birthmonth'];
	$birthyear=$_POST['birthyear'];
	$gender=$_POST['gender'];
	$location=$_POST['location'];
	$personaltext=$_POST['personaltext'];
	$fb=$_POST['fb'];
	$twitter=$_POST['twitter'];
	$name=$_POST['name'];
	$phone=$_POST['phone'];

	$regdate=date('M d Y');

    $match1 = $db->query("SELECT username FROM users WHERE username ='$username' ");
    $checkusername = mysqli_num_rows($match1);

    if($checkusername)
    {
    echo '<h2>Username not available!</h2>';
    }
    else
    {
	$createAcount=$db->query("UPDATE users
		SET name='$name',username='$username', phone='$phone', password='$password', status='1', gender='$gender', avater='avatar.png', validcode='0', activeSince=NOW(), registered_date='$regdate', location='$location', personaltext='$personaltext', fb='$fb', twitter='$twitter', birthday='$birthday', bmonth='$birthmonth', byear='$birthyear'
		WHERE email='$email' ");

	if($createAcount)
	{
		
$mail->addAddress($email); // Name is optional;
$mail->isHTML(true);
$mail->Subject ='Welcome to the '.APPNAME;
$mail->Body = '<div class="email--background">
  
  <div class="email--container">
    <div class="email--inner-container">
    <p>Warm Welcome Dear '.ucfirst($username).',</p>

<p>'.APPNAME.' is a professional community.
Our purpose is to share, help and support each other in WIN/WIN ways.
Please display a positive, friendly attitude and be respectful of other\'s opinions.</p>

<p>• Attacking other members, bashing companies, slander and libel are not allowed and can result in a warning or ban. Comments that are disrespectful to others or otherwise violate what we believe are appropriate standards for professional and civil discussion may be deleted.</p>

<p>• Always try to "give" back to our community. For each time you find help or answers, try to help someone else out in return. You may find that what goes around comes around...</p>

<p>• Give people a little time to respond to your requests. This is a peer support community. People are busy and it may take a little time for people to notice and respond to your request. Please be patient.</p>

<p><b>• PLEASE TRY TO POST IN THE CORRECT SECTION OF THE FORUM -</b> The valuable info we have here is coming in at break neck speed. I\'m constantly having to add new forums to try to keep the info organized and make it easier to find. Please take minute before asking a question or posting a new thread to look at all the forum categories on the forum home page. You may find your answer there or discover someone already posted about that issue.</p>
    
       <hr>
    <h3>Best Regards</h3>
    <p>'.APPNAME.' Team <br> < <a href="'.URL.'" class="cta">Website</a> ></p>
    </div>
  </div>
</div>';

$match = $db->query("SELECT * FROM users WHERE username='$username'");
	$data = mysqli_fetch_array($match);
	$user_id= $data['uid'];
	$username = $data['username'];
	$email = $data['email'];
	$access = $data['access'];
	$status = $data['status'];
	$password = $data['password'];

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

	$lastlogin=time();
	$db->query("UPDATE users SET activeSince ='$lastlogin' WHERE uid = '$user_id'");

	echo '<script type="text/javascript">window.location = "'.WEBROOT.'/dashboard"; </script>';

	}
		}
	}

}




if(isset($_GET['validcode']) && ($_GET['email']) )
     {

     $code = $_GET['validcode'];
     $email = $_GET['email'];

     //echo "$email";

     $match = $db->query("SELECT * FROM users WHERE email ='$email' AND validcode='$code' AND status='0' ");
    $mysql_num_rows = mysqli_num_rows($match);
    $row=mysqli_fetch_array($match);
{
$uid=$row['uid'];
$validcode=$row['validcode'];
$email=$row['email'];


    if($mysql_num_rows)
{

 echo '<div class = "panel panel-default">
   <h2>
      Complete Registration
   </h2>
      <div class = "panel-heading">

		<form action="?next=1" enctype="multipart/form-data" method="post">
		    <input type="hidden" name="email" value="'.$email.'">
			<table summary="profile editing form " class="main_box">
				<tr>
					<td><b>Email</b>:'.$email.'&nbsp;&nbsp;</td>
				</tr>

                    <tr><td valign="top" class="w"><b>Full Name</b>:
         <input type="text" style="width:40%" name="name" value="" required maxlength="255">
         </td></tr>
         <tr><td valign="top" class="w"><b>Phone Number</b>:
         <input type="text" style="width:40%" name="phone" value="" required maxlength="255">
         </td></tr>
				<tr>
					<td class="w"><b>Birthday</b>: <select name="birthday" style="color:#fff" size="1" required>
						<option value="">
							-- Day --
						</option>

<option value="1">
    1
</option>
<option value="2">
    2
</option>
<option value="3">
    3
</option>
<option value="4">
    4
</option>
<option value="5">
    5
</option>
<option value="6">
    6
</option>
<option value="7">
    7
</option>
<option value="8">
    8
</option>
<option value="9">
    9
</option>
<option value="10">
    10
</option>
<option value="11">
    11
</option>
<option value="12">
    12
</option>
<option value="13">
    13
</option>
<option value="14">
    14
</option>
<option value="15">
    15
</option>
<option value="16">
    16
</option>
<option value="17">
    17
</option>
<option value="18">
    18
</option>
<option value="19">
    19
</option>
<option value="20">
    20
</option>
<option value="21">
    21
</option>
<option value="22">
    22
</option>
<option value="23">
    23
</option>
<option value="24">
    24
</option>
<option value="25">
    25
</option>
<option value="26">
    26
</option>
<option value="27">
    27
</option>
<option value="28">
    28
</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">
    31
</option>
</select> 

<select name="birthmonth" style="color:#fff" size="1" required>
						<option selected value="">
							-- Month --
						</option>

						<option value="1">
							January
						</option>

						<option value="2">
							February
						</option>

						<option value="3">
							March
						</option>

						<option value="4">
							April
						</option>

						<option value="5">
							May
						</option>

						<option value="6">
							June
						</option>

						<option value="7">
							July
						</option>

						<option value="8">
							August
						</option>

						<option value="9">
							September
						</option>

						<option value="10">
							October
						</option>

						<option value="11">
							November
						</option>

						<option value="12">
							December
						</option>
					</select>';
					?>
                    
					<select name="birthyear"style="color:#fff"  size="1" required>
						<option value="" selected="">-- Year --</option>
					<?php
				for ($x = 1950; $x <= 2050; $x++) {
    		echo "<option value='$x'>$x</option>";
			}  ?>
				</select></td>
				</tr>

<?php
			echo '<tr>
					<td class=""><b>Gender</b>: <select style="color:#fff" name="gender" size="1">
						<option selected value="1">
							Male
						</option>

						<option value="2">
							Female
						</option>
					</select></td>
				</tr>
				<tr>
					<td valign="top"><b>Username</b>:  <input type="text" onblur="this.value=removeSpaces(this.value);" id="username" required name="username" class="form-control" placeholder="Choose username"><br> 
					<small id="usernamealert" style="color:red;">Space are automatically remove on username! </small></td>
				</tr>


				<tr>
					<td valign="top"><b>Password</b>:  <input type="password" name="password" required class="form-control" placeholder="Choose Password"> </td>
				</tr>

				<tr>
					<td><b>Location</b>: <input name="location" type="text" value="" placeholder="Choose Location"></td>
				</tr>


				<tr>
					<td class="w" valign="top"><b>Personal text</b>: <input maxlength="255" name="personaltext" style="width:40%" type="text" value="" placeholder="Enter Personal Text"></td>
				</tr>
				<tr>
					<td class="w"><b>Facebook</b>: <input name="fb" type="text" value="" placeholder="Facebook Username"></td>
				</tr>


				<tr>
					<td><b>Twitter Handle</b>: <input name="twitter" type="text" value="" placeholder="Twitter Username"></td>
				</tr>

			</table>
			<p><input name="next" type="submit" value="Complete Registration"> </p>
		</form>
   </div>
</div>';
}

else
{
   echo ' <div class="section-title">
    <h1>An error occured!</h1>
    <div class="divider"></div>
  </div>
';
}
}
}


echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

?>

	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->
</script>

<script type="text/javascript">
function removeSpaces(string) {
 return string.split(' ').join('');
}
</script>
</body>
</html>
