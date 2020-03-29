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

	$page_title='Watch Movies Online - '. APPNAME;
	$site_dsc=APPNAME." Watch Movies Online";
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
<style type="text/css">
.video-container {
position: relative;

padding-top: 3px; height: 450px; 
width: 100%;
}

.video-container iframe,
.video-container object,
.video-container embed {
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
}
#topadvert
{
    display:hide;
}
.copyright
{
 display:hide;   
}
</style>
<script>
    $("iframe").contents().find(".copyright").hide();
</script>
    <table>
      <tr>
        <th><h2><?php echo APPNAME; ?> | Watch Movies Online</h2></th>
      </tr>


         <tr>
        <td class="w" style="text-align: left;">
<?php
 $url = "https://afdah.info/feed/";
 $invalidurl = false;
 if(@simplexml_load_file($url)){
  @$feeds = simplexml_load_file($url);
 }else{
  $invalidurl = true;
  echo "<h3 class='text-danger'>We're Sorry</h3>
  <h5>Oops! Can't Load News.</h5><small>Please check your network and try opening the app</small>";
 }

?>
<?php
 $i=0;
 if(!empty($feeds)){

  $site = $feeds->channel->title;
  $creator = $feeds->dc->creator;
  $sitelink = $feeds->channel->link;

  //echo "<h1>".$site."</h1>";
  foreach ($feeds->channel->item as $item) {

   $title = $item->title;
   $link = $item->link;
   $creator = $item->creator;
   $description = $item->description;
   $postDate = $item->pubDate;
   $pubDate = date('D, d M Y',strtotime($postDate));

   if($i>=20) break;

   // $content = "this is something with an <img src=\"test.png\"/> in it.";
    $content1 = implode(' ', array_slice(explode(' ', $description), 0, 1000));
    $content = preg_replace("/<img[^>]+\>/i", "", $content1); 

    preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $content1, $image);
    $imgurl= $image['src'];

  ?>


 <div class="col-sm-4" style="border-bottom: solid 2px #aed6f1;">
      <h4 style="border-left: solid #aed6f1 3px; padding-left: 5px; font-weight: bold;">
      	<a href="moviestream.php?title=<?php echo $title; ?>&time=<?php echo $pubDate; ?>&url=<?php echo $link; ?>"> <?php echo $title; ?></a> <br><small>Last Updated: <?php echo $pubDate; ?></small>	
      	</h4>

      <p><b>Description:</b> <?php echo $description; ?>
             </p>
    </div>

       
   <?php
    $i++;
   }
 }else{
   if(!$invalidurl){
     echo "<h2>No post found</h2>";
   }
 }
 ?> 


        </td>
      </tr>
    </table>

<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';

//load footer from footer.php
require_once ('footer.php');

?>

	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->

</body>
</html>
