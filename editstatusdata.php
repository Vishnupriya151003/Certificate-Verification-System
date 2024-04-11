<?php
include 'connect.php';
$no=$_POST['usersno'];
if($no=='2' AND !empty($_POST['userno'])){
    $no=$_POST['userno'];
}
else if($no=='2' AND empty($_POST['userno'])){
    echo "<script>var response=confirm('No. Of users missing. Please enter it and retry. ');";
            echo "if(response){";
            echo "window.location.href = 'editdata.php' ;";
            echo "}</script>"  ;
}
$user=$_POST['userid'];
$email = explode(",", $user);
$email = array_map('trim', $email);
$status=$_POST['tostatus'];
$query1="UPDATE `signin` SET `status`='$status' WHERE `userid`=";
$query2="UPDATE `users` SET `status`='$status' WHERE `id`=";

foreach($email as $value){
    $query1.="'".$value."'";
    $query2.="'".$value."'";
    if($conn->query($query1)===true AND $conn->query($query2)===true){
       continue;
    }
    else{
        echo "<script>var response=confirm('Error in updating status. Please try again after some time.');";
            echo "if(response){";
            echo "window.location.href = 'editdata.php' ;";
            echo "}</script>"  ;
    }
}
echo "<script>var response=confirm('Status updated Successfully!!');";
echo "if(response){";
echo "window.location.href = 'editdata.php' ;";
echo "}</script>"  ;
?>