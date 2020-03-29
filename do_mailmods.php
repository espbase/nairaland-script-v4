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
?>

<!DOCTYPE html>
<html class="gr__nairaland_com">
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">

	<title><?php echo APPNAME; ?></title>
	<link href="<?php echo WEBROOT; ?>/css/nl.css" rel="stylesheet" type="text/css">
	<link href="http://www.nairaland.com/feed" rel="alternate" title="Nairaland" type="application/rss+xml">
	<meta content="" name="google-site-verification">


	<meta name="description" content="African discussion forum offering topics in politics, business, jobs,soccer, entertainment, technology and general discussion categories.">

	<!-- for Facebook -->
	<meta property="og:title" content="Shift Gears Forum largest">
	<meta property="og:description" content="African discussion forum offering topics in politics, business, jobs,soccer, entertainment, technology and general discussion categories.">

	<!-- for Twitter -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="Shift Gears Forum largest">
	<meta name="twitter:description" content="African discussion forum offering topics in politics, business, jobs,soccer, entertainment, technology and general discussion categories.">

	<!-- for site verification -->
	<meta name="alexaVerifyID" content="">
	<meta name="google-verification" content="">
	<meta name="yandex-verify" content="">
	<link href="feed" rel="alternate" type="application/rss+xml" title="Programming Lovers Forum">
	<link rel="shortcut icon" type="image/x-icon" href="">

</head>

<body data-gr-c-s-loaded="true">
<div class="body">

<?php
################################# include files ##########################

//load header.php
require_once ('header.php');

echo '<a id="top" name="top"></a>'; // anchor

##################### registration form ########################
?>
<h2>Send E-mail Message to Board Moderators</h2>


<table>
<tr>
	<td>
		<form action="/do_mailsupermods" id="postform" method="post" name="postform">
			<p>Subject:</p>


			<p><input name="subject" type="text"><br>
			</p>


			<p>Message:</p>


			<p>
			<textarea cols="90" id="body" name="body" rows="8"></textarea>
			</p>


			<p><input type="submit" value="Send Email">
			</p>
		</form>
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
