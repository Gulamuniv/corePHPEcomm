<?php include "include/header.php";
        include 'config.php';
        include 'Database.php';
?>
<?php 

$id  =$_GET['id'];
$db  =new Database();
if (isset($_GET['id'])) {
	$query  ="DELETE FROM phpcrud WHERE id =$id";
	$deleteData  =$db->delete($query);

}
?>
<?php include "include/footer.php"?>