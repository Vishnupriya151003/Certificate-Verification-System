<?php
session_start();
include 'connect.php';
$course=$_POST['course'];
$query='';
$query1='';
$date=date("Y-m-d");
if($_SESSION["deg"]=='1003'){
    $query="UPDATE `certify` SET `v1date`='$date' WHERE `id`='".$_SESSION['studid']."' AND `course`='".$course."'";
}
else if($_SESSION["deg"]=='1004'){
    $query="UPDATE `certify` SET `v2date`='$date' WHERE `id`='".$_SESSION['studid']."' AND `course`='".$course."'";
}
if ($conn->query($query) === TRUE) {
   
        echo "<script>var response=confirm('Verified successfully!!');";
            echo "if(response){";
            echo "window.location.href = 'certificate.php?id=".$_SESSION['studid']."' ;";
            echo "}</script>"  ;
        
            }
else {
    echo "Error updating certify table: " . $conn->error;
}

?>
