<?php
$per_page = 10;

$page=$_GET['page'];

$start = ($page-1)*$per_page;
$sql = "select * from topics limit $start,$per_page";
$result = $db->query($sql);
?>
<table class="table table-bordered">
<?php
while($row = mysqli_fetch_array($result))
{
$id=$row['topic_id'];
$emp_name=$row['content_text'];
?>
<tr>
<td><?php echo $id; ?></td>
<td><?php echo $emp_name; ?></td>
</tr>
<?php
}
?>
</table>