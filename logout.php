<?php
require 'config.php';
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}


  if (isset($_COOKIE['username']) && ($_COOKIE['password'])) {
                  $username = $_COOKIE['username'];
                  $password=($_COOKIE['password']);

                  setcookie("username", $username, time() - 3600);
                  setcookie("password", $password, time() - 3600);

              }
              
  //to fully log out a visitor we need to clear the session varialbles
  unset($_SESSION['username']);
  unset($_SESSION['AutenUsera']);
  unset($_SESSION['password']);

  $_SESSION['username'] = NULL;
  $_SESSION['password'] = NULL;
  $_SESSION['AutenUsera'] = NULL;
  session_destroy();

if(isset($_GET['redirect']) && ($_GET['redirect'])!='')
{
 $redirect=$_GET['redirect'];  
 echo '<script type="text/javascript">window.location = "'.$redirect.'"; </script>';
}
else
{
 echo '<script type="text/javascript">window.location = "'.WEBROOT.'"; </script>';   
}	

