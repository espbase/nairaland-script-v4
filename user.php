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
echo Checkuser();

require_once 'incfiles/theme/head_open.php';
############################### page title #######################
	$user=$_GET['user'];
	$page_title=$user;
	$site_dsc=$user."user details";

require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

################################# include files ##########################

//load header.php
require_once ('header.php');

##################### user details ########################
$userD=$db->query("SELECT * FROM users WHERE username='$user' ");
$u=mysqli_fetch_assoc($userD);
$username=$u['username'];
$avater=$u['avater'];
$email=$u['email'];
$location=$u['location'];
$fb=$u['fb'];
$twitter=$u['twitter'];
$youtube=$u['youtube'];
$instagram=$u['instagram'];
$pinterest=$u['pinterest'];
$linked=$u['linked'];
$active=$u['activeSince'];
$lastlogin=$u['lastlogin'];
$gender=$u['gender'];
$registered_date=$u['registered_date'];
$user_id=$u['uid'];
$accttype=$u['accttype'];

//echo $accttype;
$log_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.

//echo "$active";

//$active1=strtotime($active); // last time seen

// switch gender
switch($gender)
{
	case '1':
	$gender='m';
	break;
	case '2':
	$gender='f';
	break;
	case '0':
	$gender='n/a';
	break;

}

