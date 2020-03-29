topic
<?php

//print_r($_GET['url']);

echo basename(parse_url($_GET['topic'], PHP_URL_PATH));

//echo substr($_GET['url'], strrpos($_GET['url'], '/'+1));

preg_match("~/(.*?)$~msi", $_GET['url'], $vv);

//echo $vv[1];


?>