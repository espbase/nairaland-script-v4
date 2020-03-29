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
echo Checkuser();

require_once 'incfiles/theme/head_open.php';
############################### page title #######################

	$page_title='User Dashboard';
	$site_dsc=APPNAME." Website Setting  ";
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

echo '<a id="top" name="top"></a>'; // anchor

##################### login form ########################
$username=$_SESSION['username']; //Storing USERNAME in SESSION variabl

$error="";
?>
<style>
    table .datatable {
  //border: 1px solid #ccc;
  border-collapse: collapse;
  margin: 0;
  padding: 0;
  width: 100%;
  table-layout: fixed;
}

table .datatable caption {
  font-size: 1.5em;
  margin: .5em 0 .75em;
}

table .datatable tr {

  //border: 1px solid #ddd;
  padding: .35em;
}

table .datatable th,
table .datatable td {
  padding: .625em;
  text-align: center;
}

table .datatable th {
  font-size: .85em;
  letter-spacing: .1em;
  text-transform: uppercase;
}

@media screen and (max-width: 600px) {
  table {
    border: 0;
  }

  table .datatable caption {
    font-size: 1.3em;
  }
  
  table .datatable thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  table .datatable tr {
    //border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }
  
  table .datatable td {
    //border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: left;
  }
  
  table .datatable td::before {
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  
  table .datatable td:last-child {
    border-bottom: 0;
  }
}
</style>


<?php
//echo $user_id;
//echo WEBROOT.'/ajax/do_unlike_user.php',
// Friends List Data relations between users and friends tables for displaying user friends
$flist=$db->query("SELECT *
FROM users U, followers F
WHERE
CASE
WHEN F.friend_one = '{$user_id}' 
THEN F.friend_two = '{$user_id}'
END
AND 
F.status='1'");
//$friendsList=mysqli_num_rows($flist); // count of total friends


 $check=$flist->num_rows;

 $sql_relation= $db->query("SELECT * FROM followers WHERE friend_two='{$user_id}' AND status='1' ");
  $checkCount=$sql_relation->num_rows;

 $sql_relation1= $db->query("SELECT * FROM followers WHERE friend_one='{$user_id}' AND status='1' ");
  $checkCountfollow=$sql_relation1->num_rows;
 
 
 $callads = $db->query("SELECT SUM(adCost) AS spentcost  FROM ads WHERE uid_fk='$user_id' AND adsStatus='active' ");
    $data = mysqli_fetch_array($callads);
    $spentcost = $data['spentcost'];

$callads1 = $db->query("SELECT SUM(adCost) AS spentcost  FROM text_ads WHERE uid_fk='$user_id' AND adsStatus='active' ");
    $data1 = mysqli_fetch_array($callads1);
    $spentcost1 = $data1['spentcost'];
?>
    <table>
      <tr>
        <th><h4>USER DASHBOARD</h4></th>
      </tr>


         <tr>
        <td class="w" style="text-align: left;">
          <table class="datatable">
    <tr>
<td style="border: none; border-radius: 0; border: solid #343 1px; padding: 5px; ">
  <a href="<?php echo WEBROOT; ?>/user-campaign"><span>Acc. Bal: <?php echo CURRENCY. ' '. number_format($ses_adCredit);  ?></span></a>
</td>
<td style="border: none; border-radius: 0; border: solid #343 1px; padding: 5px;  ">
  <a href="<?php echo WEBROOT; ?>/textad-stat"><span>Amount Spent So Far: <?php echo number_format($spentcost+$spentcost1).' '. CURRENCY;  ?></span></a>
</td>
<td style="border: none; border-radius: 0; border: solid #343 1px; padding: 5px; ">
<a href="<?php echo WEBROOT; ?>/my-classified"><span>My Following: <?php echo number_format($checkCountfollow); ?></span></a>
</td>

<td style="border: none; border-radius: 0; border: solid #343 1px; padding: 5px; ">
<a href="<?php echo WEBROOT; ?>/my-directory"><span>My Followers <?php echo number_format($checkCount); ?></span></a>
</td>

  </tr>
</table>
<h4>Navigation Menu</h4>
<table class="datatable">
  <tr>
<td style="border: none; border-radius: 0; border: solid #343 1px; padding: 5px;">
  <a href="<?php echo WEBROOT; ?>/user-campaign"><span>Banner Ad Stats</span></a>
</td>
<td style="border: none; border-radius: 0; border: solid #343 1px; padding: 5px; ">
  <a href="<?php echo WEBROOT; ?>/textad-stat"><span>Text Ad Stats</span></a>
</td>
<td style="border: none; border-radius: 0; border: solid #343 1px; padding: 5px;">
<a href="<?php echo WEBROOT; ?>/my-classified"><span>My Classified</span></a>
</td>

<td style="border: none; border-radius: 0; border: solid #343 1px; padding: 5px;">
<a href="<?php echo WEBROOT; ?>/my-directory"><span>My Directory</span></a>
</td>
<td style="border: none; border-radius: 0; border: solid #343 1px; padding: 5px;">
<a href="<?php echo WEBROOT; ?>/verify-coupon?payment=coupon"><span>Verify Coupon </span></a>
</td>

  </tr>
    <tr>
<td style="border: none; border-radius: 0; border: solid #343 1px; padding: 5px;">
<a href="<?php echo WEBROOT; ?>/u/<?php echo $username; ?>"><span>My Profile</span></a>
</td>
<td style="border: none; border-radius: 0; border: solid #343 1px; padding: 5px;">
<a href="<?php echo WEBROOT; ?>/campaign"><span>Create/Set Campaign</span></a>
</td>
<td style="border: none; border-radius: 0; border: solid #343 1px; padding: 5px;">
<a href="<?php echo WEBROOT; ?>/followed-boards"><span>Followed Board</span></a>
</td>

<td style="border: none; border-radius: 0; border: solid #343 1px; padding: 5px;">
<a href="<?php echo WEBROOT; ?>/followed-topics"><span>Followed Topic</span></a>
</td>

<td style="border: none; border-radius: 0; border: solid #343 1px; padding: 5px;">
<a href="<?php echo WEBROOT; ?>/adrates"><span>Estimated Ad Rates</span></a>
</td>

  </tr>
</table>

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
