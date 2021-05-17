<html>
	<head>
	</head>
	<body style="background-color: #e4d5a1;">
<?php
	session_start();
	require_once('connect.php');
	if(!isset($_SESSION['user_id'])){ Redirect('index.php'); }
	else
	{
		$error="";
		$msg="<br><span class=msg>Patient Added Successfully</span><br><br>";
		require_once('header.php');
	}
?>
        <!-- <ul id="mainNav">
        	<li><a href="dashboard.php">DASHBOARD</a></li> < Use the "active" class for the active menu item> 
        	<li><a href="patients.php" class="active">PATIENTS</a></li>
        	<li><a href="beds.php">BEDS</a></li>
        	<li class="logout"><a href="logout.php">LOGOUT</a></li>
        </ul> -->
        <!-- // #end mainNav -->
        
        <div id="containerHolder">
			<div id="container">
        		<div id="sidebar">
                	<ul class="sideNav" style="margin-top:20px;">
					<a class="btn btn-secondary" href="patients.php" role="button" style="margin-left: 20px; background-color:#081b21;  border:solid 4px white;">View All Patients</a>
					<a class="btn btn-secondary active" href="add-patient.php" role="button" style="margin-left: 350px; background-color:#081b21;  border:solid 4px white;">Add New Patients</a>
					<a class="btn btn-secondary" href="assign-bed.php" role="button" style="margin-left: 350px; background-color:#081b21;  border:solid 4px white;">Assign/Unassign beds</a>
                    	<!-- <li><a href="patients.php">VIew All Patients</a></li>
                    	<li><a href="add-patient.php" class="active">Add New Patient</a></li>
                    	<li><a href="assign-bed.php">Assign/Unassign Beds</a></li> -->
                    </ul>
                    <!-- // .sideNav -->
                </div>    
                <!-- // #sidebar -->
                
                <!-- h2 stays for breadcrumbs -->
                <h2 style="text-align:center;">Add New Patient</h2>
                
                <div id="main" style="margin-left:550px;";>
                <form method="post" class="jNice">
					<h3>Registration Form</h3>
                    <?php
						if(isset($_POST['save']))
						{
							$name=trim($_POST['name']);
							$age=trim($_POST['age']);
							$sex=$_POST['sex'];
							$bg=trim($_POST['bg']);
							$phone=trim($_POST['phone']);
							
							if($name==""){ $error="<br><span class=error>Please enter a name</span><br><br>"; }
							elseif($age==""){ $error="<br><span class=error>Please enter the age</span><br><br>"; }
							elseif($age<1){ $error="<br><span class=error>Please enter a value greater than zero for age</span><br><br>"; }
							elseif(!is_numeric($age)){ $error="<br><span class=error>Age must be a number</span><br><br>"; }
							elseif($sex=="none"){ $error="<br><span class=error>Please select the sex</span><br><br>"; }
							elseif($bg==""){ $error="<br><span class=error>Please enter a blood group</span><br><br>"; }
							elseif($phone==""){ $error="<br><span class=error>Please enter the phone number</span><br><br>"; }
							else
							{
								mysqli_query($server,"INSERT INTO patients (name,age,sex,blood_group,phone) VALUES ('$name','$age','$sex','$bg','$phone')");
								$result=mysqli_query($server,"SELECT pat_id FROM patients ORDER BY pat_id DESC LIMIT 0,1");
								$row=mysqli_fetch_array($result);
								
								mysqli_query($server,"INSERT INTO pat_to_bed (pat_id,bed_id) VALUES ('$row[pat_id]','none')");
								echo $msg;
							}
							
							if($error!=""){ echo $error; }
						}
					?>
                    	<fieldset style="margin-top:30px;">
                        	<p><label>Patient Name:</label><input type="text" name="name" class="text-long" autofocus value="  " style="background-color:#d2a06f; border:solid 2px black;"/></p>
                            <p><label style="margin-top:20px;">Age:</label><input type="number" name="age" class="text-long"  style="background-color:#d2a06f; border:solid 2px black;" value="<?php echo $age; ?>" /></p>
                            <p><label  style="margin-top:20px;">Sex:</label>
                            <select name="sex" style="background-color:#d2a06f; border:solid 2px black;">
                            	<option value="none" >[--------SELECT--------]</option>
                            	<option value="Male">Male</option>
                            	<option value="Female">Female</option>
                            	<option value="Transexual">Transexual</option>
                            	<option value="Other">Other</option>
                            </select>
                            </p>
                            <p><label style="margin-top:20px;">Blood Group:</label><input type="text" name="bg" class="text-long" value=" "  style="background-color:#d2a06f; border:solid 2px black;"/></p>
                            <p><label style="margin-top:20px;">Phone Number:</label><input type="text" name="phone" class="text-long" value="  "  style="background-color:#d2a06f; border:solid 2px black;"/></p>
                            <input type="submit" value="Save" name="save" style="background-color: #b37542; margin-left:120px; border:solid 2px black;"/>
                        </fieldset>
                    </form>
                        <br /><br />
                </div>
                <!-- // #main -->
 <?php
	require_once('footer.php');
?>   
</body>
</html>            