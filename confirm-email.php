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

	$page_title='Join .: Confirm Email';
	$site_dsc="create your new awesome account";
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

echo '<a id="top" name="top"></a>'; // anchor

##################### registration form ########################
 @$k = ($_GET['k']);
?>
<h2>Submit Your Email To Join <?php echo APPNAME; ?></h2>
 <form action="do_confirm_email" method="get">
<table>
    <tbody><tr><td class="w"><p style="color:red"><b>Before you can join <?php echo APPNAME; ?>, we need to verify your email address. Please enter it below:</b></p><br>
    </td></tr><tr><td><label><b>Email</b>: <input name="email" required type="email"></label> 
    	<input name="k"  type="hidden" value="<?php echo $k; ?>">
    	<input type="submit" value="Submit">
    </td></tr></tbody></table>
   </form> 

    <p class="small">(<a href="#up"><b>Go Up</b></a>)</p>






<?php

//load footer from footer.php
require_once ('footer.php');

?>

</body>
</html>
