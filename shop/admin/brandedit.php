<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php';?>
<?php 
if (!isset($_GET['brandId'])||$_GET['brandId']==NULL) {
    echo "<script>window.location ='brandlist.php'</script>";
}else{
   $id =$_GET['brandId'];
}

$brand  =new Brand();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $brandName = $_POST['brandName'];
       

        $updateBrand = $brand->brandUpdate($brandName, $id);
    }
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update brand</h2>
               <div class="block copyblock"> 
          <?php
            if (isset($updateBrand)) {
                echo $updateBrand;
            }
              ?>

          <?php 
             $getbrand  = $brand->getBrandById($id);
             if ($getbrand) {
                 while ($result =$getbrand->fetch_assoc()) {
                     
            
          ?>

     <form action="" method="POST">
        <table class="form">					
      <tr>
          <td>

              <input type="text" value="<?php echo  
              $result['brandName']?>"  name ="brandName"class="medium" />
          </td>
      </tr>
<tr> 
                <td>
                    <input type="submit" name="submit" Value="Update" />
                </td>
            </tr>
        </table>
        </form>
                    <?php 

                }
            }?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>