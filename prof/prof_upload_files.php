<?php
include '../login/initSessionId.php';
	if($idsent->id==0) {
		header('Location:../login/login.php');
	}else{
		$idProf = $idsent->id;
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
		<title>Upload</title>
		<meta name="description" content="website description" />
		<meta name="keywords" content="website keywords, website keywords" />
		<meta http-equiv="content-type" content="text/html; charset=windows-1252" />
		<link rel="stylesheet" type="text/css" href="../style/style.css" title="style" />
		<script>
			function linkOption() {
				var linkChk = document.getElementById("link");
				var UploadDiv = document.getElementById("UploadDiv");
				var fileToUpload = document.getElementById("fileToUpload");
				var linkDiv = document.getElementById("linkDiv");
				var linkUrl = document.getElementById("linkUrl");
				
				if(linkChk.checked) {
					fileToUpload.disabled = true;
					UploadDiv.style.display = "none";
					linkUrl.type = "text";
					linkUrl.disabled = false;
					linkDiv.style.display = "block";
				}
				else {
					fileToUpload.disabled = false;
					UploadDiv.style.display = "block";
					linkUrl.type = "hidden";
					linkUrl.disabled = true;
					linkDiv.style.display = "none";
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
							<a href="prof_personal_info.php">Professor
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
							<a href="prof_upload_files.php">Upload</a>
						</li>
						<li>
							<a href="prof_view_uploaded.php">View Files</a>
						</li>
						<li>
							<a href="prof_personal_info.php">Personal Information</a>
						</li>
						<li>
							<a href="prof_contact_us.php">Contact Us</a>
						</li>
						<li>
							<a href="prof_logout.php">Log out</a>
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
					<h1>Upload a file for your Students Below!</h1>
					
					<?php
						//FILE UPLOAD SCRIPT HERE!
						if(isset($_POST['submit'])) {
							if(isset($_POST['linkUrl'])) { 	
								include "initConnection.php";
								$idSubject = $_POST['idSubject'];
								$description = $_POST['description'];
								$nameDocument = $_POST['linkUrl'];
								//$typeDocument = $_FILES['fileToUpload']['type'];
								$sizeDocument = -1;
								$uploadedDate = date('Y-m-d H:i:s');
								$language = $_POST['language'];
								$idUser = $idsent->id;//
								
								$query4 = 'INSERT INTO document 
										  (idSubject, description, nameDocument, sizeDocument, uploadedDate, language, idUser)
										   VALUES
										  ('.$idSubject.', "'.$description.'", "'.$nameDocument.'", '.$sizeDocument.', "'.$uploadedDate.'", "'.$language.'", '.$idUser.');';
								mysqli_query($con, $query4);
								echo'<h4 style="color:green;">Link Uploaded Successfully!</h4>';
								mysqli_close($con);
							}
							else {
								if(!file_exists('uploads/Prof'.$idProf)) {
									mkdir('uploads/Prof'.$idProf.'', 0777, true);
								}
							
								// sub-folder
								if(isset($_POST['idSubject'])) {
									$idSubject = $_POST['idSubject'];
									include "initConnection.php";
									$query2 = 'SELECT codeSubject FROM subject WHERE idSubject='.$idSubject.';';
									$result2 = mysqli_query($con, $query2);
									if(!$result2) {
										die("Error in the query: " . $query2);
									}
									$line2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
									$codeSubject = $line2['codeSubject'];
									
									if(!file_exists('uploads/Prof'.$idProf.'/'.$codeSubject)) {
										mkdir('uploads/Prof'.$idProf.'/'.$codeSubject.'', 0777, true);
									}
									$target_dir = "uploads/Prof".$idProf."/".$codeSubject."/";
								}
								
								if(isset($_FILES['fileToUpload'])){
									//echo'hello';
									$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
									$errors= array();
									//$file_name = $_FILES['fileToUpload']['name'];
									$file_size = $_FILES['fileToUpload']['size'];
									$file_tmp = $_FILES['fileToUpload']['tmp_name'];
									$file_type = $_FILES['fileToUpload']['type'];
									$file_ext = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
								  
									$extensions= array("jpeg","jpg","png","docx","pptx","rar","zip","txt","html","doc","pdf","mp4","mkv");
								  
									/*if(in_array($file_ext,$extensions)=== false){
										$errors[]="extension not allowed!";
										echo '<h4 style="color:red;">Extension (.'.$file_ext.') is not allowed!</h4>';
										goto check;
									}*/
								  
									if($file_size > 50000000) {
										$errors[]='File size exceeds 50 MB!';
										echo '<h4 style="color:red;">File size exceeds 50 MB!</h4>';
										goto check;
									}
								  
									if (file_exists($target_file)) {
										$errors[]="Sorry, file already exists!";
										echo'<h4 style="color:red;">File already exists!</h4>';
									}
								  
									check:
									if(empty($errors)==true) {
										move_uploaded_file($file_tmp, $target_file);
										
										$idSubject = $_POST['idSubject'];
										$description = $_POST['description'];
										$nameDocument = $_FILES['fileToUpload']['name'];
										//$typeDocument = $_FILES['fileToUpload']['type'];
										$sizeDocument = $_FILES['fileToUpload']['size'];
										$uploadedDate = date('Y-m-d H:i:s');
										$language = $_POST['language'];
										$idUser = $idsent->id;//
										
										$query3 = 'INSERT INTO document 
												  (idSubject, description, nameDocument, sizeDocument, uploadedDate, language, idUser)
												   VALUES
												  ('.$idSubject.', "'.$description.'", "'.$nameDocument.'", '.$sizeDocument.', "'.$uploadedDate.'", "'.$language.'", '.$idUser.');';
										mysqli_query($con, $query3);
										mysqli_close($con);
										echo'<h4 style="color:green;">File Uploaded Successfully!</h4>';
									}else{
										echo'<h4 style="color:red;">File NOT uploaded!</h4>';
									}
								}
							}
						}
					?>
					
					<?php
						include "initConnection.php";
						$query = 'SELECT * FROM subject WHERE idSubject IN(SELECT idSubject FROM professor WHERE idUser='.$idProf.');';
						$result = mysqli_query($con, $query);
						if(!$result) {
							die("Error in the query: " . $query);
						}
						$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
					?>
					
					<div class="form_settings">
						<form name="myForm" action="" method="post" onsubmit="return validateForm();" required enctype="multipart/form-data">
							<p>
								<span>Subject</span>
								<select id="idSubject" name="idSubject" style="width:150px;margin:0 0 0 -100px">
									<?php
									do {
										echo'<option value="'.$line['idSubject'].'">'.$line['codeSubject'].' - '.$line['nameSubject'].'</option>';
									}while($line = mysqli_fetch_array($result, MYSQLI_ASSOC));
									?>
								</select>
							</p><br><br>
							
							<p>
								<span>Language</span>
								<select id="language" name="language" style="width:150px;margin:0 0 0 -100px">
									<option value="fr">French</option>
									<option value="en">English</option>
								</select>
							</p><br><br>
							
							<p>
								<span>Description</span>
								<textarea required rows="4" cols="50" name="description" style="margin:0 0 0 -100px;resize:none"></textarea>
							</p><br>
							
							<p>
								<span>Link</span>
								<input type="checkbox" id="link" onclick="return linkOption();" name="link" style="margin:0 0 0 -245px">
							</p><br>
							
							<div id="linkDiv" style="display:none">
								<p>
									<span>URL</span>
									<input type="hidden" required disabled name="linkUrl" id="linkUrl" style="margin:0 0 0 -100px;resize:none">
								</p><br>
							</div>
						
							<div id="UploadDiv">
								<p>
									<span>File to Upload</span>
									<input required type="file" name="fileToUpload" id="fileToUpload" style="margin:0 0 0 100px">
								<p>
								<span style="margin:0 0 0 100px"><i>(File size must NOT excced 50MB!)</i></span><br><br>
							</div>
							
							<?php //echo'<input type="hidden" name="idProf" value="'.$idProf.'">';?>
							<?php mysqli_close($con); ?>
							
							<input class="submit" type="submit" name="submit" value="Upload" style="margin:0 0 0 200px;border-radius:6px">
						</form>
						<br>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>