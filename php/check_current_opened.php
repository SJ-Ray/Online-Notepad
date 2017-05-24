<?php
session_start();
	if(isset($_SESSION['current_opened'])&&!empty($_SESSION['current_opened']))
	{
		echo "true";
	}
	else 
	{
		echo "false";
	}
?>