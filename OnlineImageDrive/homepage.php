<!DOCTYPE html>
<html>
<head>
	<title>My Place</title>
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
		<li class="da"><a href="Signout.php">SIGN OUT</a></li>
		<li class="da"><a href="myacc.php">MY ACCOUNT</a></li>
	</ul>	
	<form method="post" enctype="multipart/form-data">
		<br><br>
		<label>Upload ID</label><br><br>
		<input type="file" name="image"><br><br>
		<input type="submit" name="sumit" value="Upload" />
	</form>
	<?php
		session_start();
		$ma=$_SESSION['ur'];
		if(isset($_POST['sumit']))
		{
			if($_FILES['image']['size']==0)
			{
				echo "<script>alert('Select an image.');</script>";
				echo "<script>document.location.href='homepage.php'</script>";
			}
			else
			{
				$image= addslashes($_FILES['image']['tmp_name']);
				$name= addslashes($_FILES['image']['name']);
				$image= file_get_contents($image);
				$image= base64_encode($image);
				saveimage($name, $image);
			}
		}
		dispalyimage();
		function saveimage($name, $image)
		{
			$con= new mysqli("localhost", "root", "1234", "docsafer");
				$r= $GLOBALS['ma'];
				$sel= "SELECT uid, fname FROM users WHERE email='$r'";
			$run= mysqli_query($con, $sel);
    		$row= mysqli_fetch_assoc($run);
    		$n= $row['fname'];
    		$n.= $row['uid'];
			$qry= "insert into $n (name, image) values ('$name', '$image')";
			$result= mysqli_query($con, $qry);
			if($result)
			{
				echo "<script>alert('Image Uploaded');</script>";
			}
			else
			{
				echo "<script>alert('Image not Uploaded');</script>";
			}
		}
		function dispalyimage()
		{
			$con= new mysqli("localhost", "root", "1234", "docsafer");
			$ri= $GLOBALS['ma'];
			$sel= "SELECT uid, fname FROM users WHERE email='$ri'";
			$run= mysqli_query($con, $sel);
    		$row= mysqli_fetch_assoc($run);
    		$n= $row['fname'];
    		$n.= $row['uid'];
			$qry= "SELECT * FROM $n";
			$result= mysqli_query($con, $qry);
			while($row= mysqli_fetch_array($result))
			{
					echo "<style>.card {box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); transition: 0.3s;width: 40%;
} .container { padding: 2px 16px; }</style>";
					echo "<br><br><center><div class='card'>";
					echo '<img style="width:50%; height:50%;" src="data:image;base64,'.$row[2].' ">';
					echo "<div class='container'>";
					echo "<h4><b>".$row[1]."</b></h4>";
					echo "<p>To download image right click on image and select 'Save Image As'</p>";
					echo "</div>";
					echo "</div></center>";

					$_SESSION['del']= $row[1];
					$_SESSION['tab']= $n;
					echo "<form action='delete.php'>";
					echo "<br><center><input type='submit' value='Delete'>";
					echo "</form></center>";
			}
			mysqli_close($con);
		}
	?>
</body>
</html>