<!DOCTYPE HTML>
<html>
	<head>
		<title>Logout</title>
		<meta name="description" content="website description" />
		<meta name="keywords" content="website keywords, website keywords" />
		<meta http-equiv="content-type" content="text/html; charset=windows-1252" />
		<link rel="stylesheet" type="text/css" href="../style/styleAdmin.css" title="style" />
		<script>
			function confirmLogout() {
			  if(confirm("You're about to logout from the ADMIN account.\nContinue?"))
				return true;
			  return false;
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
						<li>
							<a href="viewUser.php">User</a>
						</li>
						<li>
							<a href="viewInbox.php">Inbox</a>
						</li>
						<li class="selected">
							<a href="admin_logout.php">Logout</a>
						</li>
					</ul>
				</div>
			</div>
			<div id="content_header"></div>
			<div id="site_content">
				<div id="content">
					<!-- insert the page content here -->
					<h1>Good Work!</h1>
					<div class="form_settings">
						<form action="../login/login.php" method="post" onSubmit="return confirmLogout();">
							<input class="submit" type="submit" name="logout" value="Confirm Logout" style="margin: 0 0 0 90px; width: 150px">
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
