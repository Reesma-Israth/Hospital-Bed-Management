<?php

	require_once('connect.php');
	$error="";
?>   
<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Transparent Login Form UI</title>
	<!-- <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="style.css"> 
  </head>
  <style> 
 body{
background-color: #FF5733;
  background: url('./images/bg1.jpg');
  height: 100vh;
  background-size: cover;
  background-position: center;
} 
</style>
  <body style="background-color: #FF5733;
  background: url('./images/bg1.jpg');
  height: 100vh;
  background-size: cover;
  background-position: center;">

        <div id="containerHolder">
			<div id="container">
        		
                
                <!-- h2 stays for breadcrumbs -->
                <h2>User Login</h2>
                
                <div id="main">
                <form method="post" class="jNice" name="frm1">
					<h3>Login Form</h3>
                    <?php
						if(isset($_POST['save']))
						{
							$uname=$_POST['uname'];
							$pword=$_POST['pword'];
							
							if($uname==""){ $error="<br><span class=error>Please enter a username</span><br><br>"; }
							elseif($pword==""){ $error="<br><span class=error>Please enter the password</span><br><br>"; }
							else
							{
								$result=mysqli_query($server,"SELECT * FROM users WHERE uname='$uname' AND pword='$pword'");
								if(mysqli_num_rows($result)==0){ $error="<br><span class=error>Invalid Username/Password</span><br><br>"; }
								else
								{
									$row=mysqli_fetch_array($result);
									session_start();
									$_SESSION['user_id']=$row['user_id'];
									$_SESSION['name']=$row['name'];
									Redirect('dashboard.php'); 
								}
							}
							if($error!=""){ echo $error; }
						}
					?>
                    	<fieldset>
                            <p><label>Username:</label><input type="text" name="uname" class="text-long"  /></p>
                            <p><label>Password:</label><input type="password" name="pword" class="text-long" /></p>
                            <input type="submit" value="Log In" name="save" />
                        </fieldset>
                    </form>
                        <br /><br />
                </div>
                <!-- // #main -->
				</body>
				</html>
 <?php
	require_once('footer.php');
?>               