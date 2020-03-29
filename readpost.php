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

################################# Defining variables ##########################
$post_id=($_GET['id']); // get post id
$url= $_GET['title']; // get title
$link=$url; // verify if it's a real page

	$page_title=$url;
	$site_dsc="login to your awesome".APPNAME." account";
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/pagination.php';
require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

require 'incfiles/bbparser.php'; // phpbb code parser

require_once 'incfiles/topicCount.php';

//load header.php
require_once ('header.php');

echo '<a id="top" name="top"></a>'; // anchor

##################### verify if post does in databse ########################
require_once ('incfiles/postClass.php');

//load google adsense ads template
require_once ('incfiles/googleads.html');

loadpost($db, $post_id, $link); // load topic content

//load system header ads template
require_once ('ads.php');

echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

?>

	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->
	<script type="text/javascript">
   $(document).ready(function(){
/////////////////////////////////// post like
$('.love').click(function () {
               var id=$(this).attr('name');
               var link=$(this);

               $('#showpanel'+id).slideToggle('slow', function(){
                if($('#showpanel'+id).is(':visible'))
               {
                link.html('Like');
                $('#love'+id).css({
                "font-weight": "",
                "color": 'black'
                });
                var dataString = "pid="+id;

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
                link.html('Liked');
                $('#love'+id).css({
                "font-weight": "",
                "color": 'darkgreen'
                });

                var dataString = "pid="+id;

                  // AJAX Code To Submit Form.
                  $.ajax({
                    type: "POST",
                    url: "<?php echo WEBROOT ?>/ajax_like_topic.php",
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
                link.html('Liked');
               $('#loved'+id).addClass('liked');

                var dataString = "pid="+id;

                  // AJAX Code To Submit Form.
                  $.ajax({
                    type: "POST",
                    url: "<?php echo WEBROOT ?>/ajax_like_topic.php",
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

                 link.html('Like');
                $('#loved'+id).removeClass('liked');
                var dataString = "pid="+id;

                  // AJAX Code To Submit Form.
                  $.ajax({
                    type: "POST",
                    url: "<?php echo WEBROOT ?>/ajax/ajax_unlike_topic.php",
                    data: dataString,
                    cache: false,

                      success: function(html)
                      {

                      // alert('make');
                     }
                    });
               }
               });

            });

  //////////////////////////////
   });
  </script>
</body>
</html>
