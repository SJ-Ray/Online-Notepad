<?php
$fonts=array('Agency FB','Antiqua','Architect','Arial','BankFuturistic','BankGothic','Blackletter','Blagovest','Calibri','Comic Sans','Courier','Cursive','Decorative','Fantasy','Fraktur','Frosty','Garamond','Georgia','Helvetica','Impact','Minion','Modern','Monospace','Open Sans','Palatino','Roman','Sans-serif','Serif','Script','Swiss','Times','Times New Roman','Tw Cen MT','Verdana');

$sizes=array(8,9,10,11,12,14,16,18,20,22,24,26,28,36,48,72);
?>
<html>
<head>
<title> Fonts </title>
<style>
*{
margin:0px;
padding:0px;
}

.fonts{
	border:2px solid #6ca4d8;
	width:42%;
	-webkit-box-shadow:10px 10px 5px #888;
	box-shadow:8px 8px 5px #888;
}

.font_title_bar{
background-color:#6ca4d8;
display:flex;
justify-content:space-between;
align-items:center;
padding:5px;
}

.font_content{
	display:flex;
	background-color:#F0F0F0;
	flex-direction:column;
}
.font_content .upper{
	display:flex;
	justify-content:space-between;
	padding:10px;
}

.font_content .middle{
	display:flex;
	justify-content:center;
}

.sample_text{
border:1px solid gray;
display:flex;
justify-content:center;
padding:20px;
width:60%;
height:60px;
}

.lower{
display:flex;
margin:12px 25px 10px 0px;
justify-content:flex-end;
}

.lower button{
	height:30px;
	width:100px;
	margin-left:10px;
}

.upper input{
		border:1px solid blue;
}

.upper select{
	border:1px solid gray;
}

.upper input,.upper select{
	width:90%;
}

.font_selection input,.font_selection select{
	width:100%;
}

.size_selection input,.size_selection select{
	width:80%;
}
</style>
</head>
<body>
	<div class="fonts">
		<div class="font_title_bar">
			<h4> Fonts </h4>
			<img src='icons/cls.png' height='20px' width='20px'>
		</div>
		<div class="font_content">
			<div class="upper">
				<div class="font_selection">
					<h4> Font: </h4>
					<input type="text">
					<select size="7">
					<?php 
						foreach($fonts as $font)
							echo "<option value=\"$font\">$font</option>";
					?></select>
				</div>
				<div class="style_selection" style="margin-left:15px;">
					<h4> Font Style: </h4>
					<input type="text">
					<select size="7">
						<option value="regular">Regular</option>
						<option value="italic" style="font-style:italic">Italic</option>
						<option value="bold" style="font-weight:bold">Bold</option>
						<option value="bold italic" style="font-style:italic;font-weight:bold">Bold Italic</option>
					</select>
				</div>
				<div class="size_selection">
					<h4> Size: </h4>
					<input type="text">
					<select size="7">
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
						<h3> Sample Text </h3>
					</fieldset>
			</div>
			<div class="lower">
					<button> OK </button>
					<button> Cancel </button>
			</div>
		</div>
	</div>
</body>
</html>