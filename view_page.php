<?php
/*
Developer: Marshall Unduemi
Url: www.codexpresslab.iblogspot.com
Contact: unduworldofliving@gmail.com
facebook: facebook.com/marshallunduemi

*/
//Enable Error Reporting

//error_reporting(0);
//remove the above comment to enable error reporting

require_once ('config.php');
require_once ('functions.php');
//echo Checkuser();
require 'incfiles/bbparser.php'; // phpbb code parser
$page_type = $_GET['url'];
require_once 'incfiles/theme/head_open.php';
############################### page title #######################
$selsite = $db->query("SELECT * FROM site_pages WHERE page_type='$page_type' ");
$data=mysqli_fetch_assoc($selsite);

$page_title = $data['page_title'];
$site_dsc = $data['page_content'];
$page_date = $data['page_date'];

require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');


?>
<style type="text/css">
/* mak images fill their container*/
img {
  max-width: 100%;
}
img:hover {
  opacity: 0.5;
  cursor: pointer;
}

/* Bigger than Phones(tablet) */
@media only screen and (min-width: 750px) {
  .img-grid {
    width: 100%;
  }
}

/* Bigger than Phones(laptop / desktop) */
@media only screen and (min-width: 970px) {
  .img-grid {
   width: 90%;
  }
}

.video-container {
position: relative;
padding-bottom: 56.25%;
padding-top: 30px; height: 0; overflow: hidden;
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
blockquote{margin: 1px; background: #aed6f1 !important; border: 1px black solid; border-radius: 6px; text-align:left;}
</style>
<h2><?php echo $page_title.' - '.APPNAME; ?></h2>

  <table>
    <tbody>
      <tr>
        <td class="w" style="text-align: left;">
         <?php
         $TopicCleaned = badWordFilter($site_dsc);
            $bb = new bbParser(); 
                echo $bb->getHtml($TopicCleaned); 
                 ?>
                 <p style="text-align: right; font-style: italic;">Updated on <?php echo $page_date; ?></p>
        </td>
      </tr>
    </tbody>
  </table>

<?php
//preg_match("/[^\/]+$/", "http://www.mydomainname.com/m/groups/view/test", $matches);
//$last_word = $matches[0]; // test

if($page_type == 'live-radio-and-tv-dmca')
{
  //load articles from articles.php -->
require ('inc.radio.php');  

//load articles from articles.php -->
require ('inc.tv.php');
}
if($page_type == 'Kenya-Radio-Stations')
{
  //load articles from articles.php -->
require ('inc.radio.php');  

}
if($page_type == 'Kenya-TV-Stations-Live')
{
    //load articles from articles.php -->
require ('inc.tv.php');
      //load articles from articles.php -->
require ('inc.radio.php');  

}

echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';

//load footer from footer.php
require_once ('footer.php');

?>

</body>
</html>
