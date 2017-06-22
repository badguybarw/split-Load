<?php
session_start();
?>

<html>
<head>
<title>Admin Panel</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700' rel='stylesheet' type='text/css'>
<link href="assets/css/admin.css" rel="stylesheet">
<script src="assets/js/admin.js"></script> 
</head>
<body>

<?php
include('config.php');

if($_GET['logout'] == 1){
session_destroy();
?>
<meta http-equiv="refresh" content="0; url=admin.php" />
<?php
}

for($i = 0; $i < 20; $i++){

$password = str_replace("##%X%%","1",$password);
$password = str_replace("##XX%%","2",$password);
$password = str_replace("##%XH%%","3",$password);
$password = str_replace("##D%X%%","A",$password);
$password = str_replace("##%XD%%","C",$password);
$password = str_replace("##D%X%%","B",$password);
$password = str_replace("##DX%%","D",$password);
$password = str_replace("##D%Xd%%","a",$password);
$password = str_replace("##%XDd%%","c",$password);
$password = str_replace("##D%Xd%%","b",$password);
$password = str_replace("##DXd%%","d",$password);
$password = str_replace("##DcwaXd%%","e",$password);

}

if($password == $_POST['password']){
	$_SESSION['is_logged'] = 1;
}

 if($_SESSION['is_logged'] == 1){
	
include('crawldata.php');


$apikey = str_replace("#%X","1",$apikey);
$apikey = str_replace("X#H","2",$apikey);
$apikey = str_replace("X#&H","3",$apikey);
$apikey = str_replace("X6#H","5",$apikey);

if($_POST['function'] == "save"){
	
$arr = array("details"=>array("servername"=>$_POST['servername'],"description"=>$_POST['description'],
"rules"=>array(
"1"=>array("text"=>$_POST['r1txt'],"status"=>$_POST['r1on']),
"2"=>array("text"=>$_POST['r2txt'],"status"=>$_POST['r2on']),
"3"=>array("text"=>$_POST['r3txt'],"status"=>$_POST['r3on']),
"4"=>array("text"=>$_POST['r4txt'],"status"=>$_POST['r4on']),
"5"=>array("text"=>$_POST['r5txt'],"status"=>$_POST['r5on'])
),"slogan"=>$_POST['slogan']));
	
	
	$file = "storage/details.json";
$fh = fopen($file, 'w') or die("Couldn't open File! Change the .json files (storage/.json) Permissions to 777");
$imp = json_encode($arr);
fwrite($fh, $imp);
fclose($fh);
?>
<meta http-equiv="refresh" content="0">
<?php

$apikeyh = str_replace("1","#%X",$_POST['apikey']);
$apikeyh = str_replace("2","X#H",$apikeyh);
$apikeyh = str_replace("3","X#&H",$apikeyh);
$apikeyh = str_replace("5","X6#H",$apikeyh);
	
	$arr = array("settings"=>array("apikey"=>$apikeyh,"background"=>$_POST['background'],"music"=>$_POST['music'],"volume"=>$_POST['volume'],"progressbar_color"=>$_POST['color_progress_txt']));
	
	
	$file = "storage/settings.json";
$fh = fopen($file, 'w') or die("Couldn't open File! Change the .json files (storage/.json) Permissions to 777");
$imp = json_encode($arr);
fwrite($fh, $imp);
fclose($fh);
?>
<meta http-equiv="refresh" content="0">
<?php




$arr = array("staff"=>array(
"1"=>array("steamid"=>$_POST['staff1steam'],"status"=>$_POST['staff1on'],"rank"=>$_POST['staff1rank'],"color"=>$_POST['color_txt_staff1']),
"2"=>array("steamid"=>$_POST['staff2steam'],"status"=>$_POST['staff2on'],"rank"=>$_POST['staff2rank'],"color"=>$_POST['color_txt_staff2']),
"3"=>array("steamid"=>$_POST['staff3steam'],"status"=>$_POST['staff3on'],"rank"=>$_POST['staff3rank'],"color"=>$_POST['color_txt_staff3']),
"4"=>array("steamid"=>$_POST['staff4steam'],"status"=>$_POST['staff4on'],"rank"=>$_POST['staff4rank'],"color"=>$_POST['color_txt_staff4'])

));

	
	$file = "storage/staff.json";
$fh = fopen($file, 'w') or die("Couldn't open File! Change the .json files (storage/.json) Permissions to 777");
$imp = json_encode($arr);
fwrite($fh, $imp);
fclose($fh);
?>
<meta http-equiv="refresh" content="0">
<?php


	
	$arr = array("layouts"=>array("layouttop"=>$_POST['layout_top'],"layoutbottom"=>$_POST['layout_bottom']));
	
	
	$file = "storage/layouts.json";
$fh = fopen($file, 'w') or die("Couldn't open File! Change the .json files (storage/.json) Permissions to 777");
$imp = json_encode($arr);
fwrite($fh, $imp);
fclose($fh);
?>
<meta http-equiv="refresh" content="0">
<?php
}
?>
<form method="post" action="admin.php">
<div id="function-box"><input type="submit" id="update-box" value="Save changes"><a href="admin.php?logout=1"><div id="logout-box">Logout</div></a></div>
<div id="panel-body">
<input name="function" value="save" hidden>

<p style="text-align: center;font-size: 40px; margin: 5px 0 0 0;">Admin Panel</p>
<hr style="width: 50%">
<p style="text-align: center;font-size: 30px; margin: 0px 0 0 0;">General</p>

<p style="font-size: 18px">Servername</p>
<input style="margin: -10px 0 0 0; width: 100%;" type="text" name="servername" class="input-text" value="<?php echo $servername; ?>">
<p style="font-size: 18px">Slogan</p>

<input style="margin: -10px 0 0 0; width: 100%; border-radius: 5px 0px 0px 5px;" type="text" name="slogan" class="input-text" value="<?php echo $slogan; ?>">
<p style="font-size: 18px">Description</p>
<textarea style="margin: -10px 0 0 0; width: 100%;" rows="8" name="description" maxlength="480" id="desc"><?php echo $description; ?></textarea>
<hr>
<p style="text-align: center;font-size: 30px; margin: 0px 0 0 0;">Rules</p>
<p style="font-size: 16px">Rule 1</p>
<input style="margin: -10px 0 0 0; width: 92%; border-radius: 5px 0px 0px 5px;" type="text" class="input-text" name="r1txt" class="rule" value="<?php echo $r_txt['1']; ?>"><div id="ck-button" style="right: 8%;"><label><input type="checkbox" style="visibility: hidden" name="r1on" id="r1on" onclick="onoff('r1on','spanon1');" value="1"<?php if($r_on['1'] == 1){ echo 'checked="checked"';} ?>><span id="spanon1" name="spanon1"><?php if($r_on['1'] == 1){ echo 'Enabled';}else{ echo 'Disabled';} ?></span></label></div>
<p style="font-size: 16px">Rule 2</p>
<input style="margin: -10px 0 0 0; width: 92%; border-radius: 5px 0px 0px 5px;" type="text" class="input-text" name="r2txt" class="rule" value="<?php echo $r_txt['2']; ?>"><div id="ck-button" style="right: 8%;"><label><input type="checkbox" style="visibility: hidden" name="r2on" id="r2on" onclick="onoff('r2on','spanon2');" value="1"<?php if($r_on['2'] == 1){ echo 'checked="checked"';} ?>><span id="spanon2" name="spanon2"><?php if($r_on['2'] == 1){ echo 'Enabled';}else{ echo 'Disabled';} ?></span></label></div>
<p style="font-size: 16px">Rule 3</p>
<input style="margin: -10px 0 0 0; width: 92%; border-radius: 5px 0px 0px 5px;" type="text" class="input-text" name="r3txt" class="rule" value="<?php echo $r_txt['3']; ?>"><div id="ck-button" style="right: 8%;"><label><input type="checkbox" style="visibility: hidden" name="r3on" id="r3on" onclick="onoff('r3on','spanon3');" value="1"<?php if($r_on['3'] == 1){ echo 'checked="checked"';} ?>><span id="spanon3" name="spanon3"><?php if($r_on['3'] == 1){ echo 'Enabled';}else{ echo 'Disabled';} ?></span></label></div>
<p style="font-size: 16px">Rule 4</p>
<input style="margin: -10px 0 0 0; width: 92%; border-radius: 5px 0px 0px 5px;" type="text" class="input-text" name="r4txt" class="rule" value="<?php echo $r_txt['4']; ?>"><div id="ck-button" style="right: 8%;"><label><input type="checkbox" style="visibility: hidden" name="r4on" id="r4on" onclick="onoff('r4on','spanon4');" value="1"<?php if($r_on['4'] == 1){ echo 'checked="checked"';} ?>><span id="spanon4" name="spanon4"><?php if($r_on['4'] == 1){ echo 'Enabled';}else{ echo 'Disabled';} ?></span></label></div>
<p style="font-size: 16px">Rule 5</p>
<input style="margin: -10px 0 0 0; width: 92%; border-radius: 5px 0px 0px 5px;" type="text" class="input-text" name="r5txt" class="rule" value="<?php echo $r_txt['5']; ?>"><div id="ck-button" style="right: 8%;"><label><input type="checkbox" style="visibility: hidden" name="r5on" id="r5on" onclick="onoff('r5on','spanon5');" value="1"<?php if($r_on['5'] == 1){ echo 'checked="checked"';} ?>><span id="spanon5" name="spanon5"><?php if($r_on['5'] == 1){ echo 'Enabled';}else{ echo 'Disabled';} ?></span></label></div>


<hr>
<p style="text-align: center;font-size: 30px; margin: 0px 0 0 0;">Staff members</p>

<div id="staff-conf-box"><p style="font-size: 23px;">Staff 1</p>
<div style="position: relative; left: 70%; top: -15px;border-radius: 5px 5px 5px 5px;" id="ck-button"><label style="left: 0px;">
<input type="checkbox" style="visibility: hidden;" name="staff1on" id="staff1on" onclick="onoff('staff1on','staff1txt');" value="1"
<?php if($staff_on['1'] == 1){ echo 'checked="checked"';} ?>>
<span style="left: 0px;" id="staff1txt" name="staff1txt"><?php if($staff_on['1'] == 1){ echo 'Enabled';}else{ echo 'Disabled';} ?></span></label></div>
<div style="width: 100%; margin: 25px 0 0 0; text-align: center;">
<p style="font-size: 12px">SteamID</p>
<input style=" width: 100%; padding: 4px;" type="text" name="staff1steam" class="input-text" value="<?php echo $staff['1']; ?>">
<p style="font-size: 12px">Rank</p>
<input style=" width: 100%; padding: 4px;" type="text" name="staff1rank" class="input-text" value="<?php echo $staff_rank['1']; ?>">
<p style="font-size: 12px">Color</p>
<input style=" width: 56%; padding: 4px; float: left; border-radius: 5px 0px 0px 5px;" type="text" name="color_txt_staff1" onchange="updateInput(this.value, 'color_txt_tool_staff1')" id="color_txt_staff1" class="input-text" value="<?php echo $staff_color['1']; ?>">
<input type="color" value="<?php echo $staff_color['1'] ?>" 
style="border: 0; padding: 5px; border-radius: 0px 5px 5px 0px; background-color: #ffffff; height: 29px; position: relative; right: 0px; width: 40%;" name="color_txt_tool_staff1" onchange="updateInput(this.value, 'color_txt_staff1')" id="color_txt_tool_staff1">

</div>
</div>

<div id="staff-conf-box" style="left: 220px;"><p style="font-size: 23px;">Staff 2</p>
<div style=" position: relative; left: 70%; top: -15px;border-radius: 5px 5px 5px 5px;" id="ck-button"><label style="left: 0px;">
<input type="checkbox" style="visibility: hidden;" name="staff2on" id="staff2on" onclick="onoff('staff2on','staff2txt');" value="1"
<?php if($staff_on['2'] == 1){ echo 'checked="checked"';} ?>>
<span style="left: 0px;" id="staff2txt" name="staff2txt"><?php if($staff_on['2'] == 1){ echo 'Enabled';}else{ echo 'Disabled';} ?></span></label></div>
<div style="width: 100%; margin: 25px 0 0 0; text-align: center;">
<p style="font-size: 12px">SteamID</p>
<input style=" width: 100%; padding: 4px;" type="text" name="staff2steam" class="input-text" value="<?php echo $staff['2']; ?>">
<p style="font-size: 12px">Rank</p>
<input style=" width: 100%; padding: 4px;" type="text" name="staff2rank" class="input-text" value="<?php echo $staff_rank['2']; ?>">
<p style="font-size: 12px">Color</p>
<input style=" width: 56%; padding: 4px; float: left; border-radius: 5px 0px 0px 5px;" type="text" name="color_txt_staff2" onchange="updateInput(this.value, 'color_txt_tool_staff2')" id="color_txt_staff2" class="input-text"
 value="<?php echo $staff_color['2']; ?>">
<input type="color" value="<?php echo $staff_color['2'] ?>" style="border: 0; padding: 5px; border-radius: 0px 5px 5px 0px; background-color: #ffffff; height: 29px; position: relative; right: 0px; width: 40%;" name="color_txt_tool_staff2" onchange="updateInput(this.value, 'color_txt_staff2')" id="color_txt_tool_staff2">

</div>
</div>



<div id="staff-conf-box" style="left: 440px;"><p style="font-size: 23px;">Staff 3</p>
<div style=" position: relative; left: 70%; top: -15px;border-radius: 5px 5px 5px 5px;" id="ck-button"><label style="left: 0px;">
<input type="checkbox" style="visibility: hidden;" name="staff3on" id="staff3on" onclick="onoff('staff3on','staff3txt');" value="1"
<?php if($staff_on['3'] == 1){ echo 'checked="checked"';} ?>>
<span style="left: 0px;" id="staff3txt" name="staff3txt"><?php if($staff_on['3'] == 1){ echo 'Enabled';}else{ echo 'Disabled';} ?></span></label></div>
<div style="width: 100%; margin: 25px 0 0 0; text-align: center;">
<p style="font-size: 12px">SteamID</p>
<input style=" width: 100%; padding: 4px;" type="text" name="staff3steam" class="input-text" value="<?php echo $staff['3']; ?>">
<p style="font-size: 12px">Rank</p>
<input style=" width: 100%; padding: 4px;" type="text" name="staff3rank" class="input-text" value="<?php echo $staff_rank['3']; ?>">
<p style="font-size: 12px">Color</p>
<input style=" width: 56%; padding: 4px; float: left; border-radius: 5px 0px 0px 5px;" type="text" name="color_txt_staff3" onchange="updateInput(this.value, 'color_txt_tool_staff3')" id="color_txt_staff3" class="input-text"
 value="<?php echo $staff_color['3']; ?>">
<input type="color" value="<?php echo $staff_color['3'] ?>" style="border: 0; padding: 5px; border-radius: 0px 5px 5px 0px; background-color: #ffffff; height: 29px; position: relative; right: 0px; width: 40%;" name="color_txt_tool_staff3" onchange="updateInput(this.value, 'color_txt_staff3')" id="color_txt_tool_staff3">

</div>
</div>




<div id="staff-conf-box" style="left: 660px;"><p style="font-size: 23px;">Staff 4</p>
<div style=" position: relative; left: 70%; top: -15px;border-radius: 5px 5px 5px 5px;" id="ck-button"><label style="left: 0px;">
<input type="checkbox" style="visibility: hidden;" name="staff4on" id="staff4on" onclick="onoff('staff4on','staff4txt');" value="1"
<?php if($staff_on['4'] == 1){ echo 'checked="checked"';} ?>>
<span style="left: 0px;" id="staff4txt" name="staff4txt"><?php if($staff_on['4'] == 1){ echo 'Enabled';}else{ echo 'Disabled';} ?></span></label></div>
<div style="width: 100%; margin: 25px 0 0 0; text-align: center;">
<p style="font-size: 12px">SteamID</p>
<input style=" width: 100%; padding: 4px;" type="text" name="staff4steam" class="input-text" value="<?php echo $staff['4']; ?>">
<p style="font-size: 12px">Rank</p>
<input style=" width: 100%; padding: 4px;" type="text" name="staff4rank" class="input-text" value="<?php echo $staff_rank['4']; ?>">
<p style="font-size: 12px">Color</p>
<input style=" width: 56%; padding: 4px; float: left; border-radius: 5px 0px 0px 5px;" type="text" name="color_txt_staff4" onchange="updateInput(this.value, 'color_txt_tool_staff4')" id="color_txt_staff4" class="input-text"
 value="<?php echo $staff_color['4']; ?>">
<input type="color" value="<?php echo $staff_color['4'] ?>" style="border: 0; padding: 5px; border-radius: 0px 5px 5px 0px; background-color: #ffffff; height: 29px; position: relative; right: 0px; width: 40%;" name="color_txt_tool_staff4" onchange="updateInput(this.value, 'color_txt_staff4')" id="color_txt_tool_staff4">

</div>
</div>


<hr>
<div id="set-conf-box">
<p style="text-align: center;font-size: 30px; margin: 0px 0 0 0;">Settings</p>

<p style="font-size: 18px">Steam API Key</p>
<input style="margin: -10px 0 0 0; width: 100%;" type="text" name="apikey" class="input-text" value="<?php echo $apikey; ?>" required>
<span style="float:right; font-size: 10px"><a style="text-decoration:none" target="_blank" href="http://steamcommunity.com/dev/apikey">(http://steamcommunity.com/dev/apikey)</a></span>
<hr style="margin: 35px 0 0 0;">
<p style="font-size: 18px">Progress Bar Color</p>
<input style="width: 32%; padding: 4px; float: left; border-radius: 5px 0px 0px 5px;" type="text" name="color_progress_txt" onchange="updateInput(this.value, 'color_progress')" id="color_progress_txt" class="input-text"
 value="<?php echo $progress_color; ?>">
<input type="color" value="<?php echo $progress_color; ?>" style="background-color: #ffffff; height: 29px; position: absolute; right: 380px; width: 20%; border-radius: 0px 5px 5px 0px; border: 0; padding: 5px;" name="color_progress" onchange="updateInput(this.value, 'color_progress_txt')" id="color_progress">
<br>
<p style="font-size: 18px">Background Image</p>
<input style="margin: -10px 0 0 0; width: 100%;" name="background" type="text" class="input-text" value="<?php echo $background; ?>">
<p style="font-size: 18px">Music <span style="font-size: 17px; color: #727272">(only .ogg files)</span></p>
<input style="margin: -10px 0 0 0; width: 100%;" name="music" type="text" class="input-text" value="<?php echo $music; ?>">
<p style="font-size: 15px">Volume <span style="font-size: 12px; color: #727272">(From 0 to 100)</span></p>
<input style="margin: -10px 0 0 0; width: 50%;" name="volume" type="text" class="input-text" value="<?php echo $volume; ?>">



</div>
<div id="layout-box">
<hr>
<p style="text-align: center;font-size: 30px; margin: 0px 0 0 0;">Layouts</p>

<p style="font-size: 18px">Player Info and Staff</p>
<input type="radio" name="layout_top" <?php if($layout_top == 1){ echo "checked"; } ?> value="1"> Left: Player Info <span style="position: absolute; left: 160px;">Right: Staff Info</span><br>
<input type="radio" name="layout_top" <?php if($layout_top == 2){ echo "checked"; } ?> value="2"> Left: Staff Info <span style="position: absolute; left: 160px;">Right: Player Info</span><br>
<p style="font-size: 18px">Bottom Box divison</p>
<input type="radio" name="layout_bottom" <?php if($layout_bottom == 1){ echo "checked"; } ?> value="1"> Left: Rules <span style="position: absolute; left: 160px;">Middle: Description</span> <span style="position: absolute; left: 350px;">Right: Server Info</span><br>
<input type="radio" name="layout_bottom" <?php if($layout_bottom == 2){ echo "checked"; } ?> value="2"> Left: Description <span style="position: absolute; left: 160px;">Middle: Rules</span> <span style="position: absolute; left: 350px;">Right: Server Info</span><br>
<input type="radio" name="layout_bottom" <?php if($layout_bottom == 3){ echo "checked"; } ?> value="3"> Left: Server Info <span style="position: absolute; left: 160px;">Middle: Description</span> <span style="position: absolute; left: 350px;">Right: Rules</span>
	<br>
<br>
</div>
</div>
</form>
<?php
}else{
session_destroy();

	if($password == "changeme"){
	?>
	<div id="login-box" style="line-height: 170px; font-family: Roboto; font-weight: 300;">
	<div style="text-align: center;">Please change the password in the config.php file!</div>
	</div>
	<?php
	}else{
?>
<div id="login-box">
<div style="width: 720px; padding: 5px; font-size: 24px; font-weight: 300; background-color: #f2f2f2">Admin Panel - Login</div>
<form method="post" action="admin.php">
<input id="passwd" <?php if($_POST['pass'] == 1){ echo 'style="border-bottom: solid 2px #CC0000;"'; } ?> placeholder="Password" type="password" name="password">
<input type="text" value="1" name="pass" hidden>
<center>
<input id="submit" type="submit" value="Login">
</center>
</form>

<div style="bottom: 0; left: 0; position: absolute; opacity: 0.5; filter: alpha(opacity=50); /* For IE8 and earlier */"><a style="cursor: pointer;" id="helpbtn"><img src="images/icons/help-icon.png" height="20px" width="auto"></a><a style="cursor: pointer;" id="helpbtn-close"><img src="images/icons/times-icon.png" height="20px" width="auto"></a></div>
</div>
<div id="help-box"><span style="font-weight: 400;">Important:</span><br>Set a Password for this Admin Panel in the config.php file, you have to edit it with a Texteditor!</div>
<?php	
}}
?>

</body>
</html>