<html>
	<head>
		<title></title>
		<meta http-equiv="content-type" content="text/html;
		charset=iso-8859-2">
		<meta name="author" content="Kis Gábor">
		<link rel="stylesheet" type="text/css" href="../scripts/table.css">
	</head>
	<body>
		<?php
			$con=mysqli_connect('localhost', 'root', '');
			if (mysqli_connect_errno()) 
			{
				echo "Nem sikerült csatlakozni a MySQL-hez: " . mysqli_connect_error();
			}
			$sql="CREATE DATABASE phbook CHARACTER SET utf8 COLLATE utf8_hungarian_ci";
			if (mysqli_query($con,$sql)) 
			{
				echo "phbook adatbazis letrehozva!";
			} 
			else 
			{
				echo "Az adatbazis letrehozasa sikertelen: " . mysqli_error($con);
			}
		?>
		<?php
			$con=mysqli_connect('localhost', 'root', '','phbook');
			if (mysqli_connect_errno()) 
			{
				echo "Nem sikerült csatlakozni a MySQL-hez: " . mysqli_connect_error();
			}
			$sql="
			CREATE TABLE phones( id INT UNSIGNED NULL AUTO_INCREMENT PRIMARY KEY, name VARCHAR(40) CHARACTER SET utf8 COLLATE utf8_hungarian_ci, number VARCHAR(13), bdate DATE, city VARCHAR(40) CHARACTER SET utf8 COLLATE utf8_hungarian_ci, address VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_hungarian_ci)";
			if (mysqli_query($con,$sql)) 
			{
				echo "<br>phones tabla letrehozva!";
			} 
			else
			{
				echo "<br>Tabla letrehozasa sikertelen: " . mysqli_error($con);
			}
		?>
		<?php
			$con=mysqli_connect('localhost', 'root', '', 'phbook');
			if (mysqli_connect_errno()) 
			{
				echo "Nem sikerült csatlakozni a MySQL-hez: " . mysqli_connect_error();
			}
			$sql = 'LOAD DATA LOCAL INFILE \'data/default_data.csv\' REPLACE INTO TABLE phones FIELDS TERMINATED BY \',\' ENCLOSED BY \'"\' ESCAPED BY \'\\\\\' LINES TERMINATED BY \'\\r\\n\'# '
        . ' ';
			if (mysqli_query($con,$sql)) 
			{
				echo "<br>Az adatok feltoltese sikeres!";
			} 
			else 
			{
				echo "<br>Az adatok feltoltese sikertelen: " . mysqli_error($con);
			}
		?>
		<br><br><a href="index.html">Tovabb a kezdooldalra...</a>
	</body>
</html>