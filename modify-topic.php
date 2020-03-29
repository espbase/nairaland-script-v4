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

$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.
echo checkUser(); // authenticate logged in users
require_once 'incfiles/theme/head_open.php';
############################### page title #######################

    $page_title='Create Moderator';
    $site_dsc="create new moderators";
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

################################# Defining variables ##########################
$post_id=($_GET['id']); // get post id

//load header.php
require_once ('header.php');

echo '<a id="top" name="top"></a>'; // anchor

##################### verify if post does in databse ########################

$created=date('D M Y h:sa'); // get current timestamp
//$user_id=1; // custom user id
$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.
$username=$_SESSION['username']; //Storing USERNAME in SESSION variabl
$email=$_SESSION['email']; //Storing EMAIL in SESSION variable.
//echo $user_id;



$comQuery=$db->query("SELECT * FROM topics WHERE topic_id='$post_id' ");
$rowR=mysqli_fetch_array($comQuery);
$link=$rowR['link'];
$topic_id=$rowR['topic_id'];
$title=$rowR['title'];
$user_id_fk=$rowR['user_id_fk'];
$content_text=$rowR['content_text'];


if(isset($_POST['content']))
{
// insert into database
//$redirect="$post_id/$link"; // REDIRECT TO BACK TO POST

 $title=($_POST['title']);
 $content=$_POST['content'];


	$db->query("UPDATE topics SET title='$title', content_text='$content' WHERE topic_id='$post_id' ");
	//echo "$date-$urltitle.html";

$redirect=WEBROOT."/$topic_id/$link"; // create friendly seo post link(url)

header('Location: '.$redirect); // redirect to newly created post
   // echo '<h1>Submitted!</h1>';
}

