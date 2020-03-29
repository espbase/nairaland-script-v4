<?php

require_once ('config.php');
require_once ('functions.php');

if (isset($_REQUEST['id'])) {
  $id=$_REQUEST['id'];

$deletCat=$db->query("DELETE FROM category WHERE cid='$id' ");
header('location: list-board.php');

}
