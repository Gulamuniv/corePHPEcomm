<?php 
include_once '../lib/Database.php';
include_once'../helper/Format.php';

?>

<?php 

/**
 * Category Class
 */
class Product 
{
	
	private $db;
	private $fm;
	function __construct()
	{
	   $this->db   = new Database();
       $this->fm   = new Format();
	}


}


