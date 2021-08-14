<hr><b>Loại 3</b></br>
<?php
set_time_limit(0); 
require("../../../config.php");
$get = mysqli_query($kunloc,"SELECT `hotmail` FROM `hotmail` WHERE `loai` = '3'");
while($a = mysqli_fetch_assoc($get))
{
	$tokens = $a['hotmail'];
    //echo $tokens.'</br>';


}
?>
<hr><b>Loại 4</b></br>
<?php
set_time_limit(0); 
require("../config.php");
$get = mysqli_query($kunloc,"SELECT `hotmail` FROM `hotmail` WHERE `loai` = '4'");
while($a = mysqli_fetch_assoc($get))
{
	$tokens = $a['hotmail'];
   // echo $tokens.'</br>';


}
?>
<hr><b>Loại 5</b></br>
<?php
set_time_limit(0); 
require("../config.php");
$get = mysqli_query($kunloc,"SELECT `hotmail` FROM `hotmail` WHERE `loai` = '5'");
while($a = mysqli_fetch_assoc($get))
{
	$tokens = $a['hotmail'];
    //echo $tokens.'</br>';


}
?>
