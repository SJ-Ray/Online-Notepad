<?php
require_once 'db_connector.php';

if(isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['pass'])&&isset($_POST['cnf']))
{
	if(!empty($_POST['name'])&&!empty($_POST['email'])&&!empty($_POST['pass'])&&!empty($_POST['cnf']))
	{
		$name=htmlentities(trim($_POST['name']));
		$email=htmlentities(trim($_POST['email']));
		$pass=$_POST['pass'];
		$cnf=$_POST['cnf'];
		
		if(preg_match('/(\d|[!@#$%^&*()_+\-=\[\]{};\':"\\|,.<>\/?])/',$name))
		{
			echo "<font color='red'>Pls Enter a valid name</font>";
			die();
		}
		
		if(!filter_var($email,FILTER_VALIDATE_EMAIL))
		{
		echo "<font color='red'>Pls Enter a Valid Email Id...</font>";
		die();
		}		
		
		if($cnf!=$pass)
		{
		echo "<font color='red'>Password not matched...</font>";
		die();
		}
		
		$pass=md5($pass);
		if(mysqli_query($con,"insert into user_details values(NULL,'$name','$email','$pass')"))
		{
			echo "231";
			mkdir("../files/".$email);
		}
		else
		{
			if(mysqli_errno($con)==1062)
				echo "<font color='red'>User Already Registered...</font>";
			else
			echo "<font color='red'>Some Error Occured....<font>";
		}
	}
	else
    echo "<font color='red'>All Fields Are Required...</font>";
}
?>