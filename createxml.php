<?php
error_reporting(0);
require_once ('config.php'); // database connection

$xml = fopen('sitemap.xml', 'w');
fwrite($xml, '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">');

//========================================================
$sql = "SELECT * FROM `topics` ORDER BY topic_id DESC "; 
$query = $db->query($sql);

while($row = mysqli_fetch_assoc($query)) // loop all topics from databse
{

$url=$row['link'];

$created=$row['created'];
$topic_id=$row['topic_id'];


$url = urldecode(URL . '/' . $topic_id . '/' . $url);

$long = strtotime($created); //--> which results to 1332866820
$date = date('Y-m-d', $long);

$data = ' <url>

      <loc>'.$url.'</loc>

      <lastmod>'.$date.'</lastmod>

      <changefreq>daily</changefreq>

      <priority>0.8</priority>

   </url>';
      fwrite($xml, "$data");
 } 
fwrite($xml, "</urlset>");
fclose($xml);


$xml = fopen('classifiedsitemap.xml', 'w');
fwrite($xml, '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">');

//========================================================
$sql = "SELECT * FROM `classified` ORDER BY class_id DESC "; 
$query = $db->query($sql);

while($row = mysqli_fetch_assoc($query)) // loop all topics from databse
{

$url=$row['class_url'];

$class_date=$row['class_date'];


$url = urldecode(URL . '/item/' . $url);

$long = strtotime($class_date); //--> which results to 1332866820
$class_date = date('Y-m-d', $long);

$data = ' <url>

      <loc>'.$url.'</loc>

      <lastmod>'.$class_date.'</lastmod>

      <changefreq>daily</changefreq>

      <priority>0.8</priority>

   </url>';
      fwrite($xml, "$data");
 } 
fwrite($xml, "</urlset>");
fclose($xml);





$xml = fopen('usersitemap.xml', 'w');
fwrite($xml, '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">');

//========================================================
$sql = "SELECT * FROM `users` ORDER BY uid DESC "; 
$query = $db->query($sql);

while($row = mysqli_fetch_assoc($query)) // loop all topics from databse
{

$username=$row['username'];

$registered_date=$row['registered_date'];


$url = urldecode(URL . '/u/' . $username);

$long = strtotime($registered_date); //--> which results to 1332866820
$registered_date = date('Y-m-d', $long);

$data = ' <url>

      <loc>'.$url.'</loc>

      <lastmod>'.$registered_date.'</lastmod>

      <changefreq>daily</changefreq>

      <priority>0.8</priority>

   </url>';
      fwrite($xml, "$data");
 } 
fwrite($xml, "</urlset>");
fclose($xml);




$xml = fopen('pagemap.xml', 'w');
fwrite($xml, '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">');

//========================================================
$selsite = $db->query("SELECT * FROM site_pages");
while($data12=mysqli_fetch_assoc($selsite))
{
$page_title = $data12['page_title'];
$page_type = $data12['page_type'];
$page_date = $data12['page_date'];


$url = urldecode(URL . '/help/' . $page_type);

$long = strtotime($page_date); //--> which results to 1332866820
$registered_date = date('Y-m-d', $long);

$data = ' <url>

      <loc>'.$url.'</loc>

      <lastmod>'.$registered_date.'</lastmod>

      <changefreq>daily</changefreq>

      <priority>0.8</priority>

   </url>';
      fwrite($xml, "$data");
 } 
fwrite($xml, "</urlset>");
fclose($xml);


