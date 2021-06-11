<!DOCTYPE HTML>
<html>
	<head>
		<title>Verification Code</title>
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
#inputsubmit{border: 1px groove #C0C0C0;
border-radius:6px;
font-size:medium;
border-style:Solid;
padding-left:3px;
height:25px;
width:60px;}

#inputcode{border: 1px groove #C0C0C0;
border-radius:6px;
font-size:medium;
border-style:Solid;
padding-left:3px;
height:25px;
width:40px;}


input:required:valid {
  color: green;
}
input:required:invalid {
  color: red;
}

		</style>
	</head>
	<body>
	<?php
	include 'initConnection.php';
	include 'initSessionCode.php';?>
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
							<a href="../index.html">Verification Code</a>
						</li>
					</ul>
				</div>
			</div>
			<div id="site_content">
				<div class="sidebar">
				</div>
				<div id="content">
				<form id="demo" name="bata" action="" method="post">				
				<?php 
				echo ' 
				<input type="hidden" name="name" value="'.$_GET['name'].'" />	
				<input type="hidden" name="lastname" value="'.$_GET['lastname'].'" />
				<input type="hidden" name="email" value="'.$_GET['email'].'" />
				<input type="hidden" name="phonenb" value="'.$_GET['phonenb'].'" />
				<input type="hidden" name="selectfunction" value="'.$_GET['selectfunction'].'" />
				<input type="hidden" name="selectnameFacultyBranch" value="'.$_GET['selectnameFacultyBranch'].'" />
				<input type="hidden" name="selectnameMajor" value="'.$_GET['selectnameMajor'].'" />
				<input type="hidden" name="selectnameYear" value="'.$_GET['selectnameYear'].'" />';
				if(isset($_GET['filenb'])){
				echo '<input type="hidden" name="filenb" value="'.$_GET['filenb'].'" />';
				}
				
				echo '<h3>A verification code has been sent to your email</h3>';?>
				<table border="0" style="padding: 0px;margin: 0px;">
				<tr><td><h3>Enter your verification code:</h3></td>
				<td><input id="inputcode" type="text"  name="pincode" maxlength="4" pattern="\d{4}" required /></td>
				<td><input id="inputsubmit" type="submit" name="final" value="submit " /></td></tr>
				<?php 
				if($verficationcode->code==0){
				include 'sendemail.php';
				}?>
				</table>
				<?php
				if(isset($_POST['final'])){
				$vercode=$verficationcode->code;
				if($_POST['pincode']==$vercode){
					echo '
				<script>
				document.getElementById("demo").action="change.php";
				var oForm = document.forms["bata"];
				oForm.submit();
				</script>';					
				}else{?>
				<h3 style="color:red">Verification code doesn't match the one sent to your email.<br>Please try again.</h3>
					<?php
				}
				}?>
				</form>
				</div>
			</div>
		</div>
	</body>
</html>