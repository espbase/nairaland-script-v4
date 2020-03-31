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
//$user_id=1; // custom user id

################################# Defining variables ##########################
$post_id=($_GET['id']); // get post id
$url= $_GET['title']; // get title
$link=$url.'.html'; // verify if it's a real page

//load system header ads template
//require ('ads.php');

require 'incfiles/bbparser.php'; // phpbb code parser

$bb2 = new bbParser();

require_once 'incfiles/topicCount.php';
 require_once('incfiles/topic_reading_status.php'); 
// online users status 
############################### page title #######################
$queryPost=$db->query("SELECT * FROM topics T, users U
	WHERE T.topic_id='$post_id' AND T.link='$link' AND U.uid=T.user_id_fk ");

$data=$queryPost->fetch_assoc();
$content=$data['content_text'];
$title=$data['title'];
$topic_status=$data['status'];
$topic_user=$data['user_id_fk'];
$file1=$data['file1'];

$thread_status=$data['thread_status'];
$page_title=$title . ' - '. APPNAME;

$board_id=$data['board_id_fk'];

$topic_id=$data['topic_id'];
$link=$data['link'];

$article=$bb2->getHtml($content);
$justtxt = preg_replace("/<img[^>]+\>/i", "", $article); 

$site_dsc=substr(htmlentities($justtxt), 0,300);

preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $article, $image);
$urlimg='';
if($file1)
{
 $urlimg = URL.'/'.$file1;  
}
elseif($urlimg){
   $urlimg = $image['src']; 
}
else
{
 $urlimg = URL.'/images/sitecover.png';    
}


$sid=$board_id; //for ads

require_once 'incfiles/theme/head_open.php';
############################### page title #######################
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

//load system header ads template
//require ('ads.php');
##################### verify if post does in databse ########################
require_once ('incfiles/topicFunctions.php');

//load google adsense ads template
require_once ('incfiles/googleads.html');

loadpost($db, $post_id, $link); // load topic content

?>
  
  <div class="main_box">
  <div class="light_box" style="text-align: center; ">
      <?php if($thread_status=='1'){ ?>
      
      <img src="<?php echo URL; ?>/images/close.png"/>
      
      <?php } ?>
    <a name="down"></a>
    
    
  </div>
  
  <table class="boards">
    <tbody>

      <tr>
        <td>    <strong>Viewing this topic:</strong><br>
  <?php echo guestreading($post_id,$db); echo userreading($post_id,$db); ?>  viewing this topic 
        </td>
        </tr>
         
      
    </tbody>
  </table>
  
 </div>

<?php
//load footer from footer.php
require_once ('footer.php');

