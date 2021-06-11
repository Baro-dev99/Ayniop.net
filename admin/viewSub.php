<?php
/*
	if(isset($_POST['addSub'])) {
		include "initConnection.php";
		$subjectCode = $_POST['subjectCode'];
		$subjectName = $_POST['subjectName'];
		$yearId = $_POST['yearId'];
		$majorId = $_POST['majorId'];
		$query = 'INSERT INTO subject (codeSubject,nameSubject,idYear,idMajor) VALUES("'.$subjectCode.'","'.$subjectName.'",'.$yearId.','.$majorId.');';
		mysqli_query($con, $query);
		mysqli_close($con);
	}
	
	if(isset($_GET['delete'])) {
		include "initConnection.php";
		$idSubject = $_GET['idSubject'];
		$query = 'DELETE FROM subject WHERE idSubject='.$idSubject.';';
		mysqli_query($con, $query);
		mysqli_close($con);
		header("Location: viewSub.php?reEdit=true");
		exit();
	}
	
	if(isset($_GET['update'])) {
		include "initConnection.php";
		$idSubject = $_GET['idSubject'];
		$codeSubject = $_GET['codeSubject'];
		$nameSubject = $_GET['nameSubject'];
		$idYear = $_GET['idYear'];
		$idMajor = $_GET['idMajor'];
		header('Location: updateSub.php?fromView=true&idSubject='.$idSubject.'&codeSubject='.$codeSubject.'&nameSubject='.$nameSubject.'&idYear='.$idYear.'&idMajor='.$idMajor);
		exit();
	}
*/
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Subject</title>
		<meta name="description" content="website description" />
		<meta name="keywords" content="website keywords, website keywords" />
		<meta http-equiv="content-type" content="text/html; charset=windows-1252" />
		<link rel="stylesheet" type="text/css" href="../style/styleAdmin.css" title="style" />
		<script>
			function validateFormAdd() {
			  var x = document.forms["formAdd"]["subjectName"].value;
			  if (x == "" || x == null) {
				return false;
			  }
			  else {
				  alert("Subject Added!");
				  return true;
			  }
			}
		</script>
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
						<li class="selected">
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
					<h1>Subjects Management</h1><br>
					<div class="form_settings">
						<!--
						<form action="" method="post">
							<p>
								<input class="submit" type ="submit" name="add" value="Add a new Subject" style="margin:0 0 0 0px;width:150px"/>
							</p><br>
							<p>
								<input class="submit" type ="submit" name="edit" value="Edit Subjects" style="margin:0 0 0 0px;width:150px"/>
							</p><br><br>
						</form>
						-->
						<?php
							// ADD OPTION
							if(isset($_REQUEST['addSubject'])) {			
						?>
								<form action="#link" method="post">
									<p>
										<span>Subject Code</span>
										<input required name="subjectCode" style="width:200px;margin:0 0 0 -100px">
									</p>
									<p>
										<span>Subject Name</span>
										<input required name="subjectName" style="width:200px;margin:0 0 0 -100px">
									</p>
									<p>
										<span>Major</span>
										<select name="majorId" style="width:212px;margin:0 0 0 -100px">
											<?php
												include "initConnection.php";
												$query = 'SELECT * FROM major ORDER BY nameMajor;';
												$result = mysqli_query($con, $query);
												for($i = 0; $i <= mysqli_num_rows($result); $i++) {
													$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
													echo'<option value="'.$line['idMajor'].'">'.$line['nameMajor'].'</option>';
												}
												mysqli_close($con);
											?>
										</select>
									</p>
									<p>
										<span>Year</span>
										<select name="year" style="width:212px;margin:0 0 0 -100px">
											<?php
												for($i = 1; $i <= 5; $i++)
													echo'<option value="'.$i.'">'.$i.'</option>';
											?>
										</select>
									</p>
									<p>
										<input class="submit" type ="submit" name="addSub" value="Add" style="margin:0 0 0 215px;"/>
									</p><br>
								</form>
						<?php	
							}
								
							if(isset($_POST['addSub'])) {
								include "initConnection.php";
								$subjectCode = $_POST['subjectCode'];
								$subjectName = $_POST['subjectName'];
								$majorId = $_POST['majorId'];
								$year = $_POST['year'];
								
								$query = 'SELECT * FROM year WHERE idMajor='.$majorId.' and year='.$year.';';
								$result = mysqli_query($con, $query);
								$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
								
								$query1 = 'INSERT INTO subject VALUES(default, "'.$subjectCode.'","'.$subjectName.'",'.$line['idYear'].','.$majorId.');';
								mysqli_query($con, $query1);
								mysqli_close($con);
							}
							
							// DELETE OPTION
							if(isset($_GET['deleteSubject'])) {
								include "initConnection.php";
								$idSubject = $_GET['idSubject'];
								$query = 'DELETE FROM subject WHERE idSubject='.$idSubject.';';
								mysqli_query($con, $query);
								mysqli_close($con);
								header("Location: ?#link");
							}
							
							// UPDATE OPTION
							if(isset($_POST['updateSubject'])) {
								$idSubject = $_POST['idSubject'];
								$codeSubject = $_POST['codeSubject'];
								$nameSubject = $_POST['nameSubject'];
								$idMajor = $_POST['idMajor'];
								$nameYear = $_POST['nameYear'];
						?>
								<form action="#link" method="post">
									<p>
										<span>Subject ID</span>
										<input readonly name="subjectIdUp" value="<?php echo $idSubject ; ?>" style="width:200px;margin:0 0 0 -100px">
									</p>
									<p>
										<span>Subject Code</span>
										<input required name="subjectCodeUp" value="<?php echo $codeSubject; ?>" style="width:200px;margin:0 0 0 -100px">
									</p>
									<p>
										<span>Subject Name</span>
										<input required name="subjectNameUp" value="<?php echo $nameSubject; ?>" style="width:200px;margin:0 0 0 -100px">
									</p>
									<p>
										<span>Major</span>
										<select name="majorIdUp" style="width:212px;margin:0 0 0 -100px">
											<?php
												include "initConnection.php";
												$query = 'SELECT * FROM major ORDER BY nameMajor;';
												$result = mysqli_query($con, $query);
												for($i = 0; $i <= mysqli_num_rows($result); $i++) {
													$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
													if($line['idMajor'] == $idMajor)
														echo'<option selected value="'.$line['idMajor'].'">'.$line['nameMajor'].'</option>';
													echo'<option value="'.$line['idMajor'].'">'.$line['nameMajor'].'</option>';
												}
												mysqli_close($con);
											?>
										</select>
									</p>
									<p>
										<span>Year</span>
										<select name="yearUp" style="width:212px;margin:0 0 0 -100px">
											<?php
												for($i = 1; $i <= 5; $i++) {
													if($nameYear == $i)
														echo'<option selected value="'.$i.'">'.$i.'</option>';
													else
														echo'<option value="'.$i.'">'.$i.'</option>';
												}
											?>
										</select>
									</p>
									<p>
										<input class="submit" type ="submit" name="update" value="Update" style="margin:0 0 0 215px;"/>
									</p><br>
								</form>

						<?php
							}
							if(isset($_POST['update'])) {
								include "initConnection.php";
								$subjectIdUp = $_POST['subjectIdUp'];
								$subjectCodeUp = $_POST['subjectCodeUp'];
								$subjectNameUp = $_POST['subjectNameUp'];
								$majorIdUp = $_POST['majorIdUp'];
								$yearUp = $_POST['yearUp'];
								
								$query = 'SELECT * FROM year WHERE idMajor='.$majorIdUp.' and year='.$yearUp.';';
								$result = mysqli_query($con, $query);
								$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
								
								$query1 = $query = 'UPDATE subject SET codeSubject="'.$subjectCodeUp.'", nameSubject="'.$subjectNameUp.'", idYear='.$line['idYear'].', idMajor='.$majorIdUp.' WHERE idSubject='.$subjectIdUp.';';
								mysqli_query($con, $query1);
								mysqli_close($con);
							}
						?>
						
						<?php
							// Table
							include "initConnection.php";
							$query = 'SELECT * FROM subject ORDER BY idYear,idMajor';
							$result = mysqli_query($con, $query);
							echo'
								<table id="link" style="width:100%; border-spacing:0;table-layout:auto">
								<tr>
									<!--th>ID</th-->
									<th>Subject Code</th>
									<th>Subject Name</th>
									<th>Major</th>
									<th>Year</th>
									<th>Edit</th>
									<th>Delete</th>
									<th>
										<form action="" method="post">
											<input type="hidden" name="addSubject" value="">
											<button class="tooltip" style="border:none;border-style:transparent;background:#3B3B3B" type="submit">
												<span class="tooltiptext">Add a subject</span>
												<img src="../style/addN.ico">
											</button>
										</form>
									</th>
								</tr>
							';
							while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
								$query1 = 'SELECT * FROM major WHERE idMajor='.$line['idMajor'].';';
								$result1 = mysqli_query($con, $query1);
								$line1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
								
								$query2 = 'SELECT * FROM year WHERE idYear='.$line['idYear'].';';
								$result2 = mysqli_query($con, $query2);
								$line2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
								if($line2['year']==4)
									$zz ='M1';
								else if($line2['year']==5)
									$zz ='M2';
								else $zz = 'L'.$line2['year'];
								echo'
									<tr>
										<!--td>'.$line['idSubject'].'</td-->
										<td>'.$line['codeSubject'].'</td>
										<td>'.$line['nameSubject'].'</td>
										<td>'.$line1['nameMajor'].'</td>
										<td>'.$zz.'</td>									
										<td> 
											<form action="viewSub.php" method="post">
												<input type="hidden" name="updateSubject" value="true">
												<input type="hidden" name="idSubject" value="'.$line['idSubject'].'">
												<input type="hidden" name="codeSubject" value="'.$line['codeSubject'].'">
												<input type="hidden" name="nameSubject" value="'.$line['nameSubject'].'">
												<input type="hidden" name="idYear" value="'.$line['idYear'].'">
												<input type="hidden" name="idMajor" value="'.$line['idMajor'].'">
												<input type="hidden" name="nameYear" value="'.$line2['year'].'">
												<button class="tooltip"  style="border:none;border-style:transparent;" type="submit">
													<span class="tooltiptext">Edit Subject</span>
													<img src="../style/edit.ico">
												</button>
											</form>
										</td>
										<td class="tooltip">
											<a href="viewSub.php?deleteSubject=true&idSubject='.$line['idSubject'].'">
												<span class="tooltiptext">Remove Subject</span>
												<img src="../style/delete.ico">
											</a>
										</td>
										<td></td>
									</tr>
								';
							}
							echo'</table>';
							mysqli_close($con);
						?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
