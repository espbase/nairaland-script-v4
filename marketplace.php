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

	$page_title='Kenya Business Directory';
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

.buz{
  position: relative;
  display: block;
  font-family: helvetica neue, helvetica, sans-serif;

  font-size: 1.2em;
  font-weight: 500;
  letter-spacing: 0.025em;
  opacity: 0.75;
  text-align: left;
}

.span {
  font-size: 0.785em;
  font-weight: 400;
  opacity: 0.7;
}
</style>
<h2>Kenya Business Directory</h2>

<form action="" method="get">
<table summary="search">
    <tbody>
      <tr>
        <td class="">
          <p>Find companies, professionals and organizations offering their products or services to expatriates</p>
          <p><a class="btn" href="add-business">Add a Business</a></p>
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

?>
  <table summary="search">
    <tbody>
      <tr>
        <td class="" style="text-align: left;">
          <b class="buz"><?php echo $bname; ?><br><span class="span"><?php echo $address; ?></span></b>
          <b class="span"><?php echo $desc; ?></b>
         <p  class="span"> <b>Phone:</b> <?php echo $phone; ?> | <b>Website:</b> <?php echo $site; ?></p>
</td>
      </tr>
    </tbody>
  </table>
<?php } } else{ ?>
  <h3>No Directory Found</h3>
<?php } } ?>


<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';

//load footer from footer.php
require_once ('footer.php');

?>

</body>
</html>
