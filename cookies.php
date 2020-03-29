<?php
require 'config.php';


  if (isset($_COOKIE['username']) && ($_COOKIE['password'])) {
                  $username = $_COOKIE['username'];
                  $password=($_COOKIE['password']);

                 // setcookie("username", $username, time() - 3600);
                  //setcookie("password", $password, time() - 3600);
                  echo $username;

              }
              