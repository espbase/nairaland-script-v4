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

	$page_title=APPNAME.'Business Directory';
	$site_dsc=APPNAME." Kenya Business Directory";
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
</style>
<h2>Business Directory</h2>

<form action="" method="get">
<table summary="search">
    <tbody>
      <tr>
        <td class="">
          <p>Find companies, professionals and organizations offering their products or services to expatriates</p>
          <p><a class="btn" href="add-business">Add a Business</a> </p>
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

$comQuery=$db->query("SELECT * FROM directory D, sub_cat S WHERE D.bcat='$board' AND D.bname LIKE '%$keywords%' OR D.bdesc LIKE '%$keywords%' GROUP BY D.bname ");
$countR=$comQuery->num_rows;

echo "<h3>$countR Directory Matched</h3>";
if ($countR)
{
while($rowR=$comQuery->fetch_assoc())
{
   $bname =($rowR['bname']);
  $location =($rowR['location']);
  $desc =($rowR['bdesc']);
  $address =($rowR['baddress']);
  $phone =($rowR['bphone']);
  $site =($rowR['bsite']);
  $cat =($rowR['bcat']);
  $sname =($rowR['sname']);
  $buzlogo =($rowR['buzlogo']);
  $dir_id =($rowR['dir_id']);
  $bemail =($rowR['bemail']);

      $buzlogo1 = '<img src="images/bus/watermark.php?image='.$buzlogo.'&watermark=k247.png" style="width:50px">';

?>

<table summary="search">
    <tbody>
      <tr>
        <td class="" style="text-align: left;">
          <b class="buz"> <?php echo $buzlogo1; ?>  <?php echo $bname; ?><br><span class="span"><?php echo $location.' | '.$address; ?> | <?php echo $sname; ?></span></b>
          <b class="span"><?php echo $desc; ?></b>
          <p  class="span">Clicks (<?php echo $clickcount; ?>)  <b>Phone:</b> <?php echo $phone; ?> | <b>Email:</b> <?php echo $bemail; ?> | <b><a href="webclick/<?php echo $dir_id; ?>" title="<?php echo $bname; ?>" target="_blank">Open Website</a></b> </p>
</td>
      </tr>
    </tbody>
  </table>
<?php } } else{ ?>
  <h3>No Directory Found</h3>
<?php } } ?>



<div class="list-wrapper">


<?php
$comQuery1=$db->query("SELECT * FROM directory D, sub_cat S WHERE D.bcat=S.sid GROUP BY D.dir_id ORDER BY rand() ");
$countR=$comQuery1->num_rows;

echo "<h3>$countR Business Directory</h3>";
if ($countR)
{
while($rowR1=$comQuery1->fetch_assoc())
{
  $bname =($rowR1['bname']);
  $location =($rowR1['location']);
  $desc =($rowR1['bdesc']);
  $address =($rowR1['baddress']);
  $phone =($rowR1['bphone']);
  $site =($rowR1['bsite']);
  $cat =($rowR1['bcat']);
  $sname =($rowR1['sname']);
  $buzlogo =($rowR1['buzlogo']);
  $dir_id =($rowR1['dir_id']);
  $bemail =($rowR1['bemail']);
  $sname =($rowR1['sname']);
  $clickcount=$rowR1['clickcount']+1; //increament clicks by one 1
  
  if($buzlogo)
  {
     $buzlogo = '<img src="images/bus/watermark.php?image='.$buzlogo.'&watermark=k247.png" style="width:100px">';
  }
@$i = $i + 1;
if($i%2 == 0)
{ $w=''; }

else
{ $w='background: #d4ebf2 !important;'; }
?>
<div class="list-item">
  <table summary="search">
    <tbody>
      
        <td class="" style="text-align: left;">
          <b class="buz"> <?php echo $buzlogo; ?>  <h2><?php echo $bname; ?></h2><span class="span"><?php echo $location.' | '.$address; ?> | <?php echo $sname; ?></span></b>
          <br><b class="span"><?php echo $desc; ?></b>
          <p  class="span">Clicks (<?php echo $clickcount; ?>)  <b>Phone:</b> <?php echo $phone; ?> | <b>Email:</b> <?php echo $bemail; ?> | <b><a href="webclick/<?php echo $dir_id; ?>" title="<?php echo $bname; ?>" target="_blank">Open Website</a></b> </p>
</td>
     
    </tbody>
  </table>
  </div>
<?php } }  ?>
</div>

	<!--END CONTAINER SEARCH TOPICS-->									
	<div id="pagination-container"></div>
										<!-- partial -->
	<script src='https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js'></script>
	<script  src="<?php echo URL; ?>/js/paging.js"></script>
	<link rel="stylesheet" href="<?php echo URL; ?>/js/paging.css">
	
<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';

//load footer from footer.php
require_once ('footer.php');

?>

</body>
</html>
