<?php
	session_start();
	require_once('connect.php');
	if(!isset($_SESSION['user_id'])){ Redirect('index.php'); }
	else
	{
		require_once('header.php');
	}
?>
        <!-- <ul id="mainNav">
        	<li><a href="dashboard.php">DASHBOARD</a></li> <Use the "active" class for the active menu item >
        	<li><a href="patients.php" class="active">PATIENTS</a></li>
        	<li><a href="beds.php">BEDS</a></li>
        	<li class="logout"><a href="logout.php">LOGOUT</a></li>
        </ul> -->
        <!-- // #end mainNav -->
        <div id="containerHolder">
			<div id="container">
        		<div id="sidebar">
                	<ul class="sideNav" style="margin-top:35px;">
					<a class="btn btn-secondary active" href="patients.php" role="button" style="margin-left: 20px; background-color:#081b21;  border:solid 4px white;">View All Patients</a>
					<a class="btn btn-secondary" href="add-patient.php" role="button" style="margin-left: 350px; background-color:#081b21;  border:solid 4px white;">Add New Patients</a>
					<a class="btn btn-secondary" href="assign-bed.php" role="button" style="margin-left: 350px; background-color:#081b21;  border:solid 4px white;">Assign/Unassign beds</a>
<!-- <button class="btn btn-secondary" type="submit">View All Patients</button>
<button class="btn btn-secondary" type="submit">Add New Patients</button>
<button class="btn btn-secondary" type="submit">Assign/unassign beds</button> -->


                    	<!-- <li><a href="patients.php" class="active">VIew All Patients</a></li>
                    	<li><a href="add-patient.php">Add New Patient</a></li>
                    	<li><a href="assign-bed.php">Assign/Unassign Beds</a></li> -->
                    </ul>
                    <!-- // .sideNav -->
                </div>    
                <!-- // #sidebar -->
                
                <!-- h2 stays for breadcrumbs -->
                <h2>View All Patients</h2>
				<style>
					
						h2, h3{
							text-align: center;
						}
						body{
							background-color:#a6aaaa;
						}
					
					</style>
                
                <div id="main" >
					<h3>Patient Records</h3>
                    	<table cellpadding="3" cellspacing="3" class="table table-hover table-striped " style="background-color:#979797;">
							<tr>
                                <td><b>Patient ID</b></td>
                                <td><b>Name</b></td>
                                <td><b>Age</b></td>
                                <td><b>Sex</b></td>
                                <td><b>Blood Group</b></td>
                                <td><b>Status</b></td>
                            </tr> 
                            <?php
								$result=mysqli_query($server,"SELECT p.*,pb.pat_id,pb.bed_id AS bed FROM patients p,pat_to_bed pb WHERE p.pat_id=pb.pat_id ORDER BY p.pat_id DESC");
								while($row=mysqli_fetch_row($result))
								{
									$status="";
									if($row[7]=="none"){ $status="<strong>Unassigned</strong>"; }
									elseif($row[7]>0){ $status="Admitted <font color=#000>{Bed $row[7]}</font>"; } else{ $status="<font color=#048f58><strong>Discharged</strong></font"; }
									
									
									$rn=$row['0'];
					 				if(strlen($rn)==1)
					 				$rn="000".$rn;
					 				elseif(strlen($rn)==2)
					 				$rn="00".$rn;
					 				elseif(strlen($rn)==3)
					 				$rn="0".$rn;
					 				elseif(strlen($rn)>3)
					 				$rn=$rn;
									
									echo"<tr class=odd>
                                	<td>$rn</td>
                                	<td>$row[1]</td>
                                	<td>$row[2]</td>
                                	<td>$row[3]</td>
                                	<td>$row[4]</td>
									<td>$status</td>
                            		</tr>";
								}
							?>                       
                        </table>
                        <br /><br />
                </div>
                <!-- // #main -->
 <?php
	require_once('footer.php');
?>               