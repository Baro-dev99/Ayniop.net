<select name="selectnameFacultyBranch" id="bbb" onchange="this.form.submit()" required>
<?php
include 'initConnection.php';
$query = "select nameFaculty from faculty;";
$result = mysqli_query($con, $query);
$nbrow=mysqli_num_rows($result);
echo '<option disabled selected value> -- select an option -- </option>';
for($i=0;$i<$nbrow;$i++){
	$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$nameFacultyBranch=$line['nameFaculty'];
	echo '<option value="'.$nameFacultyBranch.'">'.$nameFacultyBranch.'</option>';
}
?>
</select>
<input type="hidden" name="submitfunction"/>