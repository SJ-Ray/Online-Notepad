<?php
$con=mysqli_connect("localhost","root","","notepad");//connecting to database
if(mysqli_connect_errno())//showing error in connection
	{
	echo"<font color='red'> Failed to connect database:".mysqli_connect_error()."</font>";
	}//end
?>