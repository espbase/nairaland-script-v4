<?php
//get login user sessions details
if(!empty($_SESSION['AutenUsera']) OR ($_SESSION['AutenUsera']!=0))
{
$user_id=$_SESSION['uid'];
$username=$_SESSION['username'];
}
/*
Clean url for search engine friendly, 
function created by codexppress Resource (www.codexpresslabs.info)

*/
function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $string); // Removes special chars.

   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}