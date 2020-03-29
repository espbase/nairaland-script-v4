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

require_once 'incfiles/theme/head_open.php';
############################### page title #######################

	$page_title='My Directory';
	$site_dsc=APPNAME." Website Setting  ";
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

##################### login form ########################

$error="";
?>

    <table>
      <tr>
        <th><h2>My Directory</h2></th>
      </tr>
      <tr>
        <td class="" style="text-align: left;">
            </td>
            </tr>
</table>
              <?php
$comQuery=$db->query("SELECT * FROM directory D, sub_cat S WHERE D.bcat=S.sid AND D.user_fk=$ses_user_id GROUP BY D.bname ORDER BY rand() ");
$countR=$comQuery->num_rows;

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
  $sname =($rowR['sname']);
  $clickcount=$rowR['clickcount']+1; //increament clicks by one 1
  
  $buzlogo1 = '<img src="images/bus/watermark.php?image='.$buzlogo.'&watermark=k247.png" style="width:50px">';

?>
  <table summary="search">
    <tbody>
      <tr>
        <td class="" style="text-align: left;">
          <b class="buz"><?php echo $buzlogo1; ?> <?php echo $bname; ?><br><span class="span"><?php echo $location.' | '.$address; ?> | <?php echo $sname; ?></span></b>
          <b class="span"><?php echo $desc; ?></b>
          <p  class="span">Clicks (<?php echo $clickcount; ?>)  <b>Phone:</b> <?php echo $phone; ?> | 
          <b>Email:</b> <?php echo $bemail; ?> | 
          <b><a href="<?php echo $site; ?>" title="<?php echo $bname; ?>" target="_blank"><?php echo $site; ?></a></b> |
          <b><a href="edit-business/<?php echo $dir_id; ?>" title="<?php echo $bname; ?>" target="_self">Edit</a></b></p>
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

	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->

</body>
</html>
