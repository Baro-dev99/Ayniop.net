<?php 
	if(isset($_GET['delete'])) {
		include "initConnection.php";
		$idMessage = $_GET['idMessage'];
		$query = 'DELETE FROM inbox WHERE idMessage='.$idMessage.';';
		mysqli_query($con, $query);
		mysqli_close($con);
	}
	
	if(isset($_GET['clear'])) {
		include "initConnection.php";
		$query = 'DELETE FROM inbox;';
		mysqli_query($con, $query);
		mysqli_close($con);
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Inbox</title>
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
						<li>
							<a href="viewYear.php">Year</a>
						</li>
						<li>
							<a href="viewSub.php">Subject</a>
						</li>
						<li>
							<a href="viewUser.php">User</a>
						</li>
						<li class="selected">
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
					<h1>View received Messages!</h1><br>
					<?php
						include "initConnection.php";
						$query = 'SELECT * FROM inbox ORDER BY receiveDate';
						$result = mysqli_query($con, $query);
						$nbrow = mysqli_num_rows($result);
						if($nbrow == 0) {
							echo '<h3>Oops! Empty Inbox!</h3>';
							goto noTable;
						}
						echo'
							<table style="width:100%; border-spacing:0;table-layout:auto">
							<tr>
								<!--th>ID</th-->
								<th>Type</th>
								<th>User Id</th>
								<th>Date Received</th>
								<th>Explore</th>
								<th>Delete</th>
							</tr>
						';
						while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							echo'
								<tr>
									<!--td>'.$line['idMessage'].'</td-->
									<td>'.$line['typeMessage'].'</td>
									<td>'.$line['idUser'].'</td>
									<td >'.$line['receiveDate'].'</td>
									<td class="tooltip">
										<a href="viewInbox.php?explore=true&typeMessage='.$line['typeMessage'].'&descriptionMessage='.$line['descriptionMessage'].'&receiveDate='.$line['receiveDate'].'&idUser='.$line['idUser'].'">
										<span class="tooltiptext">Explore Inbox</span>
										<img src="../style/view.ico"></a>
									</td>
									<td class="tooltip">
										<a href="viewInbox.php?delete=true&explore=false&idMessage='.$line['idMessage'].'">
										<span class="tooltiptext">Remove Inbox</span>
										<img src="../style/delete.ico"></a>
									</td>
								</tr>
							';
						}
						echo'</table>';
						mysqli_close($con);
					?>
						<div class="form_settings">
							<form action="">
								<p>
									<input class="submit" type="submit" name="clear" value="Clear All" style="margin:0 0 0 499px;"/>
								</p><br>
							</form>
						</div>
					<?php
						if(isset($_GET['explore'])) {
							$continue = $_GET['explore'];
							if($continue == "true") {
								$idUser = $_GET['idUser'];
								$descriptionMessage = $_GET['descriptionMessage'];
								include "initConnection.php";
								$query = 'SELECT * FROM user WHERE idUser='.$idUser.';';
								$result = mysqli_query($con, $query);
								$line = mysqli_fetch_array($result, MYSQLI_ASSOC)
							
					?>
								<div class="form_settings">
									<p>
										<span>Sender</span>
										<input readonly name="sender" value="<?php echo $line['fullName'].' ('.$line['function'].')'; ?>" style="width:200px;margin:0 0 0 -100px">
									</p>
									<p>
										<span>Email</span>
										<input readonly name="email" value="<?php echo $line['email'] ; ?>" style="width:200px;margin:0 0 0 -100px">
									</p>
									<p>
										<span>Content</span>
										<textarea readonly name="content" class="contact textarea" rows="8" cols="50" style="resize:none;margin:0 0 0 -100px"><?php echo $descriptionMessage; ?></textarea>
									</p>
								</div>
					<?php
								mysqli_close($con);
							}
						}
						noTable:
					?>
				</div>
			</div>
		</div>
	</body>
</html>
