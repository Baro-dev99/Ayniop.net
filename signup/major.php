<select name="selectnameMajor" id="ccc" onchange="this.form.submit()" required>
<?php
$facultybranch=$_GET['selectnameFacultyBranch'];
include 'initConnection.php';
$query="select nameMajor from major,faculty where major.idFaculty=faculty.idFaculty 
and faculty.nameFaculty='$facultybranch';";
$result = mysqli_query($con,$query);
$nbrow=mysqli_num_rows($result);
echo '<option disabled selected value> -- select an option -- </option>';
for($i=0;$i<$nbrow;$i++){
	$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$nameMajor=$line['nameMajor'];
	echo '<option value="'.$nameMajor.'">'.$nameMajor.'</option>';
}
?>
</select>
<input type="hidden" name="submitfunction"/>