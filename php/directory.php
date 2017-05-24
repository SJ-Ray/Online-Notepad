<?php
	session_start();
	if(isset($_SESSION['login'])&&!empty($_SESSION['login']))
	{		
		function createFile($file)
		{
			if(!empty($file))
			{
			$handle=fopen($_SESSION['current'].'/'.$file,"w") or die("<font color='red'>unable to create file</font>");
			fclose($handle);
			}
		}
		
		function createFolder($folder)
		{	if(!empty($folder))
			mkdir($_SESSION['current']."/".$folder);
		}
		
		function recursiveCopy($src,$dest)
		{

			if (!is_dir($dest)) {
				mkdir($dest);
			}
		
			foreach(glob("{$src}/*") as $file)
					{
						if(!is_file($file)) {
							$folder_name=substr($file,strrpos($file,"/"),strlen($file));
							recursiveCopy($file,$dest.$folder_name);
						} else {
							$file_name=substr($file,strrpos($file,"/"),strlen($file));		
							copy($file,$dest.$file_name);
						}	
					}
		}
		
		function recursiveDelete($folder)
		{
			foreach(glob("{$folder}/*") as $file)
					{
						if(is_dir($file)) { 
							recursiveDelete($file);
						} else {
						unlink($file);
						}
					}
					rmdir($folder);
		}
		function delete_file($file)
		{
			$to_delete=$_SESSION['current'].'/'.$file;
				if(is_file($to_delete))
				unlink($to_delete);
				else
				recursiveDelete($to_delete);
		}
		
		function back()
		{
				if($_SESSION['current']!="../files/".$_SESSION['login']['email'])
				{
					$pos=strrpos($_SESSION['current'], "/");
					$folder=substr($_SESSION['current'],0,$pos);
					$_SESSION['current']=$folder;
					readDirectory($folder);
				}
				else
				{
					readDirectory($_SESSION['current']);
				}
		}
		
		function read_files($file)
		{
				$file=$_SESSION['current'].'/'.$file;
				$_SESSION['current_opened']=$file;
				$read=fopen($file,"r");
				while(!feof($read)){
				echo htmlentities(fgets($read))."<br/>";
				}
				fclose($read);
		}
		
		function readDirectory($folder)
		{
			$handle=opendir($folder.'/');
			
			$_SESSION['current']=$folder;
			
			$ffolder=substr($folder,strlen("../files/".$_SESSION['login']['email']));
			if($handle)
			{
			while($file=readdir($handle))
			{
				if($file!='.'&&$file!='..')	
				{
					if(is_file($folder.'/'.$file))
					{
						echo "<div class=\"loaded_files\"><div class=\"loaded_file_icon\">";
						echo "<img src='icons/f.png' is='file' class='files' name='$file' folder='$ffolder'></div>";
						echo "<div class=\"loaded_file_txt\">$file</div></div>";
					}
					else
					{
						echo "<div class=\"loaded_files\"><div class=\"loaded_file_icon\">";
						echo "<img src='icons/folder.jpg' is='folder' class='files' name='$file' folder='$ffolder'></div>";
						echo "<div class=\"loaded_file_txt\">$file</div></div>";
					}	
				}
			}
			}
		}
	if(isset($_POST['action'])&&!empty($_POST['action']))
	{
		if($_POST['action']=="readDirectory")
		{
			if(empty($_POST['folder']))
				readDirectory($_SESSION['current']);
			else
				readDirectory($_SESSION['current']."/".$_POST['folder']);
		}
		else if($_POST['action']=="createFile")
		{
			createFile($_POST['file']);
		}
		else if($_POST['action']=="createFolder")
		{
			createFolder($_POST['folder']);
		}
		else if($_POST['action']=="back")
		{
			back();
		}
		else if($_POST['action']=="readfiles")
		{
			if(!empty($_POST['file']))
			read_files($_POST['file']);
		}
		else if($_POST['action']=='delfiles')
		{
			if(!empty($_POST['file']))
				delete_file($_POST['file']);
		}
		else if($_POST['action']=='cut')
		{
			if(!empty($_POST['file']))
			{
				$_SESSION['to_move']=$_SESSION['current'].'/'.$_POST['file'];
				$_SESSION['file_name']=$_POST['file'];
			}
		}
		else if($_POST['action']=='copy')
		{
			if(!empty($_POST['file']))
			{
				$_SESSION['to_copy']=$_SESSION['current'].'/'.$_POST['file'];
				$_SESSION['file_name']=$_POST['file'];
			}
		}
		else if($_POST['action']=='paste')
		{
			if(isset($_SESSION['to_move'])&&!empty($_SESSION['to_move']))
			{
				rename($_SESSION['to_move'],$_SESSION['current'].'/'.$_SESSION['file_name']);
				
				$_SESSION['to_move']="";
				$_SESSION['file_name']="";
			}
			
			if(isset($_SESSION['to_copy'])&&!empty($_SESSION['to_copy']))
			{
				if(is_file($_SESSION['to_copy']))
				copy($_SESSION['to_copy'],$_SESSION['current'].'/'.$_SESSION['file_name']);
				else
				recursiveCopy($_SESSION['to_copy'],$_SESSION['current'].'/'.$_SESSION['file_name']);
				
				$_SESSION['to_copy']="";
				$_SESSION['file_name']="";
			}
		}
	}
	}
	else
	{
		echo "<font color='red'>Login required...</font>";
	}
?>