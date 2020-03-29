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
//$rid=($_GET['id']); // get post id
$error="";

        $queryPost=$db->query("SELECT * FROM point_earn 
        WHERE uid_fk='$user_id' ");
        //count rows
        $checktopic=$queryPost->num_rows; // check for existence
        ?>
    <table>
      <tr>
        <th><h2>REDEEM EARNINGS</h2></th>
      </tr>
         <tr>
        <td class="w" style="text-align: left;">
          <p> To redeem earning you have to make up to 100 point minium</p>
          <?php
          if($checktopic)
        {
        $data=$queryPost->fetch_assoc();
        $totalearn=toRedeem($user_id,$db)-pointUsed($user_id,$db);
        //$totalearn=$data['topic_earn']+$data['comment_earn']+$data['view_earn'];

        //echo "<p>Topic: $data[topic_earn] Comment: $data[comment_earn] View: $data[view_earn] (Total: $totalearn)</p>";
    if ($totalearn<0) {
           echo '<h1  style="width:100%; text-align:center; color:#A60808; font-weight:bold; font-size: 1.05em; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-left: 10px; border-left: 3px solid rgb(0, 152, 247); color: rgb(0, 152, 247);text-align: justify;">Redeem not available</h1>';
        }
        else
        {
          if (isset($_REQUEST['save'])) 
          {
            # code...
            $created=date('D M Y h:sa'); // get current timestamp
            //$bankname=addslashes($_REQUEST['bankname']);
            //$accno=addslashes($_REQUEST['accno']);
            //$percentage = 10;
            //$totalearn = ($percentage / 100) * $totalearn;
            //echo $totalearn;
            //check tranfer
            $checkTr=$db->query("SELECT * FROM tranfer_request WHERE user_id_fk='$user_id' ");

            $countExist=mysqli_num_rows($checkTr);
            if ($countExist=='0') {

             $db->query("INSERT INTO tranfer_request (point_earned, user_id_fk, createdOn)
              VALUES ('".$totalearn."', '".$user_id."', '".$created."') ");
              echo '<p style="font-size: 1.05em; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-left: 10px; border-left: 3px solid rgb(0, 152, 247); color: rgb(0, 152, 247);text-align: justify;">Request successful!</p>';
            }
            else
            {
              $updateTr=$db->query("UPDATE tranfer_request SET point_earned='$totalearn' WHERE user_id_fk='$user_id' ");
              echo '<p style="font-size: 1.05em; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-left: 10px; border-left: 3px solid rgb(0, 152, 247); color: rgb(0, 152, 247);text-align: justify;">Request Updated!</p>';
            }

          }
    ?>
          <h2>Add to Wallet (<?php echo $totalearn; ?>)</h2>

         <tr>
        <td class="w">
          <form action="" method="post">
            <!--<b>Bank Name:</b> <input name="bankname" id="qsearch" placeholder="Bank Name" type="text"> &nbsp;
            <b>Account No: </b> <input name="accno" placeholder="Account No" id="qsearch" type="number">-->
            <button type="submit" name="save">Redeem Point</button>
          </form>
        </td>
      </tr>

        
        </td>
      </tr>
      <?php } }else{echo '<p style="font-size: 1.05em; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding-left: 10px; border-left: 3px solid red; color: red;text-align: justify;">Access Denied, this post do not belongs to you. If you think this is a mistake please contact us!</p>';} ?> 
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
