<!DOCTYPE HTML>
<html>
	<head>
		<title>Major</title>
		<meta name="description" content="website description" />
		<meta name="keywords" content="website keywords, website keywords" />
		<meta http-equiv="content-type" content="text/html; charset=windows-1252" />
		<link rel="stylesheet" type="text/css" href="../style/styleAdmin.css" title="style" />
	</head>
	<body>
		<div id="main">
			<div id="header">
				<div id="logo">
					<div id="logo_text">
						<!-- class="logo_colour", allows you to change the colour of the text -->
						<h1>
							Admin
							<span class="logo_colour">Section</span>
						</h1>
						<!-- <h2>Simple. Contemporary. Website Template.</h2> -->
					</div>
				</div>
				<div id="menubar">
					<ul id="menu">
						<!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
						<li>
							<a href="viewFac.php">Faculty</a>
						</li>
						<li class="selected">
							<a href="viewMaj.php">Major</a>
						</li>
						<li>
							<a href="viewYear.php">Year</a>
						</li>
						<li>
							<a href="viewSub.php">Subject</a>
						</li>
						<li>
							<a href="viewUser.php">User</a>
						</li>
						<li>
							<a href="viewInbox.php">Inbox</a>
						</li>
						<li>
							<a href="admin_logout.php">Logout</a>
						</li>
					</ul>
				</div>
			</div>
			<div id="content_header"></div>
			<div id="site_content">
				<div id="content">
					<!-- insert the page content here -->
					<h1>Faculty Majors Management</h1><br>
					<!--<form name="contactForm" action="" method="post" onsubmit="return validateForm();" required-->
						<div class="form_settings">
						
						<?php
							// ADD OPTION
							if(isset($_POST['add'])) {?>
								
								<form name="formAdd" action="#link" method="post" onsubmit="return validateFormAdd();" required>
									<p>
										<span>Major Name</span>
										<input required name="majorName" style="width:200px;margin:0 0 0 -100px">
									</p><br>
									<p>
										<span>Faculty</span>
										<select class="form_settings" name="selectFac" style="width:212px;margin:0 0 0 -100px">
										<?php 
											include "initConnection.php";
											$query = 'SELECT * FROM faculty';
											$result = mysqli_query($con, $query);
											while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
												echo '<option value="'.$line['nameFaculty'].'">'.$line['nameFaculty'].'</option>';
											}
										?>
										</select>
									</p>
									<p>
										<input class="submit" type ="submit" name="addMajor" value="Add" style="margin:0 0 0 215px;"/>
									</p><br><br>
								</form>
							<?php
							}
							
							if(isset($_POST['addMajor'])) {
								include "initConnection.php";
								$majorName = $_POST['majorName'];
								$facultyName = $_POST['selectFac'];
								
								// if exists return
								$query = "select * from major where nameMajor='$majorName' and idFaculty IN
								(select idFaculty from faculty where nameFaculty = '$facultyName')";
								$result = mysqli_query($con, $query);
								$nbrow=mysqli_num_rows($result);
								if($nbrow!=0){
									header("Location: ?#link");
									exit();
								}
								
								// else
								$query = "select * from faculty where nameFaculty = '$facultyName'";
								$result = mysqli_query($con, $query);
								$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
								$var = $line['idFaculty'];
								
								$query = "insert into major values(default, '$majorName', $var)";
								mysqli_query($con, $query);
								mysqli_close($con);
							}
							
							// DELETE OPTION
							if(isset($_GET['delete'])) {
								include "initConnection.php";
								$idMajor = $_GET['delete'];
								$query = 'DELETE FROM major WHERE idMajor='.$idMajor.';';
								mysqli_query($con, $query);
								mysqli_close($con);
								header("Location: ?#link");
							}
							
							// UPDATE OPTION
							/*if(isset($_GET['update'])) {
								$nameFaculty = $_GET['nameF'];
								$nameMajor = $_GET['nameM'];
								header("Location: updateMajor.php?nameFaculty=".$nameFaculty);
								exit();
							}*/
							// UPDATE OPTION
							if(isset($_POST['up'])) {
								$nameFaculty = $_POST['nameF'];
								$nameMajor = $_REQUEST['nameM'];?> 
								<form action="#link" method="post">
									<p>
										<span>Major Name</span>
										<input required name="MajorName" value="<?php echo $nameMajor; ?>" style="width:200px;margin:0 0 0 -100px">
									</p>
										<input type="hidden" name="hiddenM" value="<?php echo $nameMajor; ?>">
										<input type="hidden" name="hiddenF" value="<?php echo $nameFaculty; ?>">
									<p>
										<input class="submit" type ="submit" name="update" value="Update" style="margin:0 0 0 215px;"/>
									</p><br><br>
								</form>
							<?php }
							
							if(isset($_REQUEST['update'])) {
								include "initConnection.php";
								$MajorName = $_REQUEST['MajorName'];
								
								$hiddenM = $_REQUEST['hiddenM'];
								$hiddenF = $_REQUEST['hiddenF'];
								
								$query = "select * from faculty where nameFaculty = '$hiddenF'";
								$result = mysqli_query($con, $query);
								$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
								$varOld = $line['idFaculty'];
								
								$Uquery = "update major set nameMajor='$MajorName' where nameMajor = '$hiddenM' and idFaculty = $varOld";
								mysqli_query($con, $Uquery);
								mysqli_close($con);
								//header("Location: viewMaj.php");
								//exit();
							}
							
							// EDIT OPTION
							include "initConnection.php";
							$query = 'SELECT * FROM major order by idMajor';
							$result = mysqli_query($con, $query);?>
							
								<table id="link" border="0" style="width:100%; border-spacing:0;table-layout:auto">
								<tr>
									<!--th>ID</th-->
									<th style="text-align:left;">Major</th>
									<th style="text-align:left;">Faculty</th>
									<th>Edit</th>
									<th>Delete</th>
									<th> 
										<form action="" method="post">
											<input type="hidden" name="add" value="">
											<button class="tooltip" style="border:none;border-style:transparent;background:#3B3B3B" type="submit">
												<span class="tooltiptext">Add a major</span>
												<img src="../style/addN.ico">
											</button>
										</form>
									</th>
								</tr>
							<?php
							
							while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
								$var = $line['idFaculty'];
								$query2 = "select nameFaculty from faculty where idFaculty = $var";
								$result2 = mysqli_query($con, $query2);
								while($line2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
									echo'
										<tr>
											<!--td>'.$line['idMajor'].'</td-->
											<td style="text-align:left;">'.$line['nameMajor'].'</td>
											<td style="text-align:left;">'.$line2['nameFaculty'].'</td>
											<td> 
												<form action="viewMaj.php" method="post">
													<input type="hidden" name="up" value="'.$line2['nameFaculty'].'">
													<input type="hidden" name="nameF" value="'.$line2['nameFaculty'].'">
													<input type="hidden" name="nameM" value="'.$line['nameMajor'].'">
													<button class="tooltip" style="border:none;border-style:transparent;" type="submit">
														<span class="tooltiptext">Edit Major</span>
														<img src="../style/edit.ico">
													</button>
												</form>
											</td>
											<td class="tooltip">
												<a href="viewMaj.php?delete='.$line['idMajor'].'">
													<span class="tooltiptext">Remove major</span>
													<img src="../style/delete.ico">
												</a>
											</td>
											<td></td>
										</tr>
									';
								}
							}
							echo'</table>';
							//<td><a href="updateMajor.php?nameF='.$line2['nameFaculty'].'&nameM='.$line['nameMajor'].'"><img src="../style/edit.ico"></a></td>
						?>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
