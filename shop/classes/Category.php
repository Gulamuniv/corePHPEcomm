
<?php 
include_once '../lib/Database.php';
include_once'../helper/Format.php';

  ?>

<?php 
df
/**
 * Category Class
 */
class Category 
{
	
	private $db;
	private $fm;
	function __construct()
	{
	   $this->db   = new Database();
       $this->fm   = new Format();
	}
	public function catInsert($catName)
	{
	  $catName = $this->fm->validation($catName);
     $catName =  mysqli_real_escape_string($this->db->link,
     	$catName);
     if (empty($catName)) {
    	 $msg = "Category Field must not be empty";
    	 return $msg;
    	}
	}
}
?>