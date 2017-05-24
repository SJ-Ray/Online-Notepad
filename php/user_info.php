<?php
session_start();
function getName()
{
	echo $_SESSION['login']['name'];
}

if(isset($_POST['action'])&&!empty($_POST['action']))
{
	$action=$_POST['action'];
	if($action=="getName")
	{
		getName();
	}
}
?>