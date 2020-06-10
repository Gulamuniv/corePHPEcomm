<?php include "include/header.php";
        include 'config.php';
        include 'Database.php';
?>
<?php 
$id  =$_GET['id'];
$db  =new Database();
$query  ="SELECT * FROM phpcrud where id =$id";
 $getData  =$db->select($query)->fetch_assoc();

if (isset($_POST['submit'])) {
	$name  = mysqli_real_escape_string($db->link,$_POST['name']);
	$email = mysqli_real_escape_string($db->link,$_POST['email']); 
	$skill = mysqli_real_escape_string($db->link,$_POST['skill']); 
	if ($name ==""||$email== ""||$skill =="") {
		$error  ="Field not be empty!";
	}else{
		$query  = "UPDATE  phpcrud set name ='$name', email ='$email',skill='$skill' where id =$id";
		$update  =$db->update($query);
	}
}

?>
<?php if(isset($error)){
	echo "<span style ='color:red'>".$error."</span>";
}?>
<form method="post" action="update.php?id=<?php echo $id;?>">
<table class="tmain">
<tr>
	<td>Name</td>
	<td><input type="text" name="name" value="<?php echo $getData['name'] ?>"></td>
</tr><br>	
	<tr>
	<td>Email</td>
<td><input type="text" name="email" value="<?php echo $getData['email'] ?>"></td>
</tr>	
<tr>
	<td>Skill</td>
<td><input type="text" name="skill" value="<?php echo $getData['skill'] ?>"></td>
</tr>	
<tr>
	<td></td>
<td><input type="submit" name="submit" value="update">
   <input type="reset" value="cancel">
    <input type="submit" value="delete">
</td>
</tr>	
</table>
</form>
<a href="index.php">Go back</a>
<?php include "include/footer.php"?>
