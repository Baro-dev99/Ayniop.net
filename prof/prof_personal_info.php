<?php 
include '../login/initSessionId.php';
	if($idsent->id==0) {
		header('Location:../login/login.php');
	}else{
		$idProf = $idsent->id;
	}
	
	if(isset($_POST['saveChanges'])) {
		include "initConnection.php";
		
		$fullName = $_POST['fullName'];
		$phone = $_POST['phone'];
		$password = $_POST['password'];
		
		//Send mail if pass changed
		$queryPass = 'SELECT * FROM user WHERE idUser='.$idProf.';';
		$resultPass = mysqli_query($con, $queryPass);
		$linePass = mysqli_fetch_array($resultPass, MYSQLI_ASSOC);
		if($linePass['password'] != $password) {
			$to       = ''.$email;
			$subject  = 'AYNIOP Password Change';
			$message  = 'Dear '.$fullName.', your password was changed recently. ' .
						'If you did NOT make this change, please contact the administrators as soon as possible!';
			$headers  = 'From: ayniop@gmail.com' . "\r\n" .
						'MIME-Version: 1.0' . "\r\n" .
						'Content-type: text/html; charset=utf-8';
			mail($to, $subject, $message, $headers);
		}
		
		$query = 'UPDATE user SET fullName="'.$fullName.'", password="'.$password.'", phone="'.$phone.'" WHERE idUser='.$idProf.';';
		mysqli_query($con, $query);
		mysqli_close($con);
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
			<style>
		::selection {
		  background:none;
		  color:none;
		  text-shadow:none;
		}	
		</style>
		<title>Personal Info.</title>
		<meta name="description" content="website description" />
		<meta name="keywords" content="website keywords, website keywords" />
		<meta http-equiv="content-type" content="text/html; charset=windows-1252" />
		<link rel="stylesheet" type="text/css" href="../style/style.css" title="style" />
		<script>
			function validateForm() {
			  var x = document.forms["myForm"]["fullName"].value;
			  var y = document.forms["myForm"]["phone"].value;
			  var z = document.forms["myForm"]["password"].value;
			  if (x == "" || x == null || y == "" || y == null || z == "" || z == null) {
				alert("Please describe your problem below!");
				return false;
			  }
			  else {
				  alert("Changes saved successfully!");
				  return true;
			  }
			}
			
			function showPassword() {
			  var x = document.getElementById("password");
			  if (x.type == "password") {
				x.type = "text";
			  } else {
				x.type = "password";
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
						<!-- <h2>Simple. Contemporary. Website Template.</h2> -->
					</div>
				</div>
				<div id="menubar">
					<ul id="menu">
						<!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
						<li>
							<a href="prof_upload_files.php">Upload</a>
						</li>
						<li>
							<a href="prof_view_uploaded.php">View Files</a>
						</li>
						<li class="selected">
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
			<div id="content_header"></div>
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
					<h1>View your personal information below!</h1>
					<?php 
						include "initConnection.php";
						$query = 'SELECT * FROM user WHERE idUser='.$idProf.';';
						$query2 = 'SELECT * FROM subject WHERE idSubject IN(SELECT idSubject FROM professor WHERE idUser='.$idProf.');';
						$query3 = 'SELECT * FROM faculty WHERE idFaculty IN(SELECT idFaculty FROM user WHERE idUser='.$idProf.');';
						
						$result = mysqli_query($con, $query);
						$result2 = mysqli_query($con, $query2);
						$result3 = mysqli_query($con, $query3);
						
						if(!$result) {
							die("Error in the query: " . $query);
						}
						if(!$result2) {
							die("Error in the query: " . $query2);
						}
						if(!$result3) {
							die("Error in the query: " . $query2);
						}
						
						$line = mysqli_fetch_array($result, MYSQLI_ASSOC); // stores in associative array
						$line2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
						$line3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
					?>
					<div class="form_settings">
						<form name="myForm" action="" method="post" onsubmit="return validateForm();" required>
							<br>
							<p>
								<span>Full Name:</span>
								<input required id="fullName" name="fullName" value="<?php echo $line['fullName']; ?>" style="width:200px;margin:0 0 0 -100px">
							</p><br><br>
							
							<p>
								<span><i>*Email Address:</i></span>
								<input readonly id="email" name="email" value="<?php echo $line['email']; ?>" style="width:200px;margin:0 0 0 -100px;background-color:#f5f5ed">
							</p><br><br>
							
							<p>
								<span>Phone Number:</span>
								<input required type="text" title="Must contain 8 digit number" pattern="[0-9]{8}" id="phone" name="phone" value="<?php echo $line['phone']; ?>" style="width:200px;margin:0 0 0 -100px">
							</p><br><br>
							
							<p>
								<span><i>*Subject(s):</i></span>
								<select id="subject" name="subject" style="width:150px;margin:0 0 0 -100px;background-color:#f5f5ed">
									<?php
									do {
										echo'<option value="'.$line2['codeSubject'].'">'.$line2['codeSubject'].' - '.$line2['nameSubject'].'</option>';
									}while($line2 = mysqli_fetch_array($result2, MYSQLI_ASSOC));
									?>
								</select>
							</p><br><br>
							
							<p>
								<span><i>*Faculty:</i></span>
								<input readonly id="faculty" name="faculty" value="<?php echo $line3['nameFaculty']; ?>" style="width:200px;margin:0 0 0 -100px;background-color:#f5f5ed">
							</p><br><br>
							
							<p>
								<span>Password:</span>
								<input type="password" required id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[!@#$%^&*])(?=.*[A-Z]).{8,}" 
 title="Must contain at least one number, one uppercase and one lowercase letter, one special character and at least 8 or more characters" value="<?php echo $line['password']; ?>" style="width:200px;margin:0 0 0 -100px">
							</p>
							
							<p>
								<input type="checkbox" onclick="showPassword();" style="margin:0 0 0 97px;width:20px">
								Show Password
							</p><br>
							
							<p>
								<span style="margin:0 0 0 100px"><i>Note: * Fields CANNOT be edited!</i></span>
							</p><br><br>
							
							<p>
								<input class="submit" type="submit" name="saveChanges" value="Save Changes" style="margin:0 0 0 173px;width:140px;border-radius:6px">
							</p>
							<?php mysqli_close($con); ?>
						</form><br>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