// if it is admin show banned topic link
                $checkAccesslevel=$db->query("SELECT * FROM users WHERE uid='$user_id' ");
                $do_exist=$checkAccesslevel->num_rows;
                
                if($do_exist) // if is admin
                 {
                   $data1=$checkAccesslevel->fetch_assoc();
                   $access=$data1['access']; // get access level

if($user_id_fk==$user_id OR $access>0)
{
?>
<div class="section-title">
    <h1>MAKE CORRECTION TO TOPIC</h1>
    <div class="divider"></div>
  </div>
 <!-- the actual blog post: title/author/date/content -->

 <div class = "panel-body">

 <form method="POST" action="" id="postform" name="postform" enctype="multipart/form-data">
                                <input type="hidden" name="boardid" value="<?php echo $id; ?>">
                                <script type="text/javascript">
                                    document.postform.body.focus()
                                </script>
                            </p>
                             <p><b>Subject</b>:
                                <input type="text" name="title"  value="<?php echo $title; ?>" required="" id="postformtitle" maxlength="80">
                                <script type="text/javascript">
                                    document.postform.title.focus()
                                </script>
                            </p>
                            <p><b>Message</b>:
                            <div id="editbar" style="display: block;">
                                <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[b]&quot;, &quot;[/b]&quot;)" title="Bold">
                                    <span class="eb"><img src="<?php echo WEBROOT; ?>/icons/bold.gif"></span>
                                </a>
                                <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[i]&quot;, &quot;[/i]&quot;)" title="Italic">
                                    <span class="eb"><img src="<?php echo WEBROOT; ?>/icons/italicize.gif"></span>
                                </a>
                                <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[s]&quot;, &quot;[/s]&quot;)" title="Strikethrough">
                                    <span class="eb"><img src="<?php echo WEBROOT; ?>/icons/strike.gif"></span>
                                </a>
                                <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[left]&quot;, &quot;[/left]&quot;)" title="Align Left">
                                    <span class="eb"><img src="<?php echo WEBROOT; ?>/icons/left.gif"></span>
                                </a>
                                <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[right]&quot;, &quot;[/right]&quot;)" title="Align Right">
                                    <span class="eb"><img src="<?php echo WEBROOT; ?>/icons/right.gif"></span>
                                </a>
                                <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[center]&quot;, &quot;[/center]&quot;)" title="Align Center">
                                    <span class="eb"><img src="<?php echo WEBROOT; ?>/icons/center.gif"></span>
                                </a>
                                <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot;[hr]&quot;)" title="Horizontal Rule">
                                    <span class="eb"><img src="<?php echo WEBROOT; ?>/icons/hr.gif"></span>
                                </a>
                                <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[size=8pt]&quot;, &quot;[/size]&quot;)" title="Font Size">
                                    <span class="eb"><img src="<?php echo WEBROOT; ?>/icons/size.gif"></span>
                                </a>
                                <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[font=Lucida Sans Unicode]&quot;, &quot;[/font]&quot;)" title="Font Face">
                                    <span class="eb"><img src="<?php echo WEBROOT; ?>/icons/face.gif"></span>
                                </a>
                                <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[img]&quot;, &quot;[/img]&quot;)" title="Insert Image/Picture">
                                    <span class="eb"><img src="<?php echo WEBROOT; ?>/icons/img.gif"></span>
                                </a>
                                <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[url]&quot;, &quot;[/url]&quot;)" title="Insert Hyperlink">
                                    <span class="eb"><img src="<?php echo WEBROOT; ?>/icons/url.gif"></span>
                                </a>
                                <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[email]&quot;, &quot;[/email]&quot;)" title="Insert Email">
                                    <span class="eb"><img src="<?php echo WEBROOT; ?>/icons/email.gif"></span>
                                </a>
                                <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[sub]&quot;, &quot;[/sub]&quot;)" title="Subscript">
                                    <span class="eb"><img src="<?php echo WEBROOT; ?>/icons/sub.gif"></span>
                                </a>
                                <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[sup]&quot;, &quot;[/sup]&quot;)" title="Superscript">
                                    <span class="eb"><img src="<?php echo WEBROOT; ?>/icons/sup.gif"></span></a>
                                <a href="javascript:void(0);" onclick="wrapText(&quot;body&quot;, &quot;[quote]&quot;, &quot;[/quote]&quot;)" title="Quote">
                                    <span class="eb"><img src="<?php echo WEBROOT; ?>/icons/quote.gif"></span>
                                </a>

                                <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot; &#9825;&quot;)"><img src="<?php echo WEBROOT; ?>/icons/emoticons/heart.png" class="faces" title="hert">
                                </a>
                                <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot;[img]<?php echo WEBROOT; ?>/icons/emoticons/sick.png[/img]&quot;)">
                                <img src="<?php echo WEBROOT; ?>/icons/emoticons/sick.png" class="faces" title="sick">
                                <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot;[img]<?php echo WEBROOT; ?>/icons/emoticons/wub.png[/img]&quot;)"><img src="<?php echo WEBROOT; ?>/icons/emoticons/wub.png" class="faces" title="wub">
                                </a>
                                <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot;[img]<?php echo WEBROOT; ?>/icons/emoticons/ninja.png[/img]&quot;)"><img src="<?php echo WEBROOT; ?>/icons/emoticons/ninja.png" class="faces" title="ninja">
                                <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot;[img]<?php echo WEBROOT; ?>/icons/emoticons/kissing.png[/img]&quot;)"><img src="<?php echo WEBROOT; ?>/icons/emoticons/kissing.png" class="faces" title="kissing">
                                </a>
                                <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot;[img]<?php echo WEBROOT; ?>/icons/emoticons/alien.png[/img]&quot;)"><img src="<?php echo WEBROOT; ?>/icons/emoticons/alien.png" class="faces" title="alien">
                                <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot;[img]<?php echo WEBROOT; ?>/icons/emoticons/devil.png[/img]&quot;)"><img src="<?php echo WEBROOT; ?>/icons/emoticons/devil.png" class="faces" title="devil">
                                </a>
                                <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot;[img]<?php echo WEBROOT; ?>/icons/emoticons/cool.png[/img]&quot;)"><img src="<?php echo WEBROOT; ?>/icons/emoticons/cool.png" class="faces" title="cool">
                                </a>

                                <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot;[img]<?php echo WEBROOT; ?>/icons/emoticons/shocked.png[/img]&quot;)"><img src="<?php echo WEBROOT; ?>/icons/emoticons/shocked.png" class="faces" title="shocked">
                                <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot;[img]<?php echo WEBROOT; ?>/icons/emoticons/sideways.png[/img]&quot;)"><img src="<?php echo WEBROOT; ?>/icons/emoticons/sideways.png" class="faces" title="sideways">
                                </a>
                                <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot;[img]<?php echo WEBROOT; ?>/icons/emoticons/silly.png[/img]&quot;)"><img src="<?php echo WEBROOT; ?>/icons/emoticons/silly.png" class="faces" title="silly">
                                </a>
                                <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot;[img]<?php echo WEBROOT; ?>/icons/emoticons/ermm.png[/img]&quot;)"><img src="<?php echo WEBROOT; ?>/icons/emoticons/ermm.png" class="faces" title="ermm">
                                <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot;[img]<?php echo WEBROOT; ?>/icons/emoticons/whistling.png[/img]&quot;)"><img src="<?php echo WEBROOT; ?>/icons/emoticons/whistling.png" class="faces" title="slWhisting">
                                </a>
                                <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot;[img]<?php echo WEBROOT; ?>/icons/emoticons/wink.png[/img]&quot;)"><img src="<?php echo WEBROOT; ?>/icons/emoticons/wink.png" class="faces" title="wink">
                                </a>
                                <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot;[img]<?php echo WEBROOT; ?>/icons/emoticons/sad.png[/img]&quot;)"><img src="<?php echo WEBROOT; ?>/smileys/sad.png" class="faces" title="Sad">
                                <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot;[img]<?php echo WEBROOT; ?>/icons/emoticons/dizzy.png[/img]&quot;)"><img src="<?php echo WEBROOT; ?>/icons/emoticons/dizzy.png" class="faces" title="Dizzy">
                                </a>
                                <a href="javascript:void(0);" onclick="addText(&quot;body&quot;, &quot;[img]<?php echo WEBROOT; ?>/icons/emoticons/sleeping.png[/img]&quot;)"><img src="<?php echo WEBROOT; ?>/icons/emoticons/sleeping.png" class="faces" title="sleeping">
                                </a>

                                <select onchange="wrapText(&#39;body&#39;, &#39;[color=&#39;+this.options[this.selectedIndex].value+&#39;]&#39;, &#39;[/color]&#39;); this.selectedIndex = 0;" style="margin-bottom: 1ex;">
                                    <option value="" selected="selected">Change Color</option>
                                    <option value="red">Red</option>
                                    <option value="green">Green</option>
                                    <option value="blue">Blue</option>
                                    <option value="purple">Purple</option>
                                    <option value="brown">Brown</option>
                                    <option value="black">Black</option>
                                    <option value="lime">Lime</option>
                                    <option value="DeepSkyBlue">Deep Sky Blue</option>
                                    <option value="silver">Silver</option>
                                    <option value="lightgreen">Light Green</option>


                                </select>
                            </div>
                            <script>
                                document.getElementById("editbar").style.display = 'block';
                            </script>
                            <span class="noisy">Please do not post adverts in this section, to avoid being banned.</span>
                            <textarea rows="12" cols="110" name="content" id="body" required="">
                                <?php echo $content_text; ?>
                            </textarea>

                             <div id="attachments" class="clearfix">
                               <div id="formdiv">
                   <b>Attachments</b>: (maximum size: <b>2MB</b>)
                    <hr/>
                    <div id="filediv"><input name="file1" type="file" id="file"/></div><br/>
                    <div id="filediv"><input name="file2" type="file" id="file"/></div><br/>
                    <div id="filediv"><input name="file3" type="file" id="file"/></div><br/>
                    <div id="filediv"><input name="file4" type="file" id="file"/></div><br/>
           
                
                <input type="submit" name="submit" value="Submit" class="upload" id="upload" accesskey="s">

                <!-------Including PHP Script here------>
                <?php 
                include "upload.php"; 
                include "upload1.php"; 
                include "upload2.php"; 
                include "upload3.php"; 
                ?>
            </div>
           
           
                            </div>

                        </form>
                        <?php
                    }
                     }
                    else
                    {
                        echo '<h1>You do not have permission to modify this post!</h1>';
                    }


echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

?>

	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->

<script type="text/javascript" src="<?php echo WEBROOT; ?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo WEBROOT; ?>/js/form.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
    $('div.view').hide();
    $('div.slide').click(function() {
    $(this).next('div.view').slideToggle('fast');
    return false;
    });
    });
    </script>
</body>
</html>
