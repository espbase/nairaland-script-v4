<?php
/*
Developer: Marshall Unduemi
Url: www.nl.codexpress.info/
Contact: hello@codexpress.info

*/
//Enable Error Reporting

//error_reporting(0);
//remove the above comment to enable error reporting


if (file_get_contents('config.php')) { // if configured

require_once ('config.php');
require_once ('functions.php');


$perpage = PERPAGE; // how many post to display per page

/*
NOTE: featured post settings,
*/
if(isset($_GET['link']) & !empty($_GET['link']))
{
	$curpage = $_GET['link']; // get current page number
}else{
	$curpage = 1; // or setcurrent page to 1
}
$start = ($curpage * $perpage) - $perpage; // calculate number of pages
$PageSql = "SELECT * FROM `topics` WHERE post_type='post' ORDER BY topic_id ASC"; // fetch post from db
$pageres = $db->query($PageSql); // query post
$totalres = mysqli_num_rows($pageres); // count total number of post available

$endpage = ceil($totalres/$perpage); // get the last page number
$startpage = 1; // initial page set to 1
$nextpage = $curpage +1; // increament pages by 1
$previouspage = $curpage - 1; // de-creament pages by 1

$ReadSql = "SELECT * FROM `topics` WHERE post_type='post' ORDER BY topic_id DESC LIMIT $start, $perpage";
$res = $db->query($ReadSql); // query post with post limit
$rescot = mysqli_num_rows($res); // count total number of post available
/*
END featured post settings,
*/


/*
NOTE: Don't remove this line of code
this serve as the developer property
that exist between the app and the third party
*/

$site_title=APPNAME.' Forum';
if (DEVELOPER==='Marshall')
{

############################################### site content
//$siteinfo = new site();
//echo $siteinfo->discription(APPINFO);
require_once 'createxml.php';
require_once 'incfiles/theme/head_open.php';
############################### page title #######################

	$page_title=APPNAME.' Forum';
	$site_dsc=DSC;
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
//load header.php -->


if (!file_exists('install.php')) {

require_once ('header.php');


if (file_exists('config.php')) {
?>
<style type="text/css">

/* mak images fill their container*/
img {
  max-width: 98%;
}
img:hover {
  opacity: 0.5;
  cursor: pointer;
}

/* Bigger than Phones(tablet) */
@media only screen and (min-width: 750px) {
  .img-grid {
    width: 80%;
  }
}

/* Bigger than Phones(laptop / desktop) */
@media only screen and (min-width: 970px) {
  .img-grid {
   width: 90%;
  }
}

</style>
 <!--<a href="classified"><img src='https://i.imgur.com/xXj15Jo.png' id=""> </a>-->
 
 <table class="boards" style="font-size:10px !mportant; ">
    <tbody>
      <tr>
        <td>
          <span style="font-size: 23px; font-weight: bold;">Publish Daily Shoutout!</span>
          <?php
          if ($user_id!=0) {
          if (isset($_POST['content'])) {
            $msg = addslashes($_POST['content']);
            $today = date('d F, Y');
            $rtime = time();

            $insdb = $db->query("INSERT INTO shoutout (msg, uid_fk, rtime, tnd) VALUES ('$msg', '$user_id', '$rtime', '$today')");
            if ($insdb) {
              # code...
              echo "<p>Posted, pending admin approval</p>";
            }
          }
          ?>
          <form method="POST" action="" id="postform" name="postform" enctype="multipart/form-data">
             <!--<select onchange="wrapText('body', '[color='+this.options[this.selectedIndex].value+']', '[/color]'); this.selectedIndex = 0;" style="margin-bottom: 1ex; width: 300px">
                <option value="" selected="selected">Change Color</option>
                <option value="red">Red</option>
                <option value="green">Green</option>
                <option value="blue">Blue</option>
                <option value="purle">Purple</option>
                <option value="brown">Brown</option>
                <option value="black">Black</option></select>
           -->
            <script>document.getElementById("editbar").style.display = 'block';</script>
            
        <textarea rows="4" cols="80" placeholder="Type your message here, word limit 200" maxlength="200" name="content" id="body"></textarea><p>
          <p><input name="send" type="submit" value="Publish Now"></p>
          </form>
        <?php }else{echo "<h4><a href='login' title='login'>Please login to share shoutout</a></h4>";} ?>
        </td>
      </tr>
    </tbody>
  </table>
 
<?php
//echo '<div style="font-family:Lora;" >Welcome To '.$page_title.' :: Meet People and Make New Friends!</div>';

}
//echo "Value is: " . $_COOKIE['password'];


//load footer statistic from footer_stat.php
require_once ('footer_stat.php');

echo '<p class="small">(<a href="#top"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

}

else
{
  if (isset($_GET['delete'])=='install') {
    # code...
  if(is_file('install.php'))
  {
          unlink('install.php'); //delete file
  }
  }

 if (isset($_GET['status'])=='completed') { 
	echo '<h2>Install Script!</h2>
<table>
  <tr>
    <td class="w">
      <p style="color:red">========================= Warning! =========================</p>
      - Locate <b>install.php</b> file and delete it after installation...<br> Or 
            <a href="?delete=install"><b>Delete install.php File</b></a> from here with one click
    </td>
  </tr>
</table>';
}
else
{
  echo '<h2>Install Script!</h2>
<table>
  <tr>
    <td class="w">========================= Instruction =========================<br>
      <a href="install">Start Installation...</a><br>
      Contact <a href="mailto:unduworldofliving@gmail.com">support &rsaquo;&rsaquo;</a>  if any problem occure 
      </a>
    </td>
  </tr>
</table>';
}
}

?>

	</div>
</body>
</html>
<?php
}
else
{
/*
deactivate and redirect website

*/
//header('location: http://www.codexpresslabs.info');
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
}
}
else{
	header('location: install.php');
}
?>
<script type="text/javascript" src="js/nl2.js"></script>