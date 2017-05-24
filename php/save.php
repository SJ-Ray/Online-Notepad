<?php
include 'simple_html_dom.php';
session_start();

function file_write($filename,$data)
{
	$content=str_get_html($data);
	$data=html_entity_decode($content->plaintext);
	$handle=fopen($filename,'w');
	fwrite($handle,$data);
	fclose($handle);
}

if(isset($_POST['filename'])&&isset($_POST['data']))
{
	if(!empty($_POST['filename'])&&!empty($_POST['data'])){
		if(strpos($_POST['filename'],"."))
		$filename=$_POST['filename'];
		else
		$filename=$_POST['filename'].$_POST['ext'];
		
		file_write($_SESSION['current'].'/'.$filename,$_POST['data']);
	}
}

if(isset($_POST['data']))
{
		file_write($_SESSION['current_opened'],$_POST['data']);
}

?>