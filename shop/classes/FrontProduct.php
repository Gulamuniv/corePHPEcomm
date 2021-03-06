
<?php 

class DatabaseFront {

public $host = "localhost";
public $user = "root";
public $pass = "";
public $dbname = "db_store";

 public $link;
 public $error;
   public function __construct(){
    $this->connectDB();
   }

    private function connectDB(){

   $this->link = new mysqli($this->host,$this->user, $this->pass, $this->dbname);

    if(!$this->link) {
    
     $this->error ="connection fail".$this->link->connect_error;
       return false;
    }
 }

    // Select or Rread Data From Database 
     public function select($query){
       $result = $this->link->query($query) or die ($this->link->error.__LINE__);
       if ($result->num_rows > 0) {
        return $result;
       }else{
        return false;
       }
     }

      // Create Data in to the database 
     public function insert($query){
     $insert_row = $this->link->query($query) or die ($this->link->error.__LINE__);
      if($insert_row){
        
        return ($insert_row);
         exit();
      }else{
         return false;
      }
     }


      /// Update Data in to the database

   public function update($query){
   $update_row = $this->link->query($query) or die ($this->link->error.__LINE__);
   if($update_row){
   return ($update_row);
    exit();
       } else {
       return false;

       }

   }

   /// Delete Data in to the database
    public function delete($query){
   $delete_row = $this->link->query($query) or die ($this->link->error.__LINE__);
   if($delete_row){
    return ($delete_row);
    exit();
       } else {
        return false;

       }

   }
}
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
public function productInsert($data,$file)
{
 $productName = mysqli_real_escape_string($this->db->link, $data['productName'] );
$catId = mysqli_real_escape_string($this->db->link, $data['catId'] );
$brandId = mysqli_real_escape_string($this->db->link, $data['brandId'] );
$body = mysqli_real_escape_string($this->db->link, $data['body'] );
$price = mysqli_real_escape_string($this->db->link, $data['price'] );
$type = mysqli_real_escape_string($this->db->link, $data['type'] );
  
   $permited = array('jpg','png','jpeg','gif');
     $file_name = $file['image']['name'];
     $file_size = $file['image']['size'];
     $file_temp = $file['image']['tmp_name'];
     $div = explode('.', $file_name);
     $file_ext = strtolower(end($div));
     $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
     $uploaded_image = "upload/".$unique_image;
     if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "" ) {
      $msg = "<span class='error'>Field Must Not be empty .</span>";
          return $msg;
     }else{
       move_uploaded_file($file_temp, $uploaded_image);
       $query = "INSERT INTO tbl_product(productName, catId, brandId, body, price, image, type) 
          VALUES ('$productName','$catId','$brandId','$body','$price','$uploaded_image','$type')";
          $inserted_row = $this->db->insert($query);
          if ($inserted_row) {
            $msg = "<span class='success'>Product Inserted Successfully.</span> ";
          return $msg;
          }else{
            $msg = "<span class='error'>Product Not Inserted .</span> ";
          return $msg;
          }
     }
}

public function getAllProduct()
{
$query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
         FROM tbl_product
         INNER JOIN tbl_category
         ON tbl_product.catId = tbl_category.catId
         INNER JOIN tbl_brand
         ON tbl_product.brandId = tbl_brand.brandId
         ORDER BY tbl_product.productId DESC";
  $result  = $this->db->select($query);
  return $result;
}

public function getProById($proId)
{
  $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
         FROM tbl_product
         INNER JOIN tbl_category
         ON tbl_product.catId = tbl_category.catId
         INNER JOIN tbl_brand
         ON tbl_product.brandId = tbl_brand.brandId
         WHERE productId=$proId";
         $result  = $this->db->select($query);
     return $result;
}


public function productUpdate($data,$file,$id){
 
$productName    =  mysqli_real_escape_string($this->db->link, $data['productName'] );
$catId =  mysqli_real_escape_string($this->db->link, $data['catId'] );
$brandId=  mysqli_real_escape_string($this->db->link, $data['brandId'] );
$body =  mysqli_real_escape_string($this->db->link, $data['body'] );
$price = mysqli_real_escape_string($this->db->link, $data['price'] );
$type =  mysqli_real_escape_string($this->db->link, $data['type'] );

     $permited = array('jpg','png','jpeg','gif');
     $file_name = $file['image']['name'];
     $file_size = $file['image']['size'];
     $file_temp = $file['image']['tmp_name'];

     $div = explode('.', $file_name);
     $file_ext = strtolower(end($div));
     $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
     $uploaded_image = "upload/".$unique_image;
     if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "" ) {
      $msg = "<span class='error'>Field Must Not be empty .</span> ";
          return $msg;
     }else {
     if (!empty($file_name)) {
       

     if ($file_size > 1054589) {
      echo "<span class='error'>Image Size should be less then 1MB .</span>";
     }elseif (in_array($file_ext, $permited) === false) {
      echo "<span class='error'> You can Upload Only".implode(',', $permited)."</span>";
     

     } else{
          move_uploaded_file($file_temp, $uploaded_image);
          $query = "UPDATE tbl_product
          SET 
          productName   = '$productName',
          catId     = '$catId',
          brandId     = '$brandId',
          body      = '$body',
          price     = '$price',
          image     = '$uploaded_image',
          type      = '$type'
          WHERE productId = '$id' ";


          $updated_row = $this->db->update($query);
          if ($updated_row) {
          $msg = "<span class='success'>Product Updated Successfully.</span> ";
          return $msg;
        }else {
          $msg = "<span class='error'>Product Not Updated .</span> ";
          return $msg;
        } 
     }

      } else{
           $query = "UPDATE tbl_product
          SET 
          productName   = '$productName',
          catId     = '$catId',
          brandId     = '$brandId',
          body      = '$body',
          price     = '$price',
          
          type      = '$type'
          WHERE productId = '$id' ";


          $updated_row = $this->db->update($query);
          if ($updated_row) {
          $msg = "<span class='success'>Product Updated Successfully.</span> ";
          return $msg;
        }else {
          $msg = "<span class='error'>Product Not Updated .</span> ";
          return $msg;
        } 
 
        }
    }
}

public function delProById($id)
{
  $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
  $getData = $this->db->select($query);
  if ($getData) {
    while ($delImg = $getData->fetch_assoc()) {
        $dellink = $delImg['image'];
        unlink($dellink);
      }
  }

  $delquery = "DELETE FROM tbl_product WHERE productId = '$id'";
  $deldata = $this->db->delete($delquery);
  if ($deldata) {
    $msg = "<span class='success'>Product Deleted Successfully.</span> ";
    return $msg;
  }else{
    $msg = "<span class='error'>Product Not Deleted .</span> ";
    return $msg;
  }
}

public function getFeatureProduct()
{
   $query = "SELECT * FROM tbl_product WHERE type='0' ORDER BY productId DESC LIMIT 6 ";
    $result = $this->db->select($query);
    return $result;
    
}

}






?>


