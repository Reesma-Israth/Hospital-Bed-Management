<html>
<head>
<title></title>
</head>
<body style="text-align:center; background-color:#deb0ff">
<?php
	session_start();
	require_once('connect.php');
	if(!isset($_SESSION['user_id'])){ Redirect('index.php'); }
	else
	{
		$error="";
		$msg="<br><span class=msg>Bed Added Successfully</span><br><br>";
		require_once('header.php');
	}
?>
        <!-- <ul id="mainNav">
        	<li><a href="dashboard.php">DASHBOARD</a></li> <-- Use the "active" class for the active menu item >
        	<li><a href="patients.php">PATIENTS</a></li>
        	<li><a href="beds.php" class="active">BEDS</a></li>
        	<li class="logout"><a href="logout.php">LOGOUT</a></li>
        </ul> -->
        <!-- // #end mainNav -->
        
        <div id="containerHolder">
			<div id="container">
        		<div id="sidebar">
				<ul class="sideNav" style="margin-top: 35px;">
						    <a class="btn btn-secondary" href="beds.php" role="button" style="margin-left: 0px; border:solid 4px black;">View All Beds</a>
							<a class="btn btn-secondary active" href="add-bed.php" role="button" style="margin-left: 50px; border:solid 4px black;">Add New Bed</a>

                    </ul>
                	<!-- <ul class="sideNav">
                    	<li><a href="beds.php">VIew All Beds</a></li>
                    	<li><a href="add-bed.php" class="active">Add New Bed</a></li>
                    </ul> -->
                    <!-- // .sideNav -->
                </div>    
                <!-- // #sidebar -->
                
                <!-- h2 stays for breadcrumbs -->
                <h2 style="margin-top: 40px;">Add New Bed</h2>
                
                <div id="main">
                <form method="post" class="jNice">
					<h3 style="margin-top: 20;">Registration Form</h3>
                    <?php
						if(isset($_POST['save']))
						{
							$type=$_POST['type'];
							$ward=$_POST['ward'];
							
							if($type=="none"){ $error="<br><span class=error>Please select a type</span><br><br>"; }
							elseif($ward=="none"){ $error="<br><span class=error>Please select a ward</span><br><br>"; }
							else
							{
								mysqli_query($server,"INSERT INTO beds (type,ward) VALUES ('$type','$ward')");
								echo $msg;
							}
							
							if($error!=""){ echo $error; }
						}
					?>
                    	<fieldset>
                            <p><label style="margin-top:30px;"><strong>Type:</strong></label>
                            <select name="type" style="background-color: #e9c9ff; border:solid 2px black;">
                            	<option value="none">[--------SELECT--------]</option>
                            	<option value="Manual">Manual</option>
                            	<option value="Bariatric">Bariatric</option>
                            	<option value="Full-Electric">Full-Electric</option>
                            	<option value="Semi-Electric">Semi-Electric</option>
                                <option value="Low Bed">Low Bed</option>
                            </select>
                            </p>
                            <p><label><strong>Ward:</strong></label>
                            <select name="ward" style="background-color: #e9c9ff; border:solid 2px black;">
                            	<option value="none">[--------SELECT--------]</option>
                            	<option value="Postnatal">Postnatal</option>
                            	<option value="Pregnancy">Pregnancy</option>
                            	<option value="Critical Care">Critical Care</option>
                            	<option value="Orthopaedic">Orthopaedic</option>
                                <option value="Psychiatric">Psychiatric</option>
                                <option value="Accidents And Emergency">Accidents And Emergency</option>
                                <option value="Paediatric">Paediatric</option>
                            </select>
                            </p>
                            <input type="submit" value="Save" name="save" style="background-color: #b54cff; padding:5px 10px; border:solid 2px black;"/>
                        </fieldset>
                    </form>
                        <br /><br />
                </div>
                <!-- // #main -->
</body>
</html>
 <!-- ?php
	require_once('inc/footer.php');
?                -->