##################### user details ########################
$userD=$db->query("SELECT * FROM users U, topics T
	WHERE U.username='$user' AND T.user_id_fk=U.uid AND T.post_type='topic' ");
//count rows
$counttopics=$userD->num_rows;
$userPost=$db->query("SELECT * FROM users U, topics T
  WHERE U.username='$user' AND T.user_id_fk=U.uid AND T.post_type='post' ");

//count rows
$countpost=$userPost->num_rows;
require_once ('incfiles/topicCount.php'); // count page view function
?>
<h2>User Profile</h2>
<p> <a href="<?php echo URL; ?>"><?php echo APPNAME; ?></a> / <a href="<?php echo WEBROOT."/u/$username"; ?>">User Profile</a> / <a href="<?php echo WEBROOT."/my-directory"; ?>">User Directory</a></p>



<table>
		<tbody>
			<tr>
				<td>
					<p><a href="<?php echo WEBROOT; ?>/mylikepost">Posts I've Liked</a> | <a href="<?php echo WEBROOT; ?>/mysharedpost">Posts I've Shared</a> |
					<a href="<?php echo WEBROOT; ?>/quote-mentions.php">My Quotes & Mentions</a> <br> <a href="<?php echo WEBROOT."/sendemail/$username"; ?>">Send E-Mail Message To <?php echo "$username"; ?></a> </p>
    
            	
					<p><img class="img"  src="<?php echo WEBROOT."/avatars/$avater"; ?>" width="100"></p>
					<?php
					
if ($check) { // check if already liked
    ?>
   <!--

Like user begins here
   -->
    <span class="btn btn-default btn-xs liked loved" id="loved<?php echo $user_id; ?>" name="<?php echo $user_id; ?>" style="cursor: pointer;">
      <small>Following </small></span>
    <small id="showpanel<?php echo $user_id; ?>">.</small>

    <?php } // if not please display like button
    else { ?>
    <span class="btn btn-default btn-xs love" id="love<?php echo $user_id; ?>" name="<?php echo $user_id; ?>" style="cursor: pointer;"><small> Follow</small></span>
    <small id="showpanel<?php echo $user_id; ?>">.</small>
    <?php } ?> <span>(<?php echo $checkCount; ?> user's)</span>
        </p> 
		
		<p><b>Gender</b>: <?php echo "$gender"; ?></p>
        <p><b>Location</b>: <?php echo "$location"; ?></p>
        <p><b>FB</b>:  <a href="https://facebook.com/<?php echo "$fb"; ?>"><?php echo "$fb"; ?></a> </p>
        <p><b>Twitter</b>: <a href="https://twitter.com/<?php echo "$twitter"; ?>"><?php echo "$twitter"; ?></a> </p>
        
        <p><b>LinkedIn</b>: <a href="https://linkedin.com/<?php echo "$linked"; ?>"><?php echo "$linked"; ?></a> </p>
        
        <p><b>Youtube</b>: <a href="https://youtube.com/u/<?php echo "$youtube"; ?>"><?php echo "$youtube"; ?></a> </p>
        
        <p><b>Instagram </b>: <a href="https://instagram.com/<?php echo "$instagram"; ?>"><?php echo "$instagram"; ?></a> </p>
        
    <p><b>Pinterest </b>: <a href="https://pinterest.com/<?php echo "$pinterest"; ?>"><?php echo "$pinterest"; ?></a> </p>

        <p><b>Time registered</b>:  <?php echo $registered_date; ?> </p>

        <p><b>Last Active</b>: <?php echo $lastlogin; ?> </p>
         <p><b>Last Seen</b>: <?php echo time_passed($active); ?> </p>
        <p><a href="<?php echo WEBROOT."/$username/posts"; ?>">View <?php echo "$username"; ?>'s posts (<?php echo $countpost; ?>)</a> |
          <a href="<?php echo WEBROOT."/$username/topics"; ?>">View <?php echo "$username"; ?>'s topics (<?php echo $counttopics; ?>)</a></p>
				<!--	<p><b>Section Most Active In:</b> <a href="webmasters">Webmasters</a></p>-->
			
         <!--<p><b>Account Type</b>:  
          <?php 
          if (empty($accttype)) 
          {
            echo '<a href="../upgrade-account">Basic Account (Upgrade)</a>';
          }
          if ($accttype==1) 
          {
            echo '<a href="../affilate-analysis">Premium Account</a>';
          }
         ?> </p>
         <hr>-->
				</td>
			</tr>
		</tbody>
	</table>
       
<table>
		<tbody>
			<tr>
				<th>
					User Latest Topics ( <a href="<?php echo WEBROOT."/$username/topics"; ?>">View All <?php echo number_format($counttopics); ?> Topics</a> | 
					<a href="<?php echo WEBROOT."/$username/posts"; ?>"><?php echo number_format($countpost); ?> Posts</a> )
				</th>
			</tr>
<?php
	
// query topic along with board id and user id
$query_topic = $db->query("SELECT * FROM topics T, users U, sub_cat S
  WHERE U.username='$user' AND T.board_id_fk=S.sid AND T.user_id_fk=U.uid AND T.post_type='post' GROUP BY T.topic_id ORDER BY T.topic_id DESC");

//count rows
$checktopic=$query_topic->num_rows;


// query topic along with board id and user id
$query_comment = $db->query("SELECT topic_id FROM topic_comments T, users U
  WHERE T.user_id=U.uid AND U.username='$user' GROUP BY T.comment_id ");

//count rows
@$checkpost=$query_comment->num_rows;

/*
    loop categories
    */
if($checktopic){
    while($data=$query_topic->fetch_assoc())
    {
    $id=$data['topic_id'];
    $title=$data['title'];
    $link=$data['link'];
    $username=$data['username'];
    $created=$data['created'];
    // fetch categories according to board id


$queryComment=$db->query("SELECT * FROM topic_comments C, users U
  WHERE C.topic_id='$id' AND U.username='$user' AND C.status='0' GROUP BY C.comment_id ");
//count rows
$checkcomment=$queryComment->num_rows; // check for existence

$rows=$queryComment->fetch_assoc(); // populate results
$gender=$rows['gender'];

//check for last comment on this topic
if($checkcomment)
{
  $lastcomment="(<b><a href='../u/$rows[username]'>$rows[username]</a></b>)";
}
else
{
$lastcomment='- No comment yet';
}
	@$i = $i + 1;
			if($i%2 == 0)
			{ $w=''; } 
			
			else
			{ $w='w'; }
			
			
// Sub category block title
echo '<tr>
<td id="top519" class="'.$w.'">
   <img src="'.WEBROOT.'/icons/smiley.gif"> <b>
  <a href="'.WEBROOT.'/'.$id.'/'.$link.'">'.$title.'</a></b><br>
  <span class="s">by <b><a href="u/'.$username.'">'.$username.'</a></b>. <b>'.@$checktopic.'</b> Post &amp;
    <b>'.topicCount($db,$id).'</b> Views. '.$created.' '.$lastcomment.'</span>
    </td>
  </tr>';
}
}
else // if there is no topic, display below message to users
{
  echo '<tr>
        <td class="w">
      <h2>Oops! this user has no topic!</h2>
            <p>
            There is currently no topic. You can be the first to
            create topic on this board. <br>
            <span style="text-decoration: underline">
            <br>
            → <a href="'.WEBROOT.'">Click here to return back to forum home</a>
            </p>    </td>
</tr>';
}
 ?> 

    <?php


 $check=$flist->num_rows;
// switch gender
switch($gender)
{
  case '1':
  $gender='m';
  break;
  case '2':
  $gender='f';
  break;
  case '0':
  $gender='n/a';
  break;

}



//echo WEBROOT.'/ajax/do_unlike_user.php',
// Friends List Data relations between users and friends tables for displaying user friends
$flist=$db->query("SELECT *
FROM users U, followers F
WHERE
CASE
WHEN F.friend_one = '{$log_id}' 
THEN F.friend_two = '{$user_id}'
END
AND 
F.status='1'");
//$friendsList=mysqli_num_rows($flist); // count of total friends


 $check=$flist->num_rows;

 $sql_relation= $db->query("SELECT * FROM followers WHERE friend_two='{$user_id}' AND status='1' ");
  $checkCount=$sql_relation->num_rows;
?>
			
		</tbody>
	</table>
<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');
$db->close();
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
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
                link.html('Follow');
                $('#love'+id).css({
                "font-weight": "",
                "color": 'black'
                });
                var dataString = "userid="+id;

                  // AJAX Code To Submit Form.
                  $.ajax({
                    type: "POST",
                    url: "<?php echo WEBROOT ?>/ajax/do_unlike_user.php",
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
                link.html('Following');
                $('#love'+id).css({
                "font-weight": "",
                "color": 'darkgreen'
                });

                var dataString = "userid="+id;

                  // AJAX Code To Submit Form.
                  $.ajax({
                    type: "POST",
                    url: "<?php echo WEBROOT ?>/ajax/do_like_user.php",
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
                link.html('Following');
               $('#loved'+id).addClass('liked');

                var dataString = "userid="+id;

                  // AJAX Code To Submit Form.
                  $.ajax({
                    type: "POST",
                    url: "<?php echo WEBROOT ?>/ajax/do_like_user.php",
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

                 link.html('Follow');
                $('#loved'+id).removeClass('liked');
                var dataString = "userid="+id;

                  // AJAX Code To Submit Form.
                  $.ajax({
                    type: "POST",
                    url: "<?php echo WEBROOT ?>/ajax/do_unlike_user.php",
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
