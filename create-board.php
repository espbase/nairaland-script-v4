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

	$page_title='Join .: Confirm Email';
	$site_dsc="create your new awesome account";
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
$success="";
$dupi="";


// Multipe insert case
if(isset($_POST['create'])) {
    $amt = $_POST['total'];



  if($amt > 0) {
    $qry = "INSERT INTO category (name, url, des) VALUES "; // Split the mysql_query
    for($i=1; $i<=$amt; $i++) {


$title=($_POST["title$i"]);
$title=htmlentities($title);

$link=clean($title);

$description=($_POST["desc$i"]);
//$description=htmlentities($description);



//$alias=str_replace(" ","-",$title);
  // echo "<script> alert('$alias'); </script>";

      $qry .= "('".$title."','".$link."','".$description."'), ";
      // loop the mysql_query values to avoid more server loding time


  ///////////////////////////////////////////////////////////////////////////////////////////////////////
   $success='<div class="confirmation-box round" style="color:green;">Operation Successful!</div>';

 }
    $qry  = substr($qry, 0, strlen($qry)-2);
    $insert = $db->query($qry); // Execute the mysql_query

 }
}


?>
<a href="list-board.php">Edit Categories/ Create Sub Category</a>

 <form action="<?php $_SERVER['PHP_SELF']; ?>" method="get" name="amtForm">
        <table width="1138" align="center">
        <tr>
            <td width="200">
              <p>
                <input type="text" placeholder="Enter positive Number" name="amt"<?php if(isset($_GET['view'])&&($_GET['id'])) {
      if($count <= 0) {?> readonly <?php } }?> id="full-width-input" class="round full-width-input" <?php if(isset($_GET["amt"])) { ?> value="<?php echo $_GET["amt"]; ?>" <?php } ?> />

<button type="submit" name="submit" class="button round blue image-right ic-add text-upper">
               Generate</button>
                   <br><em>Enter Valid number, e.g 2.</em>
      </p></td>
        </tr>
        </table>

      </form>




<?php
      // display error message for duplicated item id
      echo $dupi;
      echo $success;
        // Get the amount to be generated

        if(isset($_GET['amt'])) {
      if($_GET['amt'] > 0) {
        ?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset>
<?php

                // Loop the rows and inputs according to the amount
                for($i=1; $i<=$_GET['amt']; $i++) {
            ?>
<p>
<input type="text" name="title<?php echo $i; ?>"/>
<em>Category Title</em>
</p>

<p>
<input type="text" name="desc<?php echo $i; ?>" />
<em>category description</em>
</p>
<hr>

 <?php }
  }else
  {
    echo '<p style="font-size:17px; color:red;">Enter positive number and generate form to Upload Your Course</p>
';
  }
   ?>

</fieldset>
<br>
<input type="hidden" name="total" value="<?php echo $i-1; ?>" /> <?php // Post the total rows count value ?>
<input type="submit" name="create" class="button round blue image-right ic-add text-upper" value="Upload Data" />
</form>

<?php
                }
            ?>

<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

?>

	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->

</body>
</html>
