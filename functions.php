<?php
/*
NOTE:

PLEASE DON'T EDIT OR REMOVE ANY LINE OF CODE
EXCEPT YOU KNOW WHAT YOU ARE DOING
----------------------------------------------------------------------------------------
*/
//@$nlverify = file_get_contents('https://textuploader.com/1dv3n/raw');

require 'incfiles/agoTime.php';
//-----------------------------------------------------------------
function encrypt($string){
  return base64_encode(base64_encode(base64_encode($string)));
}

function decrypt($string){
  return base64_decode(base64_decode(base64_decode($string)));
}

function getpercent($total, $number)
{
if ($total> 0) {
# code...
return round($number / ($total / 100), 2);
}
else
{
return 0;
}
}

function highlightWords($text, $word){
  $array = array('up', 'speed'); 
    $text = preg_replace('#'. preg_quote($word) .'#i', '<span style="background:yellow !important; color:#000; padding:2px; font-size:16px;">\\0</span>', $text);
    return $text;
}

function BoldWords($text, $word){
    $text = preg_replace('#'. preg_quote($word) .'#i', '<b>\\0</b>', $text);
    return $text;
}

function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $string); // Removes special chars.

   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}
//echo clean('a|"bc!@£de^&$f g +ksjas(df%jjjk');

//count number of registered users
function users($db)
{
$QueryReg=$db->query("SELECT uid FROM users WHERE status='1'");
$countReg=mysqli_num_rows($QueryReg);

return $countReg; // echo numbers of users
 exit;
}

//count number of topics
function topics($db)
{
$QueryTopic=$db->query("SELECT * FROM topics");
$count_article=$QueryTopic->num_rows;

return $count_article; // echo numbers of users
 exit;
}

//count number of topics
function totalcomments($db)
{
$QueryComments=$db->query("SELECT * FROM topic_comments");
$count_comments=$QueryComments->num_rows;

return $count_comments; // echo numbers of users
 exit;
}

function newsfeed($db)
{
$QueryTopic=$db->query("SELECT * FROM topics WHERE post_type='newsfeed'");
$count_article=$QueryTopic->num_rows;

return $count_article; // echo numbers of users
 exit;
}

/*
This function check for user authorization,
allow user to visit protected area
*/
function checkUser()
{
	if(empty($_SESSION['user_id']) OR empty($_SESSION['username']) OR empty($_SESSION['AutenUsera']))
	{
	echo '<script type="text/javascript">window.location = "'.WEBROOT.'/login"; </script>';
	}
}


/*
birthday script
*/
function postBirthdays($db)
{
  $bday=date('d');
  $bmonth=date('m');
  $selectDate=$db->query("SELECT * FROM users WHERE birthday='$bday' AND bmonth='$bmonth' ");
  while ($data=$selectDate->fetch_assoc())
  {
    //date in mm/dd/yyyy format; or it can be in other formats as well
    $day=$data['birthday'];
    $month=$data['bmonth'];
    $year=$data['byear'];
    $busername=$data['username'];
    $gender=$data['gender'];
    if($gender==1)
    {
       $gender='m'; 
    }
    else
    {
       $gender='f';  
    }
    $birthDate = "$month/$day/$year";//"12/17/1983";
    //explode the date to get month, day and year
    $birthDate = explode("/", $birthDate);
    //get age from date or birthdate
    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
      ? ((date("Y") - $birthDate[2]) - 1)
      : (date("Y") - $birthDate[2]));
    echo "<a href='u/$busername' class='homeuser'>$busername(<span class='$gender'>$age</span>)</a>,";
  }
}


// update info
 
function newReleased(){
    $details='<div style="width:100%;text-align:center; color:#A60808; background-color:#10E9F2;">
     For more please contact us <strong>@ <a style="color:#A60808;" href="mailto:'.EMAIL.'">'.EMAIL.'</a> </strong> 
    </div>';
    return $details;
}

// siteinfo contact info
class siteinfo{
  public function __construct(){}

  public function devInfo(){
    $details='<div style="width:100%;text-align:center; color:#00f;">
    </div>';
    return $details;
  }
}

function formatWithSuffix($input)
{
    $suffixes = array('', 'k', 'm', 'g', 't');
    $suffixIndex = 0;

    while(abs($input) >= 1000 && $suffixIndex < sizeof($suffixes))
    {
        $suffixIndex++;
        $input /= 1000;
    }

    return (
        $input > 0
            // precision of 3 decimal places
            ? floor($input * 1000) / 1000
            : ceil($input * 1000) / 1000
        )
        . $suffixes[$suffixIndex];
}

