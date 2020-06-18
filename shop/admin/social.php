<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php include '../classes/Brand.php';  ?>

<?php 
   $brand =  new Brand();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
        $fa = $_POST['facebook'];
        $tw = $_POST['twitter'];
        $lin = $_POST['linkedin'];
        $gp = $_POST['googleplus'];
        $updateSocila = $brand->SocilaUpdate($fa,$tw,$lin,$gp);
    }

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Social Media</h2>
        <div class="block">  
            <?php if (isset($updateSocila)) {
                echo($updateSocila);
            } ?>
        <?php 
        $brand =  new Brand();
        $getsocial = $brand->getSocialById();
        if ($getsocial) {
           while ($result = $getsocial->fetch_assoc()) {
           
     ?>              
         <form action="" method="POST">
            <table class="form">					
                <tr>
                    <td>
                        <label>Facebook</label>
                    </td>
                    <td>
                        <input type="text" name="facebook" value="<?php echo $result['facebook']?>" placeholder="Facebook link.." class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Twitter</label>
                    </td>
                    <td>
                        <input type="text" name="twitter" 
                        value="<?php echo $result['twitter']?>" placeholder="Twitter link.." class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td>
                        <label>LinkedIn</label>
                    </td>
                    <td>
                        <input type="text" name="linkedin"value="<?php echo $result['linkedin']?>"  placeholder="LinkedIn link.." class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td>
                        <label>Google Plus</label>
                    </td>
                    <td>
                        <input type="text" name="googleplus"value="<?php echo $result['googleplus']?>"  placeholder="Google Plus link.." class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
        <?php }}?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>