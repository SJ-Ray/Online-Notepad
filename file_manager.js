var selected_file;
var selected_file_obj;

function display(folder){
	$.post('php/directory.php',{action:"readDirectory",folder:folder},function(data){
		$('.content_display').html(data);
	});
}

display("");

function set_style(selector,x){
		if(x=="italic")
		{
			$(selector).css('font-weight',"");
			$(selector).css('font-style',x);
		}
		else if(x=="regular")
		{
			$(selector).css('font-weight',"");
			$(selector).css('font-style',"normal");
		}
		else if(x=="bold")
		{
			$(selector).css('font-weight',"bolder");
			$(selector).css('font-style',"");
		}
		else if(x=="bold italic")
			$(selector).css('font-style',"italic").css('font-weight',"bold");

}

$(document).ready(function(){
	
	$(document).on("click",'.files',function(){
		
		file_name=$(this).attr('name');
		folder=$(this).attr('folder');
		selected_file_obj=$(this);	
		selected_file=file_name;
		
		$('.loaded_files').css('border','');
		$(this).parent().parent().css('border','1px solid #56C5FF');
		$('#file_selected').val(file_name);
		$('#location_display').val(folder);
	});
	
	
	$(document).on("dblclick",'.files',function(){
		type=$(this).attr('is');
		folder=$(this).attr('name');
		if(type=="folder")
		{
			$('#location_display').val(folder);
			display(folder);
		}
		else if(type=="file")
		{
			$.post('php/directory.php',{action:"readfiles",file:folder},function(data){
				$('#work_space').contents().find('body').html(data);
				$('#p_title').text(folder.toUpperCase());
				$('.online_open').hide();	
			});
		}
	});
	
	$('.back').click(function(){
		$.post('php/directory.php',{action:"back"},function(data){
			$('.content_display').html(data);
		});
	});
	
	$('.refresh_button').click(function(){
		display("");
	});
	
	$('#create_folder').click(function(){
		x=prompt("Enter folder name");
		if(x!="")
		{
			$.post('php/directory.php',{action:"createFolder",folder:x},function(data){
				display("");
			});
		}
		else
			alert("Folder Name Required...");
	});
	
	$('#create_file').click(function(){
		x=prompt("Enter File Name");
		if(x!="")
		{
			$.post('php/directory.php',{action:"createFile",file:x},function(data){
				display("");
			});
		}
		else
			alert("File Name Required...");
	});
	
	$('.search_input').keydown(function(){
		
	});
	
	$('#delete').click(function(){
		if(selected_file=="")
			alert("No files Selected");
		else
		{
			if(confirm("confirm delete "+selected_file+"?"))
			{
			$.post('php/directory.php',{action:"delfiles",file:selected_file},function(data){
				display("");
			});
			}
		}
	});
	
	$('#cut').click(function(){
		if(selected_file=="")
			alert("No files selected");
		else{
			$.post('php/directory.php',{action:"cut",file:selected_file},function(data){
				$('.files').css('opacity','1');
				selected_file_obj.css('opacity','0.4');
			});
		}
	});
	
	$('#copy').click(function(){
		if(selected_file=="")
			alert("No files selected");
		else{
			$.post('php/directory.php',{action:"copy",file:selected_file},function(data){
			});
		}
	});
	
	$('#paste').click(function(){
			$.post('php/directory.php',{action:"paste"},function(data){
				display("");
			});
	});
	
	$('#open_button').click(function(){
		work=$(this).text();
		if(work=="Save")
		{
			filename=$('#file_selected').val();
			data=localStorage.getItem("note_data");
			ext=$('.extension').val();
			$.post('php/save.php',{filename:filename,data:data,ext:ext},function(data){
				display("");
			});
		}
		else if(work=="Open")
		{
			if(selected_file!="")
			{
				$.post('php/directory.php',{action:"readfiles",file:selected_file},function(data){
					$('#work_space').contents().find('body').html(data);
					$('#p_title').text(selected_file.toUpperCase());
					$('.online_open').hide();	
				});
			}
			else
				alert("Pls select a file...");
		}
	});
	
	
	$('#cancel_button, .close_manager').click(function(){
		$('.online_open').hide();
		$('#open_button').text("Open");
		$('#open_button').attr("id","open_button");
	});
	
	$('#select_font').change(function(){
		x=$(this).val();
		$('#selected_font').val(x);
		$('.text_to_test').css('font-family',x);
	});
	
	$('#select_style').change(function(){
		x=$(this).val();
		$('#selected_style').val(x);
		set_style('.text_to_test',x);
	});
	
	$('#select_size').change(function(){
		x=$(this).val();
		$('#selected_size').val(x);
		$('.text_to_test').css('font-size',x+'px');
	});
	
	$('#set_font').click(function(){
		family=$('#select_font').val();
		size=$('#select_size').val();
		style=$('#select_style').val();
		if(size!="")
			$('#work_space').contents().find('body').css('font-size',size+'px');
		if(family!="")	
			$('#work_space').contents().find('body').css('font-family',family);
		if(style!="")
		{
			set_style($('#work_space').contents().find('body'),style);
		}
		
		$('#work_space').contents().find('body').focus();
		$('.fonts').hide();
	});
	
	$('#set_font_cancel,#font_close').click(function(){
		$('.fonts').hide();
	});
	
});