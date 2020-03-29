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

require_once 'incfiles/theme/head_open.php';
############################### page title #######################

	$page_title='Login';
	$site_dsc="login to your awesome ".APPNAME." account";
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

echo '<a id="top" name="top"></a>'; // anchor

?>
<h2>Password Reset <?php echo APPNAME; ?></h2>

    <table>
      <tr>
        <th>Reset Your Password:</th>
      </tr>


      <tr>
        <td class="w">

 <?php


     if(@$_GET['code'])
     {
     $get_code = $_GET['code'];
     @$emailme = $_GET['email'];
     $query = $db->query("SELECT * FROM users WHERE email ='$emailme'");
     $data = mysqli_fetch_assoc($query);
     $db_code = $data['passreset'];
     $db_email = $data['email'];  

     if($emailme == $db_email & $get_code == $db_code)
     {
       echo ' <form
          id="signin_form"
          class="Form"
          accept-charset="utf-8"
          action=""
          method="post"
          style="margin-top: 0;">
      <label>
                  <span>New Password</span>
                  <input
                    id="qsearch"
                    type="password"
                    name="password"
                    placeholder="New Password">
                </label>

                <label>
                  <span>Retype Password</span>
                  <input
                    id="qsearch"
                    type="password"
                    name="password1"
                    placeholder="Retype Password">
                </label>
                <input name="code" value="'.$get_code.'" type="hidden">
               <input name="email" value="'.$emailme.'" type="hidden">
            <button type="submit">Update</button>
        

        </form>';
     }else
     {
    echo '<div style="width:100%;text-align:center; color:#A60808; font-weight:bold">Invalid verification code <br><a href="login">click here to go back </a></div>';

     }
     }




if(!empty($_POST['password']) && !empty($_POST['password1'])){
  $password=md5($_POST['password']);
  $password1=md5($_POST['password1']);
     @$emailme = $_GET['email'];

  if($password == $password1)
 {   
  $passup=$db->query("UPDATE users SET password ='".$password."', passreset =''  WHERE email='".$emailme."'") ;;
?>
<script>
 function Redirect() {
 window.location="<?php echo "login.php";?>" } 
 document.write('<p align="center" style="background-color:#CFF;">Password updated !<br> Authormatically redirect in 5 sec.</p>'); setTimeout('Redirect()', 5000);
 
 </script>
<?php  
 }else
 {
  echo"<p align='center' style='background-color:#CFF;'>Password is not thesame try again !</p>";
 }
  }
  if(empty($_POST['password']) && empty($_POST['password1'])){
echo"<p align='center' style='background-color:#CFF;'>All fields required !</p>";
  }




     if(!@$_GET['code'])
     {
     echo '
        <form
          id="signin_form"
          class="Form"
          accept-charset="utf-8"
          action="?"
          method="post"
          style="margin-top: 0;">
      
                <label>
                  <span>Email Address</span>
                  <input
                    id="qsearch"
                    type="email"
                    name="email"
                    placeholder="Email Address">
                </label>

            <button type="submit" name="forget_pass" class="button _largesubmit _loader js-verify-button">Verify</button>


        </form>';
    
     }

?>
          <div>
          Still having trouble?         <a href="" class="login-linkbutton js-contact-support">Contact support &rsaquo;&rsaquo;</a>
        </div>
        </td>
      </tr>
    </table>
    <br>


<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

?>

	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->

</body>
</html>
