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
//echo Checkuser();

require_once 'incfiles/theme/head_open.php';
############################### page title #######################

	$page_title='Business Directory and Classified';
	$site_dsc=APPNAME." Business Directory and Classified";
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

echo '<a id="top" name="top"></a>'; // anchor

##################### login form ########################

$error="";
?>
<style type="text/css">

.btn {
  display: inline-block;

  background: #339DFF;
  color: #fff;
  text-decoration: none;
  font-size: 13px;
  line-height: 28px;
  border-radius: 0px;
  -webkit-transition: all 0.3s;
  transition: all 0.3s;
  width: 130px;
  text-align: center;
}

.btn:hover {
  background: #2980D1;;
  color: #339DFF;
  box-shadow: 0 4px 4px rgba(83, 100, 255, 0.32);
}


.span {
  font-size: 1em;
  font-weight: 400;
  opacity: 0.7;
}

.margbtmWrap {
    background: #FFF;
    margin-bottom: 10px;
}
.clist {
    margin: 0px;
    padding: 0px;
    background: ;
}
.clist li {
    list-style: none;
    display: block;
    width: 30%;
    float: left;
}


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

 <!--<img src='https://i.imgur.com/W8hjksD.jpg' id=""> -->
<form action="" method="get">
<table summary="search">
    <tbody>
      <tr>
        <td class="">
          <p><a class="btn" href="add-item">Sell Your Item</a> </p>
          <p></p>
          <b>Search by</b> <input name="name" required placeholder="Business, places nearest to you" type="text" size="30" value=""> &nbsp;<label>
          <select name="board" style="width: 200px" required>
          <option value="">
            -- All Categories --
          </option>
          <?php
$queryBoard=$db->query("SELECT * FROM category C, sub_cat S WHERE C.cid=S.cid_fk group by S.sname ORDER BY S.sid");
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
        <input type="submit" value="Search"> &nbsp;</td>
      </tr>
    </tbody>
  </table>
</form>

<?php
$buslogo='';
if(isset($_GET['name']) && ($_GET['name']!=""))
{
$keywords=trim($_GET['name']);
$board=trim($_GET['board']);

$comQuery=$db->query("SELECT * FROM classified C, sub_cat S WHERE C.class_cat=S.sid AND C.class_status=1 AND C.class_cat='$board' AND C.class_name LIKE '%$keywords%' OR C.class_info LIKE '%$keywords%' GROUP BY C.class_url  ORDER BY C.class_id DESC ");

$countR=$comQuery->num_rows;

echo "<h3>$countR Directory Matched</h3>";
if ($countR)
{
while($rowR=$comQuery->fetch_assoc())
{
  $bname =($rowR['class_name']);
  $desc =($rowR['class_features']);
  $location =($rowR['class_location']);
  $buzlogo =($rowR['class_img1']);
  $class_amt =($rowR['class_amt']);
  $class_date =($rowR['class_date']);
  $class_url =($rowR['class_url']);
  $class_id =($rowR['class_id']);
  $sname =($rowR['sname']);
$clickcount=$rowR['class_clickcount']+0; //increament clicks by one 1

$comQuery12=$db->query("SELECT * FROM class_img WHERE class_fk='$class_id' ");
$rowp=$comQuery12->fetch_assoc();

  $class_img1 =($rowp['class_img1']);
  $class_img2 =($rowp['class_img1']);
	@$i = $i + 1;
			if($i%2 == 0)
			{ $w=''; } 
			
			else
			{ $w='w'; }
		
	
?>
  <table summary="search">
    <tbody>
      <tr>
                  <td class="<?php echo $w; ?>">
 <img src="<?php echo URL.'/images/bus/watermark.php?image='.$class_img1.'&watermark=k247.png'; ?>" id="gImg" width="200"> 

<h3> <a href="<?php echo URL.'/item/'.$class_url; ?>" style="text-decoration: none;"><?php echo $bname; ?></a> </h3>
<span class="smContent"> <?php echo $phone; ?></span>
<div id="inner"><i class="fa fa-map-marker"></i> <?php echo $location.' | '.$sname.'| Clicks ('.$clickcount.')'; ?></div>
<div id="inner"><i class="fa fa-map-marker"></i> <?php echo $desc; ?></div>
<h2>Ksh<?php echo number_format($class_amt); ?></h2>


</td>
      </tr>
    </tbody>
  </table>
<?php } } else{ ?>
  <h3>No Directory Found</h3>
<?php } } ?>





<?php
$comQuery1=$db->query("SELECT * FROM classified C, sub_cat S WHERE C.class_cat=S.sid AND C.class_status=1  GROUP BY C.class_url  ORDER BY C.class_id DESC ");
$countR=$comQuery1->num_rows;
//user_fk 	class_name 	class_info 	class_cat 	class_features 	class_location 	class_img1 	class_code 	class_amt 	class_url 	class_date 

if ($countR)
{
while($rowR1=$comQuery1->fetch_assoc())
{
  $bname =($rowR1['class_name']);
  $desc =($rowR1['class_features']);
  $location =($rowR1['class_location']);
  $buzlogo =($rowR1['class_img1']);
  $class_amt =($rowR1['class_amt']);
  $class_date =($rowR1['class_date']);
  $class_url =($rowR1['class_url']);
  $class_id =($rowR1['class_id']);
  $sname =($rowR1['sname']);
$clickcount=$rowR1['class_clickcount']+0; //increament clicks by one 1

$comQuery12=$db->query("SELECT * FROM class_img WHERE class_fk='$class_id' ");
$rowp=$comQuery12->fetch_assoc();

  $class_img1 =($rowp['class_img1']);
  $class_img2 =($rowp['class_img1']);
	@$i = $i + 1;
			if($i%2 == 0)
			{ $w=''; } 
			
			else
			{ $w='w'; }
		
			

?>
  <table summary="search">
    <tbody>
      <tr>
                  <td class="<?php echo $w; ?>">
 <img src="<?php echo URL.'/images/bus/watermark.php?image='.$class_img1.'&watermark=k247.png'; ?>" id="gImg" width="200"> 

<h3> <a href="<?php echo URL.'/item/'.$class_url; ?>" style="text-decoration: none;"><?php echo $bname; ?></a> </h3>
<span class="smContent"> <?php echo $phone; ?></span>
<div id="inner"><i class="fa fa-map-marker"></i> <?php echo $location.' | '.$sname.'| Clicks ('.$clickcount.')'; ?></div>
<div id="inner"><i class="fa fa-map-marker"></i> <?php echo $desc; ?></div>
<h2>Ksh<?php echo number_format($class_amt); ?></h2>


</td>
      </tr>
    </tbody>
  </table>
<?php } }  ?>
<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';

//load footer from footer.php
require_once ('footer.php');

?>

</body>
</html>
