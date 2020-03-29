
<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Redirecting...</title>
    </head>
<body>
<?php
require_once ('config.php');

	$clickid=$_REQUEST['id'];
	$queryBoard=$db->query("SELECT * FROM text_ads WHERE adsId='$clickid'");
	//fetch rows
	/*
	Define topics, category, and sub cat details and variables
	*/
	$bdata=$queryBoard->fetch_assoc();
	$baseUrl=$bdata['baseUrl'];
	$adsId=$bdata['adsId'];
	$adsClicks=$bdata['adsClicks']+1; //increament clicks by one 1


$pdateClicks=$db->query("UPDATE text_ads SET adsClicks='$adsClicks' WHERE adsId='$adsId'");
// update clicks
//echo "<script>alert('.$baseUrl.');</script>";

//echo $baseUrl;

//header('location:'.$baseUrl); // redirect to ads website url

  ?>
  <script>
      window.location='<?php echo $baseUrl; ?>';
  </script>

  </body>
</html> 
