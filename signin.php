

<?php
/*
هل الايميل موجود فى جدول اليوزرز فى العمود الخاص ب user_email 




 لو موجود    

الباسورد اللى دخلها اليوزر هل تساوى الباسورد لنفس الصف فى الداتا بيز 

لو تساوى يدخل
لو لاتساوى يكتب ان الباسورد خطأ 
ويديه لينك نسيت الباسورد

لو الايميل مش موجود يكتب ان الايميل مش موجود ويعمل مستخدم جديد

*/

	$pageTitle = 'Login';
	
	
if ( isset( $_POST['submit'] ) )
 {

	include('includes/config.php');
	   
	  $email=$_POST['email'];
	  $password=$_POST['password'];

	   $stmt = $conn->prepare("SELECT * FROM `users` WHERE user_email=:user_email");
	  
	    $stmt->bindParam(':user_email', $email);
	 
	    
	    $stmt->execute();
	    $user=$stmt->fetch();
	    if($user)
	    {
	    	//print_r($user);
	    	//echo $user['user_password'];

	    	if(md5($password)==$user['user_password'])
	    	{
	    		echo "welcome ".$user['user_name'];
	    		session_start();
	    		$_SESSION['user']=$user['user_name'];
            	header("location: index.php");

	    	}
	    	else{
	    		echo "email exists , wrong password <a href='changepassword.php'>forgot password</a>";
	    	}


	    	 
	    }
	    else{
	    	echo "Email not exist , please create new user<a href='signup.php'>sign up</a>";
	    }
	   
	   
	   
	


 }
include('includes/header.php');
?>


<div class="container">
  <h2>sign in</h2>
  <form action="signin.php" method="post">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
    </div>
    
    <div class="form-group">
      <a href="changepassword.php">forgot password?</a>
      <a href="signup.php">New user?</a>
    </div>
    <button type="submit" name='submit' class="btn btn-primary">Submit</button>
    <div class="form-group form-check">
      <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="remember"> Remember me
      </label>
    </div>
  </form>
</div>


<?php

include('includes/footer.php');

?>