// developer details
class credit{
  public function __construct(){}

  public function developer(){
    $details='<div style="text-align: right;position: fixed;z-index:9999999;bottom: 0;width: auto;right: 1%;cursor: pointer;line-height: 0;display:block !important;"><a title="NL Official Forum Script" target="_blank" href="https://nlscript.000webhostapp.com/?utm_source=nlscript&amp;utm_campaign=000_logo&amp;utm_medium=website&amp;utm_content=footer_img"><img src="'.URL.'/images/footer-powered.png" width="100" alt="www.nlscript.000webhostapp.com"></a></div>';
    return $details;
  }
}
// don't delete else app won't work
class appVerify{
  public function __construct(){}

  public function licenseKey($licenseurl){
   if (licensed($licenseurl)) {
  # code...
  //echo "registered";

}else
{
echo '
<div class="heade_line" style="height: 2px;background-image: linear-gradient(90deg,transparent,#fa1e4e,transparent); margin-top: 9px;"></div>
<h1>**Evaluation Version!**</h1>
<div class="heade_line" style="height: 2px;background-image: linear-gradient(90deg,transparent,#fa1e4e,transparent); margin-top: 9px;"></div>
<table>
  <tr>
    <td class="w">========================= Get Full Version =========================<br>
    <p>"Most of the features of <a href="https://bit.ly/nlscript">'.SOFTWARE.'</a> have been disabled because it hasn\'t been activated"<br>

   <div class="heade_line" style="height: 2px;background-image: linear-gradient(90deg,transparent,#fa1e4e,transparent); margin-top: 9px;"></div>
    
<h3>Why it happens</h3>

You must have running <a href="https://bit.ly/nlscript">'.SOFTWARE.'</a> as trial or  <a href="https://codexpress.info/nlscript" target="_blank">Subscribe</a> to continue using it.<br>

<div class="heade_line" style="height: 2px;background-image: linear-gradient(90deg,transparent,#fa1e4e,transparent); margin-top: 9px;"></div>

'.SOFTWARE.' hasn\'t been activated. To keep using '.SOFTWARE.' without interruption, activate before using it<br>
<h3>How to Activate '.SOFTWARE.' For Your Domain</h3>
     <a href="https://codexpress.info/nlscript" target="_blank">See Our Plans</a><br>
      Contact <a href="mailto:marshallunduemi@gmail.com">support &rsaquo;&rsaquo;</a>  if any problem occure 
      </a>
    </td>
  </tr>
</table>
<table>
      <tbody>
        <tr>
          <td class="small w grad">
          
            <b><a href="https://m.me/marshallunduemi" title="Codexpress Programming Labs">Marshall\'s Invent</a></b> - Copyright © 2017 <a href="https://codexpress.info/nlscript" title="Codexpress">Codexpress</a>. All rights reserved.
            <br><b>Disclaimer</b>: Your are <b>solely responsible</b> for <b>this application</b></td>
        </tr>
      </tbody>
    </table> ';
exit();
};
   // return $details;
  }
}


 function badWordFilter($data){
      $originals = array("sesx", ":)", ";)", ":D", ";D", ">:(", ":(", ":o", ":8)", ":P", ":-[", ":-X", "???", ":-:", ":-*", ":'(", ":'*(", ":&*(", "*&*"); // list of words to remove
      $replacements = array("****", "<img src='".URL."/icons/smiling.png' class='faces'/>", 
        "<img src='".URL."/icons/winking.png' class='faces'/>", 
      "<img src='".URL."/icons/hug.png' class='faces'/>",
      "<img src='".URL."/icons/hundredpoints.png' class='faces'/>",
      "<img src='".URL."/icons/rose.png' class='faces'/>",
      "<img src='".URL."/icons/redheart.png' class='faces'/>",
      "<img src='".URL."/icons/dizzy.png' class='faces'/>",
      "<img src='".URL."/icons/crown.png' class='faces'/>",
      "<img src='".URL."/icons/tongue.png' class='faces'/>",
      "<img src='".URL."/icons/kisseyes.png' class='faces'/>",
      "<img src='".URL."/icons/facekiss.png' class='faces'/>",
      "<img src='".URL."/icons/loudcry.png' class='faces'/>",
      "<img src='".URL."/icons/grimacing.png' class='faces'/>",
      "<img src='".URL."/icons/fire.png' class='faces'/>",
      "<img src='".URL."/icons/victoryhand.png' class='faces'/>",
      "<img src='".URL."/icons/starface.png' class='faces'/>",
      "<img src='".URL."/icons/raisinghand.png' class='faces'/>",
      "<img src='".URL."/icons/eyes.png' class='faces'/>"); // list of words to replace
      $data = str_ireplace($originals,$replacements,$data);
      return $data;
  }
	
	
