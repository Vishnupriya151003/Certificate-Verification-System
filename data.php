<?php
session_start();
$filetype = $_POST['file-type'];
$flag=0;
include('connect.php');

require 'phpspreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
try{
if(isset($_POST['excelfile']))
{
    $fileName = $_FILES['file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls','csv','xlsx'];

    if(in_array($file_ext, $allowed_ext))
    {
        $inputFileNamePath = $_FILES['file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();
        $query = "SELECT * FROM rolls WHERE rollname='".$filetype."'";
        $rst=$conn->query($query);
        while($row=$rst->fetch_assoc()){
            $filetype=$row["rollid"];
        }
        $count = "0";
        foreach($data as $row)
        {
            if($count > 0)
            {
                $sql='';$sql1='';
                if($filetype=="1001" || $filetype=="1002"){
                    $userid = $row['0'];
                    $status = $row['1'];
                    $faculty = $row['2'];
                    $verifier = $row['3'];
                    if($userid!='' && $status!='' && $faculty!='' && $verifier!=''){
                    $sql = "INSERT INTO signin (userid,username,password,roll,status) VALUES ('".$userid."','','Nil','".$filetype."','".$status."')";
                    $sql1 = "INSERT INTO users (`name`, `id`, `year`, `degree`, `dept`, `status`, `faculty`, `verifier`) VALUES ('','".$userid."','','','','".$status."','".$faculty."','".$verifier."')";
                }}
                else if($filetype=="1003" || $filetype=="1004"){
                    $userid = $row['0'];
                    $status = $row['1'];
                    if($userid!='' && $status!='' ){
                    $sql = "INSERT INTO signin (userid,username,password,roll,status) VALUES ('".$userid."','','Nil','".$filetype."','".$status."')";
                }}
                else if($filetype=="1005"){
                    $userid = $row['0'];
                    $name = $row['1'];
                    $password = $row['2'];
                    $status = $row['3'];
                    if($userid!='' && $status!='' && $name!='' && $password!=''){
                    $sql = "INSERT INTO signin (userid,username,password,roll,status) VALUES ('".$userid."','".$name."','".$password."','".$filetype."','".$status."')";
                }}
                if ($conn->query($sql) === TRUE) {
                    if($sql1!='' && $conn->query($sql1) === TRUE){
                    $msg = true;
                    }
                    if($sql1==''){
                        $msg=true;
                    }
                }
            }
            else
            {
                $count = "1";
            }
        }
        if(isset($msg))
        {
            $flag = 1;
            echo "<script>var response=confirm('Data fed successfully!!');";
            echo "if(response){";
            echo "window.location.href = 'datafeed.php' ;";
            echo "}</script>"  ;
        }
        else
        {
            $flag= 0;
            echo "<script>var response=confirm('Can't feed the data. Please try again');";
            echo "if(response){";
            echo "window.location.href = 'datafeed.php' ;";
            echo "}</script>"  ;
        }
    }
    else
    {
        $flag = -1;
        echo "<script>var response=confirm('Not in the expected file format. Please try again.');";
        echo "if(response){";
        echo "window.location.href = 'datafeed.php' ;";
        echo "}</script>"  ;
    }
}
}
catch(Exception $e) {
    echo "<script>var response=confirm('The data already exists in the database.');";
        echo "if(response){";
        echo "window.location.href = 'datafeed.php' ;";
        echo "}</script>"  ;
    
  }

?>
