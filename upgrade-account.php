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

require 'mail.config.php';
$mail->From = REPLYEMAIL;
$mail->FromName = APPNAME;
require_once 'incfiles/theme/head_open.php';
############################### page title #######################

	$page_title='Account Upgrade';
	$site_dsc=APPNAME." Account Upgrade";
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');


##################### login form ########################
if (isset($_GET['coupon']) && ($_GET['payment_method'])) {
 $coupon = ($_GET['coupon']);
 $referral = addslashes($_GET['referral']);
 $payment_method = ($_GET['payment_method']);
 $used_coupon=date('d F, Y h:ia');
 
 

 $qryConfirmed = $db->query("SELECT * FROM coupons WHERE coupon='$coupon' AND payment_method='$payment_method' ");
$countlog=mysqli_num_rows($qryConfirmed);
$data = mysqli_fetch_array($qryConfirmed);
$coupon_id= $data['coupon_id'];
$dbcoupon_status= $data['coupon_status'];

 if ($countlog) {
        $qryCon = $db->query("UPDATE coupons SET coupon_status='1', coupon_used='$used_coupon' WHERE coupon_id='$coupon_id'");

        $qryCon = $db->query("UPDATE users SET accttype=1, user_ref='$referral' WHERE uid='$ses_user_id'");

        if ($dbcoupon_status==1) {
           echo "<h3>Oops! Coupon code already used</h3><hr>";
        }
        else
        {
            echo "<h3>Your account has been confirmed <a href='affilate-analysis'>Click here to continue</a></h3><hr>";

            ////////////////////////////////// VALIDATE REFERRALS /////////////////////////////////////
         $qryConfirmed = $db->query("SELECT * FROM users WHERE username='$referral' ");
          $dat = mysqli_fetch_array($qryConfirmed);
          $ref_uid_fk= $dat['uid'];

        $inQury=$db->query("INSERT INTO referrals (ref_uid_fk,  reg_uid_fk,  ref_status,  ref_credit,  ref_date) 
          VALUES ('$ref_uid_fk',  '$ses_user_id',  '1',  '$persignup',  NOW()) ");

////////////////////////////////// VALIDATE REFERRALS /////////////////////////////////////

         /* Send a registration link to entered email address */

$mail->addAddress($ses_email);               // Name is optional
$mail->isHTML(true);
$mail->Subject = 'Affiliate Activated';
$mail->Body    = '<div class="email--background">
        
        <div class="email--container">
            <img src="'.URL.'/images/logo.png">

            <div class="email--inner-container">
                <p>Hello '.$ses_username.', thank you for joining our Affiliate program, your account is ready, you can start making money, by commenting, viewing, and referral.</p>
            </div>
            <hr>
              <p><a href="'.URL.'/about-us">About Us</a> <a href="'.URL.'/tnc">Terms & Conditions</a> 
      <a href="'.URL.'/policy">Privacy & Policy</a> <a href="'.URL.'/disclaimer">Disclaimer</a>  
      <a href="'.URL.'/copyright">Copyright</a> <a href="'.URL.'/faq">Frequently Asked Questions</a>

    <h3>Best Regards</h3>
    <p>'.APPNAME.' Team <br> < <a href="'.URL.'" class="cta">Website</a> ></p>
        </div>

    </div>';
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} 

        }

 }
 else
 {
  echo "<h3>Oops! error occured, incorrect coupon entered!</h3><hr>";
 }
}
?>

   <h3>ACCOUNT UPGRADE</h3>
   <table>
    <tr>
        <td class="">
          <b>
<label> Payment Method <span class="required">*</span><br>
  <input type="button" onclick="window.location='?payment=pesapal'" name="" value="Pesapal">
    <input type="button" onclick="window.location='?payment=coupon'" name="" value="Coupon">

</label>
</b>
        </td>
      </tr>
  </table>
<?php
if (isset($_GET['payment']) && !empty(($_GET['payment']))) {
 $payment=($_GET['payment']);
if ($payment=='coupon') {
  # code...
?>
<form action="" method="get" id="postopt">

  <table>
    <tbody>
     
      <tr>
        <td class="w">
<p>
<h3>If you cannot make payment online please purchase an epin from our distributors CLICK <a href="<?php echo URL; ?>/epin" target="_blank">HERE</a></h3>
<b>Coupon</b> <span class="required">*</span>
<input name="coupon" required="" type="text" placeholder="Enter your coupon code" value="" size="32">
</p>
<p><b>Referral</b> <span class="required"></span>
<?php
if($ses_user_ref)
{
?>
<input type="text" readonly name="referral" placeholder="Enter referral username" size="32" value="<?php echo $ses_user_ref; ?>">
<?php } else{ ?>
<input type="text" readonly name="referral" placeholder="Enter referral username" size="32" value="kenyans247">
<?php }?>
</p>
<input name="payment_method" type="hidden" value="<?php echo $payment; ?>">

<div class="col col-100">
<div class="form-group">
<p>
Your personal data will be used to process your order, support your experience throughout this website,
and for other purposes described in our <a href="<?php echo URL; ?>/privacy-policy" target="_blank" class="text-red">privacy policy</a>.
</p>
</div>
</div>
        </td>
      </tr>
      <tr>
        <td class="">
<div class="col col-100">
<div class="form-group">
<p>
<input type="checkbox" required=""> I have read and agree to the website <a href="<?php echo URL; ?>/tos" target="_blank" class="text-red">terms and conditions <span class="required">*</span></a>
</p>
<button class="btn-default btn-lg" type="submit">Make Payment</button>
</div>
</div>
        </td>
      </tr>
    </tbody>
  </table>  
</form>
<?php
}
if ($payment=='pesapal') {
  # code...
?>
<form action="https://www.kenyans247.com/accountpay" method="post">

  <table>
    <tbody>
      <tr>
        <td class="w">

  <p><b>Referral</b> <span class="required"></span>
      <input type="text" name="referral" placeholder="Enter referral username" size="32" value="<?php echo $ses_user_ref; ?>">
      </p>
<p>
Your personal data will be used to process your order, support your experience throughout this website,
and for other purposes described in our <a href="<?php echo URL; ?>/privacy-policy" target="_blank" class="text-red">privacy policy</a>.
</p>
<input type="hidden" name="uid" value="<?php echo $user_id; ?>" />

<input type="hidden" name="first_name" value="<?php echo $ses_name; ?>" />
<input type="hidden" name="last_name" value="<?php echo $ses_username; ?>" />

<input type="hidden" name="type" value="MERCHANT"  readonly="readonly" />
<input type="hidden" name="description" value="<?php echo APPNAME; ?> Affiliate Payment" />
<input type="hidden" name="reference" value="<?php echo $user_id; ?>" />
<input type="hidden" name="email" value="<?php echo $ses_email; ?>" />
<input type="hidden" name="phone" value="<?php echo $ses_phone; ?>" />
     <!--( (the Order ID )
      leave as default - MERCHANT)-->
<input type="hidden" name="amount" value="<?php echo $refamt; ?>" />
      <!--(in Kshs)-->
</p></td></tr>
      <tr>
        <td class="">
<input name="payment_method" type="hidden" value="<?php echo $payment; ?>">
<p>
<input type="checkbox" required=""> I have read and agree to the website <a href="<?php echo URL; ?>/tos" target="_blank" class="text-red">terms and conditions <span class="required">*</span></a>
</p>
<input type="submit" value="Make Payment" />

        </td>
      </tr>
    </tbody>
  </table>  
</form>
<?php
}
}
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';

//load footer from footer.php
require_once ('footer.php');

?>

</body>
</html>
