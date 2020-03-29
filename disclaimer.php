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

require_once 'incfiles/theme/head_open.php';
############################### page title #######################
$selsite = $db->query("SELECT * FROM site_pages WHERE page_type='disclaimer' ");
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
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';

//load footer from footer.php
require_once ('footer.php');

?>

</body>
</html>
