
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


	public function getAllCat()
	{
		$query  ="SELECT *FROM tbl_category ORDER BY catId DESC";
		$result  = $this->db->select($query);
		return $result;
	}

	public function getCatById($id)
	{
	  $query  ="SELECT *FROM tbl_category where catId =$id";
	  $result  = $this->db->select($query);
		return $result;
	}

	public function catUpdate($catName,$id)
	{
	$catName = $this->fm->validation($catName);
    $catName =  mysqli_real_escape_string($this->db->link, $catName );
     $id =  mysqli_real_escape_string($this->db->link, $id);
     if (empty($catName)) {
    	 $msg = "<span class='error'>Category Field Must Not be empty.</span> ";
    	 return $msg;

     }else {
			$query = "UPDATE tbl_category
            SET
            catName = '$catName'
            WHERE catId = '$id' ";
            $update_row  = $this->db->update($query);
            if ($update_row) {
            	$msg = "<span class='success'>Category Updated Successfully.</span> ";
            	return $msg;
            }else {
            	$msg = "<span class='error'>Category Not Updated .</span> ";
    			return $msg;
            }

     }

	}

public function delCatById($id)
{
	 $query = "DELETE FROM tbl_category WHERE catId ='$id' ";
	 $deldata = $this->db->delete($query);
	 if ($deldata) {
		$msg = "<span class='success'>Category Deleted Successfully.</span>";
		  return $msg;
	}else {
	 $msg = "<span class='error'>Category Not Deleted .</span> ";
		    	 return $msg;
  			}
}

}
?>