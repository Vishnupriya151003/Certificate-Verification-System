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
$query1="DELETE FROM `users` WHERE `id`=";
$query2="DELETE FROM `signin` WHERE `userid`=";
$query3="DELETE FROM `certify` WHERE `id`=";
foreach($email as $value){
    $query1.="'".$value."'";
    $query2.="'".$value."'";
    $query3.="'".$value."'";
    if($conn->query($query1)===true AND $conn->query($query1)===true AND $conn->query($query1)===true){
        continue;
    }
    else{
        echo "<script>var response=confirm('Error in deleting. Please try again after some time.');";
            echo "if(response){";
            echo "window.location.href = 'editdata.php' ;";
            echo "}</script>"  ;
    }
}
echo "<script>var response=confirm('Deleted Successfully!!');";
            echo "if(response){";
            echo "window.location.href = 'editdata.php' ;";
            echo "}</script>"  ;
?>