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
echo checkUser(); // authenticate logged in users


$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.
$username=$_SESSION['username']; //Storing USERNAME in SESSION variabl
$email=$_SESSION['email']; //Storing EMAIL in SESSION variable.

require_once 'incfiles/theme/head_open.php';
############################### page title #######################
$post_id=($_GET['topic']); // get post id

$bid=($_GET['board']); // get board id
@$quote_id=($_GET['quote_id']); // get post id
$creator=($_GET['creator']); // get user id of the post
$commentid=($_GET['commentid']); // get comment id
$url= $_GET['url']; // get title
$link=$url; // verify if it's a real page
//echo "$post_id/$bid/$link"; // test comment link
//require_once ('incfiles/functions.php'); //
$created=date('D M Y h:sa'); // get current timestamp
//$user_id=1; // custom user id
$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.
$username=$_SESSION['username']; //Storing USERNAME in SESSION variabl
$email=$_SESSION['email']; //Storing EMAIL in SESSION variable.


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

$page_title=APPNAME. '- New Post';
$site_title=APPNAME;
$site_dsc=APPNAME. '- New Post';
	
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
##################### verify if post does in databse ########################
if (isset($_GET['topic'])) {

$topicid=($_GET['topic']); // get user id of the post
$commentid=($_GET['commentid']); // get comment id
$link= $_GET['link']; // get title
//echo "$post_id/$bid/$link"; // test comment link


$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.
$username=$_SESSION['username']; //Storing USERNAME in SESSION variabl
$email=$_SESSION['email']; //Storing EMAIL in SESSION variable.

$quryCon=$db->query("SELECT comment FROM topic_comments WHERE comment_id='$commentid'");
$rowQuote=mysqli_fetch_array($quryCon);
$comment_content=$rowQuote['comment'];


if(isset($_POST['post']))
{
$reply=addslashes($_POST['content']);

// insert into database
$redirect="$topicid/$link"; // REDIRECT TO BACK TO POST


$done=$db->query("UPDATE topic_comments SET comment='$reply' WHERE comment_id='$commentid'");
if ($done) {
echo '<script type="text/javascript">window.location = "'.WEBROOT.'/'.$redirect.'"; </script>';
}
else{
    echo "<h2>Oops! error updating content</h2>";
}

}
$QueryComment=$db->query("SELECT * FROM topic_comments WHERE comment_id='$commentid' ");
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
 
<p>1. Please post all threads in the right section, and don't derail threads by posting off topic.<br />2. Don't abuse, bully, deliberately insult/provoke, fight, or wish harm to Kenyans247 members OR THEIR TRIBES.<br />3. Don't threaten, support or DEFEND violent acts against any person, tribe, race, animals, or group (e.g. rape).<br />4. Discussions of the art of love-making should be restricted to the hidden sexuality section.<br />5. Don't post pornographic or disgusting pictures or videos on any section of Kenyans247.<br />6. Don't post adverts or affiliate links outside the areas where adverts are explicitly allowed.<br />7. Don't say, do, or <strong>THREATEN</strong> to do anything that's detrimental to the security, success, or reputation of Kenyans247.<br />8. Don't post false information on Kenyans247.<br />9. Don't use Kenyans247 for illegal acts, e.g scams, plagiarism, hacking, gay meetings, incitement, promoting secession.<br />10. Don't violate the privacy of any people e.g. by posting their private pics, info, or chats without permission.<br />11. Don't create distracting posts with: ALL WORDS BOLD / huge font sizes / ALL CAPS / distracting imagesspaces, etc.<br />12. Don't insert signatures into your posts. Instead, add the desired signature to your profile.<br />13. Please report any post or topic that violates the rules of Kenyans247 using the (Report) button.<br />14. Please search the forum before creating a new thread on Kenyans247.<br />15. Don't attempt to post censored words by misspelling them.<br />16.&nbsp;<strong>Don't promote shady investments like betting, HYIP, MLM, FOREX, binary options, and&nbsp;cryptocurrencies&nbsp;on Kenyans247.</strong><br />18. Don't spam the forum by advertising in the wrong places or posting the same content many times.<br />19. Don't use alternate accounts to access Kenyans247 after being banned. If you do, make sure we don't find out.<br />20. Complaints to or against moderators must be sent privately. Please don't disobey, disrespect, or defame them.&nbsp;<br />21. Please spell words correctly when you post, and try to use perfect grammar and punctuation.<br />22. Don't ask Kenyans247 members for contact details (email, phone, account pin bbpin) or investments.</p></p><a name="skip"></a>
 
 <form method="POST" action="" id="postform" name="postform" enctype="multipart/form-data">
      <p>
       <script type="text/javascript">document.postform.title.focus()</script>
        </p><p><b>Message</b>:
             </p><div id="editbar" style="display: block;">
             <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[b]&quot;, &quot;[/b]&quot;)" title="Bold">
             <span class="eb"><img src="/icons/bold.gif"></span></a>
             <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[i]&quot;, &quot;[/i]&quot;)" title="Italic">
             <span class="eb"><img src="/icons/italicize.gif"></span></a>
             <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[s]&quot;, &quot;[/s]&quot;)" title="Strikethrough">
             <span class="eb"><img src="/icons/strike.gif"></span></a>
             <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[left]&quot;, &quot;[/left]&quot;)" title="Align Left">
             <span class="eb"><img src="/icons/left.gif"></span></a>
             <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[right]&quot;, &quot;[/right]&quot;)" title="Align Right">
             <span class="eb"><img src="/icons/right.gif"></span></a>
             <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[center]&quot;, &quot;[/center]&quot;)" title="Align Center">
             <span class="eb"><img src="/icons/center.gif"></span></a>
             <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot;[hr]&quot;)" title="Horizontal Rule">
             <span class="eb"><img src="/icons/hr.gif"></span></a>
             <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[size=8pt]&quot;, &quot;[/size]&quot;)" title="Font Size">
             <span class="eb"><img src="/icons/size.gif"></span></a>
             <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[font=Lucida Sans Unicode]&quot;, &quot;[/font]&quot;)" title="Font Face">
             <span class="eb"><img src="/icons/face.gif"></span></a>

             <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[img]&quot;, &quot;[/img]&quot;)" title="Insert Image/Picture">
             <span class="eb"><img src="/icons/img.gif"></span></a>
             <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[url]&quot;, &quot;[/url]&quot;)" title="Insert Hyperlink">
             <span class="eb"><img src="/icons/url.gif"></span></a>

             <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[sub]&quot;, &quot;[/sub]&quot;)" title="Subscript">
             <span class="eb"><img src="/icons/sub.gif"></span></a>
             <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[sup]&quot;, &quot;[/sup]&quot;)" title="Superscript">
             <span class="eb"><img src="/icons/sup.gif"></span></a>
             <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[code]&quot;, &quot;[/code]&quot;)" title="Code">
             <span class="eb"><img src="/icons/code.gif"></span></a>
             <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[quote]&quot;, &quot;[/quote]&quot;)" title="Quote">
             <span class="eb"><img src="/icons/quote.gif"></span></a>
      <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot; :)&quot;)"><img src="/icons/smiley.png" class="faces"></a>
             <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot; ;)&quot;)"><img src="/icons/wink.png" class="faces"></a>
             <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot; :D&quot;)"><img src="/icons/cheesy.png" class="faces"></a>
             <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot; ;D&quot;)"><img src="/icons/grin.png" class="faces"></a>
             <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot; >:(&quot;)"><img src="/icons/angry.png" class="faces"></a>
             <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot; :(&quot;)"><img src="/icons/sad.png" class="faces"></a>
             <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot; :o&quot;)"><img src="/icons/shocked.gif" class="faces"></a>
             <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot; 8)&quot;)"><img src="/icons/cool.png" class="faces"></a>
             <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot; ???&quot;)"><img src="/icons/huh.png" style="width:15px;height:22px;"></a>
             <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot; :P&quot;)"><img src="/icons/tongue.png" class="faces"></a>
             <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot; :-[&quot;)"><img src="/icons/embarassed.png" class="faces"></a>
             <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot; :-X&quot;)"><img src="/icons/lipsrsealed.png" class="faces"></a>
             <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot; :-\\&quot;)"><img src="/icons/undecided.png" class="faces"></a>
             <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot; :-*&quot;)"><img src="/icons/kiss.gif" class="faces"></a>
             <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot; :'(&quot;)"><img src="/icons/cry.gif" class="faces"></a>
             <select onchange="wrapText('body', '[color='+this.options[this.selectedIndex].value+']', '[/color]'); this.selectedIndex = 0;" style="margin-bottom: 1ex;">
                <option value="" selected="selected">Change Color</option>
               <option value="red">Red</option>
                <option value="green">Green</option>
                <option value="blue">Blue</option>
                <option value="purle">Purple</option>
                <option value="brown">Brown</option>
                <option value="black">Black</option></select>
            </div>
            <script>document.getElementById("editbar").style.display = 'block';</script>
            
        <textarea rows="12" cols="90" name="content" id="body"><?php echo "$comment_content"; ?></textarea>
                            <p><p>
            <input type="hidden" name="postid" value="<?php echo $post_id; ?>">
          
                              <input type="hidden" name="boardid" value="<?php echo $bid; ?>">
                                <input type="hidden" name="link" value="<?php echo $link; ?>">
       <input type="submit" name="post" value="Submit" class="upload" id="upload" accesskey="s">
                                <script type="text/javascript">
                                    document.postform.body.focus()
                                </script>
        </p><p>
       
        </p><div id="attachments" class="clearfix">
        <b>Attachments</b>: (maximum size: <b>4MB</b> for pictures and <b>250kB</b> for other files)
   <div id="filediv">
      <div id="filediv"><input name="file1" type="file" id="file"/></div><br/>
    <div id="filediv"><input name="file2" type="file" id="file"/></div><br/>
    <div id="filediv"><input name="file3" type="file" id="file"/></div><br/>
    <div id="filediv"><input name="file4" type="file" id="file"/></div><br/>
    
    <!-------Including PHP Script here------>
    <?php
    include "quote_upload1.php";
    include "quote_upload2.php";
    include "quote_upload3.php";
    include "quote_upload4.php";
    ?>
        </form></td></tr></tbody></table>

  <p class="small">(<a href="#up"><b>Go Up</b></a>)</p>

<?php
}
else
{
    echo "<h2>Error occured</h2>";
}
//load footer from footer.php
require_once ('footer.php');

?>

<script type="text/javascript" src="https://www.nairaland.com/static/nl2.js"></script>
	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->

</body>
</html>
