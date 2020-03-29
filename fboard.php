<?php
require_once ('config.php');
require_once ('functions.php');
echo Checkuser();

$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.
$bid=($_GET['id']); // get board id
$created=time();


$checkmat=$db->query("SELECT * FROM followed_boards WHERE user_id_fk='$user_id' AND board_id_fk='$bid' ");
$val=mysqli_num_rows($checkmat);
if ($val) {
//DO NOTING
}
else
{
  if($checked)
  {
$db->query("INSERT INTO followed_boards (board_id_fk, user_id_fk, bdate) VALUES('$bid','$user_id', '$created') ");
}
  }

// HACK:
header ('location: fboard.php');
