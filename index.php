 <!DOCTYPE html>
<html>
<head>
<title>Loading screen</title>
<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500' rel='stylesheet' type='text/css'>
 <link href="assets/css/main.css" rel="stylesheet">
</head>

<?php
include('crawldata.php');

$apikey = str_replace("#%X","1",$apikey);
$apikey = str_replace("X#H","2",$apikey);
$apikey = str_replace("X#&H","3",$apikey);
$apikey = str_replace("X6#H","5",$apikey);

if($volume == ""){
	$volume = 0.5;
}


//Different Layouts
if($layout_top == 2){
	?>
	<style>
.staff-info{
	left: 10px;
	
}
#player-info{
	left: auto;
	right: 10px;
}
	</style>
	<?php
}

if($layout_bottom == 2){
	?>
	<style>
#server-desc{
	left: 0;
}
#rule-info{
	left: 42%;
}
	</style>
	<?php
}
if($layout_bottom == 3){
	?>
	<style>

#rule-info{
	left: auto;
	right: 5px;
	width: 26%;
}
#server-info{
	left: 15px;
}
	</style>
	<?php
}

$volume = $volume / 100;

?>
<body>
<script>
$(function() {
	var volume = <?php echo json_encode($volume); ?>;
    $("audio").each(function(){ this.volume = volume; });
});


 function GameDetails( servername, serverurl, mapname, maxplayers, steamid, gamemode ) {
	 document.getElementById("Map").innerHTML = mapname;
	 document.getElementById("Gamemode").innerHTML = gamemode;
	 document.getElementById("Slots").innerHTML = maxplayers;
	 }
	 document.getElementById("FilePercent").innerHTML = "5%";
	 function SetStatusChanged( status ) { document.getElementById("FileStatus").innerHTML = status;
			if(status == 'Retrieving server info...') {
				if(status != 'Retrieving server info...' || status != 'Mounting Addons' || status != 'Workshop Complete' || status != 'Sending client info...'){
				$('#loadingbar').css({"width" : "35%"});
				document.getElementById("FilePercent").innerHTML = "30%";
			}
			
				$('#loadingbar').css({ "width" : "10%"});
				document.getElementById("FilePercent").innerHTML = "5%";
			}
			if(status == 'Mounting Addons') {
				$('#loadingbar').css({ "width" : "55%"});
				document.getElementById("FilePercent").innerHTML = "55%";
			}
			if(status == 'Workshop Complete') {
				$('#loadingbar').css({ "width" : "89%"});
				document.getElementById("FilePercent").innerHTML = "89%";
			}
			if(status == 'Sending client info...') {
				$('#loadingbar').css({"width" : "99%"});
				document.getElementById("FilePercent").innerHTML = "99%";
			}
		}
</script>

<?php

// Get Player/Staff Information from Steam API
 $intt = 0;
 $id = $_GET["steamid"];
 $map = $_GET["mapname"];
 $id_str = $id.";";
 for($i = 1; $i <= 4; $i++){
	 if($staff_on[$i] == 1){
		 $id_str = $id_str.",".$staff[$i];
		 $intt++;
	 }
 }
 $link = file_get_contents('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key='.$apikey.'&steamids=' . $id_str . '&format=json');
 $myarray = json_decode($link, true);
 $working = 0;
 if($apikey == "Change this"){
	 ?>
	 <div style="width: 100%; height: 100%; z-index: 9999999; position: absolute; left: 0; top: 0; background-color: #fff; text-align: center;"><h1>Welcome!<br>Change the password in the config.php file(with a Texteditor) and access the admin.php file,<br> with your earlier entered password, through your browser!<br>On there you can change all the Information</h1></div>
	 <?php
	 die();
 }else{
	 $working = 1;
 }
 
 if($myarray['response']['players'][0]['steamid'] == "" && $intt > 0){
	 ?>
	 <div style="width: 100%; height: 100%; z-index: 9999999; position: absolute; left: 0; top: 0; background-color: #fff; text-align: center;"><h1>'<?php echo $apikey; ?>' isn't a valid Steam API-Key, please enter a working one!<br>Make sure there are no blanks before and after the key!<br><br>Or your server doesn't have allow_url_fopen activated, make sure it is! <br>Ask your host, most of the time they will enable it.</h1></div>
	 <?php
	 die();
 }else{
	 $working = 1;
 }
 
