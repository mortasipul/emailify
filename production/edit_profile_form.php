<?php
session_start();
require_once("db.php");
$con = mysqli_connect("localhost", "root", "", "emailify");
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$email = $_SESSION['email'];
$active = $_SESSION['active'];
$image =$_SESSION['image'];
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
    $full_name = $mysqli->real_escape_string($_POST['fullname']);
    $country = $mysqli->real_escape_string($_POST['country']);
    $title = $mysqli->real_escape_string($_POST['title']);
    $city = $mysqli->real_escape_string($_POST['city']);
    $image = $mysqli->real_escape_string($_POST['image']);

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        header("location: success.php");
    } else {
        header("loction: error.php");
    }
}
    $id_sql ="SELECT id FROM users WHERE first_name = '$first_name' And last_name='$last_name'";
    $specificId= mysqli_query($con, $id_sql);
    $row = mysqli_fetch_row($specificId);
    $id = $row[0];
    $sql = "INSERT INTO profile_info (fullname, country, title, city, image, path) VALUES ('$full_name','$country','$title', '$city', '$image', '$path')";
//    $move ="SELECT * FROM profile_info p FULL JOIN users u ON p.id = u.id";
    //move the data into the users table
    if(!$mysqli->query($sql)){
//        if(!$mysqli->query($move)){
            die('There was an error running the query [' . $mysqli->error . ']');
    }
    else
    {
        echo "Your data has been saved";
    }

    echo("<script>location.href = 'profile.php';</script>");
