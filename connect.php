<?php 
$servername="localhost";
$username="KARE";
$password="Kare@626126";
$database="kare";
$conn=new mysqli($servername,$username,$password,$database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
?>