if($myarray['response']['players'][0]['steamid'] == $id){
	 $joining_name = $myarray['response']['players'][0]['personaname'];
	 $joining_avatar = $myarray['response']['players'][0]['avatarfull'];
 }
 
 if($myarray['response']['players'][1]['steamid'] == $id){
	 $joining_name = $myarray['response']['players'][1]['personaname'];
	 $joining_avatar = $myarray['response']['players'][1]['avatarfull'];
 }
 
 if($myarray['response']['players'][2]['steamid'] == $id){
	 $joining_name = $myarray['response']['players'][2]['personaname'];
	 $joining_avatar = $myarray['response']['players'][2]['avatarfull'];
 }
 
 if($myarray['response']['players'][3]['steamid'] == $id){
	 $joining_name = $myarray['response']['players'][3]['personaname'];
	 $joining_avatar = $myarray['response']['players'][3]['avatarfull'];
 }
 
 if($joining_name == ""){
	 
	 ?>
	 <div style="width: 100%; height: 100%; z-index: 9999999; position: absolute; left: 0; top: 0; background-color: #fff; text-align: center;"><h1>You are not accessing this site through Garry's Mod<br>No User Information obtained<br><br>Click here to run a Demo with my Profile: <a href="index.php?steamid=76561198249390938">index.php?steamid=76561198249390938</a></h1></div>
	 <?php
	 die();
 }
	 
 
 
 for($int = 1; $int <= 5; $int++){
	 if($staff_on[$int] == 1){
		 for($intz = 0; $intz <= 5; $intz++){
			 if($myarray['response']['players'][$intz]['steamid'] == $staff[$int]){
	 $staff_name[$int] = $myarray['response']['players'][$intz]['personaname'];
	 $staff_avatar[$int] = $myarray['response']['players'][$intz]['avatarmedium'];
		}
		 }
		 
	 }
 }






// Get SteamID through SteamID 64
function parseInt($string) {
    if(preg_match('/(\d+)/', $string, $array)) {
        return $array[1];
    } else {
        return 0;
    }}


$steamY = parseInt($id);
$steamY = $steamY - 76561197960265728;
$steamX = 0;

if ($steamY%2 == 1){
$steamX = 1;
} else {
$steamX = 0;
}

$steamY = (($steamY - $steamX) / 2);
$steamID = "STEAM_0:" . (string)$steamX . ":" . (string)$steamY;

//Checking if there is only one Staff Box
//to move it to the right later on(Screen-width max: 1025px)

$n_int = 0;
for($int = 1; $int <= 4; $int++){
	
	if($staff_on[$int] == 1){
		$n_int++;
	}
}

if($working == 1){
	?>
	<audio controls autoplay loop hidden>
<source src="<?php echo $music; ?>" type="audio/ogg">
</audio>
	<?php
}
?>

 
<div id="background-img"><img style="max-width: 100%; max-height: 100%;" width="100%" src="<?php echo $background; ?>"></div>
 <div class="staff-info" <?php if($n_int <= 1 && $layout_top != 2){ echo 'id="one-staff"'; } ?>>
<?php for($int = 1; $int <= 4; $int++){
	if($staff_on[$int] == 1){
		?>
		<div id="staff-box"><div id="color-box" style="background-color: <?php echo $staff_color[$int]; ?>"><p style="color: #ffffff; white-space: nowrap;overflow: hidden;text-overflow: ellipsis; margin-left: 75px; margin-top: 16px; font-size: 18px;"><?php echo $staff_rank[$int]; ?></p>
		</div><div style="width: 60px; height: 60px; border-width: 3px; top: 6px; border-radius: 50%; border-style: solid; border-color: #f2f2f2; position: absolute; z-index: 999999;"></div><img height="60px" style="z-index: 1; position: relative; border-width: 3px; top: 4px; border-radius: 50%; border-style: solid; border-color: #f2f2f2;" width="auto" src="<?php echo $staff_avatar[$int]; ?>">
		<div id="staff-name">
		<span style="font-weight: 400; position: relative; font-size: 18px;"><?php echo $staff_name[$int]; ?></span></div></div>

		<?php
	}
} ?>


