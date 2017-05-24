<?php
$fonts=array('Arial','Calibri','Comic Sans','Courier','Cursive','Fantasy','Frosty','Garamond','Georgia','Helvetica','Impact','Monospace','Open Sans','Sans-serif','Serif','Script','Times New Roman','Tw Cen MT','Verdana');

$sizes=array(8,9,10,11,12,14,16,18,20,22,24,26,28,36,48,72);
?>
<html>
	<head>
		<title>Notepad</title>
		<link rel="stylesheet" href="css/notepad.css">
		<link rel="stylesheet" href="css/menu.css">
		<link rel="stylesheet" href="file_manager.css">
		<link rel="stylesheet" href="fonts.css">
	</head>
	<body>
		
		<div class="title_bar">
			<div class="notepad_icon"><img src="icons/notepad.png"><span class="log_name"><?php
			session_start();
			echo @$_SESSION['login']['name'];
			?></span></div>
			<h1><span id="p_title">Untitled</span> - Notepad</h1>
		</div>
		
		<div class="menu_bar">
			<ul>
				<li>File</li>
				<li>Edit</li>
				<li>Format</li>
				<li class="login_li">Login</li>
				<li class="file_manager">File Manager</li>
				<li>About</li>
				<li class="log_out">Log Out</li>
			</ul>
		</div>

		<div class="file_option">
			<div class="blank">
			</div>
			<div class="file_list">
			<ul>
			<li>New<span class="file_short">Ctrl+N</span></li>
			<li>Open...<span class="file_short">Ctrl+O</span></li>
			<form id="file_upload" name="f1" action="" method="post" enctype="multipart/form-data">
			<input name="file" type="file" class="file">
			</form>
			<li>Save Online..</li>
			<li>Save Offline..<span class="file_short">Ctrl+S</span></li>
			<hr>
			<li>Print...<span class="file_short">Ctrl+P</span></li>
			<hr>
			<li>Exit</li>
			</ul>
			</div>
		</div>
		
		<div class="edit_option">
			<div class="blank">
			</div>
			<div class="edit_list">
			<ul>
				<li>Undo<span class="file_short">Ctrl+Z</span></li>
				<hr>
				<li>Cut<span class="file_short">Ctrl+X</span></li>
				<li>Copy<span class="file_short">Ctrl+C</span></li>	
				<li>Paste<span class="file_short">Ctrl+V</span></li>
				<li>Delete<span class="file_short">Del</span></li>
				<hr>
				<li>Find...<span class="file_short">Ctrl+F</span></li>
				<li>Find Next<span class="file_short">F3</span></li>
				<li>Replace...<span class="file_short">Ctrl+H</span></li>
				<hr>
				<li>Select All<span class="file_short">Ctrl+A</span></li>	
				<li>Time/Date<span class="file_short">F5</span></li>
			</ul>
			</div>
		</div>

		<div class="format_option">
			<div class="blank">
				<ul>
				<li><input type="checkbox" id="wrap_check"></li>
				</ul>
			</div>
			<div class="format_list">
			<ul>
			<li>Word Wrap</li>
			<li class="font_format">Font...</li>
			</ul>
			</div>
		</div>
		
		<div class="login_option">
			<div class="login_title">
				<h4>Login</h4>
				<img src="icons/cls.png" class="close_login" height="20px" width="20px">
			</div>
			<div class="login_area">
				<ul>
					<li>Email:<input type="text" id="log_mail"></input></li><br>
					<li>Password:&nbsp;<input type="password" id="log_password"></input></li>
				</ul>
			</div>
			<div class="login_bottom">
					<a href="#" id="new_user">New user??</a>
					<button id="log_in" style="width:80px;height:30px;">Login</button>
			</div>
		</div>
		
		<div class="registration">
			<div class="registration_title">
				<h4>Registration</h4>
				<img src="icons/cls.png" height="20px" width="20px" class="close_registration">
			</div>
			<div class="registration_area">
				<ul>
					<li>Name:<input type="text" id="r_name"></input></li>
					<li>Email:<input type="text" id="r_mail"></input></li>
					<li>Password:<input type="password" id="r_pass"></input></li>
					<li>Confirm Password:<input type="password" id="r_conf"></input></li>
					<li><span id="reg_feed"></span><button id="sign_up">Sign Up</button></li>
				</ul>
			</div>			
		</div>
		
		<div class="about_notepad">
				<h3>About Notepad</h3>
			<div class="logo_area">
				<img src="icons/sj.gif" id="logo"></img>
				<h2>Sun14</h2>
			</div>
			<hr>
			<div class="about_info">
			<img src="icons/sjp.jpg" id="sj_pic" alt="Suraj Kumar"></img>
			<p>Sun14 <br> Version 0.1(build 9600)<br>
				&copy;2015 SJ-Ray Corporation. All Rights Reserved.<br>
				On-line Notepad is a approach to provide text editing solutions
				<br>on server based operating systems.<br><br>
				Created just for fun and learning purpose
						by <strong>Suraj Kumar</strong>
			</p>
			</div>
			<br><br>
			<button id="abt_ok"> Ok </button>
		</div>
		
		<div class="online_open">
		<div class="open_title">
			<div class="notepad_icon"><img src="icons/notepad.png"></div>
			<span class="op_title">File Manager</span>
			<div class="controls">
				<span style="position:relative;left:-5px;"><img src="icons/cls.png" height="25px" width="25px" class="close_manager"></span>
			</div>
		</div>
		
	<div class="open_contents">
		<div class="location_nav_section">
			<span>
			<img src="icons/home_arrow_inactive.png">
			<img src="icons/home_arrow_active_rtl.png" class="back">
			<img src="icons/ssdk_title_div.png" height="10px">
			</span>
			
			<input type="text" class="file_input" id="location_display" placeholder="root">
			
			<img src="icons/browser_refresh.png" class="refresh_button">
			
			<input type="text" class="search_input" placeholder="Search here">
			<span style="position:relative;right:20px;top:5px;">
			<img src="icons/logo.contrast-white_scale-80.png" class="search_button" height="15px">
			</span>
		</div>
		<div class="layout_preview_option">
			<span>&nbsp;<img src="icons/images.jpg" height="30px" width="40px" 
			class="tools" id="create_folder"></span>
			
			<span style="margin-left:20px"><img src="icons/p.jpg" height="30px" width="40px" class="tools" id="create_file"></span>
			
			<span style="margin-left:20px"><img src="icons/del.jpg" height="30px" width="40px" class="tools" id="delete"></span>
			
			<span style="margin-left:20px"><img src="icons/cut1.jpg" height="30px" width="40px" class="tools" id="cut"></span>
			
			<span style="margin-left:20px"><img src="icons/copy1.jpg" height="30px" width="40px" class="tools" id="copy"></span>
			
			<span style="margin-left:20px"><img src="icons/paste.jpg" height="30px" width="40px" class="tools" id="paste"></span>
			
			<span style="margin-left:20px"><img src="icons/download1.jpg" height="30px" width="40px" class="tools" id="download"></span>
				
		</div>
		<div class="content_display">
			
		</div>
		<div class="content_footer">
			<div class="file_related_footer">
				File name:<input type="text" class="file_input" id="file_selected">
				<select class="extension">
				<option value="">All Files (*.*)</option>
				<option value=".txt" >Text Documents (*.txt)</option>
				</select>
			</div>
			<div class="file_related_footer1">
				Encoding:<select class="encoding">
				<option>ANSI</option>
				</select>
				<button class="btn" id="open_button">Open</button>
				<button class="btn" id="cancel_button">Cancel</button>
			</div>
		</div>
	</div>
