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

require_once 'incfiles/theme/head_open.php';
############################### page title #######################

	$page_title='Creat And Edit Boards';
	$site_dsc="Creat And Edit Boards";
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

echo '<a id="top" name="top"></a>'; // anchor

##################### registration form ########################
?>
<h2>Creat And Edit Boards</h2>
<?php

$scid=$_REQUEST['id'];
//echo "$scid";

$success="";
$dupi="";


// Multipe insert case
if(isset($_POST['create'])) {

$title=($_POST["title"]);
$title=htmlentities($title);

$link=clean($title);

$description=($_POST["desc"]);
$addesc=($_POST["addesc"]);

$createSub=$db->query("INSERT INTO sub_cat (sname, surl, dsc, ad_dsc, cid_fk)
VALUES ('".$title."','".$link."','".$description."','".$addesc."','".$scid."')");


  ///////////////////////////////////////////////////////////////////////////////////////////////////////
   $success='<div class="confirmation-box round" style="color:green;">Operation Successful!</div>';

 }


?>
<a href="list-board.php">Edit Categories/ Create Sub Category</a>





<?php
      // display error message for duplicated item id
      echo $dupi;
      echo $success;


        ?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset>
<p>
<input type="text" required name="title"/>
<em>Category Title</em>
</p>

<p>
<input type="text" name="desc" />
<em>category description</em>
</p>
<p>
<input type="text" name="addesc" />
<em>Ad description</em>
</p>
</fieldset>

<input type="submit" name="create" class="button round blue image-right ic-add text-upper" value="Upload Data" />
</form>

<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

?>

	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->

</body>
</html>
