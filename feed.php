<?php
require_once ('config.php');
require_once ('functions.php');
$page_title=TITLE;
$site_url=URL;
$site_email=EMAIL;

echo '<?xml version="1.0" encoding="utf-8" standalone="yes" ?><rss version="2.0"><channel>
<title>'.$page_title.'</title>
<link>'.$site_url.'</link>
    <description>'.$page_title.' '.APPNAME.'</description>
<language>en-En</language>
<webMaster> '.$site_email.'</webMaster>';



@header("Content-Type: application/xml");

require 'incfiles/bbparser.php'; // phpbb code parser



$sql = "SELECT * FROM `topics` ORDER BY topic_id DESC "; 
$query = $db->query($sql);

while($row = mysqli_fetch_assoc($query))
{
$title=$row['title']; 
$link=$row['link']; 
$tid = $row["topic_id"];

$date = date("r", $row["time"]);
$mmessage = $row["content_text"];
$bbcodes = new bbParser(); 
$message = $bbcodes->getHtml($mmessage);
$link =  $site_url . '/' . $tid . '/' . $link;
//redirect="$topic_id/$link"; // create friendly seo post link(url)
echo '<item>
<title>'.$title.'</title>
<link>'.$link.'</link>
<description><![CDATA['.$message.']]></description>
<pubDate>'.$date.'</pubDate>
</item>';
}
echo '</channel></rss>';

?>