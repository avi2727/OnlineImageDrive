<?php
	$con= new mysqli("localhost", "root", "1234", "docsafer");
	session_start();
	$na= $_SESSION['del'];
	$tb= $_SESSION['tab'];
	$quy= "DELETE FROM $tb WHERE name='$na'";
	$run= mysqli_query($con, $quy);
	if($run)
	{
		echo "<script>alert('Deleted.');</script>";
		echo "<script>document.location.href='homepage.php'</script>";
	}
?>