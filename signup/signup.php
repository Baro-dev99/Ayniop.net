<!DOCTYPE HTML>
<html>
	<head>
		<title>SIGNUP</title>
		<meta name="description" content="website description" />
		<meta name="keywords" content="website keywords, website keywords" />
		<meta http-equiv="content-type" content="text/html; charset=windows-1252" />
		<link rel="stylesheet" type="text/css" href="../style/styleSignup.css" title="style" />
		<style>
input{border: 1px groove #C0C0C0;
border-radius:6px;
font-size:medium;
border-style:Solid;
height:40px;
width:230px;
padding-left:10px;}
select{border: 1px groove #C0C0C0;
border-radius:6px;
font-size:medium;
border-style:Solid;
height:40px;
width:180px;}
table tr th
{background:#3B3B3B;
font-size:14px;
 color: #FFF;
 padding: 7px 4px;
 text-align: left;}
#btn-link {
    border: none;
    outline: none;
    background: none;
    cursor: pointer;
    color: #0000EE;
    padding: 0;
	width:75px;
    text-decoration: underline;
    font-family: inherit;
    font-size: inherit;
}
		</style>
	</head>
	<body>
	<?php
include 'initConnection.php';
include 'initSessionCode.php';
				if(isset($_GET['finalsubmit'])){
				$email=$_GET['email'];
				$query = "select * from user where email='$email';";
				$result = mysqli_query($con, $query);
				$nbrow=mysqli_num_rows($result);
					if($nbrow==0){
						if($_GET['selectfunction']==='pr' && count($listsubject->list)>1){
							$verficationcode->setcode(0);
						header("Location:verficationcode.php?name=".$_GET['name']."&lastname=".$_GET['lastname']."&email=".$_GET['email']."&phonenb=".$_GET['phonenb']."&selectfunction=".$_GET['selectfunction']."&selectnameFacultyBranch=".$_GET['selectnameFacultyBranch']."&selectnameMajor=".$_GET['selectnameMajor']."&selectnameYear=".$_GET['selectnameYear']);				
						}
						else
						if($_GET['selectfunction']==='st' && $nbrow==0){
						$filenumber=$_GET['filenb'];
						$query = "select * from student where fileNumber='$filenumber';";
						$result = mysqli_query($con, $query);
						$nbrow=mysqli_num_rows($result);
						$verficationcode->setcode(0);
						header("Location:verficationcode.php?name=".$_GET['name']."&lastname=".$_GET['lastname']."&email=".$_GET['email']."&phonenb=".$_GET['phonenb']."&filenb=".$_GET['filenb']."&selectfunction=".$_GET['selectfunction']."&selectnameFacultyBranch=".$_GET['selectnameFacultyBranch']."&selectnameMajor=".$_GET['selectnameMajor']."&selectnameYear=".$_GET['selectnameYear']);			
						}
					}
				}
