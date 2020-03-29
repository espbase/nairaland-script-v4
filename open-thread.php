<?php

require_once ('config.php');
require_once ('functions.php');


if (isset($_GET['topic'])) {
	$id=($_GET['topic']);
	$link=($_GET['link']);

	$queryMove=$db->query("UPDATE topics SET thread_status='0' WHERE topic_id='$id'  ") or die(mysqli_error());
	
	echo "<script>window.location='$id/$link';</script>";
}