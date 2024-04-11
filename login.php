<?php
session_start();
    include "connect.php";


    $id = $_POST['id'];
    $password = $_POST['pass']; 
    $_SESSION['id']=$id;        
    $query = "select * from signin where userid='".$id."'";
    $result=$conn->query($query);
    $_SESSION["deg"];
    if($result->num_rows>0){
      while($row=$result->fetch_assoc()){
        $_SESSION["deg"]=$row["roll"];
        if($row["roll"]=='1003'){
          $_SESSION['name']=$row["username"];
          header("Location: search.php");
        }
        else if($row["roll"]=='1004'){
          $_SESSION['name']=$row["username"];
          header("Location: search.php");
        }
          else if($row["roll"]=='1005'){
            $_SESSION['name']=$row["username"];
            header("Location: datafeed.php");
          }
          
        }     
    }
    else{
      $flag=0;
      print("Oops! Can't log you in. Contact the administrator");
  }
   
  
    $conn->close();

?>