if (isset($_GET['idSubject'])&& isset($_GET['codeSubject']) && isset($_GET['nameSubject']) && isset($_GET['idYear']) && isset($_GET['idMajor'])){
$listsubject->add(new subject($_GET['idSubject'],$_GET['codeSubject'],$_GET['nameSubject'],$_GET['idYear'],$_GET['idMajor']));}
?>
		<div id="main">
			<div id="header">
				<div id="logo">
					<div id="logo_text">
						<!-- class="logo_colour", allows you to change the colour of the text -->
						<h1>
							<a href="signup.php">AYNIOP
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
							<a href="signup.php">Sign Up</a>
						</li>
						<li class="selected">
							<a href="../login/login.php">Back to Login</a>
						</li>
					</ul>
				</div>
			</div>
			<div id="site_content">
				<div class="sidebar">
				</div>
				<div id="content">
				<form action="#emailscroll" id="changeform" name="bata" style="display:inline">
				<table border="0" >
				
				<?php 
				if(!isset($_GET['submitfunction'])){
				unset($_SESSION['subject']);
				unset($_SESSION['code']);
				session_destroy();
				include 'firsttime.html'; 
				$listsubject->unsetall();
				}
				else
				if(isset($_GET['submitfunction'])){
				
				echo '<tr>
				<td><h3>Name</h3></td>
				<td><input type="text" name="name" value="'.$_GET['name'].'" required/></td>
				</tr>
				<tr>
				<td><h3>Last Name</h3></td>
				<td><input type="text" name="lastname" value="'.$_GET['lastname'].'" required/></td>
				</tr>
				<tr>
				<td id="emailscroll"><h3>Email</h3></td>
				<td><input type="text" name="email" value="'.$_GET['email'].'" onblur="remove(\'tralert\')" required/></td></tr>';
				if(isset($_GET['finalsubmit'])){
				$emailerror=$_GET['email'];
				$query = "select * from user where email='$emailerror';";
				$result = mysqli_query($con, $query);
				$nbrow=mysqli_num_rows($result);
				if($nbrow!=0){
				echo '<tr id="tralert"><td></td><td style="color:red">This email is taken.<br><a href="../login/login.php" style="color:blue">Sign in</a> or Try another.</td></tr>';				
					}
				}
				echo '
				<tr>
				<td><h3>Phone Number</h3></td>
				<td><input type="text" name="phonenb" title="Must contain 8 digit number" pattern="[0-9]{8}" value="'.$_GET['phonenb'].'" required/></td>
				</tr>
				<tr>
				<td><h3>Select</h3></td>
				<td>';
				$stringggg="";
				if($_GET['selectfunction']==='pr'){
				$stringggg=$_GET['selectfunction'];
				echo '
				<input type="hidden" name="filenb" value=""/>
				<select name="selectfunction" onchange="this.form.submit()">
				  <option value="pr">Prof</option>
				  <option value="st">Student</option>
				</select>
				<input type="hidden" name="submitfunction"/>
				</td></tr>';				
				}
				if($_GET['selectfunction']==='st'){
				$stringggg=$_GET['selectfunction'];
				echo '
				<select name="selectfunction" onchange="this.form.submit()">
				  <option value="st">Student</option>
				  <option value="pr">Prof</option>
				</select>
				<input type="hidden" name="submitfunction"/>
				</td></tr>';
				echo '
				<tr><td><h3>File Number</h3></td>
				<td><input type="text" name="filenb" title="Must contain only digit number" pattern="[0-9]{1,}" value="'.$_GET['filenb'].'" required/></td></tr>';
				
				if(isset($_GET['finalsubmit'])){
				$filenberror=$_GET['filenb'];
				$query = "select * from student where fileNumber='$filenberror';";
				$result = mysqli_query($con, $query);
				$nbrow=mysqli_num_rows($result);
				if($nbrow!=0){
				echo '<tr id="tralert"><td></td><td style="color:red">This file number is taken.<br><a href="../login/login.php" style="color:blue">Sign in</a> or Try another.</td></tr>';				
					}
				}				
				}
				echo '
				<tr><td><h3>Faculty</h3></td><td>';
				include 'faculty.php';
				if(isset($_GET['selectnameFacultyBranch'])){
				$listsubject->check($_GET['selectnameFacultyBranch']);
				echo '<tr><td><h3>Major</h3></td><td>';
				include 'major.php';
				$string=$_GET['selectnameFacultyBranch'];
				$stringg="";
				$stringgg="";
				if(isset($_GET['selectnameMajor'])){
				echo '<tr><td><h3>Year</h3></td><td>';
				include 'year.php';
				$stringg=$_GET['selectnameMajor'];
				if(isset($_GET['selectnameYear'])){
				$stringgg=$_GET['selectnameYear'];
				if($_GET['selectfunction']==='pr'){
				echo '<tr><td></td><td><h3>Subject Registration :</h3></td></tr>
				<tr><th>CodeSubject</th>
				<th>NameSubject</th>
				<th>

				Add&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
				</th></tr>';	
				if(isset($_GET['remove'])){
				$listsubject->unsetbyid($_GET['remove']);
				include 'table.php';
				include 'viewsubject.php';
				}
				else{
				include 'table.php';
				include 'viewsubject.php';						
				}
				}
				if(count($listsubject->list)>1)
					{
						echo '<script>
						remove("trsubject");						
						</script>';
					}
					if($_GET['selectfunction']==='pr'){
				if(isset($_GET['finalsubmit'])){
					if(count($listsubject->list)==1)
					{
						echo '<tr id="trsubject"><td></td><td style="color:red">Please add subject!!!</td></tr>';
					}					
					}}
				echo '<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td><input style="width:130px;" type="submit" name="finalsubmit" value="Confirm &nbsp"/></td></tr></table>';
				
				}
				}				
				}?>
				<script type="text/javascript">
				function selectnameFacultyBranch() {
				var lat="<?php echo $string; ?>";
				document.getElementById('bbb').value=lat; 
				}
				function selectnameMajor() {
				var lat="<?php echo $stringg; ?>";
				document.getElementById('ccc').value=lat;
				}
				function selectnameYear() {
				var lat="<?php echo $stringgg; ?>";
				document.getElementById('ddd').value=lat;
				}
				function remove(x) {
				document.getElementById(x).style.display='none';	
				}
				selectnameFacultyBranch();
				selectnameMajor();
				selectnameYear();
			</script>
			<?php
				
				
				}
				?>

					</form>
					<div id="down"></div>
				</div>
			</div>
		</div>
	</body>
</html>