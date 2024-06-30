<?php
// $id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

    $con = new mysqli("localhost","root","","paktravelers");
    if($con->connect_error){
        die("Error Connective:".$con->connect_error);
    }
    $query = "INSERT INTO `contact`(`name`, `email`, `message`, `subject`) VALUES ('$name','$email','$subject','$message')";
    if($con->query($query)){
        header('location:contact.html');
    } else {
    }
    $con->close();
?>