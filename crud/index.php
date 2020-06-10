<?php include "include/header.php";
        include 'config.php';
        include 'Database.php';
?>
<?php 
$db  =new Database();
$query  ="SELECT * FROM phpcrud";
 $read  =$db->select($query);

?>
<?php if(isset($_GET['msg'])){
	echo "<span style ='color:green'>".$_GET['msg']."</span>";
}?>
<table class="tmain">
	
	<thead>
		<tr>
			<th>Sr No</th>
			<th>Name</th>
			<th>email</th>
			<th>Skill</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody class="center">
		<?php 
		 $sr =1; if ($read) {
			while ($row= $read->fetch_assoc()) {
			
			
			
		 ?>
		<tr>
			<td><?php echo $sr?></td>
			<td><?php echo $row['name'];?></td>
			<td><?php echo $row['email'];?></td>
			<td><?php echo $row['skill'];?></td>
			<td><a href="update.php?id=<?php echo $row['id'];?>">Edit</a>
			<a href="delete.php?id=<?php echo $row['id'];?>">Delete</a></td>
		</tr>
		<?php $sr++;}
	}
		else{
			echo "No Recorde Found!";
		}?>
	</tbody>
</table>
<a href="create.php">create</a>
<?php include "include/footer.php"?>