function mypoint($user_id,$db)
{
 $checkPoint=$db->query("SELECT SUM(point_earned) FROM tranfer_request WHERE user_id_fk='$user_id' ");
$data=$checkPoint->fetch_assoc();
$user_points=$data['SUM(point_earned)']; 
return $user_points;
}
function pointUsed($user_id,$db)
{
 $checkPoint=$db->query("SELECT SUM(point_used) FROM tranfer_request WHERE user_id_fk='$user_id' ");
$data=$checkPoint->fetch_assoc();
$user_points=$data['SUM(point_used)']; 
return $user_points;
}

function toRedeem($user_id,$db)
{
  $checkPoint=$db->query("SELECT SUM(topic_earn), SUM(comment_earn), SUM(view_earn) FROM point_earn WHERE uid_fk='$user_id' ");
$data=$checkPoint->fetch_assoc();
$user_points=$data['SUM(topic_earn)']+$data['SUM(comment_earn)']+$data['SUM(view_earn)'];
return $user_points;
}



function cart_code_gen($length = 5) {
  $str = "";
  $characters = array_merge(range('0','9'));
  $max = count($characters) - 1;
  for ($i = 0; $i < $length; $i++) {
    $rand = mt_rand(0, $max);
    $str .=$characters[$rand];
  }
  return $str;
}

/* gets the data from a URL */
function get_data($url) {
  $ch = curl_init();
  $timeout = 5;
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

      function nltimeago($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
//echo time_elapsed_string('2013-05-01 00:22:35');
//echo time_elapsed_string('@1367367755'); # timestamp input
//echo time_elapsed_string('2013-05-01 00:22:35', true);

function userRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
$user_ip=userRealIpAddr(); // get user machine address code
$user_agent=$_SERVER['HTTP_USER_AGENT'];

//get login user sessions details
if(isset($_SESSION['AutenUsera']) && $_SESSION['AutenUsera'] == 1) {
$user_id=$_SESSION['user_id'];

$getUserDetails = $db->query("SELECT * FROM users WHERE uid='$user_id' ");
$data = mysqli_fetch_array($getUserDetails);

$ses_user_id= $data['uid'];
$ses_username = $data['username'];
$ses_name = $data['name'];
$ses_email = $data['email'];
$ses_access = $data['access'];
$ses_status = $data['status']; 
$ses_adCredit = $data['ad_credit']; 
$ses_user_ref = $data['user_ref']; 

$ses_phone = $data['phone']; 
}


/*
USING PHP TO GET USER GEOLOCATION INFORMATION
----------------------------------------------------------------------------
City
State
Country
Country_Code
Continent
Continent_Code
----------------------------------------------------------------------------

*/
function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city"           => @$ipdat->geoplugin_city,
                        "state"          => @$ipdat->geoplugin_regionName,
                        "country"        => @$ipdat->geoplugin_countryName,
                        "country_code"   => @$ipdat->geoplugin_countryCode,
                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}

/*

############## HOW TO CALL THE FUNCTION ON YOUR WEBSITE 
############## REOLACE IP_ADDRESS WITH YOUR IP GOTTEN FROM USER 
############## 


*/
function addays($adStart)
{
 $now = time(); // or your date as well
$your_date = strtotime($adStart);
$datediff = $now - $your_date; 
$real= round($datediff / (60 * 60 * 24));
return $real;
}

function earnfx($topic_id, $user_id, $amtfit, $type='post', $user_ip,$db)
{
$created=date('D M Y h:sa');

$qryCh = $db->query("SELECT * FROM earnings WHERE earn_status=1 AND earn_type='$type' AND user_id_fk='$user_id' ");
$count = mysqli_num_rows($qryCh);

if ($count) {
  # code...
}
else
{
  $inQury=$db->query("INSERT INTO earnings (post_id_fk,user_id_fk,earn_amt,earn_status,earn_type,earn_date,earn_ip) 
          VALUES ('$topic_id',  '$user_id',  '$amtfit',  '1', '$type', '$created', '$user_ip') ");
}
}
