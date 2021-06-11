<select name="selectnameYear" id="ddd" onchange="this.form.submit()" required>
<?php
include 'initConnection.php';
$facultybranch=$_GET['selectnameFacultyBranch'];
$major=$_GET['selectnameMajor'];
$query ="select year from year where idMajor in 
(select idMajor from major where nameMajor='$major' and idFaculty in 
(select idFaculty from faculty where nameFaculty='$facultybranch'));";

$result = mysqli_query($con, $query);
$nbrow=mysqli_num_rows($result);
echo '<option disabled selected value> -- select an option -- </option>';
for($i=0;$i<$nbrow;$i++){
	$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$year=$line['year'];
	echo '<option value="'.$year.'">'.$year.'</option>';
}
?>
</select>
<input type="hidden" name="submitfunction"/>