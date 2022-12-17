<!DOCTYPE html>
<html>
<head>
	<title>Users</title>
	<style type="text/css">
		body{
            background-image: url("wallpaper.jpg");
            background-repeat: no-repeat;
			background-size: cover;
        }

		ul {
    			list-style-type: none;
    			margin: 0;
    			padding: 0;
    			overflow: hidden;
    			background-color: #fff;
    			box-shadow: 0 2px 2px rgba(0,0,0,0.2);
		}

		 .logo {
    			float: left;
		}

		 .da {
    			float: right;
		}

		li a {
    			display: block;
    			color: #4a4a4a;
    			text-align: center;
 			    text-decoration: none;
 			    padding: 23px 32px;
		}

		li a:hover {
    			color: #dd5347;
		}
	</style>
</head>
<body>
	<ul>
		<li class="logo"><img src="logo.jpg" height="60px" width="70px"></li>
		<li class="logo"><h3>Image Drive</h3></li>
		<li class="da"><a href="admin.php">BACK</a></li>
	</ul>
	<?php
		$conn = new mysqli("localhost", "root", "1234", "docsafer");
   		if ($conn->connect_error) 
    	{
        	die("Connection failed: " . $conn->connect_error);
    	}

    	$sel= "select * from users";
    
    	$result= mysqli_query($conn, $sel);

    	echo "<center>";
    	echo "<br><br><h1>IMAGE DRIVE USERS</h1>";
    	echo "<br><br><table border='2'>";
    		echo "<tr>";
    		echo "<th>Name</th>";
    		echo "<th>Email ID</th>";
    		echo "<th>Mobile No.</th>";
    		echo "<th>Last Login<br>(Yr-Mnth-Day Hr:Min:Sec)</th>";
    		echo "</tr>";
    	while($row= mysqli_fetch_assoc($result))
		{
			echo "<tr>";
				echo "<td>".$row['fname']." ".$row['lname']."</td>";
				echo "<td>".$row['email']."</td>";
				echo "<td>".$row['code']." - ".$row['mobile']."</td>";
				echo "<td>".$row['lastlogin']."</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "</center>";
    ?>
</body>
</html>