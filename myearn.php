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
echo checkUser();
require_once 'incfiles/topicCount.php';
require_once 'incfiles/theme/head_open.php';
############################### page title #######################

	$page_title='MY EARNINGS';
	$site_dsc=APPNAME."MY EARNINGS";
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

echo '<a id="top" name="top"></a>'; // anchor

##################### login form ########################
$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.
$error="";


?>

    <table>
      <tr>
        <th><h2>MY WALLET (<?php echo number_format(mypoint($user_id,$db)); ?>) Credits</h2> <a href='redeem'>Redeem Now (<?php echo number_format(toRedeem($user_id,$db)-pointUsed($user_id,$db)); ?>) </a></th>
      </tr>


         <tr>
        <td class="w" style="text-align: left;">
        <?php
        // count total earn 
        $queryPost=$db->query("SELECT * FROM topics T, users U, point_earn P
        WHERE T.topic_id=P.topic_id_fk AND T.status='0' AND U.uid=P.uid_fk AND U.uid=T.user_id_fk AND T.user_id_fk='$user_id' ");
        //count rows
        $checktopic=$queryPost->num_rows; // check for existence
        if($checktopic)
        {
        while($data=$queryPost->fetch_assoc())
        {
        $totalearn=$data['topic_earn']+$data['comment_earn']+$data['view_earn'];
        echo "<fieldset><a href=''>$data[title]</a><legend>
        <br /><small>Topic: ($data[topic_earn]) Comment: ($data[comment_earn]) View: ($data[view_earn]) <b>(Total: $totalearn)</b></small> ";
        if ($totalearn<0) {
           echo '<div style="width:100%; color:#A60808; font-weight:bold">Redeem pending</div>';
        }
        else
        {
          //echo " <a href='redeem?id=$data[topic_id]'>Redeem Point</a>";
        }
        echo "</legend></fieldset>";
      }
    }
    else{echo '<p style="font-size: 3em; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-left: 10px; border-left: 3px solid red; color: red;text-align: justify;">NO EARNING YET!</p>
      <p><b>Tips to Earn</b>: Try make reasonable post that will attract users, interactions and comments. Also try share your posts on social media to increase the chance of earning</p>';} 
        ?>
        </td>
      </tr>
    </table>

<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

?>

	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->

</body>
</html>
