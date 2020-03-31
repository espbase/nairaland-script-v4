	<?php
//require 'bbParser.php';


  class bbParser{
    public function __construct(){}
    
    public function getHtml($str){
      $bb[] = "#\[b\](.*?)\[/b\]#si";
      $html[] = "<b>\\1</b>";
      $bb[] = "#\[url\](.*?)\[/url\]#si";
      $html[] = "<a href=\\1 rel=nofollow>\\1</a>";
      $bb[] = "#\[i\](.*?)\[/i\]#si";
      $html[] = "<i>\\1</i>";
      $bb[] = "#\[u\](.*?)\[/u\]#si";
      $html[] = "<u>\\1</u>";
      $bb[] = "#\[hr\]#si";
      $html[] = "<hr>";
      $bb[] = "#\[del\](.*?)\[/del\]#si";
      $html[] = "<del>\\1</del>";
      $bb[] = "#\[code\](.*?)\[/code\]#si";
      $html[] = "<code>\\1</code>";
      $bb[] = "#\[right\](.*?)\[/right\]#si";
      $html[] = "<p align='right'>\\1</p>";
      $bb[] = "#\[left\](.*?)\[/left\]#si";
      $html[] = "<p align='left'>\\1</p>";
      $bb[] = "#\[center\](.*?)\[/center\]#si";
      $html[] = "<p align='center'>\\1</p>";

       $bb[] = "#\[youtube\](.*?)\[/youtube\]#si";
      $html[] = "<div class='video-container'><iframe width='853' height='480' src='https://www.youtube.com/embed/\\1?wmode=transparent&controls=1&modestbranding=1&showinfo=1&autohide=1'></iframe></div>";

      $bb[] = "#\[color=Red\](.*?)\[/color\]#si";
      $html[] = "<font color='Red'>\\1</font>";
      
      $bb[] = "#\[color=green\](.*?)\[/color\]#si";
      $html[] = "<font color='green'>\\1</font>";
       $bb[] = "#\[color=brown\](.*?)\[/color\]#si";
      $html[] = "<font color='brown'>\\1</font>";
      $bb[] = "#\[color=blue\](.*?)\[/color\]#si";
      $html[] = "<font color='blue'>\\1</font>";
       $bb[] = "#\[color=purple\](.*?)\[/color\]#si";
      $html[] = "<font color='purple'>\\1</font>";
      $bb[] = "#\[color=gray\](.*?)\[/color\]#si";
      $html[] = "<font color='gray'>\\1</font>";
      $bb[] = "#\[color=black\](.*?)\[/color\]#si";
      $html[] = "<font color='black'>\\1</font>";
      $bb[] = "#\[color=silver\](.*?)\[/color\]#si";
      $html[] = "<font color='silver'>\\1</font>";
      $bb[] = "#\[color=lightgreen\](.*?)\[/color\]#si";
      $html[] = "<font color='lightgreen'>\\1</font>";
      $bb[] = "#\[color=DeepSkyBlue\](.*?)\[/color\]#si";
      $html[] = "<font color='DeepSkyBlue'>\\1</font>";
      $bb[] = "#\[color=lime\](.*?)\[/color\]#si";
      $html[] = "<font color='lime'>\\1</font>";
      $bb[] = "#\[quote\](.*?)\[/quote\]#si";
      $html[] = "<blockquote>\\1</blockquote>";
      $bb[] = "#\[sup\](.*?)\[/sup\]#si";
      $html[] = "<sup>\\1</sup>";
      $bb[] = "#\[sub\](.*?)\[/sub\]#si";
      $html[] = "<sub>\\1</sub>";

      $str = preg_replace ($bb, $html, $str);
      $patern="#\[url=([^\]]*)\]([^\[]*)\[/url\]#i";
      $replace='<a href="\\1" target="_blank" rel="nofollow">\\1</a>';
      $replace='<a href="\\1" target="_blank" rel="nofollow">\\2</a>';
      $str=preg_replace($patern, $replace, $str); 
      $patern="#\[img\]([^\[]*)\[/img\]#i";
      $replace='<img src="\\1" alt="kenyans247" id="img-responsive"/>';
      
      $str=preg_replace($patern, $replace, $str); 
      $patern="#\[email=([^\[]*)\]([^\[]*)\[/email\]#i";
      $replace='<a href="mailto:\\1">< \\1 ></a>';
      $replace='<a href="mailto:\\1">< \\2 ></a>';
      
      $str=preg_replace($patern, $replace, $str); 
      $patern="#\[size=([^\[]*)\]([^\[]*)\[/size\]#i";
      $replace='<font size="\\1"> \\1</font>';
      $replace='<font size="\\1"> \\2</font>';
      
      $str=preg_replace($patern, $replace, $str);  
	  $str=nl2br($str);
      return $str;
    }
  }

?>
