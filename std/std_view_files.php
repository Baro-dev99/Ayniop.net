<?php
include '../login/initSessionId.php';
	if($idsent->id==0) {
		header('Location:../login/login.php');
	}else{
		$idStd = $idsent->id;
	}
	
	function convertSize($tmpSize) {
		if($tmpSize / (1000*1000) >= 1) {
			$size = number_format($tmpSize / (1000*1000), 2, '.', '') .' MB';
		}
		else if ($tmpSize / 1000 >= 1) {
			$size = number_format($tmpSize / 1000, 2, '.', '') .' KB';
		} 
		else {
			$size = number_format($tmpSize, 2, '.', '') .' B';
		}
		return $size;
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Explore Files</title>
		<meta name="description" content="website description" />
		<meta name="keywords" content="website keywords, website keywords" />
		<meta http-equiv="content-type" content="text/html; charset=windows-1252" />
		<link rel="stylesheet" type="text/css" href="../style/style.css" title="style" />
	</head>
	<body>
		<div id="main">
			<div id="header">
				<div id="logo">
					<div id="logo_text">
						<!-- class="logo_colour", allows you to change the colour of the text -->
						<h1>
							<a href="std_personal_info.php">Student
								<span class="logo_colour">Section</span>
							</a>
						</h1>
						<!--<h2>Simple. Contemporary. Website Template.</h2>-->
					</div>
				</div>
				<div id="menubar">
					<ul id="menu">
						<!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
						<li class="selected">
							<a href="std_view_files.php">Explore Files</a>
						</li>
						<li>
							<a href="std_personal_info.php">Personal Information</a>
						</li>
						<li>
							<a href="std_contact_us.php">Contact Us</a>
						</li>
						<li>
							<a href="std_logout.php">Log out</a>
						</li>
					</ul>
				</div>
			</div>
			<div id="site_content">
				<div class="sidebar">
					<!-- insert your sidebar items here -->
					<h3>Useful Links</h3>
					<ul>
						<li>
							<a href="https://www.ul.edu.lb/dalil/default.aspx" target="_blank" style="text-decoration:none">LU Official Website</a>
						</li>
						<li>
							<a href="http://sisol.ul.edu.lb/" target="_blank" style="text-decoration:none">LU Registration</a>
						</li>
						<li>
							<a href="https://www.facebook.com/ul.edu.lb" target="_blank" style="text-decoration:none">LU Facebook Page</a>
						</li>
					</ul>
					<h3>Latest News</h3>
					<ul>
						<li></li>
						<li></li>
						<li></li>
						<li></li>
						<li></li>
					</ul>
				</div>
				<div id="content">
					<!-- insert the page content here -->
					<h1>Select a subject to view its uploaded files!</h1>
					<?php 
						include "initConnection.php";
						$query = 'SELECT * FROM subject 
								  WHERE idMajor IN(select idMajor from student where idUser='.$idStd.')
								  and idYear IN(select idYear from student where idUser='.$idStd.');';
						$result = mysqli_query($con, $query);
						if(!$result) {
							die("Error in the query: " . $query);
						}
						
						$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
					?>
					<div class="form_settings">
						<form action="" method="post"><br>
							<p>
								<span>Subject</span>
								<select id="idSubject" name="idSubject" style="width:150px;margin:0 0 0 -100px">
								<option disabled selected value> -- select an option -- </option>
									<?php
									do {
										//echo'<option value="'.$line['codeSubject'].' - '.$line['nameSubject'].'">'.$line['codeSubject'].' - '.$line['nameSubject'].'</option>';
										echo'<option value="'.$line['idSubject'].'">'.$line['codeSubject'].' - '.$line['nameSubject'].'</option>';
									}while($line = mysqli_fetch_array($result, MYSQLI_ASSOC));
									mysqli_close($con);
									?>
								</select>
							</p><br><br>
							
							<p>
								<span>Files Language</span>
								<select id="language" name="language" style="width:150px;margin:0 0 0 -100px">
									<option disabled selected value> -- select an option -- </option>
									<option value="all">All</option>
									<option value="fr">French</option>
									<option value="en">English</option>
								</select>
							</p><br><br>
							
							<p>
								<input class="submit" type="submit" name="confirm" value="Confirm" style="margin:0 0 0 150px;width:100px;border-radius:6px">
							</p>
							<?php 
							$string="";
							$stringg="";
							if(isset($_POST['language']))$string=$_POST['language'];
							if(isset($_POST['idSubject']))$stringg=$_POST['idSubject'];							
							?>
							<script type="text/javascript">
								function selectlanguage() {
								var lat="<?php echo $string; ?>";
								document.getElementById('language').value=lat; 
								}
								selectlanguage();
								function selectsubject() {
								var lat="<?php echo $stringg; ?>";
								document.getElementById('idSubject').value=lat; 
								}
								selectsubject();
								selectlanguage();
							</script>	
						</form><br>
					</div>
					<?php 
						if(isset($_POST['confirm'])) {
							include "initConnection.php";
							if(isset($_POST['idSubject'])&& isset($_POST['language'])){
							$idSubject = $_POST['idSubject'];
							$language = $_POST['language'];
							
							$subjectQuery = "SELECT codeSubject FROM subject WHERE idSubject=".$idSubject.";";
							$subjectResult = mysqli_query($con, $subjectQuery);
							if(!$subjectResult) {
								die("Error in the query: " . $query);
							}
							$subjectLine = mysqli_fetch_array($subjectResult, MYSQLI_ASSOC);
							$codeSubject = $subjectLine['codeSubject'];
							
							if($language == "all") {
								$query = "SELECT * FROM document WHERE idSubject=".$idSubject.";";
								echo '<h2>Displaying results of the subject '.$codeSubject.' in both languages!</h2>';
							}
							else {
								$query = "SELECT * FROM document WHERE idSubject=".$idSubject." and language='".$language."';";
								if($language=="fr")
									$languagee="french";
								if($language=="en")
									$languagee="english";								
								echo '<h2>Displaying results of the subject '.$codeSubject.' in '.$languagee.'</h2>';
							}
							$result = mysqli_query($con, $query);
							if(!$result) {
								die("Error in the query: " . $query);
							}
							$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
							if($line['nameDocument'] == "") {
								echo '<h4>Oops! No uploaded files yet!</h4>';
								goto skipTable;
							}
							
							echo '<table style="width:100%; border-spacing:0;table-layout:auto">';
							echo '<tr>
									<th>Name</th>
									<th>Language</th>
									<th>Description</th>
									<th>Uploaded on</th>
									<th>Size</th>
									<th>Download</th>
								  </tr>';
							do{
								$abrvName = mb_substr($line['nameDocument'], 0, 20);
								$abrvDesc = mb_substr($line['description'], 0, 20);
								echo '<tr>
										<td><abbr style="text-decoration:none"title="'.$line['nameDocument'].'">'.$abrvName.'</abbr></td>
									    <td>'.$line['language'].'</td>
										<td><abbr style="text-decoration:none" title="'.$line['description'].'">'.$abrvDesc.'</abbr></td>
										<td>'.$line['uploadedDate'].'</td>
								';
										if($line['sizeDocument'] == -1) {
											echo'<td>-</td>';
											echo'<td vertical-align:top style="text-align:center"><a target="_blank" href="'.$line['nameDocument'].'"><img src="../style/link.ico"></a></td>';
										}
										else {
											echo'<td>'.convertSize($line['sizeDocument']).'</td>';
											echo'<td vertical-align:top style="text-align:center"><a href="../prof/uploads/Prof'.$line['idUser'].'/'.$subjectLine['codeSubject'].'/'.$line['nameDocument'].'" download><img src="../style/download.ico"></a></td>';
										}
							echo	'</tr>';
								
							} while($line = mysqli_fetch_array($result, MYSQLI_ASSOC));
							echo '</table>';
							skipTable:
							mysqli_close($con);
							}
						}
					?>
				</div>
			</div>
		</div>
	</body>
</html>