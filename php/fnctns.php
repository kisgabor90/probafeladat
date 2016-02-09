<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/index.css">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	</head>
	<body>
		<?php
			$reqID = intval($_GET['reqID']);
			
			if($reqID==1) {
				$name = strval($_GET['name']);
				$number = strval($_GET['number']);
				$bdate = intval($_GET['bdate']);
				$city = strval($_GET['city']);
				$address = strval($_GET['address']);
			}
			else if($reqID==3) {
				$dataID = intval($_GET['dataID']);
				$name = strval($_GET['name']);
				$number = strval($_GET['number']);
				$bdate = intval($_GET['bdate']);
				$city = strval($_GET['city']);
				$address = strval($_GET['address']);
			}
			
			// set MySQL connection //
			
			$con = mysqli_connect('localhost','root','');
			if (!$con) {
				die('Could not connect: ' . mysqli_error($con));
			}
			
			// ******************* //

			mysqli_select_db($con,"phbook");
			
			if($reqID==1) {
				$sql = "INSERT INTO phones (name, number, bdate, city, address)
			VALUES ('$name', '$number', '$bdate','$city', '$address')";
				mysqli_query($con,$sql);
			}
			else if($reqID==3) {
				$sql = "UPDATE phones SET name='$name', number='$number', bdate='$bdate', city='$city', address='$address' WHERE id='".$dataID."'";
				mysqli_query($con,$sql);
			}
			else if($reqID==4) {
				$dataID = intval($_GET['dataID']);
				$sql = "DELETE FROM phones WHERE id='".$dataID."'";
				mysqli_query($con,$sql);
			}
			
			$sql="SELECT * FROM phones";
			$result = mysqli_query($con,$sql);
			
			$i = 0;
			while($row = mysqli_fetch_array($result)) {
				if($i%2==0) {
					echo "<div class='row dbl'>
							  <div class='row lft Wd2'>" . $row['name'] . "</div>
							  <div class='row lft Wd1'>" . $row['number'] . "</div>
							  <div class='row lft Wd1'>" . $row['bdate'] . "</div>
							  <div class='row lft Wd2'>" . $row['city'] . "</div>
							  <div class='row lft Wd2'>" . $row['address'] . "</div>
							  <div class='row lft Wd3'><a href='#' onclick='MyRequest(2, " . $row['id'] . ");'><div class='modImg'></div></a><div class='spc'></div><a href='#' onclick='MyRequest(4, " . $row['id'] . ");'><div class='delImg'></div></a></div>
							  <div class='c'></div>
						  </div>";
				}
				else {
					echo "<div class='row odd'>
							  <div class='row lft Wd2'>" . $row['name'] . "</div>
							  <div class='row lft Wd1'>" . $row['number'] . "</div>
							  <div class='row lft Wd1'>" . $row['bdate'] . "</div>
							  <div class='row lft Wd2'>" . $row['city'] . "</div>
							  <div class='row lft Wd2'>" . $row['address'] . "</div>
							  <div class='row lft Wd3'><div class='modImg' onclick='MyRequest(2, " . $row['id'] . ");'></div><div class='spc'></div><a href='#' onclick='MyRequest(4, " . $row['id'] . ");'><div class='delImg'></div></a></div>
							  <div class='c'></div>
						  </div>";
				}
				$i++;
			}
			mysqli_close($con);
		?>
	</body>
</html>