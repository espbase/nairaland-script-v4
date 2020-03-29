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

	$page_title='Website Setting';
	$site_dsc=APPNAME." Website Setting  ";
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

if (isset($_POST['saveconfig'])) {
  $appurl = addslashes($_POST['appurl']);
  $appname = addslashes($_POST['appname']);
  $apptitle = addslashes($_POST['apptitle']);
  $appinfo = addslashes($_POST['appinfo']);
  $trademark = addslashes($_POST['trademark']);
  $appdesc = addslashes($_POST['appdesc']);
  $currency = addslashes($_POST['currency']);
  $perpage = addslashes($_POST['perpage']);
  $ref = addslashes($_POST['ref']);
  $timezone = addslashes($_POST['timezone']);

  $updateCon = $db->query("UPDATE site_config 
    SET appurl='$appurl', appname='$appname', apptitle='$apptitle', appinfo='$appinfo', trademark='$trademark', appdesc='$appdesc', currency='$currency', refamt='$ref', timezone='$timezone', indexperpage='$perpage' WHERE config_id=1 ");

  echo "<script>alert('Configuration Updated');</script>";
}
?>
<table>
  <tbody>
    <tr>
      <th><h2>WEBSITE CONFIGURATION</h2>
        <p>Please enter your email address and a link allowing you to reset your password will be emailed to you.</p>
    </th>
  </tr>
   <form method="POST" action="">
  <tr>
    <td class="w"> 
    <b>App URL</b><input type="text" value="<?php echo URL; ?>" name="appurl" size="32">
  </td>
</tr>

<tr>
    <td class="w">
    <b>App Name </b><input type="text" value="<?php echo APPNAME; ?>" name="appname" size="32">
  </td>
</tr>
<tr>
    <td class="w">
    <b>App Title </b><input type="text" value="<?php echo TITLE; ?>" name="apptitle" size="32">
  </td>
</tr>

<tr>
    <td class="w">
    <b>App Info </b><input type="text" value="<?php echo APPINFO; ?>" name="appinfo" size="32">
  </td>
</tr>

<tr>
    <td class="w">
    <b>Trademark </b><input type="text" value="<?php echo TRADEMARK; ?>" name="trademark" size="32">
  </td>
</tr>

<tr>
    <td class="w">
    <b>App Discription </b>
     <textarea rows="3" cols="40" name="appdesc" id="body"><?php echo DSC; ?></textarea>
  </td>
</tr>

<tr>
    <td class="w">
    <b>Currency (Initials) </b><input type="text" value="<?php echo CURRENCY; ?>" name="currency" size="32">
  </td>
</tr>

<tr>
    <td class="w">
    <b>Home - Post Per Page</b> <input type="text" value="<?php echo PERPAGE; ?>" name="perpage" size="32">
  </td>
</tr>
<tr>
    <td class="w">
    <b>Referrial Bonus (Amt <?php echo CURRENCY; ?>)</b> <input type="text" value="<?php echo REF; ?>" name="ref" size="32">
  </td>
</tr>

<tr>
    <td class="w">
    <b>Timezone </b>
    <select name="timezone">
      <option>Africa/Nairobi</option>
      <option>Africa/Lagos</option>
    </select>
  </td>
</tr>
<tr>
    <td class="w">
    <input type="submit" name="saveconfig" value="Save Settings">
  </td>
</tr>
    </form>

</tbody>
</table>

<?php
if (isset($_POST['savesocial'])) {
  $fb = addslashes($_POST['fb']);
  $twitter = addslashes($_POST['twitter']);
  $yt = addslashes($_POST['yt']);
  $insta = addslashes($_POST['insta']);
  $author = addslashes($_POST['author']);
  $authorweb = addslashes($_POST['authorweb']);

  $updateCon = $db->query("UPDATE site_config 
    SET author='$author', authorweb='$authorweb', fb='$fb', twitter='$twitter', yt='$yt', insta='$insta' WHERE config_id=1 ");

  echo "<script>alert('Social Configuration Updated');</script>";
}
?>
<table>
  <tbody>
    <tr>
      <th><h2>APP SOCIAL AND CONTACT</h2>
    </th>
  </tr>
   <form method="POST" action="">
  <tr>
    <td class="w"> 
    <b>Facebook Username</b><input type="text" value="<?php echo FB; ?>" name="fb" size="32">
  </td>
</tr>

<tr>
    <td class="w">
    <b>Twitter Username</b><input type="text" value="<?php echo TW; ?>" name="twitter" size="32">
  </td>
</tr>
<tr>
    <td class="w">
    <b>Youtube Username</b><input type="text" value="<?php echo YOUTUBE; ?>" name="yt" size="32">
  </td>
</tr>

<tr>
    <td class="w">
    <b>Instagram Username</b><input type="text" value="<?php echo INSTA; ?>" name="insta" size="32">
  </td>
</tr>
<tr>
    <td class="w">
    <b>App Owner </b><input type="text" value="<?php echo AUTHOR; ?>" name="author" size="32">
  </td>
</tr>

<tr>
    <td class="w">
    <b>Owner Website</b><input type="url" value="<?php echo AUTHORWEB; ?>" name="authorweb" size="32">
  </td>
</tr>

<tr>
    <td class="w">
    <input type="submit" name="savesocial" value="Save Settings">
  </td>
</tr>
    </form>

</tbody>
</table>

<?php
if (isset($_POST['saveblogsetting'])) {
  $spon = addslashes($_POST['spon']);
  $feed = addslashes($_POST['feed']);


  $updateCon = $db->query("UPDATE site_config 
    SET sponlimit='$spon', newsfeedlimit='$feed' WHERE config_id=1 ");

  echo "<script>alert('Blog Configuration Updated');</script>";
}
?>
<table>
  <tbody>
    <tr>
      <th><h2>BLOG SETTINGS</h2>
    </th>
  </tr>
   <form method="POST" action="">
  <tr>
    <td class="w"> 
    <b>Sponsored Post Per Page</b><input type="text" value="<?php echo SPONLIMIT; ?>" name="spon" size="32">
  </td>
</tr>

<tr>
    <td class="w">
    <b>NewsFeed Post Per Page</b><input type="text" value="<?php echo NEWSFEEDLIMIT; ?>" name="feed" size="32">
  </td>
</tr>
<tr>
    <td class="w">
    <input type="submit" name="saveblogsetting" value="Save Settings">
  </td>
</tr>
    </form>

</tbody>
</table>
<?php
if (isset($_POST['saveemail'])) {
  $appemail = addslashes($_POST['appemail']);
  $adsemail = addslashes($_POST['adsemail']);
  $noreplyemail = addslashes($_POST['noreplyemail']);
  $smtpsecure = addslashes($_POST['smtpsecure']);
  $mailerport = addslashes($_POST['mailerport']);
  $smtpserver = addslashes($_POST['smtpserver']);
  $mailerpass = addslashes($_POST['mailerpass']);
  $smtpdebug = addslashes($_POST['smtpdebug']);

  $updateCon = $db->query("UPDATE site_config 
    SET appemail='$appemail', adsemail='$adsemail', noreplyemail='$noreplyemail', mailerpass='$mailerpass', mailerport='$mailerport', smtpserver='$smtpserver', smtpdebug='$smtpdebug', smtpsecure='$smtpsecure' WHERE config_id=1 ");

  echo "<script>alert('EMAIL Configuration Updated');</script>";
}
?>
<table>
  <tbody>
    <tr>
      <th><h2>EMAIL SETTINGS</h2>
    </th>
  </tr>
   <form method="POST" action="">
    <tr>
    <td class="w">
    <b>App Email </b><input type="text" value="<?php echo EMAIL; ?>" name="appemail" size="32">
  </td>
</tr>

<tr>
    <td class="w">
    <b>Ads Email </b><input type="text" value="<?php echo $adsemail; ?>" name="adsemail" size="32">
  </td>
</tr>

<tr>
    <td class="w">
    <b>No Reply Email </b><input type="text" value="<?php echo $noreplyemail; ?>" name="noreplyemail" size="32">
  </td>
</tr>
  <tr>
    <td class="w"> 
    <b>SMTP Secure</b><input type="text" value="<?php echo $smtpsecure; ?>" name="smtpsecure" size="32">
  </td>
</tr>

<tr>
    <td class="w">
    <b>Mail Port</b><input type="text" value="<?php echo $mailerport; ?>" name="mailerport" size="32">
  </td>
</tr>
<tr>
    <td class="w">
    <b>SMTP servers</b><input type="text" value="<?php echo $smtpserver; ?>" name="smtpserver" size="32">
  </td>
</tr>

<tr>
    <td class="w">
    <b>SMTP Password</b><input type="text" value="<?php echo $mailerpass; ?>" name="mailerpass" size="32">
  </td>
</tr>
<tr>
    <td class="w">
    <b>SMTP Debug</b><input type="text" value="<?php echo $smtpdebug; ?>" name="smtpdebug" size="32">
    <br><small>0 means don't show debug information | 1 means show information</small>
  </td>
</tr>

<tr>
    <td class="w">
    <input type="submit" name="saveemail" value="Save Settings">
  </td>
</tr>
    </form>

</tbody>
</table>


<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';

//load footer from footer.php
require_once ('footer.php');

?>

</body>
</html>
