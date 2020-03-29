<?php
require '../config.php';
require ('../incfiles/topicCount.php');
require ('../functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>BOARD MANAGEMENT - <?php echo APPNAME; ?></title>
	<meta content="width=device-width,initial-scale=1" name="viewport">
	<meta content="A Nairaland admin dashboard software by codexpress labs" name="description">
	<meta content="Mannatthemes" name="author"><!-- App favicon -->
	<link href="<?php echo URL.'/images/applogo.png' ?>" rel="shortcut icon">
	<link href="assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"><!-- DataTables -->
	<link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
	<link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css"><!-- App css -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/icons.css" rel="stylesheet" type="text/css">
	<link href="assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/style.css" rel="stylesheet" type="text/css">
	<style type="text/css">
		img.faces {width:15px; height:15px}
	</style>
</head>
<body>
	<!-- Top Bar Start -->
	
	<?php
	require 'inc.user_control.php';
	?>
	<div class="page-wrapper">
		<div class="page-wrapper-inner">
			<!-- Left Sidenav -->
			<?php include 'sidenav.php'; ?>
			<!-- end left-sidenav--><!-- Page Content-->
			<div class="page-content">>
<?php 

// if cant get build tag
if (isset($_GET['build'])!="board") {
 ?>

		<div class="row">
						<div class="col-lg-12 col-sm-12">
							<div class="card">
								<div class="card-body table-responsive">
									<h5 class="header-title"><?php echo APPNAME; ?> USERS</h5>

									<div class="">
										<table class="table dt-responsive nowrap" id="datatable2" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
											<thead>
												<tr>
													<th>S/N</th>
													<th>Full Name</th>
													<th>Wallet</th>
													<th>Post</th>
													<th>Joined Date</th>
													
													
												</tr><!--end tr-->
											</thead>
											<tbody>
<?php
$i=1;
$queryBoard=$db->query("SELECT * FROM users");
//$countCat=mysqli_num_rows($queryBoard);
while ($clist=mysqli_fetch_assoc($queryBoard))
{
	$name = $clist['name'];
	$username = $clist['username'];
	$email = $clist['email'];
	$gender = $clist['gender'];
	$activeSince = $clist['activeSince'];
	$location = $clist['location'];
	$ad_credit = $clist['ad_credit'];
?>
												<tr>
													<td><?php echo $i++; ?></td>
													<td><i class="mdi mdi-cards-playing-outline text-danger mr-1 font-18"></i><?php echo $name; ?><br>
													<a href="<?php echo URL.'/u/'.$username; ?>"><small><?php echo $username; ?></small></a> </td>
													<td><?php echo $email; ?></td>
													<td><?php echo $gender; ?></td>
													<td><?php echo $location; ?></td>
													<td><?php echo $activeSince; ?></td>
													<td><?php echo $currency.':'.number_format($ad_credit); ?></td>
													
												</tr><!--end tr-->
												<?php
											}
											?>
											
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div><!--end row-->
<?php
}
// end cant get build tag
if (isset($_GET['editsubboard'])) {
	$board_id = $_GET['editsubboard'];


if (isset($_POST['btneditsubboard'])) {
	$body = $_POST['body'];
	$title = $_POST['title'];
	$addesc = $_POST['addesc'];
	$catcost = $_POST['catcost'];
	$url = clean(strtolower($title));

	$updateBoard = $db->query("UPDATE sub_cat SET sname='$title', surl='$url', dsc='$body', ad_dsc='$addesc', catcost='$catcost' WHERE sid='$board_id' ");
}

	$queryBoard=$db->query("SELECT * FROM sub_cat WHERE sid='$board_id' ");
//$countCat=mysqli_num_rows($queryBoard);
$clist=mysqli_fetch_assoc($queryBoard);
	$bname = $clist['sname'];
	$cid = $clist['sid'];
	$des = $clist['dsc'];
	$ad_dsc = $clist['ad_dsc'];
	$catcost = $clist['catcost'];

?>
		<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<form action="" method="post">
				<div class="card-body">
					<h4 class="mt-0 header-title">Modify Board</h4>
				<p class="text-muted mb-4">
					<input class="form-control form-control-success" name="title" value="<?php echo $bname; ?>" type="text">
					<code class="highlighter-rouge">You are modifying "<?php echo $bname; ?>" Board</code> 
					<h4 class="mt-0 header-title">Board Description</h4>
					<div id="editbar" style="display: block;">
						<?php include '../inc.icons.php'; ?>
					</div>
					<textarea rows="2" cols="80" class="form-control" name="body" id="body" placeholder="Enter short board discription"><?php echo $des; ?></textarea>
<h4 class="mt-0 header-title">Ad Description</h4>
<input type="text" name="addesc" class="form-control" value="<?php echo $ad_dsc; ?>">

					<h4 class="mt-0 header-title">Cost/Weekly </h4>
					<input type="text" name="catcost" class="form-control" value="<?php echo $catcost; ?>">
				</p>
				<input type="submit" class="btn btn-success col-sm-4" value="Submit" name="btneditsubboard"> 
				<input type="button" class="btn btn-warning col-sm-4" value="Clear" onclick="window.location='all-category.php'">
					</div>
				</form>
				</div><!--end card-body-->
			</div><!--end card-->
		</div><!--end col-->
<?php } ?>

<?php
if (isset($_GET['list'])) {
	$list = $_GET['list'];

		$queryBoard=$db->query("SELECT * FROM sub_cat WHERE cid_fk='$list' ");
//$countCat=mysqli_num_rows($queryBoard);
$clist=mysqli_fetch_assoc($queryBoard);
	$bname = $clist['sname'];
	$cid = $clist['sid'];
	$des = $clist['dsc'];
?>
	<div class="row">
						<div class="col-lg-12 col-sm-12">
							<div class="card">
								<div class="card-body table-responsive">
									<h5 class="header-title"><?php echo $bname; ?> board SUB Categories</h5>

										<table class="table dt-responsive ">
											<thead>
												<tr>
													<th>S/N</th>
													<th>Board Title</th>
													<th>Edit </th>
													<th>Action </th>
													
													
													
												</tr><!--end tr-->
											</thead>
											<tbody>
<?php
$i=1;
$queryBoard=$db->query("SELECT * FROM sub_cat WHERE cid_fk = '$list' ");
//$countCat=mysqli_num_rows($queryBoard);
while ($clist=mysqli_fetch_assoc($queryBoard))
{
	$bname = $clist['sname'];
	$sid = $clist['sid'];
	$des = $clist['dsc'];

?>
												<tr>
													<td><?php echo $i++; ?></td>
													<td><a href="#" title="<?php echo $bname; ?>" target="_blank" ><i class="mdi mdi-cards-playing-outline text-danger mr-1 font-18"></i><?php echo $bname; ?></a><br>
													<small><?php echo $des; ?></small> </td>
													<td><a href="?editsubboard=<?php echo $sid ?>">Edit</a></td>
													<td><a href="?deletesub=<?php echo $sid ?>&list=<?php echo $list ?>">Delete</a></td>
													
													
													
												</tr><!--end tr-->
												<?php
											}
											?>
											
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
<?php } ?>

				</div><!-- container -->
				<?php require 'footer.php'; ?>
			</div><!-- end page content -->
		</div><!--end page-wrapper-inner -->
	</div><!-- end page-wrapper -->
	<!-- jQuery  -->

<script>
$( ".deleteBoard" ).click(function() {
	alert('fd');
 if (confirm('Are You Sure, you want to delete this board?')){
 	var deleteid = $(this).attr('id');
   window.location = "?deleteid="+deleteid;
}else{
   alert("You are not redirected.")
}
});


</script>
<script src="assets/js/jquery.min.js">
	</script>
	<script src="assets/js/bootstrap.bundle.min.js">
	</script>
	<script src="assets/js/metisMenu.min.js">
	</script>
	<script src="assets/js/waves.min.js">
	</script>
	<script src="assets/js/jquery.slimscroll.min.js">
	</script><!-- Required datatable js -->
	<script src="assets/plugins/datatables/jquery.dataTables.min.js">
	</script>
	<script src="assets/plugins/datatables/dataTables.bootstrap4.min.js">
	</script><!-- Buttons examples -->
	<script src="assets/plugins/datatables/dataTables.buttons.min.js">
	</script>
	<script src="assets/plugins/datatables/buttons.bootstrap4.min.js">
	</script>
	<script src="assets/plugins/datatables/jszip.min.js">
	</script>
	
	<script src="assets/plugins/datatables/dataTables.responsive.min.js">
	</script>
	<script src="assets/plugins/datatables/responsive.bootstrap4.min.js">
	</script>
	<script src="assets/pages/jquery.datatable.init.js">
	</script><!-- App js -->
	<script src="assets/js/app.js">
	</script>
	<script type="text/javascript" src="<?php echo URL; ?>/js/nl2.js"></script>
</body>
</html>