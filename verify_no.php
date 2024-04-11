<?php 
session_start();
    include 'connect.php';
    $course=$_POST['course'];
    $query="UPDATE `users` SET `certify`='not verified' WHERE `id`='".$_SESSION['studid']."'";
     if($conn->query($query)===true){
        $txt =$_POST['reason'];
        $query1="UPDATE `certify` SET `reason`='$txt' WHERE `id`='".$_SESSION['studid']."' AND `course`='".$course."'";
        if($conn->query($query1)===true){
            echo "<script>var response=confirm('Response noted successfully');";
            echo "if(response){";
            echo "window.location.href = 'certificate.php?id=".$_SESSION['studid']."' ;";
            echo "}</script>"  ;
        }
        }
            ?>