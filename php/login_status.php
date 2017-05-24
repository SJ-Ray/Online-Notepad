<?php
session_start();
	if(isset($_SESSION['login'])&&!empty($_SESSION['login']))
	{
		echo "100";
	}
	else
	{
		echo "001";
	}
?>