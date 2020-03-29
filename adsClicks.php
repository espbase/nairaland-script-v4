
<!DOCTYPE html>
<html>
    <head>
        <title>Redirecting...</title>
    </head>
<body>
<?php
require_once ('config.php');

	$clickid=$_REQUEST['id'];
	$queryBoard=$db->query("SELECT * FROM ads WHERE adsId='$clickid'");
	//fetch rows
	/*
	Define topics, category, and sub cat details and variables
	*/
	$bdata=$queryBoard->fetch_assoc();
	$baseUrl=$bdata['baseUrl'];
	$adsId=$bdata['adsId'];
	$adsClicks=$bdata['adsClicks']+1; //increament clicks by one 1


$pdateClicks=$db->query("UPDATE ads SET adsClicks='$adsClicks' WHERE adsId='$adsId'");
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