</div>

	<div class="fonts">
		<div class="font_title_bar">
			<h4> Fonts </h4>
			<img src='icons/cls.png' id="font_close" height='20px' width='20px'>
		</div>
		<div class="font_content">
			<div class="upper">
				<div class="font_selection">
					<h4> Font: </h4>
					<input type="text" id="selected_font">
					<select size="7" id="select_font">
					<?php 
						foreach($fonts as $font)
							echo "<option value=\"$font\">$font</option>";
					?></select>
				</div>
				<div class="style_selection" style="margin-left:15px;">
					<h4> Font Style: </h4>
					<input type="text" id="selected_style">
					<select size="7" id="select_style">
						<option value="regular">Regular</option>
						<option value="italic" style="font-style:italic">Italic</option>
						<option value="bold" style="font-weight:bold">Bold</option>
						<option value="bold italic" style="font-style:italic;font-weight:bold">Bold Italic</option>
					</select>
				</div>
				<div class="size_selection">
					<h4> Size: </h4>
					<input type="text" id="selected_size">
					<select size="7" id="select_size">
					<?php 
						foreach($sizes as $size)
							echo "<option value=\"$size\">$size</option>";
					?>
					</select>
				</div>
			</div>
			<div class="middle">
					<fieldset class="sample_text">
						<legend> Sample </legend>
						<h3 class="text_to_test"> Sample Text </h3>
					</fieldset>
			</div>
			<div class="lower">
					<button id="set_font"> OK </button>
					<button id="set_font_cancel"> Cancel </button>
			</div>
		</div>
	</div>
	
	
	<div class="find">
		<div class="find_title">
			<h4>Find</h4>
			<img src="icons/cls.png" height="20px" width="20px" class="close_find">
		</div>
		<div class="find_body">
			<div class="find_body_upper">
			<h5 style="font-size:13px">Find what:</h5>
			<input type="text" style="height:20px;width:150px;" id="find_what"></input>
			<button id="find">Find Next</button>
			</div>
			<br>
			<div class="find_body_lower">
			<input type="checkbox" id="find_match_case">Match Case</input>
			<fieldset>
				<legend>Direction</legend>
				<input type="radio" name="direction" class="find_radio" value="up">Up</input>
				<input type="radio" name="direction" class="find_radio" value="down" checked>Down</input>
			</fieldset>
			<button class="find_cancel">Cancel</button>
			</div>
		</div>
	</div>
	
	<div class="replace">
		<div class="replace_title">
			<h4>Replace</h4>
			<img src="icons/cls.png" height="20px" width="20px" class="close_find">
		</div>
		<div class="replace_body">
			<div class="replace_inputs">
			<div style="display:flex;justify-content:space-between;">Find what:<input type="text" style="height:20px" id="find_what_replace"></input></div>
			<div style="display:flex;margin-top:10px;">Replace with:<input type="text"style="height:20px" id="replace_with"></input></div><br>
			<input type="checkbox" id="match_case_replace">Match Case</input>
			</div>
			<div class="replace_buttons">
				<button id="find_next_replace">Find Next</button>
				<button id="replace">Replace</button>
				<button id="replace_all">Replace All</button>
				<button class="find_cancel">Cancel</button>
			</div>
		</div> 
	</div>
				<iframe name="work_space" id="work_space">
				<html>
					<body>
				
					</body>
				</html>
				</iframe>
			
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery-ui.js"></script>
		<script type="text/javascript" src="js/com.js"></script>
		<script type="text/javascript" src="file_manager.js"></script>
		<script type="text/javascript" src="js/notepad.js"></script>
	</body>
</html>
