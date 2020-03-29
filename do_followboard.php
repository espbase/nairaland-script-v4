<?php
require_once ('config.php');
require_once ('functions.php');
echo Checkuser();

$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.

if (isset($_GET['board']) AND isset($_GET['redirect']) ) {

  $bid=($_GET['board']); // get board id
  $redirect=($_GET['redirect']); // get board id
  $created=time();


  $checkmat=$db->query("SELECT * FROM followed_boards WHERE user_id_fk='$user_id' AND board_id_fk='$bid' ");
  $val=mysqli_num_rows($checkmat);
  if ($val) {
// already followed_board
  }
  else
  {
    if($bid!=0)
    {
  $db->query("INSERT INTO followed_boards (board_id_fk, user_id_fk, bdate) VALUES('$bid','$user_id', '$created')");
  // follow board
  }
    }
  header ('location: forum/'.$redirect);
  // HA
}
else {
  # error message
}
