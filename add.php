<?php
session_start();
include 'connect.php';
  $flag; $query='';
if(isset($_POST['submit'])){ 
    $uid=$_POST['id'];
    $year = $_POST['year'];
    $degree = $_POST['degree'];
    $dept = $_POST['dept'];
    echo $uid.$_SESSION['name'].$year.$degree.$dept;
    $query='';
    if($year !=''&&$dept!=''&&$dept!=''){
    
    $query = "UPDATE `users` SET `name`='".$_SESSION['name']."',`year`='".$year."',`degree`='".$degree."',`dept`='".$dept."' WHERE id='".$uid."'";
    if ($conn->query($query) === TRUE) {
      echo "<script>var response=confirm('Record updated successfully');";
      echo "if(response){";
      echo "window.location.href = 'group.php' ;";
      echo "}</script>";
    } else {
      echo "<script>var response=confirm('Error:  . $query . <br> . $conn->error.');";
    echo "if(response){";
    echo "window.location.href = 'edit.php' ;";
    echo "}</script>";
      echo "Error: " . $query . "<br>" . $conn->error;
    }
    }
    else{
    echo "<script>var response=confirm('Updation Failed. Some Fields are Blank....!!');";
    echo "if(response){";
    echo "window.location.href = 'edit.php' ;";
    echo "}</script>";
    }
    
      
    }
    
    
?>