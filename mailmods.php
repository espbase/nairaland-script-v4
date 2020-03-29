<?php
/*
Developer: Marshall Unduemi
Url: www.codexpresslabs.info
Contact: info@codexpresslabs.info

*/
//Enable Error Reporting

//error_reporting(0);
//remove the above comment to enable error reporting

require_once ('config.php');
require_once ('functions.php');
require 'mail.config.php';
$mail->From = REPLYEMAIL;
$mail->FromName = APPNAME;
/*
NOTE: Don't remove this line of code
this serve as the developer property
that exist between the app and the third party
*/

if (DEVELOPER==='Marshall')
{
$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.
############################################### site content
//$siteinfo = new site();
//echo $siteinfo->discription(APPINFO);
$page_title='Send Email To Super Moderators - '.APPNAME.' Ads';
$site_dsc='Send Email To Super Moderators - '.APPNAME.' Ads';

//echo checkUser(); // authenticate logged in users
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');


##################### mail form ########################
if (isset($_POST['body']) AND isset($_POST['subject']))
{
    $body= addslashes($_POST['body']);
    $subject= trim($_POST['subject']);
    $board= ($_GET['board']);


    $query_mods = $db->query("SELECT * FROM mods M, users U
        WHERE M.board_id_fk='$board' M.user_id_fk=U.uid AND mod_type='super' ");
    //count rows
    @$checkUsers=$query_mods->num_rows;
    $modArray=array();

        if ($checkUsers)
        {
    while($data=$query_mods->fetch_assoc())
    {
    $mod_emails=$data['email'];
    $username=$data['username'];


        /* Send a registration link to entered email address */
        $to = $mod_emails;
        $subject = $subject;
        $header = APPNAME;
        $body =$body;

        $sent=mail($to,$subject,$body,$header);

    /* if email is sent display success message */
                    if ($sent)
                    {
                    
$mail->addAddress($email); // Name is optional;
$mail->isHTML(true);
$mail->Subject =$subject;
$mail->Body = '<div class="email--background">
  
  <div class="email--container">
    <div class="email--inner-container">
    <p>Dear '.ucfirst($username).',<br>
    <hr>
    <p>'.$ses_username.' Sent a message to you</p>
    '.$body.'
<p>
       <hr>
    <h3>Best Regards</h3>
    <p>'.APPNAME.' Team <br> < <a href="'.URL.'" class="cta">Website</a> ></p>
    </div>
  </div>
</div>';
if (!$mail->send()) {
 echo '<div style="width:100%;text-align:center; color:#C5110BCC; font-weight:bold">Oops! an unknow error occured</div>';
}else
{
   echo '<div style="width:100%;text-align:center; color:green; font-weight:bold">Hello!! your message has been delivered!!</div>';  
}
                    }

    }
}
}

?>
<h2>Send E-mail Message to Board Moderators</h2>


<table>
<tr>
    <td>
        <form action="" id="postform" method="post" name="postform">
            <p>Subject:</p>


            <p><input name="subject" type="text"><br>
            </p>


            <p>Message:</p>


            <p>
            <textarea cols="90" id="body" name="body" rows="8"></textarea>
            </p>


            <p><input type="submit" value="Send Email">
            </p>
        </form>
    </td>
</tr>
</table>

<?php

//load footer statistic from footer_stat.php
//require_once ('footer_stat.php');

echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

?>


</body>
</html>
<?php
}
else
{
/*
deactivate and redirect website

*/
 echo '<h2>Warning!</h2>
<table>
  <tr>
    <td class="w">========================= Instruction =========================<br>
      - You have tempered with the soruce code, please refer to the documentation or Contact developer...
    </td>
  </tr>
</table>';
/*
deactivate and redirect website

*/
}
 ?>
