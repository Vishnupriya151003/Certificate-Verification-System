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
$field=$_POST['field'];
$fieldname=$_POST['fieldname'];
$query;
if($field=='faculty'){
    $query="UPDATE `users` SET `faculty`='".$fieldname."' WHERE id=";
}
else if($field=='verifier'){
    $query="UPDATE `users` SET `verifier`='".$fieldname."' WHERE id=";
}

foreach($email as $value){
    $query.="'".$value."'";
    
    if($conn->query($query)===true){
        continue;
    }
    else{
        echo "<script>var response=confirm('Error in updating. Please try again after some time.');";
            echo "if(response){";
            echo "window.location.href = 'editdata.php' ;";
            echo "}</script>"  ;
    }
}
echo "<script>var response=confirm('Updated Successfully!!');";
            echo "if(response){";
            echo "window.location.href = 'editdata.php' ;";
            echo "}</script>"  ;
?>