<?php
if ($adspace=='Activate') {

?>
<div class="vertipics">

<div id="desktopads">
	<?php
	//echo $sid;
	
	$queryBoard=$db->query("SELECT * FROM ads WHERE (catId='$sid' OR sub_id='$sid') ORDER BY rand() LIMIT 0,3");
	//fetch rows
	/*
	Define topics, category, and sub cat details and variables
	*/
	$checkad = mysqli_num_rows($queryBoard);
	if($checkad)
	{
	while($bdata=$queryBoard->fetch_assoc()){
	$adsName=$bdata['adsName'];
	$baseUrl=$bdata['baseUrl'];
	$adsId=$bdata['adsId'];
	$imgUrl=$bdata['imgUrl'];
	$adsDate=$bdata['adsDate'];
	$adCost=$bdata['adCost'];
	$countcost = $adCost-$ses_adCredit;
//	echo $countcost;
	$adsStatus=$bdata['adsStatus'];

	$adstype=$bdata['adstype'];

	if ($adstype!='text') {

	if($adsStatus=='active')
	{
	
	if(nltimeago('@'.$adsDate)=='1 week') # timestamp input
	{
	   $qryAd = $db->query("UPDATE ads SET adsStatus='expired' WHERE adsId='$adsId'");
	   
	   $qryAd = $db->query("UPDATE users SET adCost='$countcost' WHERE uid='$ses_user_id'"); 
	}
	?>
	
	<a href="<?php echo URL;  ?>/callback/<?php echo $adsId;  ?>" target="_blank" rel="nofollow">
		<img src="<?php echo URL ?>/images/ad/<?php  echo $imgUrl;  ?>" class="img-responsive" style=" margin:5px;padding:2px;">
	</a>
	<?php  }
	
	else{
	?>
	<a href="<?php echo $adlinker; ?>" rel="nofollow">
		<img src="<?php echo $defaultadurl; ?>" class="img-responsive" style="margin:5px;padding:2px;">
	</a>
	<?php } } ?>
	
	
	<?php }
	if($checkad==1){
	        ?>
	        <a href="<?php echo $adlinker; ?>" rel="nofollow">
		<img src="<?php echo $defaultadurl; ?>" class="img-responsive" style="margin:5px;padding:2px;">
		<a href="<?php echo $adlinker; ?>" rel="nofollow">
		<img src="<?php echo $defaultadurl; ?>" class="img-responsive" style="margin:5px;padding:2px;">
	</a>
	<?php
	    }
	    if($checkad==2){
	        ?>
	        <a href="<?php echo $adlinker; ?>" rel="nofollow">
		<img src="<?php echo $defaultadurl; ?>" class="img-responsive" style="margin:5px;padding:2px;">
	</a>
	<?php
	    }
	}else{ ?>
	<a href="<?php echo $adlinker; ?>" rel="nofollow">
		<img src="<?php echo $defaultadurl; ?>" class="img-responsive" style=" margin:5px;padding:2px;">
	</a>
	<a href="<?php echo $adlinker; ?>" rel="nofollow">
		<img src="<?php echo $defaultadurl; ?>" class="img-responsive" style="margin:5px;padding:2px;">
	</a>
	<a href="<?php echo $adlinker; ?>" rel="nofollow">
		<img src="<?php echo $defaultadurl; ?>" class="img-responsive" style=" margin:5px;padding:2px;">
	</a>
	<?php } ?>
</div>



<div id="ipadads">
	<?php
	//echo $sid;
	
	$queryBoard=$db->query("SELECT * FROM ads WHERE catId='$sid' OR sub_id='$sid' ORDER BY rand() LIMIT 0,2");
	//fetch rows
	/*
	Define topics, category, and sub cat details and variables
	*/
	$checkad = mysqli_num_rows($queryBoard);
	if($checkad)
	{
	while($bdata=$queryBoard->fetch_assoc()){
	$adsName=$bdata['adsName'];
	$baseUrl=$bdata['baseUrl'];
	$adsId=$bdata['adsId'];
	$imgUrl=$bdata['imgUrl'];
	$adsDate=$bdata['adsDate'];
	$adCost=$bdata['adCost'];
	$countcost = $adCost-$ses_adCredit;
//	echo $countcost;
	$adsStatus=$bdata['adsStatus'];

	$adstype=$bdata['adstype'];

	if ($adstype!='text') {
	if($adsStatus=='active')
	{
	
	if(nltimeago('@'.$adsDate)=='1 week') # timestamp input
	{
	   $qryAd = $db->query("UPDATE ads SET adsStatus='expired' WHERE adsId='$adsId'");
	   
	    $qryAd = $db->query("UPDATE users SET adCost='$countcost' WHERE uid='$ses_user_id'"); 
	}
	?>
	
	<a href="<?php echo URL;  ?>/callback/<?php echo $adsId;  ?>" target="_blank" rel="nofollow">
		<img src="<?php echo URL ?>/images/ad/<?php  echo $imgUrl;  ?>" class="img-responsive" style="padding:2px;">
	</a>
	<?php
	}
	else{
	?>
	<a href="<?php echo $adlinker; ?>" rel="nofollow">
		<img src="<?php echo $defaultadurl; ?>" class="img-responsive" style=" margin:5px;padding:2px;">
	</a>
	<?php } ?>
	
	
	<?php } } 
	if($checkad==1){
	        ?>
	        <a href="<?php echo $adlinker; ?>" rel="nofollow">
		<img src="<?php echo $defaultadurl; ?>" class="img-responsive" style="margin:5px;padding:2px;">
	</a>
	<?php
	    }
	    } else{ ?>
	<a href="<?php echo $adlinker; ?>" rel="nofollow">
		<img src="<?php echo $defaultadurl; ?>" class="img-responsive" style="margin:5px;padding:2px;">
	</a>
	<a href="<?php echo $adlinker; ?>" rel="nofollow">
		<img src="<?php echo $defaultadurl; ?>" class="img-responsive" style=" margin:5px;padding:2px;">
	</a>
	<?php } ?>
</div>



<div id="mobileads">
    	<?php
	//$sid
	$queryBoard=$db->query("SELECT * FROM ads WHERE catId='$sid' OR sub_id='$sid' ORDER BY rand() LIMIT 0,1");
	//fetch rows
	/*
	Define topics, category, and sub cat details and variables
	*/
	$checkad = mysqli_num_rows($queryBoard);
	if($checkad)
	{
	while($bdata=$queryBoard->fetch_assoc()){
	$adsName=$bdata['adsName'];
	$baseUrl=$bdata['baseUrl'];
	$adsId=$bdata['adsId'];
	$imgUrl=$bdata['imgUrl'];
	$adsDate=$bdata['adsDate'];
	$adCost=$bdata['adCost'];
	$adsStatus=$bdata['adsStatus'];
	$countcost = $adCost-$ses_adCredit;
	$adstype=$bdata['adstype'];
	$uid_fk=$bdata['uid_fk'];

	if ($adstype!='text') {
	if($adsStatus=='active')
	{

	if(nltimeago('@'.$adsDate)=='1 week') # timestamp input
	{
	   $qryAd = $db->query("UPDATE ads SET adsStatus='expired' WHERE adsId='$adsId'");
	   
	    $qryAd = $db->query("UPDATE users SET adCost='$countcost' WHERE uid='$uid_fk'"); 
	}
	?>
	<a href="<?php echo URL;  ?>/callback/<?php echo $adsId;  ?>" target="_blank" rel="nofollow">
		<img src="<?php echo URL ?>/images/ad/<?php  echo $imgUrl;  ?>" class="img-responsive" style="padding:2px;">
	</a>
	<?php  
	}
	else{
	?>
	<a href="<?php echo $adlinker; ?>" rel="nofollow">
		<img src="<?php echo $defaultadurl; ?>" class="img-responsive" style=" padding:2px;">
	</a>
	<?php } ?>
	
	<?php } } }else{ ?>
	<a href="<?php echo $adlinker; ?>" rel="nofollow">
		<img src="<?php echo $defaultadurl; ?>" class="img-responsive" style=" padding:2px;">
	</a>
	<?php } ?>
</div>


<div id="">
	<?php
	//echo $sid;
	
	$querytext=$db->query("SELECT * FROM text_ads WHERE catId='$sid' OR sub_id='$sid' ORDER BY rand() LIMIT 0,5");
	//fetch rows
	/*
	Define topics, category, and sub cat details and variables
	*/
	while($bdata=$querytext->fetch_assoc()){
	$adsName=$bdata['adsName'];
	$baseUrl=$bdata['baseUrl'];
	$adsId=$bdata['adsId'];
	$imgUrl=$bdata['imgUrl'];
	$adsDate=$bdata['adsDate'];
	$adCost=$bdata['adCost'];
	//$countcost = $adCost-$ses_adCredit;
//	echo $countcost;
	$adsStatus=$bdata['adsStatus'];
	$adstype=$bdata['adstype'];

	if($adsStatus=='active')
	{
	
	?>
	<span onclick="window.open('<?php echo URL;  ?>/callback1/<?php echo $adsId;  ?>')" style="cursor: pointer;" title="<?php echo $adsName; ?> Ad Choice"><span id="ads-badge">Ad</span>
	<span id="domain"><?php echo $adsName; ?></span> 	
	<a class="" id="ads" target="_blank" rel="nofollow" style="font-weight: bold; text-decoration: none; padding:2px;font-size: 11px; opacity: 0.65; border-radius: 2px;" href="<?php echo URL;  ?>/callback1/<?php echo $adsId;  ?>">
		<span class="message">Visit Site</span></a></span>
	<?php  }  }?>
</div>
</div>
<?php } ?>