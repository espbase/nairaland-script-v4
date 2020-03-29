<?php
/*
Developer: Marshall Unduemi
Url: www.codexpresslabs.info
Contact: hello@codexpress.info

*/
//Enable Error Reporting

//error_reporting(0);
//remove the above comment to enable error reporting

require_once ('config.php');
require_once ('functions.php');
require_once ('incfiles/bbparser.php');
//echo Checkuser();

echo checkUser(); // authenticate logged in users
require_once 'incfiles/theme/head_open.php';
############################### page title #######################
$post_id=($_GET['id']); // get post id
$bid=($_GET['id']); // get board id
// To Insert Page View And Select Total Pageview

$Querybord=$db->query("SELECT * FROM category C, sub_cat S WHERE S.sid='$bid' AND S.cid_fk=C.cid ");
$rb=mysqli_fetch_array($Querybord);
$sname=$rb['sname'];
$cname=$rb['name'];
$surl=$rb['surl'];
$url=$rb['url'];

//$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.

$page_title='New Topic - '.$sname.', '. APPNAME;
$site_title=APPNAME;
$site_dsc='New Topic - '.$sname.', '. APPNAME;
	
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

$created=date('D M Y h:sa'); // get current timestamp
//$user_id=1; // custom user id
$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.
$username=$_SESSION['username']; //Storing USERNAME in SESSION variabl
$email=$_SESSION['email']; //Storing EMAIL in SESSION variable.
//echo $user_id;
$checkAccesslevel=$db->query("SELECT * FROM users WHERE uid='$user_id' AND access='admin' OR access='mod'");
$dataUser=mysqli_fetch_assoc($checkAccesslevel);
$service_status=$dataUser['service_status'];
$do_exist=$checkAccesslevel->num_rows;



$checkIP=$db->query("SELECT * FROM flaggedip WHERE ip_address='$user_ip' ");
$dataIP=mysqli_fetch_assoc($checkIP);
$ip_status=$dataIP['ip_status'];

