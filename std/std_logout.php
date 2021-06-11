<!DOCTYPE HTML>
<html>
	<head>
		<title>Logout</title>
		<meta name="description" content="website description" />
		<meta name="keywords" content="website keywords, website keywords" />
		<meta http-equiv="content-type" content="text/html; charset=windows-1252" />
		<link rel="stylesheet" type="text/css" href="../style/style.css" title="style" />
		<script>
			function confirmLogout() {
			  if(confirm("You're about to logout from your account.\nContinue?"))
				return true;
			  return false;
			}
		</script>
	</head>
	<body>
	<?php
	include '../login/initSessionId.php';
	if($idsent->id==0) {
	header('Location:../login/login.php');}
	?>
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
						<!-- <h2>Simple. Contemporary. Website Template.</h2> -->
					</div>
				</div>
				<div id="menubar">
					<ul id="menu">
						<!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
						<li>
							<a href="std_view_files.php">Explore Files</a>
						</li>
						<li>
							<a href="std_personal_info.php">Personal Information</a>
						</li>
						<li>
							<a href="std_contact_us.php">Contact Us</a>
						</li>
						<li class="selected">
							<a href="std_logout.php">Log out</a>
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
					<h1>Thanks for visiting our website!</h1>
					<div class="form_settings">
						<form action="../login/login.php" method="post" onSubmit="return confirmLogout();">

							<input class="submit" type="submit" name="logout" value="Confirm Logout" style="margin: 0 0 0 110px; width: 150px;border-radius:6px">
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
