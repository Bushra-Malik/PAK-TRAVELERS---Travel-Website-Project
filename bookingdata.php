<?php
// $id = $_POST['id'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$gender = $_POST['gender'];
$emailAddress = $_POST['emailAddress'];
$phoneNumber = $_POST['phoneNumber'];
$place = $_POST['place'];
    
    $con = new mysqli("localhost","root","","paktravelers");
    if($con->connect_error){
        die("Error Connective:".$con->connect_error);
    }
    $query = "INSERT INTO `booking`( `first name`, `last name`, `gender`, `email`, `phone number`, `place`)  VALUES ('$firstName','$lastName','$gender','$emailAddress','$phoneNumber','$place')";
    if($con->query($query)){
    } else {
    }
    header("location:Tripbooked.html");
    $con->close();
?>