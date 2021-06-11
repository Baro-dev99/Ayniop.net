<?php
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <?php
			echo '<tr><td></td><td><h3 id="down">Chosen Subject :</h3></td></tr>
				<tr><th>CodeSubject</th>
				<th>NameSubject</th>
				<th>Major</th>
				<th style="width:50px">Year</th>
				<th>Remove</th></tr>';	
for ($i = 1; $i <count($listsubject->list); $i++) {
        echo '<tr style="background:#d9d9d9;font-size:14px"><td>'.$listsubject->list[$i]->codeSubject.'</td>
				<td>'.$listsubject->list[$i]->nameSubject.'</td>';
				$id=$listsubject->list[$i]->idMajor;
				$query="select nameMajor from major where idMajor=$id";
				$result = mysqli_query($con,$query);
				$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
				$nameMajor=$line['nameMajor'];
				echo '<td>'.$nameMajor.'</td>';
				
				
				$id=$listsubject->list[$i]->idYear;
				$query="select year from year where idYear=$id";
				$result = mysqli_query($con,$query);
				$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
				$year=$line['year'];
				echo '<td>'.$year.'</td>';
				
				echo '<td>
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
				&remove='.$listsubject->list[$i]->idSubject.'
				#down">
				✘</a>
				</td></tr>';
}
        ?>
    </body>
</html>
