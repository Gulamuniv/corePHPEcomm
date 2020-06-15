<?php include "inc/header.php"; ?>
<?php 
  $login =  Session::get("cuslogin");
   if ($login == true) {
  	header("Location:order.php");
  }

?>


<?php 
   
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login']) ) {
              
        $customLogin = $cmr->customerLogin($_POST);
    }

?>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
    	 	<?php 
		          if (isset($customLogin)) {
		          	echo $customLogin;
		          }

		        ?>
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<form action=" " method="post" >
                	<input name="email" placeholder="Email" type="text" >
                    <input name="pass" type="password" placeholder="Enter Your Password">
                    <div class="buttons"><div><button class="grey" name="login" >login</button></div></div>
                 </form>
            </div>
                      <?php 
   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register']) )
   {
              
        $customerReg = $cmr->customerRegistration($_POST);
        print_r($customerReg);
    }
  
?>
    			<?php 
            	if (isset($customerReg)) {
				  	echo($customerReg);
				  }
    		 ?>
		   		
    	<div class="register_account">
    		<h3>Register New Account</h3>

		   		
 		<form action=" " method="post">
    			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Enter Your Name">
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="Enter Your City">
							</div>
							
							<div>
								<input type="text" name="zip" placeholder="Enter Your Zip">
							</div>
							<div>
								<input type="text" name="email" placeholder="Enter Your Email">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Enter Your Address">
						</div>
		    		<div>
						<input type="text" name="country" placeholder="Country" />
				 </div>		        
	
		           <div>
		          <input type="text" name="phone" placeholder="Enter Your Phone">
		          </div>
				  
				  <div>
					<input type="text" name="pass" placeholder="Enter Your Password">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		      <div class="search"><div><button class="grey" name="register">Create Account</button></div></div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
    <?php include "inc/footer.php"; ?>