<!DOCTYPE HTML>
<html>
	<head>
		<title>Forgot Password</title>
		<meta name="description" content="website description" />
		<meta name="keywords" content="website keywords, website keywords" />
		<meta http-equiv="content-type" content="text/html; charset=windows-1252" />
		<link rel="stylesheet" type="text/css" href="../style/styleSignup.css" title="style" />
		<style>
#button {
  text-decoration: none;
  background-color: #EEEEEE;
  color: #333333;
  padding: 9px 15px 10px 15px;
  border-top: 1px solid #CCCCCC;
  border-right: 1px solid #333333;
  border-bottom: 1px solid #333333;
  border-left: 1px solid #CCCCCC;
  border: 1px groove #C0C0C0;
border-radius:6px;
font-size:medium;
border-style:Solid;
cursor:default;

}
input{border: 1px groove #C0C0C0;
border-radius:6px;
font-size:medium;
border-style:Solid;
height:40px;
width:230px;}
select{border: 1px groove #C0C0C0;
border-radius:6px;
font-size:medium;
border-style:Solid;
height:40px;
width:115px;}
		</style>
	</head>
	<body>
	<?php
	include 'initConnection.php';
	include 'initSession.php';?>
		<div id="main">
			<div id="header">
				<div id="logo">
					<div id="logo_text">
						<!-- class="logo_colour", allows you to change the colour of the text -->
						<h1>
							<a href="../index.php">AYNIOP
								<span class="logo_colour">I3308</span>
							</a>
						</h1>
						<h2>All. You. Need. In. One. Place.</h2>
					</div>
				</div>
				<div id="menubar">
					<ul id="menu">
						<!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
						<li class="selected">
							<a href="../index.php">Forgot Password</a>
						</li>
					</ul>
				</div>
			</div>
			<div id="site_content">
				<div class="sidebar">
				</div>
				<div id="content">
				<?php 
				$put=0;
				if(isset($_POST['search'])){
				$email=$_POST['email'];
				$query = "select * from user where email='$email';";
				$result = mysqli_query($con, $query);
				$nbrow=mysqli_num_rows($result);
				if($nbrow==1){
					$put=2;
					}
				if($nbrow==0){
				$put=1;
					}
				}
				
				echo '<form id="demo" name="bata" action="" method="post">';?>			
				<h3>Please enter your email address to reset your password.</h3>
				<table border="0" style="padding: 0px;margin: 0px;">
				<tr>
				<td><h3>Email</h3></td>
								<?php
				if($put==2){
				echo '<td><input type="text" name="email" value="'.$_POST['email'].'" required /></td>';
				}
				else{echo '
				<td><input type="text" name="email" value="" required /></td>';}?>
				<td><input style="width:80px;" type="submit" name="search" value="Reset"/></td>
				<td><a href="../login/login.php" id="button">Cancel</a></td>
				</tr>
				</table>
				<?php 
				if($put==1){
				?>
				<h3 style="color:red">This account doesn't exist.<br>Please try again with other information.</h3>
				<?php
				}
				if($put==2){
				$verficationcode->setcode(0);
				echo '
				<script>
				document.getElementById("demo").action="reset.php";
				var oForm = document.forms["bata"];
				oForm.submit();
				</script>';					
				}?>
				</form>
				</div>
			</div>
		</div>
	</body>
</html>