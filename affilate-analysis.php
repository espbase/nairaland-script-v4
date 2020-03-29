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

	$page_title='Affiliate Dashboard';
	$site_dsc=APPNAME." Affiliate Dashboard";
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

?>

    <h2>Affiliate Dashboard - <?php echo APPNAME; ?></h2>
<style type="text/css">

.adscircle {
  display: inline-block;
  background: #339DFF;
  color: #fff;
  text-decoration: none;
  font-size: 13px;
  line-height: 28px;
  border-radius: 0px;
  -webkit-transition: all 0.3s;
  transition: all 0.3s;

   box-shadow: 0 4px 4px rgba(83, 100, 255, 0.32);
   margin: 3px;
}


.buz{
  position: relative;
  display: block;
  font-family: helvetica neue, helvetica, sans-serif;

  font-size: 1.2em;
  font-weight: 500;
  letter-spacing: 0.025em;
  opacity: 0.75;
  text-align: left;
}

.span {
  font-size: 0.985em;
  font-weight: 400;
  opacity: 0.7;
}

</style>
  <table>
    <tbody>
      <tr>
        <th> <a href="my-directory">My Directory:</a>   Marketing: <a href="">Referral Link</a>  
        <a href="https://api.whatsapp.com/send?text=Make Money On KNU  register to get start&source=kenyans247.com&data=www.kenyans247.com/confirm-email/?k=<?php echo $ses_username; ?>">Referral Link</a> </th>
      </tr>
      <tr>
        <td class="w" >
         
            <?php
            $inQurytotal=$db->query("SELECT * FROM users WHERE user_ref='$ses_username'");
            $reftotal=mysqli_num_rows($inQurytotal);

            $inQury=$db->query("SELECT * FROM referrals WHERE ref_uid_fk='$ses_user_id' AND ref_status=1 ");
            $countPaid=mysqli_num_rows($inQury);

            $inQuryun=$db->query("SELECT * FROM referrals WHERE ref_uid_fk='$ses_user_id'");
            $unpaidref=mysqli_num_rows($inQuryun);

            $quryCredit=$db->query("SELECT SUM(ref_credit) as total FROM referrals WHERE ref_uid_fk='$ses_user_id' AND ref_status=1 ");
            $countCredit=mysqli_num_rows($quryCredit);
            $data = mysqli_fetch_array($quryCredit);
            $totalcredit = $data['total'];

            $quryEarn=$db->query("SELECT SUM(earn_amt) as earntotal FROM earnings WHERE user_id_fk='$ses_user_id' AND earn_status=1 ");
            $countCredit=mysqli_num_rows($quryEarn);
            $data1 = mysqli_fetch_array($quryEarn);
            $totalearncredit = $data1['earntotal'];
            
            $qurydaily=$db->query("SELECT SUM(earn_amt) as earndaily FROM earnings WHERE user_id_fk='$ses_user_id' AND earn_status=1 AND earn_type='daily' ");
            $countCredit=mysqli_num_rows($qurydaily);
            $data12 = mysqli_fetch_array($qurydaily);
            $earndaily = $data12['earndaily'];
            
            $qurycomment=$db->query("SELECT SUM(earn_amt) as earncomment FROM earnings WHERE user_id_fk='$ses_user_id' AND earn_status=1 AND earn_type='comment' ");
            $data122 = mysqli_fetch_array($qurycomment);
            $earncomment = $data122['earncomment'];
            
            $quryview=$db->query("SELECT SUM(earn_amt) as earnview FROM earnings WHERE user_id_fk='$ses_user_id' AND earn_status=1 AND earn_type='view' ");
            $data1222 = mysqli_fetch_array($quryview);
            $earnview = $data1222['earnview'];

            ?>
            <div align='left'>
                <b class="buz"><?php echo CURRENCY.' '; echo number_format($totalearncredit + $totalcredit); ?> Current Balance<br></b>
             <ul>
  <li>Activities:<b> <?php  echo CURRENCY.' '; echo number_format($totalcredit); ?></b></li>
  <li>Comments:<b> <?php  echo CURRENCY.' '; echo number_format($earncomment); ?></b></li>
  <li>Daily Login:<b> <?php  echo CURRENCY.' '; echo number_format($earndaily); ?></b></li>
  <li>Topic View:<b> <?php  echo CURRENCY.' '; echo number_format($earnview); ?></b></li>
  <li>Total Referrals:<b> <?php  echo CURRENCY.' '; echo number_format($reftotal); ?></b></li>
  <li>Paid Referral:<b> <?php  echo CURRENCY.' '; echo number_format($countPaid); ?></b></li>
  <li>Unpaid Referral:<b> <?php  echo CURRENCY.' '; echo number_format($reftotal-$unpaidref); ?></b></li>
</ul> 
</div>
        </td>
      </tr>
    </tbody>
  </table>
  

<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';

//load footer from footer.php
require_once ('footer.php');

?>

</body>
</html>
