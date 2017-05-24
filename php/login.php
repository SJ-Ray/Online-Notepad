<?php
require 'db_connector.php';
session_start();
if(isset($_POST['email'])&&isset($_POST['password'])&&!empty($_POST['email'])&&!empty($_POST['password']))
		{
		$id=addslashes(trim($_POST['email']));
		$pass=md5(addslashes(trim($_POST['password'])));
	
			$result=mysqli_query($con,"select * from user_details where email='$id' and password='$pass'");
			
			if(mysqli_num_rows($result)==1)
				{
				$_SESSION['login']=mysqli_fetch_assoc($result);
				$_SESSION['current']="../files/".$_SESSION['login']['email'];
				echo '1';
				}
		}
?>