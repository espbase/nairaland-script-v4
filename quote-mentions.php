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

/*
NOTE: Don't remove this line of code
this serve as the developer property
that exist between the app and the third party
*/

$site_title=APPNAME;
if (DEVELOPER==='Marshall')
{

############################################### site content
//$siteinfo = new site();
//echo $siteinfo->discription(APPINFO);
$page_title='My Quotes & Mentions ';
$site_dsc='My Quotes & Mentions ';

require_once 'incfiles/theme/head_open.php';
############################### page title #######################
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag
require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

require 'incfiles/bbparser.php'; // phpbb code parser
//load header.php -->
require_once ('header.php');
/*
developer credit
Don't temper or try to edit and modify
*/
/////////////////////////////////////////////////
$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.
echo checkUser(); // authenticate logged in users
echo '<a id="top" name="top"></a>';

//load board.php list of categories -->
 //require_once ('inc_board.php');

//load google adsense ads template
//require_once ('incfiles/googleads.html');

//load articles from articles.php -->
//require_once ('inc_articles.php');

?>
<!--<p id="legend2">
</p>-->
<h2>My Quotes & Mentions</h2>
<p><a href="./"><?php echo APPNAME; ?> </a> / <b>My Quotes & Mentions</b></p>
<!-- item container -->
<table>
		<tbody>

<?php
// retrieve selected results from database and display them on page
$result=$db->query("SELECT * FROM topic_comments T, users U, topics TP WHERE T.user_id=U.uid AND TP.topic_id=T.topic_id AND T.user_id='$user_id' AND T.quote_id!='' ORDER BY T.comment_id DESC");

while($data = mysqli_fetch_array($result)) {
	$content=$data['comment'];
	$comment_id=$data['comment_id'];
	$gender=$data['gender'];
	$pusername=$data['username'];
	$board_id=$data['board_id_fk'];
	$post_status=$data['status'];
	$topic_id=$data['topic_id'];
	$url=$data['link'];
	$comment_id_fk=$data['comment_id_fk'];
  	$comment_id_fk=$data['comment_id_fk'];
  	$comment_creator=$data['creator'];
  	$topic_quote=$data['quote_id'];
  	$com_file1=$data['file1'];
  	$com_file2=$data['file2'];
  	$com_file3=$data['file3'];
  	$com_file4=$data['file4'];

  	switch($gender)
{
  case '1':
  $gender='m';
  break;
  case '2':
  $gender='f';
  break;
  case '0':
  $gender='n/a';
  break;
}
$queryBoard=$db->query("SELECT * FROM topics T, sub_cat S, category C
  WHERE S.sid='$board_id' AND S.cid_fk=C.cid  ");

@$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.
$bdata=$queryBoard->fetch_assoc();
$category_name=$bdata['name'];
$sname=$bdata['sname'];
$slink=$bdata['surl'];
$clink=$bdata['url'];

 $commentclean = badWordFilter($content);
$bb = new bbParser();
 ?>
<tr>
				<td class="bold l pu">
    <a href="<?php echo WEBROOT."/forum/$slink"; ?>">
     <img src='https://www.nairaland.com/icons/xx.gif'> <?php echo ucfirst($sname); ?></a>
      / <a href="<?php echo WEBROOT."/$data[topic_id]/$data[link]"; ?>">
      <?php echo ucfirst($data['title']); ?></a>
  by <a class="user" href="../u/<?php echo $data['username']; ?>"><?php echo ucfirst($pusername)."($gender)"; ?></a>: <span class="s"><b><?php echo ucfirst($data['created']); ?></b></span></td></tr>

</td>
			</tr>
 <tr>
				<td class="l w pd" id="pb72884735">
					<div class="narrow">
<?php
$comQuery=$db->query("SELECT * FROM topic_comments TC, users U, profile P, topics TP
      WHERE TP.topic_id='$topic_id'
      AND TC.comment_id='$comment_id_fk'
      AND U.uid=TC.user_id
      AND TP.board_id_fk='$board_id'
      ");
      $checkcomment1=$comQuery->num_rows;
      if($checkcomment1)
      {
      $rowR=mysqli_fetch_array($comQuery);
      $comment_user=$rowR['username'];
      $commentReply=$rowR['comment'];
      $comment_id_k=$rowR['comment_id'];
      $user_id_k=$rowR['user_id'];
      $avater=$rowR['avater'];
      $qfile1=$rowR['file1'];
      $quote_file1=$rowR['file1'];
      $quote_file2=$rowR['file2'];
      $quote_file3=$rowR['file3'];
      $quote_file4=$rowR['file4'];

      if ($comment_creator)
      {
      if ($comment_id_fk) {
      echo "<blockquote><a href='".WEBROOT."/u/$comment_user'><b>$comment_user</b> Said</a>:<br>".$bb->getHtml($commentReply);
      // FOR VERSION 4.0
      //echo "$comment_id_k";
      
    //END
    if($quote_file2)
    {
    //echo '<br><img src="'.WEBROOT.'/'.$qfile1.'" style="width:450px;" alt="comment image 1"/> ';
    }
    
      echo "</blockquote>";
      //END
      }
      //echo $bb->getHtml($reply); // topic content
      }
      }
      if ($topic_quote) { // if user quote topic
    $queryQuoteTopic=$db->query("SELECT * FROM topics T, users U
      WHERE T.topic_id='$topic_quote' AND U.uid=T.user_id_fk  ");
    //fetch rows
    $rowQuote=mysqli_fetch_array($queryQuoteTopic);
    $topic_content=$rowQuote['content_text'];
    $topic_user=$rowQuote['username'];
    $topic_k=$rowQuote['topic_id'];
    $avater=$rowQuote['avater'];
    $topic_file1=$rowQuote['file1'];
    $topic_file2=$rowQuote['file2'];
    $topic_file3=$rowQuote['file3'];
    $topic_file4=$rowQuote['file4'];


    echo "<blockquote> <a href='".WEBROOT."/u/$topic_user'><b>$topic_user</b></a>:<br>".$bb->getHtml($topic_content);

    if($topic_file1)
    {
    echo '<br><img src="'.WEBROOT.'/'.$topic_file1.'" style="width:450px;" alt="comment image 1"/> ';
    }
    if($topic_file2)
    {
    echo '<br><img src="'.WEBROOT.'/'.$topic_file2.'" style="width:450px;" alt="comment image 1"/> ';
    }
    if($topic_file3)
    {
    echo '<br><img src="'.WEBROOT.'/'.$topic_file3.'" style="width:450px;" alt="comment image 1"/> ';
    }
    if($topic_file4)
    {
    echo '<br><img src="'.WEBROOT.'/'.$topic_file4.'" style="width:450px;" alt="comment image 1"/> ';
    }
    echo "</blockquote>";
    }
    // topic content
    echo $bb->getHtml($commentclean); // topic content
    //echo "$topic_id";
    // FOR VERSION 4.0
    echo "<br />";
    if($com_file1)
    {
    echo '<a href="'.WEBROOT.'/'.$com_file1.'" target="_blank" title="Enlarge Photo"><img src="'.WEBROOT.'/'.$com_file1.'"  style="width:450px"  alt="comment image 1"/></a> ';
    }
    if($com_file2)
    {
    echo '<a href="'.WEBROOT.'/'.$com_file2.'" target="_blank" title="Enlarge Photo"><img src="'.WEBROOT.'/'.$com_file2.'"  style="width:450px"  alt="comment image 1"/></a> ';
    }
    if($com_file3)
    {
    echo '<a href="'.WEBROOT.'/'.$com_file3.'" target="_blank" title="Enlarge Photo"><img src="'.WEBROOT.'/'.$com_file3.'"  style="width:450px"  alt="comment image 1"/></a> ';
    }
    if($com_file4)
    {
    echo '<a href="'.WEBROOT.'/'.$com_file4.'" target="_blank" title="Enlarge Photo"><img src="'.WEBROOT.'/'.$com_file4.'"  style="width:450px"  alt="comment image 1"/></a> ';
    }
    //END
    echo "</td>
			</tr>";
}
?>
</tbody>
	</table>
	<?php

// display the links to the pages
for ($page=1;$page<=$number_of_pages;$page++) {
  echo '<a href="?page=' . $page . '">(' . $page . ')</a> ';
}
#########################################################################

echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

?>

	
</body>
</html>
<?php
}
else
{
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
/*
deactivate and redirect website

*/
}
 ?>
