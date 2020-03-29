					
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.checked {
  color: orange;
}
.fa:hover{
	color: orange;
	cursor: pointer;
}
#ratingReviews {
    font-size: 30px;

    color: #ffe358;
}
span.count{
	font-weight: bolder;
}
</style>

	 <h3><i class="fa fa-star" id="ratingReviews"></i>Average Score</h3>
<?php
//call database connection
require 'config.php';

$post_id = $_GET['post_id'];
$user_id = $_GET['user_id'];
$textrate ='';
$qryRate = $db->query("SELECT user_id_fk, SUM(rateval=1) AS one, SUM(rateval=2) AS two, SUM(rateval=3) AS three, SUM(rateval=4) AS four, SUM(rateval=5) AS five  FROM rating WHERE post_id_fk='$post_id' ");
$dataRate = mysqli_fetch_array($qryRate);
$rateOne = $dataRate['one'];
$rateTwo = $dataRate['two'];
$rateThree = $dataRate['three'];
$rateFour = $dataRate['four'];
$rateFive = $dataRate['five'];
$user_id_fk = $dataRate['user_id_fk'];

$total =  $rateOne*1 + $rateTwo*2 + $rateThree*3 + $rateFour*4 + $rateFive*5;

$totalRate = $rateOne + $rateTwo + $rateThree + $rateFour + $rateFive;
@$weightAverage =  $total / $totalRate;



$weightAverage =  number_format((float)$weightAverage, 1, '.', '');

$qryratings = $db->query("SELECT rate_id FROM rating WHERE post_id_fk='$post_id' ");
$countVote = mysqli_num_rows($qryratings);

if ($weightAverage=='nan') {
	@$weightAverage = 'No rating yet';
}

if ($countVote==1) {
@$textrate = "Based on $countVote rating";
}
if ($countVote>1) {
@$textrate = "Based on $countVote ratings";
}

?>

		<span class="count"><?php echo $weightAverage; ?>/5.0</span>	
		<br>	
		<span class="s"><b><?php echo $textrate; ?></b></span>		

<?php
if ($user_id) {
if ($user_id_fk!=$user_id) {
?>
<span class="s">Please rate this post</span>
<span class="fa fa-star rate" data="1"></span>
<span class="fa fa-star rate" data="2"></span>
<span class="fa fa-star rate" data="3"></span>
<span class="fa fa-star rate" data="4"></span>
<span class="fa fa-star rate" data="5"></span>
<input type="hidden" class="post_id" value="<?php echo $post_id; ?>">
<input type="hidden" class="user_id" value="<?php echo $user_id; ?>">
<?php } }else{ echo '<span class="s">Please login to rate this post</span>'; }?>

<script type="text/javascript">
	$('.rate').click(function () {
var rateval=$(this).attr('data');
var post_id=$('.post_id').val();
var user_id=$('.user_id').val();
// AJAX Code To Submit Form.
var dataString = "rateval="+ rateval + "&post_id="+ post_id + "&user_id="+ user_id;
$.ajax({
type: "POST",
url: "<?php echo URL; ?>/insertRateData.php",
data: dataString,
cache: false,
success: function(html)
{
alert("Thank you for giving me "+ rateval +' star');
}
})

//alert(dataString);
});
	
</script>