</div>
<?php 
$mainColor = "36ab98";
  // Getting the main color in the avatar
  $image=imagecreatefromjpeg($joining_avatar);
  $thumb=imagecreatetruecolor(1,1); imagecopyresampled($thumb,$image,0,0,0,0,1,1,imagesx($image),imagesy($image));
    $mainColor=strtoupper(dechex(imagecolorat($thumb,0,0)));
?>
<div id="player-info"><div id="strip" style="top: 5px; background-color: #<?php echo $mainColor; ?>;"></div><img style="position: absolute; display: inline-block; top: 0;" class="avatar" id="img-avatar" src="<?php echo $joining_avatar;?>" />
<p style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-weight: 300;" id="username">Welcome, <?php echo $joining_name; ?>!</p>
<p style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-weight: 300;" id="steamid"><?php echo $steamID; ?></p>
<div id="strip" style="bottom: 5px; background-color: #<?php echo $mainColor; ?>;"></div></div>
 <div id="bottom-bar">
<div id="server-desc"><div style="margin: -5px 0 0 0px; width: 100%; padding: 5px; font-size: 28px; font-weight: 300; text-align: left;">Description</div><?php echo $description; ?>
</div>

<?php

// Rule counter

$int_count = 0;
 for($int = 1; $int <= 5; $int++){
	 if($r_on[$int] == 1){
		 $int_count++;
	 }
 }

 if($int_count != 0){
 ?>

<div id="rule-info"><div style="margin: -5px 0 0 0px; width: 100%; padding: 5px; font-size: 28px; font-weight: 300; text-align: left;">Rules</div>
<?php
 }
 
$int_conf = 1;
 for($int = 1; $int <= 5; $int++){
	 if($r_on[$int] == 1){
		 if($int_conf % 2 == 0){
			?>
		   <div id="rule-box" style=""><div id="rule-box-value"><?php echo $int_conf; ?>.</div><p style="margin-left: 42px; margin-top: 0; width: 89%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $r_txt[$int]; ?></p></div>
		   <?php 
			 
		 }else{
			 if($int_conf == 1){
				?>
				 <div id="rule-box" style="margin: 0px 0 0 0;"><div id="rule-box-value"><?php echo $int_conf; ?>.</div><p style="margin-left: 42px; margin-top: 0; width: 89%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $r_txt[$int]; ?></p></div>
				<?php				
			 }else{
			 ?>
		  <div id="rule-box" ><div id="rule-box-value"><?php echo $int_conf; ?>.</div><p style="margin-left: 42px; margin-top: 0; width: 89%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $r_txt[$int]; ?></p></div>
		  <?php
		  }
		 }
		 $int_conf++;
	 }
 }

 if($int_count != 0){
 ?>
 </div>
 <?php } ?>
 <div id="server-info">
 <div style="margin: -5px 0 0 0px; width: 100%; padding: 5px; font-size: 28px; font-weight: 300; text-align: left;">Server Info</div>
 
 <p id="info-txt" style="font-weight: 300; margin: 0;">Map: <span id="Map" style="position: absolute; left: 180px; font-weight: 400;">mapname</span></p>
 <p id="info-txt" style="font-weight: 300; margin: 8px 0 0 0;">Gamemode: <span id="Gamemode" style="position: absolute; left: 180px; font-weight: 400;">gamemode</span></p>
 <p id="info-txt" style="font-weight: 300; margin: 8px 0 0 0;">Maxplayers: <span id="Slots" style="position: absolute; left: 180px; font-weight: 400;">maxplayers</span></p>
 </div>
 </div>
 <div id="title-bar"><?php echo $servername; ?><br><span style="font-size: 30px"><?php echo $slogan; ?><span></div>


<div id="bar"><div id="FileStatus" style="border-radius: 25px; background-color: #cccccc; padding: 5px; padding-left: 20px; padding-right: 20px; top: 5px; right: 65px; text-align: center; position: absolute; height: 20px;">Retrieving server info...</div><div id="FilePercent" style="border-radius: 25px; background-color: #cccccc; padding: 5px; top: 5px; right: 10px; text-align: center; width: 40px; position: absolute; height: 20px;">0%</div>
  <div id="loadingbar" style="background-color: <?php echo $progress_color; ?>; width: 1%;"></div>
</div>

</body>
</html> 