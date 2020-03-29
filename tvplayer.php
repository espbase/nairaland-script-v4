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
$tvname = $_GET['url'];
	$page_title=$tvname .' TV LIVE';
	$site_dsc=APPNAME." $tvname STREAM TV  ";
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

echo '<a id="top" name="top"></a>'; // anchor

##################### login form ########################


?>
    <table>
      <tr>
        <th><h2>YOU'RE ON <?php echo strtoupper($tvname); ?> LIVE TV</h2></th>
      </tr>
         <tr>
        <td class="w" style="text-align: left;">
          <div id="tvbox">
            
          </div>

      </tr>
    </table>

<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';

//load footer from footer.php
require_once ('footer.php');

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$("#tvbox").html('<br><p align="center"><img src="../images/material_spinner.gif" width="25"/><br> <small>Please wait, loading TV Station...</small></p>');
LoadLiveTv();
function LoadLiveTv(){
    $.ajax({
        url: "../loadtv.php?name=<?php echo $tvname ?>",
        success: 
        function(result){
            $("#tvbox").html(result); //insert text of test.php into your div
        }
    });
}
});
 </script>
</body>
</html>
