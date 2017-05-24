var login_status;
var search_index=[];
var find_counter=-1;

function logCheck()
{
	$.post('php/login_status.php',{},function(data){
			if(data=="100")
			localStorage.setItem("login_status","true");
			else if(data=="001")
			localStorage.setItem("login_status","false");
	});
	
}

function setUser()
{	

	logCheck();
	
	if(localStorage.getItem("login_status")=="true")
	{
			$('.log_name').css('background-color','black');
			$('.login_li').hide();
			$('.file_manager').show();
			$('.log_out').show();
	}
	else
	{
			$('.login_option').css('display','flex');
			$('.log_name').text("").css('background-color','');
			$('.login_li').show();	
			$('.log_out').hide();
			$('.file_manager').hide();
	}
}

$(document).ready(function(){
	
$('#log_in').click(function(){
var mail=$('#log_mail').val();
var pass=$('#log_password').val();
if(mail==''||pass=='')
	alert("All fields are important");
else{
		$.post('php/login.php',{email:mail,password:pass},function(data){
			$.post('php/user_info.php',{action:"getName"},function(name){
				$('.log_name').text(name).css('background-color','black');
				$('.login_li').hide();
				$('.file_manager').show();
				$('.log_out').show();
				display("");
				localStorage.setItem("login_status","true");
				$('.login_option').hide();
			});
		});
}
});

$('.log_out').click(function(){
	$.post('php/log_out.php',{},function(data){
		setUser();
	});
});

$('#sign_up').click(function(){
var name=$('#r_name').val();
var email=$('#r_mail').val();
var pass=$('#r_pass').val();
var cnf=$('#r_conf').val();

if(name==''||email==''&&pass==''&&cnf=='')
{
	$('#reg_feed').html("<font color='red'>All Fields are Required...</font>");
}

if(pass!=cnf)
	$('#reg_feed').html("<font color='red'>Password Not Matched...</font>");
else
	$('#reg_feed').html("");

$.post('php/register.php',{name:name,email:email,pass:pass,cnf:cnf},function(data){
	if(data=="231")
	{
		$('#reg_feed').html("<font color='green'>Successfully Registered...</font>");
		
		$('.registration').fadeOut(500);
	}
	else
		$('#reg_feed').html(data);
});

});

$('#download').click(function(){
		if(selected_file!="")
		{
			//$.post('php/upload.php',{action:'dwnlink',current:selected_file},function(data){
			var form = $('<form></form>').attr('action', 'php/upload.php').attr('method', 'post');
		
			form.append($("<input></input>").attr('type', 'hidden').attr('name', 'action').attr('value', 'dwnlink'));
		
			form.append($("<input></input>").attr('type', 'hidden').attr('name', 'current').attr('value', selected_file));
		
			form.appendTo('body').submit().remove();
			
			//});
		}
});

$('#r_name').focusout(function(){
var name=$('#r_name').val();
var nameReg=/(\d|[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?])/g;
	if(nameReg.test(name))
	$('#reg_feed').html("<font color='red'>Pls. Enter a valid Name");
	else 
	$('#reg_feed').html("");
});

$('#r_mail').focusout(function(){
var email=$('#r_mail').val();
var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

	if(!emailReg.test(email))
	$('#reg_feed').html("<font color='red'>Pls. Enter a valid Email");
	else 
	$('#reg_feed').html("");
});

function indexer(find_what,match_case)
{
	var str=$('#work_space').contents().find('body').html();
	str=str.replace(/<\/?span[^>]*>/g,"");
	arr=str.split(' ');
	var newStr="";
	c=0;
				if(match_case)
				{	
					for(index in arr)
					{
						if(arr[index]==find_what || arr[index]==find_what+'<br>')
							search_index[c++]=index;
					}
				}
				else 
				{
					for(index in arr)
					{
						if(arr[index].toLowerCase()==find_what.toLowerCase() || arr[index].toLowerCase()==find_what.toLowerCase()+'<br>' )
							search_index[c++]=index;
					}
				}
}

function search_highlight(find_radio)
{
	var str=$('#work_space').contents().find('body').html();
	str=str.replace(/<\/?span[^>]*>/g,"");
	arr=str.split(' ');
			try{
				
				if(find_radio=='down')
				{	
					if(find_counter<search_index.length-1)
					find_counter++;
				
					arr[search_index[find_counter]]="<span style='background-color:yellow'>"+arr[search_index[find_counter]]+"</span>";
				}
				else
				{
					if(find_counter>0)
					find_counter--;
			
					arr[search_index[find_counter]]="<span style='background-color:yellow'>"+arr[search_index[find_counter]]+"</span>";
				}
			}
			catch(e){
				alert("item not found");
			}
			newStr=arr.join(' ');
			$('#work_space').contents().find('body').html(newStr);
}

$('#find').click(function(){
		x=$('#find_what').val().trim();
		match_case=$('#find_match_case').is(':checked');
		find_radio=$('.find_radio:checked').val(); 
		
		if(x!="")
		{
			indexer(x,match_case);
			search_highlight(find_radio);
		}
		else
			alert("Nothing to Search for...");
});

$('#find_next_replace').click(function(){
	x=$('#find_what_replace').val().trim();
	match_case=$('#match_case_replace').is(':checked');
	if(x!="")
	{
			indexer(x,match_case);
			search_highlight("down");
	}
	else
		alert("Nothing to Search for...");
});

$('#replace').click(function(){
replace_with=$('#replace_with').val().trim();
	var str=$('#work_space').contents().find('body').html();
		str=str.replace(/<\/?span[^>]*>/g,"");
		arr=str.split(' ');
		try{
			arr[search_index[find_counter]]=replace_with;
		}
		catch(e)
		{
			alert("nothing to replace for");
		}
		newStr=arr.join(' ');
		$('#work_space').contents().find('body').html(newStr);
});

$('#replace_all').click(function(){
replace_with=$('#replace_with').val().trim();
var str=$('#work_space').contents().find('body').html();
		str=str.replace(/<\/?span[^>]*>/g,"");
		arr=str.split(' ');
		try{
			for(index in search_index)
			arr[search_index[index]]=replace_with;
		}
		catch(e)
		{
		}
		newStr=arr.join(' ');
		$('#work_space').contents().find('body').html(newStr);
});

$('.find_cancel').click(function(){
	$(this).parent().parent().parent().hide();
	var str=$('#work_space').contents().find('body').html();
	str=str.replace(/<\/?span[^>]*>/g,"");
	$('#work_space').contents().find('body').html(str);
});

});