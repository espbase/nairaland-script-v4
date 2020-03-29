<?php
/*
Developer: Marshall Unduemi
Url: www.codexpresslabs.info
Contact: info@codexpresslabs.info

*/
//Enable Error Reporting

//error_reporting(0);
//remove the above comment to enable error reporting
$keywoards=($_GET['q']); // get post id

require_once ('config.php');
require_once ('functions.php');

require_once 'incfiles/theme/head_open.php';
############################### page title #######################
require 'incfiles/bbparser.php'; // phpbb code parser
	$page_title='Search Result - '.$keywoards;
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag
require_once 'incfiles/theme/body_open.php';

################################# Defining variables ##########################
require_once ('header.php');
$sid='index';
//load system header ads template
?>
<table summary="search">
  <tbody>
    <tr>
      <td class="w">
          <form action="" method="get">
        <input name="q" type="text" value="<?php echo $_GET['q']; ?>"> &nbsp;<label>
            
            <select name="board">
          <option value="0">
            -- All Sections --
          </option>
              <?php
    $queryBoard=$db->query("SELECT * FROM category C, sub_cat S WHERE C.cid=S.cid_fk group by S.sname ORDER BY S.sname ASC");
//fetch rows
/*
Define topics, category, and sub cat details and variables
*/
while($bdata=$queryBoard->fetch_assoc()){
$sname=$bdata['sname'];
$sid=$bdata['sid'];
$cid=$bdata['cid'];
$catcost=$bdata['catcost'];

if($sname=='Homepage')
{
 //echo '<option value="index|0|'.$catcost.'">'.$sname.'</option>';   
}
else
{
    echo '<option value="'.$sid.'">'.$sname.'</option>';
}


}
?>
        </select> &nbsp;</label>
        <input name="topicsonly" type="checkbox" value="1"> Topics&nbsp; <label>
            <input name="imagesonly" type="checkbox" value="1"> Images</label>&nbsp; 
        <input type="submit" name="search" value="Search"> &nbsp;
        </form>
      </td>
    </tr>
  </tbody>
</table>

<?php
require ('ads.php');

//board_id_fk
?>


<table>
<tbody>
<?php

if(isset($_GET['q']) && ($_GET['q']!=""))
{
$keywords=trim($_GET['q']);
@$board=trim($_GET['board']);
@$topicsonly=trim($_GET['topicsonly']);
@$imagesonly=trim($_GET['imagesonly']);

$type = '';
if($topicsonly)
{
  $type = 'topic';  
}
if($imagesonly)
{
  $imgr = '1';  
}
else
{
  $imgr = '0';    
}

//echo $type;

$comQuery=$db->query("SELECT * FROM users U, topics TP
  WHERE U.uid=TP.user_id_fk AND U.uid=TP.user_id_fk AND TP.title LIKE '%$keywords%' OR TP.content_text LIKE '%$keywords%' OR post_type='$type'
	GROUP BY TP.topic_id ORDER BY TP.topic_id DESC ");
$countR=$comQuery->num_rows;

echo "<h3>$countR Search Query Matched</h3>";
if ($countR)
{
while($rowR=$comQuery->fetch_assoc())
{
$authorId=$rowR['user_id_fk'];
$title=$rowR['title'];
$link=$rowR['link'];
$content=$rowR['content_text'];
$topic_id=$rowR['topic_id'];
$board_id_fk=$rowR['board_id_fk'];
$created=$rowR['created'];
$topic_elaps=$rowR['time'];
$gender=$rowR['gender'];

$file1=$rowR['file1'];
$file2=$rowR['file2'];
$file3=$rowR['file3'];
$file4=$rowR['file4'];

$post_type=$rowR['post_type'];

// switch gender
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

$QueryBoard=$db->query("SELECT * FROM sub_cat WHERE sid='$board_id_fk' ");
$rd=$QueryBoard->fetch_assoc();
$sname=$rd['sname'];

$QueryUsers=$db->query("SELECT * FROM users WHERE uid='$authorId' ");
$r=$QueryUsers->fetch_assoc();
$authorname=$r['username'];
?>
		<tr>
			<td class="bold l pu">
			
				<img src="/icons/xx.gif"> 	<a href="<?php echo "$rowR[topic_id]/$rowR[link]"; ?>"><?php echo ucfirst($sname); ?> / 
				<a href="<?php echo "$rowR[topic_id]/$rowR[link]"; ?>"><?php echo ucfirst($title); ?></a>
				by <a class="user" href="<?php echo WEBROOT ?>/u/<?php echo $author; ?>"><?php echo ucfirst($authorname)."($gender)"; ?></a>:
				<span class="s"><b><?php echo $created; ?></b></span>
			</td>
		</tr>
		<tr>
			<td class="l w pd" id="pb78674027">
				<div class="narrow">
				<?php
				// topic content
					$content = badWordFilter($content); // filter bad words
					//echo $cleaned
					
					$content = !empty($keywords)?highlightWords($content, $keywords):$content;
					
					$bb = new bbParser(); echo $bb->getHtml($content); // topic content
					
					// Highlight words in text


					?>
				</div>
				
				<!--<p class="s">(<a href="https://www.nairaland.com/newpost?post=78674027&amp;topic=1788778">Quote</a>) 
				(<a href="https://www.na
				4027">Report</a>) <b id="lpt78674027"></b>
				(<a href="https://www.na
				2378674027" id="lpl786', '0', 'lpt78674027', 'lpl78674027'); return false;">Like</a>)<b id="shb78674027"></b>
				(<a href="hEE0910E17FB668, 'eturn false;">Share</a>)</p>-->
			</td>
		</tr>

<?php
}

}
else
{
	echo '<hr><tr>
		<td id="top519" class="w"><a name="519"></a>  <h2>No search Matche Your Query</h2></b>
		</td>

	</tr><hr>';
}
	}
	else
	{
		echo '<hr><tr>
			<td id="top519" class="w"><a name="519"></a> <h2>Empty search Query</h2></b>
			</td>

		</tr><hr>';
	}
?>
</tbody>
	</table>
<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';

//load system header ads template
require ('ads.php');
//load footer from footer.php
require_once ('footer.php');

?>

</body>
</html>
