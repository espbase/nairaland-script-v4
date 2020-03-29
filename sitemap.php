<?php
 $output = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
  $output .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
  echo $output;
header('Content-type: application/xml');

error_reporting(0);
require_once ('config.php'); // database connection
$page_title=TITLE;
$site_url=URL;
$site_email=EMAIL;
$site_desc=DSC;
require 'incfiles/bbparser.php'; // phpbb code parser


//========================================================
$sql = "SELECT * FROM `topics` ORDER BY topic_id DESC "; 
$query = $db->query($sql);

while($row = mysqli_fetch_assoc($query)) // loop all topics from databse
{
$title1=$row['title']; 
$link1=$row['link']; 
$tid1 = $row["topic_id"];

$date = date("r", $row["time"]);
$mmessage = $row["content_text"];
$mmessage = str_replace('&', 'and', $mmessage); // Replaces all & symbol with and.
$bbcodes = new bbParser(); 
$message = $bbcodes->getHtml($mmessage);
$link2 = urldecode($site_url . '/' . $tid1 . '/' . $link1);

?>
<url>
  <loc><?php print $link2 ?></loc>
  <lastmod><?php print $date ?></lastmod>
  <changefreq>daily</changefreq>
</url>
<?php } ?>
</urlset>