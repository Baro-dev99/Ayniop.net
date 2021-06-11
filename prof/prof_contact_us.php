<?php 
include '../login/initSessionId.php';
	if($idsent->id==0) {
		header('Location:../login/login.php');
	}else{
		$idUser = $idsent->id;
	}
	if(isset($_POST['messageSubmit'])) {
		include "initConnection.php";
		
		$messageType = $_POST['messageType'];
		$messageDescription = $_POST['messageDescription'];
		$date = date("Y-m-d H:i:s");
		
		$query = 'INSERT INTO inbox (typeMessage, descriptionMessage, idUser, receiveDate) VALUES ("'.$messageType.'", "'.$messageDescription.'", '.$idUser.', "'.$date.'");';
		//$query = "INSERT INTO inbox (typeMessage, descriptionMessage, idUser) VALUES ('$messageType','$messageDescription', $idUser)";
		if(!mysqli_query($con, $query))
			die("SERVER ERROR: Error in query");
		mysqli_close($con);
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Contact Us</title>
		<meta name="description" content="website description" />
		<meta name="keywords" content="website keywords, website keywords" />
		<meta http-equiv="content-type" content="text/html; charset=windows-1252" />
		<link rel="stylesheet" type="text/css" href="../style/style.css" title="style" />
		<script>
			function validateForm() {
			  var x = document.forms["contactForm"]["messageDescription"].value;
			  if (x == "" || x == null) {
				alert("Please describe your problem below!");
				return false;
			  }
			  else {
				  alert("Your Message was Received!");
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
						<li>
							<a href="prof_personal_info.php">Personal Information</a>
						</li>
						<li class="selected">
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
					<h1>Contact Us</h1>
					<form name="contactForm" action="" method="post" onsubmit="return validateForm();" required>
						<div class="form_settings">
							<p>
								<span>Message Subject:</span>
								<select id="messageType" name="messageType">
									<option value="bug">Report a bug</option>
									<option value="deleteAccount">Request delete account</option>
									<option value="dataChange">Request data change</option>
									<option value="other">Other</option>
								</select>
							</p>
					
							<p>
								<span>Describe it here briefly:</span>
								<textarea class="contact textarea" rows="8" cols="50" name="messageDescription" style="resize:none" required></textarea>
							</p>
							<p style="padding-top: 15px">
								<span>&nbsp;</span>
								<input class="submit" type="submit" name="messageSubmit" value="submit" style="border-radius:6px" />
							</p>
						</div>
					</form>
					<p>
						<br />
						<br />NOTE: We will try to answer your needs as soon as possible!
					</p>
				</div>
			</div>
		</div>
	</body>
</html>
