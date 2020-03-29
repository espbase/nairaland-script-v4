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
require 'incfiles/bbparser.php'; // phpbb code parser
?>

<!DOCTYPE html>
<html>
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">

	<title><?php echo APPNAME; ?></title>
	<link href="<?php echo WEBROOT; ?>/css/nl.css" rel="stylesheet" type="text/css">
	<link href="http://www.nairaland.com/feed" rel="alternate" title="Nairaland" type="application/rss+xml">
	<meta content="" name="google-site-verification">


	<meta name="description" content="African discussion forum offering topics in politics, business, jobs,soccer, entertainment, technology and general discussion categories.">

	<!-- for Facebook -->
	<meta property="og:title" content="Shift Gears Forum largest">
	<meta property="og:description" content="African discussion forum offering topics in politics, business, jobs,soccer, entertainment, technology and general discussion categories.">

	<!-- for Twitter -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="Shift Gears Forum largest">
	<meta name="twitter:description" content="African discussion forum offering topics in politics, business, jobs,soccer, entertainment, technology and general discussion categories.">

	<!-- for site verification -->
	<meta name="alexaVerifyID" content="">
	<meta name="google-verification" content="">
	<meta name="yandex-verify" content="">
	<link href="feed" rel="alternate" type="application/rss+xml" title="Programming Lovers Forum">
	<link rel="shortcut icon" type="image/x-icon" href="">

</head>

<body data-gr-c-s-loaded="true">
<div class="body">

<?php
################################# Defining variables ##########################
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



$comQuery=$db->query("SELECT * FROM forum_rule WHERE fid='1' ");
$rowR=mysqli_fetch_array($comQuery);
$content_text=$rowR['content_text'];


if(isset($_POST['post']))
{
// insert into database
//$redirect="$post_id/$link"; // REDIRECT TO BACK TO POST

 $content=addslashes($_POST['content']);


	$db->query("UPDATE forum_rule SET content_text='$content' WHERE fid='1' ");
	//echo "$date-$urltitle.html";

//$redirect="$topic_id/$link"; // create friendly seo post link(url)

//header('Location: ../'.$redirect); // redirect to newly created post
    echo '<h1>Submitted!</h1>';
}

?>
<div class="section-title">
    <h1>UPDATE FORUM RULES</h1>
    <div class="divider"></div>
  </div>
 <!-- the actual blog post: title/author/date/content -->

 <div class = "panel-body">


 <form method="POST" action="" id="postform" name="postform" enctype="multipart/form-data">
                                <script type="text/javascript">
                                    document.postform.body.focus()
                                </script>
                            </p>
                            <p><b>List Of Do's and Don'ts</b>:
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
                            <textarea rows="12" cols="110" name="content" id="body" required="">
                                <?php echo $content_text; ?>
                            </textarea>

                            <p>
                                <input type="submit" name="post" value="Submit" accesskey="s">
                            </p>

                        </form>

												                    <div class="user-block slide">

												                      <h1 style="font-size: 17px; color: darkgreen; font-weight: bold; cursor: pointer;">Recent Rules</h1>
												                    </div>
												          <!-- post 1 -->
												          <div class="box-body view" style="display: block;">
												        <p align="left">
																	<?php  $bb = new bbParser(); echo $bb->getHtml($content_text); ?>
												        </p>
												    </div>
<?php
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
