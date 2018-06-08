<?php

header("content-type:image/jpeg");

$host = 'localhost';
$user = 'root';
$pass = '';

mysqli_connect($host, $user, $pass);

mysqli_select_db('emalify/profile_info');

$name=$_GET['name'];

$select_image="select * from image_table where imagename='$name'";


$var=mysqli_query($select_path);

while($row=mysqli_fetch_array($var))
{
    $image_name=$row["imagename"];
    $image_path=$row["imagepath"];
    echo "img src=".$image_path."/".$image_name." width=100 height=100";
}
?>