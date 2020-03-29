<?php


$qryConfig = $db->query("SELECT * FROM `site_config` ");
$data=mysqli_fetch_array($qryConfig);
  $appurl = $data['appurl'];
  $appname = $data['appname'];
  $apptitle = $data['apptitle'];
  $appinfo = $data['appinfo'];
  $trademark = $data['trademark'];
  $appdesc = $data['appdesc'];
  $currency = $data['currency'];
  $perpage = $data['indexperpage'];
  $refamt = $data['refamt'];
  $shoutoutcode = $data['shoutoutcode'];

  $author = $data['author'];
  $authorweb = $data['authorweb'];
  $appemail = $data['appemail'];
  $adsemail = $data['adsemail'];
  $noreplyemail = $data['noreplyemail'];
  $timezone = $data['timezone'];

  $fb = $data['fb'];
  $twitter = $data['twitter'];
  $yt = $data['yt'];
  $insta = $data['insta'];
  $shouttime = $data['shouttime'];

  $smtpsecure = $data['smtpsecure'];
  $mailerport = $data['mailerport'];
  $mailerpass = $data['mailerpass'];
  $smtpserver = $data['smtpserver'];
  $smtpdebug = $data['smtpdebug'];
  $sponlimit = $data['sponlimit'];
  $newsfeedlimit = $data['newsfeedlimit'];
  
  $adlinker = $data['adlink'];
  $admsger = $data['admsg'];
  $defaultadurl = $data['adimg'];
  
  
  $perlogin = $data['perlogin'];
  $perview = $data['perview'];
  $perreply = $data['perreply'];
  $persignup = $data['persignup'];
  $perpost = $data['perpost'];
  $googleverify = $data['googleseo'];
  $bing = $data['bing'];
  $alexaVerify = $data['alexaVerify'];
  $yandex = $data['yandex'];
  $addthisid = $data['addthisid'];
  $adspace = $data['adspace'];

define('DEVELOPER', 'Marshall');

@date_default_timezone_set($timezone );


define('WEBROOT', $appurl);  // define custom root for web app
define('APPNAME', $appname); // set application name
define('APPINFO', $appinfo); // set application name
define('TRADEMARK', $trademark); // set application trade mark name
define('URL', $appurl); // set website url
define('FB', $fb); // set application trade mark name
define('TW', $twitter); // set website url
define('GPLUS', ''); // GPLUS url
define('INSTA', $insta); // set INSTA url
define('YOUTUBE', $yt); // set YOUTUBE url
define('TITLE', $apptitle);
define('DSC', $appdesc);
define('EMAIL', $appemail);  // define email
define('REPLYEMAIL', $noreplyemail);  // define email
define('ADEMAIL', $adsemail);  // define email
define('AUTHOR', $author); // set YOUTUBE url
define('AUTHORWEB', $authorweb); // set YOUTUBE url
define('CURRENCY', $currency); // set YOUTUBE url
//define('REF', $ref); // set YOUTUBE url
define('PERPAGE', $perpage); // set YOUTUBE url
define('TIMEZONE', $timezone ); // set YOUTUBE url
define('SOFTWARE', 'CodeXpress Nairaland'); 
define('SPONLIMIT', $sponlimit); // set YOUTUBE url
define('NEWSFEEDLIMIT', $newsfeedlimit ); // set YOUTUBE url
//define('DEVELOPER', 'Marshall');

$licenseurl = 'http://localhost/nl/license/index?url='.$appurl;

function licensed($licenseurl)
{
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $licenseurl,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

return $response;
}


//echo 'Online: '. $response;
//echo time();
//echo $license;
/*if (isset($_COOKIE['username']) && ($_COOKIE['password'])) {
$username = $_COOKIE['username'];
$password = $_COOKIE['password'];
//$password=hash('sha256', $password);

$match = $db->query(\"SELECT * FROM users WHERE username='$username' AND password='$password'\");
$countlog=mysqli_num_rows($match);
$data = mysqli_fetch_array($match);
$user_id= $data['uid'];
$username = $data['username'];
$email = $data['email'];
$access = $data['access'];
$status = $data['status'];
setcookie(\"username\", $username, time()+(10*365*24*60*60)); // store into cookies
setcookie(\"password\", $password, time()+(10*365*24*60*60));// store into cookies
$_SESSION['AutenUsera']=1; //SET TO TRUE.
$_SESSION['user_id']=$user_id; //Storing user ID in SESSION variable.
$_SESSION['username']=$username; //Storing USERNAME in SESSION variable.
$_SESSION['email']=$email; //Storing EMAIL in SESSION variable.
$_SESSION['access']=$access; //Storing ACCESS in SESSION variable.
$dailytime = date('d-m-Y');
$created=date('D M Y h:sa');
$lastlogin=time();
$db->query(\"UPDATE users SET activeSince ='$lastlogin', lastlogin='$created' WHERE uid = '$user_id'\");
} */