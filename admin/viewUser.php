
<!DOCTYPE HTML>
<html>
	<head>
		<title>User</title>
		<meta name="description" content="website description" />
		<meta name="keywords" content="website keywords, website keywords" />
		<meta http-equiv="content-type" content="text/html; charset=windows-1252" />
		<link rel="stylesheet" type="text/css" href="../style/styleAdmin.css" title="style"/>
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
						<li>
							<a href="viewMaj.php">Major</a>
						</li>
						<li>
							<a href="viewYear.php">Year</a>
						</li>
						<li>
							<a href="viewSub.php">Subject</a>
						</li>
						<li class="selected">
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
				<div class="sidebar">
					<!-- insert your sidebar items here -->
					<div class="form_settings">
						<form action="viewUser.php" method="post"><br>
							<p>
								<input name="searchId" placeholder="User ID" style="width:86px;margin:0 0 0 110px">
							</p>
							<p>
								<input class="submit" type="submit" name="search" value="Search" style="margin:0 0 0 110px;"/>
							</p><br>
						</form>
					</div>
				</div>
				<div id="content">
					<!-- insert the page content here -->
					<h1>Users Management</h1><br><br>
					<?php
						// DELETE USER
						if(isset($_GET['delete'])) {
							include "initConnection.php";
							$idUser = $_GET['idUser'];
							$function = $_GET['function'];
							if($function == 'st') {
								$query = 'DELETE FROM student WHERE idUser='.$idUser.';';
								mysqli_query($con, $query);
							}
							else {
								$query = 'DELETE FROM professor WHERE idUser='.$idUser.';';
								mysqli_query($con, $query);
							}
							$query = 'DELETE FROM user WHERE idUser='.$idUser.';';
							if(!mysqli_query($con, $query))  die("Error in the query: " . mysqli_error($con));
							mysqli_close($con);
						}
						
						// UPDATE USER
						if(isset($_GET['update'])) {
							include "initConnection.php";
							$idUser = $_GET['idUser'];
							//$fullName = $_GET['fullName'];
							//$phone = $_GET['phone'];
							//$idFaculty = $_GET['idFaculty'];
							//$function = $_GET['function'];
							//$email = $_GET['email'];
							
							$queryUser = 'SELECT * FROM user WHERE idUser='.$idUser.';';
							$resultUser = mysqli_query($con, $queryUser);
							$lineUser = mysqli_fetch_array($resultUser, MYSQLI_ASSOC);
							//
							$queryMjr = 'select nameMajor from major where idMajor IN(select idMajor from student where idUser='.$idUser.');';
							$resultMjr = mysqli_query($con, $queryMjr);
							$lineMjr = mysqli_fetch_array($resultMjr, MYSQLI_ASSOC);
							
							$fullName = $lineUser['fullName'];
							$phone = $lineUser['phone'];
							$function = $lineUser['function'];
							$major = $lineMjr['nameMajor'];
							$email = $lineUser['email'];
							
					?>
						<div class="form_settings">
							<form action="viewUser.php" method="post">
								<p>
									<span>User ID</span>
									<input readonly name="userId" value="<?php echo $idUser ; ?>" style="width:200px;margin:0 0 0 -100px">
								</p>
								<p>
									<span>Full Name</span>
									<input required name="nameFull" value="<?php echo $fullName; ?>" style="width:200px;margin:0 0 0 -100px">
								</p>
								<p>
									<span>Phone Nb.</span>
									<input required name="phoneNb" value="<?php echo $phone; ?>" style="width:200px;margin:0 0 0 -100px">
								</p>
								<?php if($function == "st"){ ?>
									<p>
										<span>Major</span>
										<select name="majorM" style="width:200px;margin:0 0 0 -100px">
										<?php 
											$query = 'SELECT * FROM major';
											$result = mysqli_query($con, $query);
											while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
												if($major == $line['nameMajor'])
													echo'<option selected value="'.$line['idMajor'].'">'.$line['nameMajor'].'</option>';
												else
													echo'<option value="'.$line['idMajor'].'">'.$line['nameMajor'].'</option>';
											}
											mysqli_close($con);
										?>
										</select>
									</p>
								<?php }else{} ?>
								<p>
									<span>Email</span>
									<input required name="emailM" value="<?php echo $email; ?>" style="width:200px;margin:0 0 0 -100px">
								</p>
								<p>
									<span>Function</span>
									<?php
										if($function == "st")
											echo'<input readonly name="function" value="Student" style="width:200px;margin:0 0 0 -100px">';
										else
											echo'<input readonly name="function" value="Professor" style="width:200px;margin:0 0 0 -100px">';
									?>
								</p><br>
								
								<p>
									<input class="submit" type="submit" name="updateUser" value="Update" style="margin:0 0 0 215px;"/>
								</p><br>
							</form>
						</div>
					<?php
						}
						if(isset($_REQUEST['updateUser'])) {
							include "initConnection.php";
							$userId = $_REQUEST['userId'];
							$nameFull = $_REQUEST['nameFull'];
							$phoneNb = $_REQUEST['phoneNb'];
							$emailM = $_REQUEST['emailM'];
							
							$query = 'UPDATE user SET fullName="'.$nameFull.'", phone='.$phoneNb.', email="'.$emailM.'" WHERE idUser='.$userId.';';
							mysqli_query($con, $query);
							
							if(isset($_REQUEST['majorM'])){ 
								$majorM = $_REQUEST['majorM'];
								$query = 'UPDATE student SET idMajor='.$majorM.' WHERE idUser='.$userId.';';
								mysqli_query($con, $query);
							}	
							mysqli_close($con);
						}
						
						// Display 
						include "initConnection.php";
						$query = 'SELECT * FROM user ORDER BY idFaculty,function';
						$result = mysqli_query($con, $query);
						echo'
							<table class="mimi" style="width:120%; border-spacing:0;table-layout:auto">
							<tr>
								<th>ID</th>
								<th style="text-align:left;">Full Name</th>
								<th>Phone Nb.</th>
								<th>Faculty</th>
								<th>Function</th>
								<th>Email</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						';
						while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							$queryF = 'SELECT nameFaculty FROM faculty WHERE idFaculty='.$line['idFaculty'].';';
							$resultF = mysqli_query($con, $queryF);
							$lineF = mysqli_fetch_array($resultF, MYSQLI_ASSOC);
							if(isset($_POST['search'])) {
								if($line['idUser'] == $_POST['searchId']) {
									echo'
										<tr>
											<td>'.$line['idUser'].'</td>
											<td style="text-align:left;">'.$line['fullName'].'</td>
											<td>'.$line['phone'].'</td>
											<td >'.$lineF['nameFaculty'].'</td>
											<td>'.$line['function'].'</td>
											<td>'.$line['email'].'</td>
											<td class="tooltip">
												<a href="viewUser.php?update=true&idUser='.$line['idUser'].'&fullName='.$line['fullName'].'&phone='.$line['phone'].'&idFaculty='.$line['idFaculty'].'&function='.$line['function'].'&email='.$line['email'].'">
												<span class="tooltiptext">Edit User</span>
												<img src="../style/edit.ico"></a>
											</td>
											<td class="tooltip">
												<a href="viewUser.php?delete=true&idUser='.$line['idUser'].'">
												<span class="tooltiptext">Remove User</span>
												<img src="../style/delete.ico"></a>
											</td>
										</tr>
									';
								}
							}
							else {
								
								echo'
									<tr>
										<td>'.$line['idUser'].'</td>
										<td style="text-align:left;">'.$line['fullName'].'</td>
										<td>'.$line['phone'].'</td>
										<td >'.$lineF['nameFaculty'].'</td>
										<td>'.$line['function'].'</td>
										<td>'.$line['email'].'</td>
										<td class="tooltip">
											<a href="viewUser.php?update=true&idUser='.$line['idUser'].'&fullName='.$line['fullName'].'&phone='.$line['phone'].'&idFaculty='.$line['idFaculty'].'&function='.$line['function'].'&email='.$line['email'].'">
											<span class="tooltiptext">Edit User</span>
											<img src="../style/edit.ico"></a>
										</td>
										<td class="tooltip">
											<a href="viewUser.php?delete=true&idUser='.$line['idUser'].'&function='.$line['function'].'">
											<span class="tooltiptext">Remove User</span>
											<img src="../style/delete.ico"></a>
										</td>
									</tr>
								';
							}
						}
						echo'</table>';
						mysqli_close($con);
					?>
				</div>
			</div>
		</div>
	</body>
</html>
