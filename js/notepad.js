//function to hide all the menu options
function hider()
{
var arr=['file','edit','format','login'];
for(i=0;i<arr.length;i++)
$('.'+arr[i]+'_option').hide();
$('.online_open').hide();
$('.about_notepad').hide();
$('.fonts').hide();
$('.find').hide();
$('.replace').hide();
}

function print_date()
{
	var cd=new Date();
	var hrs=cd.getHours();
	var mid='AM';
	hours=hrs%12;
	if(hours==0)
	hrs=0;
	else if(hrs>12)
	mid='PM';
	var dt=hours+':'+cd.getMinutes()+' '+mid+' '+cd.getDate()+'/'+(cd.getMonth()+1)+'/'+cd.getFullYear();
	$('#work_space').contents().find('body').focus();
	work_space.document.execCommand("InsertHTML",false,dt);
}
	
function open_document()
{
	if(localStorage.getItem("login_status")=="true")
		{
			$('.file').click();
			$('.file').change(function(e){
				if($(this).val()!='')
				{
					var size=$('.file')[0].files[0].size;
					var name=$('.file')[0].files[0].name;
				
					if(size>5000000)
						alert("Max allowed File Size is 5 mb");
					else
					{
						$('#p_title').text(name.toUpperCase());
						$('#file_upload').submit();
					}
				}
			});
		}
		else
		{
			$('.login_option').show();
		}
}	
	
$(document).ready(function(){
work_space.document.designMode = 'On';
hider();

setUser();

//making about,login,register draggable

$('.about_notepad').draggable({containment:'document'});
$('.login_option').draggable({containment:'document'});
$('.registration').draggable({containment:'document'});
$('.online_open').draggable({containment:'document'});
$('.fonts').draggable({containment:'document'});
$('.find').draggable({containment:'document'});
$('.replace').draggable({containment:'document'});

//closing the dialogues
$('#abt_ok , .b_close').click(function(){
$(this).parent().hide();
});

//showing or hiding the dialogues
$('.menu_bar li').click(function(){
	var x=$(this).text().toLowerCase();
	hider();
	if(x=='about')
	$('.about_notepad').show();
	else if(x=='file manager')
	$('.online_open').show();
	else
	$('.'+x+'_option').css('display','flex');
});

$('#new_user').click(function(){
	$('.registration').css('display','flex');
	$('.login_option').hide();
});

$('.title_bar').click(function(){
hider();
});

$('#work_space').contents().find('body').click(function(){
hider();
});

//uploading opened file
$('#file_upload').on('submit',(function(e){
e.preventDefault();
$.ajax({
		url:"php/upload.php",
		type:"POST",
		data:new FormData(this),
		contentType:false,
		cache:false,
		processData:false,
		success:function(data){
		$('#work_space').contents().find('body').html(data);//displaying the content of uploaded file
		}
		});
	}));


//file option of menu bar
$('.file_list li').click(function(){
	var temp=$(this).text().toLowerCase();
	
	var x=temp.indexOf('ctrl');
	if(x>0)
	y=temp.substring(0,x);
	else
	y=temp;
	
	if(y=='open...')//opening existing document
	open_document();
	else if(y=='new') //opening new window 
	window.open('http://localhost/Note/index.php');
	else if(y=='save offline..') //saving the document
	{
		if(localStorage.getItem("login_status")=="true")
		{
		
			$.post('php/check_current_opened.php',{},function(data){
				if(data=="true")
				{
					$.post('php/upload.php',{action:'dwnlink',current:""},function(data){
						window.location=data;
					});
				}
				else if(data=="false")
				{
					txt=$('#work_space').contents().find('body').html();
							if(txt!="")
							{
								$('#open_button').text("Save");
								localStorage.setItem("note_data",txt);
								$('.online_open').show();
							}
							else 
								alert("Nothing to Save");
				}
			});
		}
		else
		{
			$('.login_option').show();
		}
	}
	else if(y=='save online..')
	{
		if(localStorage.getItem("login_status")=="true")
		{
			$.post('php/check_current_opened.php',{},function(data){
				if(data=="false")
				{
							txt=$('#work_space').contents().find('body').html();
							if(txt!="")
							{
								$('#open_button').text("Save");
								localStorage.setItem("note_data",txt);
								$('.online_open').show();
							}
							else 
								alert("Nothing to Save");
				}
				else if(data=="true"){
						txt=$('#work_space').contents().find('body').html();
						$.post('php/save.php',{data:txt},function(data){
								alert("saved...");
						});
				}
			});
		}
		else
		{
			$('.login_option').show();
		}
	}
	else if(y=='print...')
	window.frames["work_space"].print();
	else if(y=='exit')
	window.close();
	
	$('.file_option').hide();
});

//edit option of menu bar 
$('.edit_list li').click(function(){
	
	var temp=$(this).text().toLowerCase();
	var x=temp.indexOf('ctrl');
	if(x>0)
	y=temp.substring(0,x);
	else
	y=temp;
	
	if(y=='select all')
	{
	$('#work_space').contents().find('body').focus();
	work_space.document.execCommand('SelectAll',false,null);
	}
	else if(y=='undo')
	work_space.document.execCommand('Undo',false,null);
	else if(y=='cut')	
	{
	x=window.frames["work_space"].getSelection().toString();
	localStorage.setItem("clipboard",x);
	work_space.document.execCommand('delete',false,null);
	}
	else if(y=='copy')
	{
    x=window.frames["work_space"].getSelection().toString();
	localStorage.setItem("clipboard",x);
	}
	else if(y=='paste')
    {
	paste=localStorage.getItem("clipboard");
	work_space.document.execCommand("InsertHTML",false,paste);
	}
	else if(y=='deletedel')
	work_space.document.execCommand('Delete',false,null);
	else if(y=='find...')
	{
		$('.find').show();
		$('#find_what').focus();
	}
	else if(y=='find nextf3')
	{
		$('.find').show();
	}
	else if(y=='replace...')
	{
		$('.replace').show();
	}
	else if(y=='time/datef5')
	{
		print_date();
	}
	$('.edit_option').hide();
});

$('.font_format').click(function(){
var x=$(this).text();
$(this).parent().parent().parent().hide();
$('.fonts').show();
});

$('.close_login ,.close_registration').click(function(){
	$(this).parent().parent().hide();
});

$('.close_find').click(function(){
	$(this).parent().parent().hide();
	var str=$('#work_space').contents().find('body').html();
	str=str.replace(/<\/?span[^>]*>/g,"");
	$('#work_space').contents().find('body').html(str);
});

});


//shortcut key handling 

$('#work_space').contents().find('body').keydown(function(e) {
			
			if(e.ctrlKey && e.keyCode==78){//ctrl+n
				window.open('http://localhost/Note/index.php');
				e.preventDefault();
			}
			else if(e.ctrlKey && e.keyCode==79){//ctrl+o
					open_document();
					e.preventDefault();
			}
			else if(e.ctrlKey && e.keyCode==80)//ctrl+p
			{
				window.frames["work_space"].print();
				e.preventDefault();
			}
			else if(e.ctrlKey && e.keyCode==70)//ctrl+f
			{
				$('.find').show();
				$('#find_what').focus();
				e.preventDefault();
			}
			else if(e.ctrlKey && e.keyCode==72)//ctrl+h
			{
				$('.replace').show();
				e.preventDefault();
			}
			if(e.keyCode==116)//f5
			{
				print_date();
				e.preventDefault();
			}		
}); 

$(window).on('unload',function(){
	$.post('php/unset_current_opened.php',{},function(data){
	});
});	