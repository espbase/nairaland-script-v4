<table>
		<tbody>
<?php
if(isset($_GET['delete']))
{
   $delete = $_GET['delete'];
   
   $qryDel = $db->query("DELETE FROM followed_boards WHERE  board_id_fk='$delete' ");
}

if(isset($_POST['board']))
{
   $board = $_POST['board'];
   
 $created=time();


  $checkmat=$db->query("SELECT * FROM followed_boards WHERE user_id_fk='$ses_user_id' AND board_id_fk='$board' ");
  $val=mysqli_num_rows($checkmat);
  if ($val) {
// already followed_board
  }
  else
  {
    if($board!=0)
    {
  $db->query("INSERT INTO followed_boards (board_id_fk, user_id_fk, bdate) VALUES('$board','$ses_user_id', '$created')");
  // follow board
  }
    }

}


/*
fetch board form database
*/
$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.


$query_cat = $db->query("SELECT * FROM followed_boards FT, sub_cat S
	WHERE FT.user_id_fk='$user_id' AND FT.board_id_fk=S.sid ORDER BY FT.fid DESC ");
//count rows
$check=$query_cat->num_rows;

if($check){
/*
		loop categories
		*/
		while($data=$query_cat->fetch_assoc())
		{
		$s_id=$data['sid'];
		$stitle=$data['sname'];
		$cat_alias=$data['surl'];
		// fetch categories according to board id

		$queryTopic=$db->query("SELECT * FROM topics WHERE board_id_fk='$s_id' post_type='topic'  ");
		//count rows
		//$countTopic=$queryTopic->num_rows;

echo '<tr>
		<td id="top519" class=""><b><a href="forum/'.$cat_alias.'">'.$stitle.'</a> 	(<a href="?delete='.$s_id.'">X</a>) </b><br>
		</td>

	</tr>';
}
}
else
{
echo '<tr>
				<td class="w">
			<h2>Oops! No subscribe yet</h2>
						<p>
						You have not subscribe to any board. <br>
						→ <a href="'.WEBROOT.'">Click here to return back to forum home</a>
						</p>		</td>
</tr>';
}

?>
<tr>
				<td class="w">
					<form action="" method="post">
					    	<select name="board" required=""> 
    <option value=''>Select Category</option> 
    <?php
    $queryBoard=$db->query("SELECT * FROM sub_cat ORDER BY sid");
//fetch rows
/*
Define topics, category, and sub cat details and variables
*/
while($bdata=$queryBoard->fetch_assoc()){
$sname=$bdata['sname'];
$sid=$bdata['sid'];


if($sname=='Home Page')
{
// echo '<option value="index|0|'.$catcost.'">'.$sname.'</option>';   
}
else
{
    echo '<option value="'.$sid.'">'.$sname.'</option>';
}


}
?>
    </select>
					<input type="submit" value="Follow">
					</form>
				</td>
			</tr>
		</tbody>
	</table>
	