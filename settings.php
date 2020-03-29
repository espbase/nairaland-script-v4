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

##################### login form ########################

$error="";
?>

    <table>
      <tr>
        <th><h2>WEBSITE CONFIGURATION</h2></th>
      </tr>


         <tr>
        <td class="w" style="text-align: left;">
          <ul>
          <li><?php echo '<a href="'.WEBROOT.'/list-board">Boards</a>'; ?></li>
          <li><?php echo '<a href="'.WEBROOT.'/create-mod">Create Moderator</a>'; ?></li>
          <li><?php echo '<a href="'.WEBROOT.'/adcontrol">Ads Control</a>'; ?></li>
          <li><?php echo '<a href="'.WEBROOT.'/ad-credit.php">Fund User Account</a>'; ?></li>
          <li><?php echo '<a href="'.WEBROOT.'/create-admin">Create Admin</a>'; ?></li>
          <li><?php echo '<a href="'.WEBROOT.'/manage-pages">Manage Pages</a> '; ?></li>
          <li><?php echo '<a href="'.WEBROOT.'/theme-settings">Theme & Appearance </a>'; ?></li>
          <li><?php echo '<a href="'.WEBROOT.'/update-config">Website Configuration</a>'; ?></li>

          </ul>
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
