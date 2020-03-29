<?php
require 'config.php';


$qrynotice = $db->query("SELECT * FROM topics WHERE notice=1 ORDER BY topic_id DESC LIMIT 1");

$ndata = mysqli_fetch_assoc($qrynotice);
                    $post_id=$ndata['topic_id'];
                    

setcookie('notid',$post_id,time()+60*60*24*365, '/'); 

//echo  $_COOKIE['notid'];

