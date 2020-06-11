
<?php 
include_once '../lib/Database.php';
include_once'../helper/Format.php';

  ?>

<?php 

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
    	}else{
    		$query  ="INSERT INTO tbl_category (catName) VALUES('$catName')";
    		$insertCat =$this->db->insert($query);
    		if ($insertCat) {
    			$msg  ='<span class ="success"> Category Inserted SuccessFully</span>';
    			return $msg;
    		}else{
                $msg  ='<span class ="error"> Category Not Inserted</span>'; 
                return $msg;
    		}

    	}
	}
}
?>