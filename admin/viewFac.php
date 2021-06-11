<?php
	/*if(isset($_POST['addFac'])) {
		include "initConnection.php";
		$facultyName = $_POST['facultyName'];
		$query = "select * from faculty where nameFaculty='$facultyName'";
		$result = mysqli_query($con, $query);
		$nbrow=mysqli_num_rows($result);
		if($nbrow!=0){
		?>
			<script type="text/javascript">
				wrong();
				document.getElementById('zzz').innerHTML ='Error while trying to add a new faculty !!<br> Pls enter a different value<br>';
			</script>
		<?php
		}
		
		$query = "insert into faculty values(default, '$facultyName')";
		mysqli_query($con, $query);
		mysqli_close($con);
	
	
	if(isset($_GET['delete'])) {
		include "initConnection.php";
		$idFaculty = $_GET['delete'];
		$query = 'DELETE FROM faculty WHERE idFaculty='.$idFaculty.';';
		mysqli_query($con, $query);
		mysqli_close($con);
	}
	
	if(isset($_GET['update'])) {
		$nameFaculty = $_GET['update'];
		header("Location: updateFac.php?nameFaculty=".$nameFaculty);
		exit();
	}*/
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Faculty</title>
		<meta name="description" content="website description" />
		<meta name="keywords" content="website keywords, website keywords" />
		<meta http-equiv="content-type" content="text/html; charset=windows-1252" />
		<link rel="stylesheet" type="text/css" href="../style/styleAdmin.css" title="style" />
		<style>
			.btn button:focus{
				background:transparent;
				border:none;
				border-color:red;
			}
			button:active{
				border:none;
				border-style:transparent;
			}
		</style>
		<script>
			function wrongAdd(){
				document.getElementById('zzz').innerHTML ='Duplicate value : Error while trying to add a new FACULTY :)  <br> Try with adding a different value(s) (:<br>';
			}
			function rightAdd(){
				document.getElementById('zzz').innerHTML = 'FACULTY Has Been Added Successfully <3';
			}
			function rightDel(){
				document.getElementById('zzz').innerHTML ='FACULTY Has Been Deleted Successfully <3';
			}
			function rightUp(){
				document.getElementById('zzz').innerHTML ='FACULTY Has Been Updated Successfully <3';
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
							<a href="viewFac.php">Admin
								<span class="logo_colour">Section</span>
							</a>
						</h1>
						<!-- <h2>Simple. Contemporary. Website Template.</h2> -->
					</div>
				</div>
				<div id="menubar">
					<ul id="menu">
						<!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
						<li class="selected">
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
					<h1>Faculty Management</h1><br> 
					<div class="form_settings">
						<!--<form action="" method="post">
							<p>
								<!--<input class="submit" type ="submit" name="add" value="Add a new Faculty" style="margin:0 0 0 0px;width:150px"/->
							</p><br>
							<p>
								<!--<input class="submit" type ="submit" name="edit" value="Edit Faculties" style="margin:0 0 0 0px;width:150px"/>->
							</p><br><br>
							<p id="zzz" style="font-size:small;color:red;font-weight:normal;margin-top:20px;"></p><br>
						</form-->
						<?php
							// ADD OPTION
							if(isset($_REQUEST['addFaculty'])) {
								?>
									<form name="formAdd" action="#link" method="post" onsubmit="return validateFormAdd();" required>
										<p>
											<span>Faculty Name</span> 
											<input required name="facultyName" style="width:200px;margin:0 0 0 -100px">
										</p>
										<p>
											<input class="submit" type ="submit" name="addFac" value="Add" style="margin:0 0 0 215px;"/>
										</p><br><br>
									</form>
								<?php
							}
							
							if(isset($_POST['addFac'])) {
								include "initConnection.php";
								$facultyName = $_POST['facultyName'];
								$query = "select * from faculty where nameFaculty='$facultyName'";
								$result = mysqli_query($con, $query);
								$nbrow=mysqli_num_rows($result);
								if($nbrow!=0){
								?>
									<script type="text/javascript">
										wrongAdd();
									</script>
								<?php 
								//header("Location: viewFac.php");
								//exit();
								}
								
								$query = "insert into faculty values(default, '$facultyName')";
								mysqli_query($con, $query);
								mysqli_close($con);
								?>
									<script type="text/javascript">
										rightAdd();
									</script>
								<?php 
								//exit();
							}
							
							
							   // DELETE OPTION
							if(isset($_REQUEST['delete'])) {
								include "initConnection.php";
								$idFaculty = $_REQUEST['delete'];
								$query = 'DELETE FROM faculty WHERE idFaculty='.$idFaculty.';';
								mysqli_query($con, $query);
								mysqli_close($con);
								header("Location: ?#link");
								?>
									<script type="text/javascript">
										rightDel();
									</script>
								<?php
							} 
							
							// UPDATE OPTION
							if(isset($_POST['up'])) {
								$nameFaculty = $_POST['up'];?> 
								<form action="#link" method="post">
									<p>
										<span>Faculty Name</span>
										<input required name="facultyName" value="<?php echo $nameFaculty; ?>" style="width:200px;margin:0 0 0 -100px">
									</p>
										<input type="hidden" name="hidden" value="<?php echo $nameFaculty; ?>">
									<p>
										<input class="submit" type ="submit" name="update" value="Update" style="margin:0 0 0 215px;"/>
									</p><br><br>
								</form>
							<?php }
							
							if(isset($_POST['update'])) {
								include "initConnection.php";
								$facultyName = $_POST['facultyName'];
								$hidden = $_POST['hidden'];
								$query = 'UPDATE faculty SET nameFaculty="'.$facultyName.'" WHERE nameFaculty="'.$hidden.'";';
								mysqli_query($con, $query);
								mysqli_close($con);
								?>
									<script type="text/javascript">
										rightUp();
									</script>
								<?php
								//header("Location: viewFac.php");
								//exit();
							}
							
							// EDIT OPTION
							//if(isset($_POST['edit'])) {
								include "initConnection.php";
								$query = 'SELECT * FROM faculty order by idFaculty';
								$result = mysqli_query($con, $query);
								?>
									<table id="link" border="0" style="width:100%; border-spacing:0;table-layout:auto;">
									<tr>
										<!--th>ID</th-->
										<th style="text-align:left;">Faculty Name</th>
										<th>Edit</th>
										<th>Delete</th>
										<th> 
											<form action="" method="post">
												<input type="hidden" name="addFaculty" value="">
												<button class="tooltip" style="border:none;border-style:transparent;background:#3B3B3B" type="submit">
													<span class="tooltiptext">Add a faculty</span>
													<img src="../style/addN.ico">
												</button>
											</form>
										</th>
									</tr>
								<?php
								//<th><a method="post" href="viewFac.php?addFaculty"><img src="../style/addN.ico"></a></th>
								while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
									echo'
										<tr>
											<!--td>'.$line['idFaculty'].'</td-->
											<td style="text-align:left;">'.$line['nameFaculty'].'</td>
											<td> 
												<form action="viewFac.php" method="post">
													<input type="hidden" name="up" value="'.$line['nameFaculty'].'">
													<button class="tooltip" style="border:none;border-style:transparent;" type="submit">
														<span class="tooltiptext">Edit faculty</span>
														<img src="../style/edit.ico">
													</button>
												</form>
											</td>
											<td class="tooltip" ><a href="viewFac.php?delete='.$line['idFaculty'].'">
												<span class="tooltiptext">Remove faculty</span>
												<img src="../style/delete.ico"></a>
											</td>
											<td></td>
										</tr>
									';
								}
								echo'</table>';
								//<td><a href="viewFac.php?nameFaculty='.$line['nameFaculty'].'"><img src="../style/edit.ico"></a></td>
								//<button type="submit"><img src="../style/delete.ico"></button>
								//<td><a href="viewFac.php?delete='.$line['idFaculty'].'"><img src="../style/delete.ico"></a></td>
							/*
							<td> 
								<form action="viewFac.php" method="post">
								<input type="hidden" name="delete" value="'.$line['idFaculty'].'">
								<button style="border:none;" type="submit"><img src="../style/delete.ico"></button>
								</form>
							</td>
							
							//}
							
							
							 */
							
						?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
