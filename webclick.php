
<!DOCTYPE html>
<html>
    <head>
        <title>Opening Web link...</title>
    </head>
<body>
<?php
require_once ('config.php');

$clickid = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)); //Get last word from URL after a slash in PHP
//$lastWord = substr($url, strrpos($url, '/') + 1);

	$queryBoard=$db->query("SELECT * FROM directory WHERE dir_id='$clickid'");
	//fetch rows
	/*
	Define topics, category, and sub cat details and variables
	*/
	$bdata=$queryBoard->fetch_assoc();
	$baseUrl=$bdata['bsite'];
	$dir_id=$bdata['dir_id'];
	$clickcount=$bdata['clickcount']+1; //increament clicks by one 1


$pdateClicks=$db->query("UPDATE directory SET clickcount='$clickcount' WHERE dir_id='$dir_id'");
// update clicks
//echo $baseUrl;

  ?>
  <h1>Please Wait...</h1>
   <script>
      window.location='<?php echo $baseUrl; ?>';
  </script>

  </body>
</html> 