if ($ip_status==0) {

if(isset($_POST['content']))
{
// insert into database
//$redirect="$post_id/$link"; // REDIRECT TO BACK TO POST

 $title=addslashes($_POST['title']);
 $content=addslashes($_POST['content']);
 @$checked=$_POST['follow'];
 @$post_type=$_POST['post_type'];
  //$month=date('F, Y');

  $date=mt_rand();
  $created=date('D d, F, Y h:sa');
  $today=date('d F Y');
  $month=date('F Y');

$newtitle=clean($title);
$asked=time();
/*The url would only contain number and letter for  search Engine friendly*/
/*Check the title if there is space, then replace with '-''*/
//$newurltitle=str_replace(" ","-",$newtitle);
if ($user_id!=0) {

$url=strtolower($newtitle).".html"; //."-".$newtitle.".html";
 $db->query("INSERT INTO topics (post_type, title, link, content_text, user_id_fk, board_id_fk, created, month, time, ip_address)
   VALUES ('".$post_type."','".$title."', '".$url."', '".$content."', '".$user_id."', '".$bid."', '".$created."', '".$month."', '".$asked."', '$user_ip') ");
//echo "$date-$urltitle.html";

 $db->query("INSERT INTO flaggedip (ip_address, user_Agent, ip_status, flagged_date)
   VALUES ('".$user_ip."','".$user_agent."', '0',  '".$created."') ");

/*

*/
$comQuery=$db->query("SELECT * FROM topics ORDER BY topic_id DESC");
$rowR=mysqli_fetch_array($comQuery);
$link=$rowR['link'];
$topic_id=$rowR['topic_id'];

$redirect="$topic_id/$link"; // create friendly seo post link(url)
//$amtfit = $perpost;
//echo earnfx($topic_id, $ses_user_id, $amtfit, $type='post', $user_ip,$db); 

//$inQury=$db->query("INSERT INTO earnings (post_id_fk,user_id_fk,earn_amt,earn_status,earn_type,earn_date,earn_ip) 
         // VALUES ('$topic_id',  '$ses_user_id',  '3',  '1', 'post', '$created', '$user_ip') ");

echo '<script type="text/javascript">window.location = "'.URL.'/'.$redirect.'"; </script>';
//header('Location: ../'.$redirect); // redirect to newly created post
}
else
{
  echo '<h2>Oops! an error occure try again</h2>';
}
}

//require 'incfiles/bbparser.php'; // phpbb code parser


##################### registration form ########################

?>

<h2>New Topic - <?php echo "$sname, ". APPNAME; ?></h2>
<p class="bold"><a href="/?"><?php echo APPNAME; ?></a> / 
    <a href="<?php echo URL."/$url"; ?>"><?php echo "$cname"; ?></a> / 
    <a href="<?php echo URL."/forum/$url"; ?>"><?php echo "$sname"; ?></a>  / <a href="">New Topic</a></p>




                <!-------Including PHP Script here------>
<?php 
$checkTr=$db->query("SELECT user_id_fk FROM tranfer_request WHERE user_id_fk='$user_id' ");

$countExist=mysqli_num_rows($checkTr);
//if ($countExist) {
//include 'incfiles/uploadAdsImg.php'; 

?>



<table>
<tbody>
<tr>
<td class="l"><b>Please Observe The Following Rules:</b> (<a href="#down">skip</a>)<br>
<?php
$queryBoard=$db->query("SELECT * FROM site_pages WHERE page_assigned='rule'");
$countCat=mysqli_num_rows($queryBoard);
//Full texts  page_id page_date page_type page_title  page_content
if ($countCat) {

$clist=mysqli_fetch_assoc($queryBoard);

  $page_id = $clist['page_id'];
  $page_date = $clist['page_date'];
  $page_type = $clist['page_type'];
  $page_title = $clist['page_title'];
  $page_content = $clist['page_content'];
  $page_assigned = $clist['page_assigned'];

        $bb = new bbParser();
        echo $bb->getHtml($page_content);

        echo "<br /> <span style='float: right;'><small>Updated on <?php echo $page_date; ?></small></span>";
}
else
{
  echo "<h3>No page assigned as rule</h3>";
}
?>

<br />
 
 <form method="POST" action="" id="postform" name="postform" enctype="multipart/form-data">
        <p><b>Subject</b>: <input type="text" required="" name="title" id="postformtitle" maxlength="80">
       <script type="text/javascript">document.postform.title.focus()</script>
        </p><p><b>Message</b>:
             </p><div id="editbar" style="display: block;">
             <?php require 'inc.icons.php'; ?>
            </div>
            <script>document.getElementById("editbar").style.display = 'block';</script>
            
        <textarea rows="12" cols="80" required="" name="content" id="body"></textarea><p>
            <?php
  if($do_exist) // if is admin
  {
  echo '<select name="post_type">
           <option value="post">Topic Feed</option>
           <option value="topic">Thread</option>
           <!-- <option value="topic">Thread</option>
             <option value="newsfeed">News Feed</option>-->
            <option value="sponsored">Sponsored Post</option>
          </select>';
  // create admin post url
  }
  else
  {
      echo '<select name="post_type">
            <option value="topic">Thread</option>
            <!--<option value="newsfeed">News Feed</option>-->
          </select>';
  }
  ?>
        <input type="submit" name="submit" id="upload" value="Submit" accesskey="s">
        </p><p>
       
        </p><div id="attachments" class="clearfix">
          
        <b>Attachments</b>: (maximum size: 4MB for pictures and 250kB for other files)
    <div id="filediv"><input name="file1" type="file" id="file"/></div><br/>
      <div id="filediv"><input name="file2" type="file" id="file"/></div><br/>
      <div id="filediv"><input name="file3" type="file" id="file"/></div><br/>
      <div id="filediv"><input name="file4" type="file" id="file"/></div><br/>
      
      <!-------Including PHP Script here------>
      <?php
      include "upload.php";
      include "upload1.php";
      include "upload2.php";
      include "upload3.php";
      ?>
    </div>
        </form></td></tr></tbody></table>
         <p>Your <b><u>IP ADDRESS (<?php echo $user_ip; ?>)</u></b></p>
      <?php } else{?>


        <table id="down">
    <tbody>
      <tr>
        <td class="small w grad">
          <h1>Oops! We're Sorry</h1>
            <p>You have been spotted, your <b><u>IP ADDRESS (<?php echo $user_ip; ?>)</u></b> is flagged, please if this was an error send an email to <b><?php echo EMAIL; ?></b></p>

        </td>
      </tr>
    </tbody>
  </table>

    <?php  } ?>


  <p class="small">(<a href="#up"><b>Go Up</b></a>)</p>

<?php


//load footer from footer.php
require_once ('footer.php');

?>

<script type="text/javascript" src="https://www.nairaland.com/static/nl2.js"></script>
	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->

</body>
</html>
