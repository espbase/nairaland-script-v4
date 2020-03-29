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
require_once ('incfiles/bbparser.php');
echo checkUser(); // authenticate logged in users


$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.
$username=$_SESSION['username']; //Storing USERNAME in SESSION variabl
$email=$_SESSION['email']; //Storing EMAIL in SESSION variable.

require_once 'incfiles/theme/head_open.php';
############################### page title #######################
$post_id=($_GET['id']); // get post id
//$bid=($_GET['bid']); // get post id
//$url= $_GET['link']; // get title
//$link=$url.'.html'; // verify if it's a real page
//echo "$post_id/$bid/$link"; // test comment link

//require_once ('incfiles/functions.php'); // 

$created=date('D M Y h:sa'); // get current timestamp
//$user_id=1; // custom user id


$Querybord=$db->query("SELECT * FROM topics WHERE topic_id='$post_id' ");
$rb=mysqli_fetch_array($Querybord);
$title=$rb['title'];
$board_id_fk=$rb['board_id_fk'];


$page_title=APPNAME. '- Modify Post';
$site_title=APPNAME;
$site_dsc=APPNAME. '- Modify Post';
	
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');


$comQuery=$db->query("SELECT * FROM topics WHERE topic_id='$post_id' ");
$rowR=mysqli_fetch_array($comQuery);
$link=$rowR['link'];
$topic_id=$rowR['topic_id'];
$title=$rowR['title'];
$bid=$rowR['board_id_fk'];
$user_id_fk=$rowR['user_id_fk'];
$content_text=$rowR['content_text'];

$Querybord=$db->query("SELECT * FROM category C, sub_cat S WHERE S.sid='$bid' AND S.cid_fk=C.cid ");
$rb=mysqli_fetch_array($Querybord);
$sname=$rb['sname'];
$cname=$rb['name'];
$surl=$rb['surl'];
$url=$rb['url'];

if(isset($_POST['submit']))
{
// insert into database
//$redirect="$post_id/$link"; // REDIRECT TO BACK TO POST

 $title=($_POST['title']);
 $content=addslashes($_POST['content']);


    $db->query("UPDATE topics SET title='$title', content_text='$content' WHERE topic_id='$post_id' ");
    //echo "$date-$urltitle.html";

$redirect="$topic_id/$link"; // create friendly seo post link(url)
echo '<script type="text/javascript">window.location = "'.URL.'/'.$redirect.'"; </script>';
//header('Location: '.$redirect); // redirect to newly created post
   // echo '<h1>Submitted!</h1>';
}

// if it is admin show banned topic link
                $checkAccesslevel=$db->query("SELECT * FROM users WHERE uid='$user_id' ");
                $do_exist=$checkAccesslevel->num_rows;
                
                if($do_exist) // if is admin
                 {
                   $data1=$checkAccesslevel->fetch_assoc();
                   $access=$data1['access']; // get access level

if($user_id_fk==$user_id OR $access=='admin' OR $access=='mod')
{

?>

<h2><?php echo APPNAME; ?> - Edit Article</h2>
<p class="bold"><a href="<?php echo URL; ?>"><?php echo APPNAME; ?></a> / 
    <a href="<?php echo URL."/$url"; ?>"><?php echo "$cname"; ?></a> / 
     <a href="<?php echo URL."/forum/$surl"; ?>"><?php echo "$sname"; ?></a> / 
    <a href="<?php echo URL."/$post_id/$link"; ?>"><?php echo "$title"; ?></a> </p>

<table>
<tbody>
<tr>
<td class="l"><b>Please Observe The Following Rules:</b> (<a href="#skip">skip</a>)<br>
 <?php 
$checkTr=$db->query("SELECT user_id_fk FROM tranfer_request WHERE user_id_fk='$user_id' ");

$countExist=mysqli_num_rows($checkTr);
//if ($countExist) {
include 'incfiles/uploadAdsImg.php'; 

?>


<a name="skip"></a>
 
 <form method="POST" action="" id="postform" name="postform" enctype="multipart/form-data">
      <p><b>Subject</b>: <input type="text" name="title" value="<?php echo $title; ?>" required="" id="postformtitle" maxlength="80">
       <script type="text/javascript">document.postform.title.focus()</script>
        </p><p><b>Message</b>:
             </p><div id="editbar" style="display: block;">
            <?php require 'inc.icons.php'; ?>
            </div>
            <script>document.getElementById("editbar").style.display = 'block';</script>
            
        <textarea rows="12" cols="90" name="content" id="body"> <?php echo $content_text; ?></textarea><p>
        <input type="hidden" name="postid" value="<?php echo $post_id; ?>">
          <input type="submit" name="submit" value="Submit" class="upload" id="upload" accesskey="s">
                              <input type="hidden" name="boardid" value="<?php echo $bid; ?>">
                                <input type="hidden" name="link" value="<?php echo $link; ?>">
                                <script type="text/javascript">
                                    document.postform.body.focus()
                                </script>
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
        </form></td></tr></tbody></table>
        <?php
                    }
                     }
                    else
                    {
                        echo '<h1>You do not have permission to modify this post!</h1>';
                    }
                    ?>


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
