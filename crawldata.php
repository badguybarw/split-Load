<?php
// Get JSON File Information(Settings)
$file = file_get_contents('storage/settings.json');
$json = json_decode($file, true);

$apikey = $json['settings']['apikey'];
$background = $json['settings']['background'];
$music = $json['settings']['music'];
$volume = $json['settings']['volume'];
$progress_color = $json['settings']['progressbar_color'];


// Get JSON File Information(Staff)
$file = file_get_contents('storage/staff.json');
$json = json_decode($file, true);

for($i = 1; $i <= 4; $i++){

$staff[$i] = $json['staff'][$i]['steamid'];
$staff_on[$i] = $json['staff'][$i]['status'];
$staff_rank[$i] = $json['staff'][$i]['rank'];
$staff_color[$i] = $json['staff'][$i]['color'];
}

// Get JSON File Information(Details)
$file = file_get_contents('storage/details.json');
$json = json_decode($file, true);

$servername = $json['details']['servername'];
$slogan = $json['details']['slogan'];
$description = $json['details']['description'];


for($i = 1; $i <= 5; $i++){
$r_txt[$i] = $json['details']['rules'][$i]['text'];
$r_on[$i] = $json['details']['rules'][$i]['status'];
}

// Get JSON File Information(Layouts)
$file = file_get_contents('storage/layouts.json');
$json = json_decode($file, true);

$layout_bottom = $json['layouts']['layoutbottom'];
$layout_top = $json['layouts']['layouttop'];


?>