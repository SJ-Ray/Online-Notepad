<html>
<head>
<title>Open</title>	
<style>
	.find{
		width:320px;
		border:1px solid #6ca4d8;
		box-shadow:8px 8px 5px #888;
	}	
	.replace{
		width:332px;
		border:1px solid #6ca4d8;
		font-size:12px;
		box-shadow:8px 8px 5px #888;
	}
	.find_title,.replace_title{
		display:flex;
		justify-content:space-between;
		align-items:center;
		height:20px;
		background-color:#6ca4d8;
		padding:3px;
	}
	.find_body{
		background-color:#F0F0F0;
	}
	.find_body_upper{
		display:flex;
		justify-content:space-between;
		align-items:center;
		padding:3px;
	}
	.find_body_lower{
		position:relative;
		top:-10px;
		display:flex;
		font-size:13px;
		justify-content:space-between;
		align-items:flex-start;
		padding:3px;
	}
	.find button{
		height:20px;
		width:80px;
		font-size:10px;
	}
	.replace_body{
		display:flex;
		background-color:#F0F0F0;
	}
	.replace_inputs{
		margin:10px;
	}
	.replace_buttons{
		padding:10px;
		display:flex;
		flex-direction:column;
	}
	.replace_buttons button{
		font-size:11px;
		width:80px;
		}
</style>
<body>
	<div class="find">
		<div class="find_title">
			<h4>Find</h4>
			<img src="icons/cls.png" height="23px" width="23px" class="close_manager">
		</div>
		<div class="find_body">
			<div class="find_body_upper">
			<h5 style="font-size:13px">Find what:</h5>
			<input type="text" style="height:20px;width:150px;"></input>
			<button>Find Next</button>
			</div>
			<div class="find_body_lower">
			<input type="checkbox">Match Case</input>
			<fieldset>
				<legend>Direction</legend>
				<input type="radio" name="direction" value="up">Up</input>
				<input type="radio" name="direction" value="down">Down</input>
			</fieldset>
			<button>Cancel</button>
			</div>
		</div>
	</div>
	<br>
	<div class="replace">
		<div class="replace_title">
			<h4>Replace</h4>
			<img src="icons/cls.png" height="23px" width="23px" class="close_manager">
		</div>
		<div class="replace_body">
			<div class="replace_inputs">
			<div style="display:flex;justify-content:space-between;">Find what:<input type="text" style="height:20px"></input></div>
			<div style="display:flex;margin-top:10px;">Replace with:<input type="text"style="height:20px"></input></div><br>
			<input type="checkbox">Match Case</input>
			</div>
			<div class="replace_buttons">
				<button>Find Next</button>
				<button>Replace</button>
				<button>Replace All</button>
				<button>Cancel</button>
			</div>
		</div> 
	</div>
</body>
</html>	