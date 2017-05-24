<?php
session_start();
include_once 'zip.php';

		if(isset($_FILES['file']['name'])&&!empty($_FILES['file']['name']))
		{
			$name=$_FILES['file']['name'];
			$_SESSION['name']=$name;
			/*
			//code for checking allowed extentions
			$ext=substr($name,strrpos($name,"."));
			*/
			$size=round($_FILES['file']['size']/(1024*1024),2);
			if($size<5)
			{
				$type=$_FILES['file']['type'];
				$tmp_name=$_FILES['file']['tmp_name'];
				$_SESSION['tmp_name']='../files/'.$_SESSION['login']['email'].'/'.$name;
				$_SESSION['current_opened']=$_SESSION['tmp_name'];
				move_uploaded_file($tmp_name,$_SESSION['tmp_name']);
				$read=fopen($_SESSION['tmp_name'],"r");
				while(!feof($read)){
				echo htmlentities(fgets($read))."<br>";
				}
				fclose($read);
			}
		}
		
function dwnlink($file)
{
	
	if(empty($file))
	{
		header('Content-disposition:attachment;filename=note/'.'$_SESSION[\'current_opened\'];');
		header('content-type:text/html');
		echo 'note/'.$_SESSION['current_opened'];
	}
	else
	{
		$new_file=$_SESSION['current'].'/'.$file;
		if(is_file($new_file))
		{
			header('Content-disposition:attachment;filename='.$file);
			header('content-type:'.mime_content_type($new_file));
			header('Content-Length:'.filesize($new_file));
			readfile($new_file);
		}
		else
		{
			$zip_name = $file.'.zip';
			$zip_directory = '/';
			$zip = new zip( $zip_name, $zip_directory );
			$zip->add_directory($new_file);	
			$zip->save();
			$zip_path = $zip->get_zip_path();
			
			header('Content-disposition: attachment; filename='.$zip_name);
			header('Content-Type:'.mime_content_type($new_file));
			header('Content-Length:'.filesize($zip_path));
			readfile($zip_path);
			
			@unlink($zip_path);
			
		}
	}
}

if(isset($_POST['action'])&&!empty($_POST['action'])){
if($_POST['action']=='dwnlink')
{
	$file=$_POST['current'];
	dwnlink($file);
}	
}
?>