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

echo '<a id="top" name="top"></a>'; // anchor

##################### login form ########################

$error="";
?>

    <table>
      <tr>
        <th><h2>ADMIN CONTROL PANEL</h2></th>
      </tr>


         <tr>
        <td class="w" style="text-align: left;">

<table>
 
  <tr>
<td style="border: none; border-radius: 0; border: solid #343 1px; padding: 5px; font-size: 15px; font-weight: bold;">
  <a href="<?php echo WEBROOT; ?>/admin/list-banned-topics"><span>Banned Topics</span></a>
</td>
<td style="border: none; border-radius: 0; border: solid #343 1px; padding: 5px; font-size: 15px; font-weight: bold;">
<a href="<?php echo WEBROOT; ?>/reportedtopic"><span>Reported Topics</span></a>
</td>

<td style="border: none; border-radius: 0; border: solid #343 1px; padding: 5px; font-size: 15px; font-weight: bold;">
<a href="<?php echo WEBROOT; ?>/delete-topics"><span>All Topics</span></a>
</td>

<td style="border: none; border-radius: 0; border: solid #343 1px; padding: 5px; font-size: 15px; font-weight: bold;">
<a href="<?php echo WEBROOT; ?>/list-banned-users"><span>Users</span></a>
</td>

<td style="border: none; border-radius: 0; border: solid #343 1px; padding: 5px; font-size: 15px; font-weight: bold;">
<a href="<?php echo WEBROOT; ?>/list-flagged-topics"><span>Flagged Topics</span></a>
</td>


<td style="border: none; border-radius: 0; border: solid #343 1px; padding: 5px; font-size: 15px; font-weight: bold;">
<?php echo '<a href="'.WEBROOT.'/list-board">Boards</a>'; ?>
</td>
  </tr>
    <tr>
<td style="border: none; border-radius: 0; border: solid #343 1px; padding: 5px; font-size: 15px; font-weight: bold;">
<?php echo '<a href="'.WEBROOT.'/theme-settings">Theme & Appearance </a>'; ?>
</td>
<td style="border: none; border-radius: 0; border: solid #343 1px; padding: 5px; font-size: 15px; font-weight: bold;">
<?php echo '<a href="'.WEBROOT.'/create-forum-rule">Create Forum Rules</a> '; ?>
</td>

<td style="border: none; border-radius: 0; border: solid #343 1px; padding: 5px; font-size: 15px; font-weight: bold;">
<?php echo '<a href="'.WEBROOT.'/create-admin">Create Admin</a>'; ?>
</td>

<td style="border: none; border-radius: 0; border: solid #343 1px; padding: 5px; font-size: 15px; font-weight: bold;">
<?php echo '<a href="'.WEBROOT.'/adcontrol">Ads Control</a>'; ?>
</td>

<td style="border: none; border-radius: 0; border: solid #343 1px; padding: 5px; font-size: 15px; font-weight: bold;">
<?php echo '<a href="'.WEBROOT.'/manage-earnings">Manage Earners</a>'; ?>
</td>


<td style="border: none; border-radius: 0; border: solid #343 1px; padding: 5px; font-size: 15px; font-weight: bold;">
<?php echo '<a href="'.WEBROOT.'/create-mod">Create Moderator</a>'; ?>
</td>
  </tr>
</table>

        </td>
      </tr>
    </table>

<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

?>

	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->

</body>
</html>
