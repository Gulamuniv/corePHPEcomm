<?php 
include_once '../lib/Database.php';
include_once'../helper/Format.php';

  ?>
<?php  
class Brand 
{
	
	private $db;
	private $fm;
	function __construct()
	{
	   $this->db   = new Database();
       $this->fm   = new Format();
	}


public function brandInsert($brandName)
	{
	 $brandName = $this->fm->validation($brandName);
     $brandName =  mysqli_real_escape_string($this->db->link,
     	$brandName);
     if (empty($brandName)) {
    	 $msg = "Category Field must not be empty";
    	 return $msg;
    	}else{
    		$query  ="INSERT INTO tbl_brand (brandName) VALUES('$brandName')";
    		$insertBrand =$this->db->insert($query);
    		if ($insertBrand) {
    			$msg  ='<span class ="success"> Brand Inserted SuccessFully</span>';
    			return $msg;
    		}else{
                $msg  ='<span class ="error">Brand Not Inserted</span>'; 
                return $msg;
    		}

    	}
	}


public function getAllBrand()
{
	$query  ="SELECT *FROM tbl_brand ORDER BY brandId DESC";
		$result  = $this->db->select($query);
		return $result;
}

public function getBrandById($id)
{
	$query  ="SELECT *FROM tbl_brand where brandId =$id";
	$result  = $this->db->select($query);
		return $result;
}

public function brandUpdate($brandName, $id)
{
   $brandName = $this->fm->validation($brandName);
    $brandName =  mysqli_real_escape_string($this->db->link, $brandName );
     $id =  mysqli_real_escape_string($this->db->link, $id);
     if (empty($brandName)) {
    	 $msg = "<span class='error'>Brand Field Must Not be empty.</span> ";
    	 return $msg;

     }else {
			$query = "UPDATE tbl_brand
            SET
            brandName = '$brandName'
            WHERE brandId = '$id' ";
            $update_row  = $this->db->update($query);
            if ($update_row) {
            	$msg = "<span class='success'>Brand Updated Successfully.</span> ";
            	return $msg;
            }else {
            	$msg = "<span class='error'>Brand Not Updated .</span> ";
    			return $msg;
            }
	
}


}


public function delBrandById($Id)
{
	$query = "DELETE FROM tbl_brand WHERE brandId ='$Id'";
	 $deldata = $this->db->delete($query);
	 if ($deldata) {
			$msg = "<span class='success'>Brand Deleted Successfully.</span>";
		  return $msg;
	}else{
	 			$msg = "<span class='error'>Brand Not Deleted .</span> ";
		    	 return $msg;
  	}
}

}