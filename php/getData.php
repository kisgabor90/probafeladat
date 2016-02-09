<!DOCTYPE html>
<html>
	<head>
	<title></title>
	</head>
	<body>
		<?php
			
			$dataID = intval($_GET['dataID']);

			// set MySQL connection //
			
			$con = mysqli_connect('localhost','root','');
			if (!$con) {
				die('Could not connect: ' . mysqli_error($con));
			}
			
			// ******************* //

			mysqli_select_db($con,"phbook");
			$sql = "SELECT * FROM phones WHERE id='".$dataID."'";
			$result = mysqli_query($con,$sql);
			

			while($row = mysqli_fetch_array($result)) {
				echo "||" . $row['name'] . "||" . $row['number'] . "||" . $row['bdate'] . "||" . $row['city'] . "||" . $row['address'] . "||";
			}
			mysqli_close($con);
		?>
	</body>
</html>