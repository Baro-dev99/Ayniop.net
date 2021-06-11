<!DOCTYPE HTML>
<html>
	<head>
		<title>Year</title>
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
						<li>
							<a href="viewMaj.php">Major</a>
						</li>
						<li class="selected">
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
					<h1>Academic Years Management</h1><br>
						<div class="form_settings">
							
							<?php
							// ADD OPTION
							if(isset($_GET['add'])) {?>
								<form name="formAdd" action="" method="get">
									<p>
										<span>Faculty</span>
										<input type="hidden" name="add" value="">
										<select required id="a" name="selectFac" onchange="this.form.submit();" style="width:200px;margin:0 0 0 -100px;">
										<option disabled selected value> -- select an option -- </option>
										<?php 
											include "initConnection.php";
											$query = "SELECT * FROM faculty";
											$result = mysqli_query($con, $query);
											while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
												echo '<option value="'.$line['nameFaculty'].'">'.$line['nameFaculty'].'</option>';
											}
										?>
										</select>
										<input type="hidden" name="kk"/>
									</p><br>
								</form>
							<?php }if(isset($_GET['kk'])){ ?>
									<form name="formAdd" action="" method="get">
										<p>
											<span>Major</span>
											<input type="hidden" name="add" value="">
											<select required id="b" name="selectMajor" onchange="this.form.submit()" style="width:200px;margin:0 0 0 -100px">
											<option disabled selected value> -- select an option -- </option>
												<?php
												include "initConnection.php";
												$selectFac = '';
												if(isset($_GET['selectFac'])){
													$selectFac = $_GET['selectFac'];
													$query = "SELECT * FROM major where idFaculty IN
													(select idFaculty from faculty where nameFaculty = '$selectFac')";
													$result = mysqli_query($con, $query);
													
													while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
														echo '<option value="'.$line['nameMajor'].'">'.$line['nameMajor'].'</option>';
													}
												}
											?>
											</select>
											<input type="hidden" name="kkk"/><input type="hidden" name="kk"/>
											<input type="hidden" name="selectFac" value="<?php echo $selectFac;?>"/>
										</p><br>
									</form>
								<?php }if(isset($_GET['kkk'])){ ?>
									<form name="formAdd" action="" method="get">
										<p>
											<span>Year</span>
											<input type="hidden" name="add" value="">
											<select required id="c" name="selectYear" onchange="this.form.submit()" style="width:200px;margin:0 0 0 -100px">
											<option disabled selected value> -- select an option -- </option>
											<?php 
												include "initConnection.php";
												if(isset($_GET['selectMajor'])){
													$selectMajor = $_GET['selectMajor'];
													/* $query = "SELECT year FROM year where idMajor IN 
													(select idMajor from major where nameMajor= '$selectMajor') order by year"; */
													$query = "SELECT distinct(year) FROM year order by year";
													$result = mysqli_query($con, $query);
													while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
														if($line['year']==4)
															echo '<option value="'.$line['year'].'">M1</option>';
														else if($line['year']==5)
															echo '<option value="'.$line['year'].'">M2</option>';
														else echo '<option value="'.$line['year'].'">L'.$line['year'].'</option>';
													}
													//x = "<?php header('Location: ?#a'); ? >";
												}
											?>
											</select>
											<input type="hidden" name="kkkk"/><input type="hidden" name="kk"/><input type="hidden" name="kkk"/>
											<input type="hidden" name="selectFac" value="<?php echo $selectFac;?>"/>
											<input type="hidden" name="selectMajor" value="<?php echo $selectMajor;?>"/>
										</p><br>
									</form>
									
								<?php }if(isset($_GET['kkkk'])){ ?>
									<form name="formAdd" action="" method="get">
										<p>
											<input class="submit" type ="submit" name="addYear" value="Add" style="margin:0 0 0 200px;"/>
											<input type="hidden" name="selectYear" value="<?php echo $_GET['selectYear'];?>"/>
											<input type="hidden" name="selectMajor" value="<?php echo $_GET['selectMajor'];?>"/>
										</p><br><br>
									</form>
								<?php }
							
										$zz=$zzz=$zzzz='';
										 if(isset($_GET['selectFac'])){
											//header('Location: ?#a');
											$zz = $_GET['selectFac'];
											//echo $zz;
										}
										if(isset($_GET['selectMajor'])){
											$zzz = $_GET['selectMajor'];
											//echo $zzz;
										}
										if(isset($_GET['selectYear'])){
											$zzzz = $_GET['selectYear'];
											//echo $zzzz;
										}
							
									?>
								
							
							
							<script type="text/javascript">
							//alert('a');
							
							function selectFac(){
								var x = "<?php echo $zz; ?>";
								document.getElementById('a').value = x;
							} 
							selectFac();
							//alert('b');
							function selectMajor(){
								var x = "<?php echo $zzz; ?>";
								document.getElementById('b').value = x;
							}
							selectMajor();
							//alert('c');
							function selectYear(){
								var x = "<?php echo $zzzz; ?>";
								document.getElementById('c').value = x;
							}
							selectYear();
							</script>
						
						
							<?php 
							if(isset($_GET['addYear'])) {
								include "initConnection.php";
								$majorName = $_GET['selectMajor'];
								$year = $_GET['selectYear'];
								
								// if exists return
								$query = "select * from year where year='$year' and idMajor In
								(select idMajor from major where nameMajor='$majorName')";
								$result = mysqli_query($con, $query);
								$nbrow=mysqli_num_rows($result);
								if($nbrow!=0){
									//header("Location: ?#link");
									exit();
								}
								
								// else
								$query = "select * from major where nameMajor = '$majorName'";
								$result = mysqli_query($con, $query);
								$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
								$var = $line['idMajor'];
								
								$query = "insert into year values(default, '$year', $var)";
								mysqli_query($con, $query);
								//mysqli_close($con);
								$q = 'SELECT * FROM major m , year y where m.idMajor = y.idMajor';
								$result = mysqli_query($con, $q);
								$nb=mysqli_num_rows($result);
								if($nb>15){
									$v = $nb-10;
									header("Location: ?#$v");
								}else header("Location: ?#link");
							}
							
							// DELETE OPTION
							if(isset($_GET['delete'])) {
								include "initConnection.php";
								$idYear = $_GET['delete'];
								$query = 'DELETE FROM year WHERE idYear='.$idYear.';';
								mysqli_query($con, $query);
								mysqli_close($con);
								header("Location: ?#link");
							}

							
							// EDIT OPTION ?>
							
							<table id="link" border="0" style="width:100%; border-spacing:0;table-layout:auto">
							<tr>
								<!--th>ID</th-->
								<th>Year</th>
								<th style="text-align:left;">Major</th>
								<th>Delete</th>
								<th> 
									<form action="viewYear.php" method="GET">
										<input type="hidden" name="add" value="">
										<button class="tooltip" style="border:none;border-style:transparent;background:#3B3B3B" type="submit">
											<span class="tooltiptext">Add a year</span>
											<img src="../style/addN.ico">
										</button>
									</form>
								</th>
							</tr>
							<?php
							include "initConnection.php";
							$query = 'SELECT * FROM major m , year y where m.idMajor = y.idMajor';
							$result = mysqli_query($con, $query);
							$i=0;
							
							while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
								if($line['year']==4)
									$zz ='M1';
								else if($line['year']==5)
									$zz ='M2';
								else $zz = 'L'.$line['year'];
								
								echo '
									<tr id='.$i++.'>
										<!--td>'.$line['idYear'].'</td-->
										<td>'.$zz.'</td>
										<td style="text-align:left;">'.$line['nameMajor'].'</td>
										<td class="tooltip">
											<a href="viewYear.php?delete='.$line['idYear'].'">
												<span class="tooltiptext">Remove year</span>
												<img src="../style/delete.ico">
											</a>
										</td>
										<td></td>
									</tr>';
							}
							?>
							
							</table>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
