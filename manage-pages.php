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

//$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.
require_once 'incfiles/theme/head_open.php';



$page_title='Page Update - '. APPNAME;
$site_title=APPNAME;
$site_dsc='Page Update - '. APPNAME;
	
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

$created=date('D M Y h:sa'); // get current timestamp

if (isset($_GET['delete_page']) && (!empty($_GET['delete_page']))) {
 $id = $_GET['delete_page'];
 $delPage =$db->query("DELETE FROM site_pages WHERE page_id='$id' ");

echo "<h2>Page Deleted Successfully</h2>";
}


if (isset($_POST['uploadpage'])) {
$ptitle = addslashes($_POST['ptitle']);
$purl = addslashes(clean($_POST['purl']));

$inPage = $db->query("INSERT INTO site_pages (page_type, page_title) VALUES ('$purl', '$ptitle')");

echo "<h2>Page Created Successfully!</h2>";
}
?>
<h2>Page Management</h2>
<table>
    <tbody>
      <tr>
        <th>Create New Page</th>
      </tr>
      <tr>
        <td class="w">
         
              <span style="color: red; font-size: 17px;"></span>
          <form action="" method="post">
            Enter Page Url: 
            <input type="" name="purl">
             Enter Page Title: 
            <input type="" name="ptitle">
            <input type="submit" name="uploadpage" value="Create Page">
          </form>
        </td>
      </tr>
    </tbody>
  </table>

<table>
    <tbody>
      <tr>
        <th>Select Page to Edit Content</th>
      </tr>
      <tr>
        <td class="w">
              <span style="color: red; font-size: 17px;"></span>
          <form action="" method="get">
           Page Type: <select name="type">
<?php
$selsite = $db->query("SELECT * FROM site_pages");
while($data=mysqli_fetch_assoc($selsite))
{
$page_title = $data['page_title'];
$page_type = $data['page_type'];
$page_date = $data['page_date'];

echo "<option value='$page_type'>$page_title Page</option>";
}

?>
            <input type="submit" name="submit" value="Search">
          </form>
        </td>
      </tr>
    </tbody>
  </table>

<?php
if (isset($_GET['type']) && (!empty($_GET['type']))) {
 $type = $_GET['type'];


if (isset($_POST['submit'])) {
 $pagetitle = addslashes($_POST['title']);
 $pagebody = addslashes($_POST['body']);

$db->query("UPDATE site_pages SET page_title='$pagetitle', page_content='$pagebody', page_date='$created' WHERE page_type='$type' ");
echo "<script>alert(' ".$type." - page content updated!');</script>";
}

$queryPages=$db->query("SELECT * FROM site_pages WHERE page_type='$type' ");
$countrow = mysqli_num_rows($queryPages);
$data=mysqli_fetch_array($queryPages);
$page_content=$data['page_content'];
$page_title=$data['page_title'];
$page_id=$data['page_id'];

if ($countrow) {

require 'incfiles/bbparser.php'; // phpbb code parser


##################### registration form ########################

?>
<form method="POST" action="" id="postform" name="postform" enctype="multipart/form-data">
<table>
    <tbody>
      <tr>
        <th>Page Title<br><input type="text" value="<?php echo $page_title ?>" required="" name="title" id="postformtitle" ></th>
      </tr>
      <tr>
        <td class="w">

       <script type="text/javascript">document.postform.title.focus()</script>

             <div id="editbar" style="display: block;">
             <?php include 'inc.icons.php'; ?>
            </div>
            <script>document.getElementById("editbar").style.display = 'block';</script>
            
        <textarea rows="8" cols="80" name="body" id="body"><?php echo $page_content; ?></textarea>
        <input type="submit" name="submit" id="upload" value="Submit" accesskey="s">
         <input type="button" onclick="window.location='?delete_page=<?php echo $page_id; ?>'" style="background: red; color: white; cursor: pointer;" value="Delete Page">
        </td></tr></tbody></table>
        </form>

      

  <p class="small">(<a href="#up"><b>Go Up</b></a>)</p>

<?php
}else
{
  echo "<h2>404 Oops! no page found...</h2>";
}
}

//load footer from footer.php
require_once ('footer.php');

?>

<script type="text/javascript" src="https://www.nairaland.com/static/nl2.js"></script>
	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->

</body>
</html>
