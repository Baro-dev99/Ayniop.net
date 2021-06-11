<?php
include 'initConnection.php';
$facultybranch=$_GET['selectnameFacultyBranch'];
$major=$_GET['selectnameMajor'];
$year=$_GET['selectnameYear'];
$query = "select * from subject where NOT idSubject IN(select idSubject from professor)
and idYear IN(select idYear from year where year=$year and idMajor IN(select idMajor from major where nameMajor='$major')) 
and idMajor IN(select idMajor from major where nameMajor='$major'
and idFaculty IN (select idFaculty from faculty where nameFaculty='$facultybranch'));";
$result = mysqli_query($con, $query);
$nbrow=mysqli_num_rows($result);
for($i=0;$i<$nbrow;$i++){
	
	$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$codeSubject=$line['codeSubject'];
	$nameSubject=$line['nameSubject'];
	$idSubject=$line['idSubject'];
	$idYear=$line['idYear'];
	$idMajor=$line['idMajor'];
	if($listsubject->checkidsubject($idSubject)==0){
	echo '<tr style="background:#d9d9d9;font-size:14px;"><td>'.$codeSubject.'</td>
		  <td style="font-size:14px;">'.$nameSubject.'</td> 
		  <td style="font-size:14px;">
		  
		  <a href="signup.php?
			name='.$_GET['name'].'
			&lastname='.$_GET['lastname'].'
			&email='.$_GET['email'].'
			&phonenb='.$_GET['phonenb'].'
			&filenb='.$_GET['filenb'].'
			&selectfunction='.$_GET['selectfunction'].'
			&submitfunction='.$_GET['submitfunction'].'
			&selectnameFacultyBranch='.$_GET['selectnameFacultyBranch'].'
			&submitfunction='.$_GET['submitfunction'].'
			&selectnameMajor='.$_GET['selectnameMajor'].'
			&submitfunction='.$_GET['submitfunction'].'
			&selectnameYear='.$_GET['selectnameYear'].'
			&submitfunction='.$_GET['submitfunction'].'
			&idSubject='.$idSubject.'
			&codeSubject='.$codeSubject.'
			&nameSubject='.$nameSubject.'
			&idYear='.$idYear.'
			&idMajor='.$idMajor.'
			#down">
			✔</a>
			
			
			
			</td></tr>';}
}
?>
<input type="hidden" name="submitfunction"/>