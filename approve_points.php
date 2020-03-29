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
        <th><h2>PENDING REQUEST</h2></th>
      </tr>


         <tr>
        <td class="w" style="text-align: left;">
        <?php
        $queryPost=$db->query("SELECT * FROM users U, tranfer_request T
        WHERE  U.uid=T.user_id_fk GROUP BY T.user_id_fk");
        //count rows
        $checktopic=$queryPost->num_rows; // check for existence
        if($checktopic)
        {
        while($data=$queryPost->fetch_assoc())
        {
        echo "<fieldset><legend><a href='".WEBROOT."/user_points?id=$data[uid]' title='Waiting for approval'>$data[name]($data[username])</a>";
        
        echo "</legend></fieldset>";
      }
    }
    else{echo '<p style="font-size: 3em; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-left: 10px; border-left: 3px solid red; color: red;text-align: justify;">NO REQUEST YET!</p>
      ';} 
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
