<!DOCTYPE HTML>
<html>
	<head>
		<title>Reset Password</title>
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




/* The message box is shown when the user clicks on the password field */
#message {
  display:none;
  background: #f1f1f1;
  padding-left: 10px;
  padding-top: 5px;
  width:300px;
}
#message p {
  padding: 3px 35px;
  font-size: 15px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
  position: relative;
  left: -35px;
  content: "✔";
}

.invalid:before {
  position: relative;
  left: -35px;
  content: "✖";
}
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
							<a href="../index.php">Reset Password</a>
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
				<input type="hidden" name="email" value="'.$_POST['email'].'" />';?>				
				<table border="0" style="padding: 0px;margin: 0px;">
<?php 
if(isset($_POST['finsih'])){
	$email=$_POST['email'];
	$passw=$_POST['psw'];
$query = "UPDATE user SET password='$passw' WHERE email='$email';";
mysqli_query($con, $query);	
header('Location:../login/login.php');
}
echo '
<tr><td><h3><label for="psw">New Password</label></h3></td>'; ?>
<td><input type="password" id="psw" name="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[!@#$%^&*])(?=.*[A-Z]).{8,}" 
 title="Must contain at least one number, one uppercase and one lowercase letter, one special character and at least 8 or more characters" required></td></tr>
<tr><td><h3><label for="psw">Confirm Password</label></h3></td>
<td><input type="password" id="cpsw" required></td>
<td> <input id="su" style="width:80px;" type="submit" name="finsih" value="Submit"></td></tr>
<tr><td></td></tr>
</table>
<div id="message">
  <h3 style="padding: 0px;margin: 0px; color:green">Password must contain the following:</h3>
  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  <p id="capital" class="invalid">A <b>capital</b> letter</p>
  <p id="special" class="invalid">A <b>special</b> character</b></p>
  <p id="number" class="invalid">A <b>number</b></p>
  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
  <p id="pass" class="invalid">Password <b>confirmation</b></p>
</div>			
				</form>
				</div>
			</div>
		</div>
		<script>
var myInput = document.getElementById("psw");
var myCInput = document.getElementById("cpsw");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");
var special = document.getElementById("special");
var pass = document.getElementById("pass");
var submitbtn = document.getElementById("su");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}



// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
 
  // Validate char
  var specials = /(?=.*[!@#$%^&*])/g;
  if(myInput.value.match(specials)) {  
    special.classList.remove("invalid");
    special.classList.add("valid");
  } else {
    special.classList.remove("valid");
    special.classList.add("invalid");
  }
  
 
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
  
  var password = document.getElementById("psw").value;
   var confirmPassword = document.getElementById("cpsw").value;
  if (password != confirmPassword) {
    pass.classList.remove("valid");
    pass.classList.add("invalid");
	submitbtn.disabled = true;
  } else {
	pass.classList.remove("invalid");
    pass.classList.add("valid");
	submitbtn.disabled = false;
  }
}
	myCInput.onkeyup = function() {
	   var password = document.getElementById("psw").value;
   var confirmPassword = document.getElementById("cpsw").value;
  if (password != confirmPassword) {
    pass.classList.remove("valid");
    pass.classList.add("invalid");
	submitbtn.disabled = true;
  } else {
	pass.classList.remove("invalid");
    pass.classList.add("valid");
	submitbtn.disabled = false;
  }
}
</script>
	</body>
</html>