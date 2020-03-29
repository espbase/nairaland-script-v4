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
$bid=($_GET['bid']); // get post id
$url= $_GET['link']; // get title
$link=$url.'.html'; // verify if it's a real page
//echo "$post_id/$bid/$link"; // test comment link

//require_once ('incfiles/functions.php'); // 

$created=date('D M Y h:sa'); // get current timestamp
//$user_id=1; // custom user id


$Querybord=$db->query("SELECT * FROM topics WHERE topic_id='$post_id' ");
$rb=mysqli_fetch_array($Querybord);
$title=$rb['title'];
$board_id_fk=$rb['board_id_fk'];

$Querybord=$db->query("SELECT * FROM category C, sub_cat S WHERE S.sid='$bid' AND S.cid_fk=C.cid ");
$rb=mysqli_fetch_array($Querybord);
$sname=$rb['sname'];
$cname=$rb['name'];
$surl=$rb['surl'];
$url=$rb['url'];

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

$quryEarn=$db->query("SELECT * FROM earnings WHERE user_id_fk='$ses_user_id' AND post_id_fk='$post_id' AND earn_type='comment' ");
$countCredit=mysqli_num_rows($quryEarn);
       
     // echo $perreply;     
if(isset($_POST['post']))
{
$reply=addslashes($_POST['content']);
$checked=$_POST['follow'];
// insert into database

//***********************************************
$redirect="$post_id/$link"; // REDIRECT TO BACK TO POST

$db->query("INSERT INTO topic_comments (comment, topic_id, board_id_fk, user_id, commentedOn)
 VALUES ('$reply', '$post_id','$bid', '$user_id', '$created') ");

$checkmat=$db->query("SELECT * FROM followed_topics WHERE user_id_fk='$user_id' AND topic_id_fk='$post_id' ");
$val=mysqli_num_rows($checkmat);


 if($countCredit==0)
    {

      
     $inQury=$db->query("INSERT INTO earnings (post_id_fk,user_id_fk,earn_amt,earn_status,earn_type,earn_date,earn_ip) 
  VALUES ('$post_id',  '$ses_user_id',  '$perreply',  '1', 'comment', '$created', '$user_ip') ");   
    }
    
$comQuery=$db->query("SELECT * FROM topics WHERE user_id_fk='$ses_user_id' ");
$checkval=mysqli_num_rows($comQuery);
if($checkval)
{
    
}
else
{
    
   
}


if ($val) {
//DO NOTING
}
else
{
if($checked)
{
$db->query("INSERT INTO followed_topics (topic_id_fk, user_id_fk, fdate) VALUES('$checked','$user_id', '$created') ");
}
    }

echo '<script type="text/javascript">window.location = "'.URL.'/'.$redirect.'"; </script>';

}
$QueryComment=$db->query("SELECT * FROM topic_comments ORDER BY comment_id DESC");
$rowComment=mysqli_fetch_array($QueryComment);
$comment_id_fk=$rowComment['comment_id'];

?>

<h2><?php echo APPNAME; ?> - New Post</h2>
<p class="bold"><a href="<?php echo URL; ?>"><?php echo APPNAME; ?></a> / 
    <a href="<?php echo URL."/$url"; ?>"><?php echo "$cname"; ?></a> / 
     <a href="<?php echo URL."/forum/$surl"; ?>"><?php echo "$sname"; ?></a> / 
    <a href="<?php echo URL."/$post_id/$link"; ?>"><?php echo "$title"; ?></a> </p>

<table>
<tbody>
<tr>
<td class="l"><b>Please Observe The Following Rules:</b> (<a href="#skip">skip</a>)<br>
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

 <form method="POST" action="" id="postform" name="postform" enctype="multipart/form-data">
        </p><p><b>Message</b>:
             <div id="editbar" style="display: block;">
             <?php include 'inc.icons.php'; ?>
            </div>
            <script>document.getElementById("editbar").style.display = 'block';</script>
            
        <textarea rows="12" cols="90" name="content" id="body"></textarea><p>
        <input type="hidden" name="postid" value="<?php echo $post_id; ?>">
        <input type="submit" value="Submit" name="post" accesskey="s">
         <input type="checkbox" value="<?php echo $post_id; ?>" checked="yes" name="follow">Follow this topic
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
    include "com_upload1.php";
    include "com_upload2.php";
    include "com_upload3.php";
    include "com_upload4.php";
    ?>
        </form></td></tr></tbody></table>


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