?>

	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->

	<script type="text/javascript">
   $(document).ready(function(){
/////////////////////////////////// post like ///////////////////////////////////
$('.love').click(function () {
               var id=$(this).attr('name');
               var link=$(this);

               $('#showpanel'+id).slideToggle('slow', function(){
                if($('#showpanel'+id).is(':visible'))
               {
                link.html('(Like)');
                $('#love'+id).css({
                "font-size": "8.5pt",
                //"color": '#551818'
                });
                var dataString = "tid="+id+"&type=topic";

                  // AJAX Code To Submit Form.
                  $.ajax({
                    type: "POST",
                    url: "<?php echo WEBROOT ?>/ajax/ajax_unlike_topic.php",
                    data: dataString,
                    cache: false,

                      success: function(html)
                      {

                    //alert('make');
                     }
                    })

               }
               else
               {
                link.html('(Unlike)');
                $('#love'+id).css({
                "font-weight": "bold",
               // "color": 'darkgreen',
                });

                var dataString = "tid="+id+"&type=topic";

                  // AJAX Code To Submit Form.
                  $.ajax({
                    type: "POST",
                    url: "<?php echo WEBROOT ?>/ajax/ajax_like_topic.php", //first like
                    data: dataString,
                    cache: false,

                      success: function(html)
                      {

                        //alert('make');
                     }
                    })

               }
               })

            });

            //////////////////////////////////////// post unlike
  $('.loved').click(function () {
                var id=$(this).attr('name');
                //alert(id);
               var link=$(this);

               $('#showpanel'+id).slideToggle('slow', function(){
                if($('#showpanel'+id).is(':visible'))
               {
                link.html('(Unlike)');
               $('#loved'+id).addClass('liked');

                var dataString = "tid="+id+"&type=topic";

                  // AJAX Code To Submit Form.
                  $.ajax({
                    type: "POST",
                    url: "<?php echo WEBROOT ?>/ajax/ajax_like_topic.php",
                    data: dataString,
                    cache: false,

                      success: function(html)
                      {

                      //alert('make');
                     }
                    })

               }
               else
               {

                 link.html('(Like)');
                $('#loved'+id).removeClass('liked');
                var dataString = "tid="+id+"&type=topic";

                  // AJAX Code To Submit Form.
                  $.ajax({
                    type: "POST",
                    url: "<?php echo WEBROOT ?>/ajax/ajax_unlike_topic.php",
                    data: dataString,
                    cache: false,

                      success: function(html)
                      {

                      //alert(html);
                     }
                    });
               }
               });

            });

/////////////////////////////////// comments like ///////////////////////////////////
$('.clove').click(function () {
               var id=$(this).attr('name');
               var link=$(this);

               $('#cshowpanel'+id).slideToggle('slow', function(){
                if($('#cshowpanel'+id).is(':visible'))
               {
                link.html('(Like)');
                $('#clove'+id).css({
                "font-size": "8.5pt",
                //"color": '#551818'
                });
                var dataString = "commentId="+id+"&type=comment";

                  // AJAX Code To Submit Form.
                  $.ajax({
                    type: "POST",
                    url: "<?php echo WEBROOT ?>/ajax/ajax_unlike_comment.php",
                    data: dataString,
                    cache: false,

                      success: function(html)
                      {

                    //alert('make');
                     }
                    })

               }
               else
               {
                link.html('(Unlike)');
                $('#clove'+id).css({
                "font-weight": "bold",
                //"color": 'darkgreen',
                });

                var dataString = "commentId="+id+"&type=comment";

                  // AJAX Code To Submit Form.
                  $.ajax({
                    type: "POST",
                    url: "<?php echo WEBROOT ?>/ajax/ajax_like_comment.php", //first like
                    data: dataString,
                    cache: false,

                      success: function(html)
                      {

                        //alert('make');
                     }
                    })

               }
               })

            });

            //////////////////////////////////////// post unlike
  $('.cloved').click(function () {
                var id=$(this).attr('name');
                //alert(id);
               var link=$(this);

               $('#cshowpanel'+id).slideToggle('slow', function(){
                if($('#cshowpanel'+id).is(':visible'))
               {
                link.html('(Unlike)');
               $('#cloved'+id).addClass('liked');

                var dataString = "commentId="+id+"&type=comment";

                  // AJAX Code To Submit Form.
                  $.ajax({
                    type: "POST",
                    url: "<?php echo WEBROOT ?>/ajax/ajax_like_comment.php",
                    data: dataString,
                    cache: false,

                      success: function(html)
                      {

                      //alert('make');
                     }
                    })

               }
               else
               {

                 link.html('(Like)');
                $('#cloved'+id).removeClass('liked');
                var dataString = "commentId="+id+"&type=comment";

                  // AJAX Code To Submit Form.
                  $.ajax({
                    type: "POST",
                    url: "<?php echo WEBROOT ?>/ajax/ajax_unlike_comment.php",
                    data: dataString,
                    cache: false,

                      success: function(html)
                      {

                      //alert(html);
                     }
                    });
               }
               });

            });
            
            
            
//################## post shares  and un share#########################

/////////////////////////////////// post like ///////////////////////////////////
$('.share').click(function () {
               var id=$(this).attr('name');
               var link=$(this);

               $('#showpanel'+id).slideToggle('slow', function(){
                if($('#showpanel'+id).is(':visible'))
               {
                link.html('(Share)');
                $('#share'+id).css({
                "font-size": "8.5pt",
                //"color": '#551818'
                });
                var dataString = "tid="+id+"&type=topic";

                  // AJAX Code To Submit Form.
                  $.ajax({
                    type: "POST",
                    url: "<?php echo WEBROOT ?>/ajax/ajax_post_unshare.php",
                    data: dataString,
                    cache: false,

                      success: function(html)
                      {

                    //alert('make');
                     }
                    })

               }
               else
               {
                link.html('(Un-Share)');
                $('#share'+id).css({
                "font-weight": "bold",
             //   "color": 'darkgreen',
                });

                var dataString = "tid="+id+"&type=topic";

                  // AJAX Code To Submit Form.
                  $.ajax({
                    type: "POST",
                    url: "<?php echo WEBROOT ?>/ajax/ajax_post_share.php", //first like
                    data: dataString,
                    cache: false,

                      success: function(html)
                      {

                        //alert('make');
                     }
                    })

               }
               })

            });

            //////////////////////////////////////// post unlike
  $('.shared').click(function () {
                var id=$(this).attr('name');
                //alert(id);
               var link=$(this);

               $('#showpanel'+id).slideToggle('slow', function(){
                if($('#showpanel'+id).is(':visible'))
               {
                link.html('(Unlike)');
               $('#sharereact'+id).addClass('sharereact');

                var dataString = "tid="+id+"&type=topic";

                  // AJAX Code To Submit Form.
                  $.ajax({
                    type: "POST",
                    url: "<?php echo WEBROOT ?>/ajax/ajax_post_share.php",
                    data: dataString,
                    cache: false,

                      success: function(html)
                      {

                      //alert('make');
                     }
                    })

               }
               else
               {

                 link.html('(Share)');
                $('#sharereact'+id).removeClass('sharereact');
                var dataString = "tid="+id+"&type=topic";

                  // AJAX Code To Submit Form.
                  $.ajax({
                    type: "POST",
                    url: "<?php echo WEBROOT ?>/ajax/ajax_post_unshare.php",
                    data: dataString,
                    cache: false,

                      success: function(html)
                      {

                      //alert(html);
                     }
                    });
               }
               });

            });



  
//############################## end post share and unshare #########################
   });
  </script>
  <!--<script src="<?php echo WEBROOT ?>/sharebtn/needsharebutton.js"></script>
    <script>  
      new needShareDropdown(document.getElementById('share-button-2'));
    </script>
    -->
</body>
</html>
