<?php
session_start();
include "connect.php";
    
  $course = $_POST['file-type'];
  $query="SELECT * FROM `group` WHERE sect='".$course."'";
  $result = $conn->query($query);
  $coursename;
  while ($row = $result->fetch_assoc()) {
    $coursename = $row["name"];
  }
  echo $row;
  $id=$_SESSION['email'];
  $date = date('Y-m-d ');
  $update=0;
  $checkQuery = "SELECT * FROM `certify` WHERE `id`='$id' AND `course`='$coursename'";
            $checkResult = $conn->query($checkQuery);
            if ($checkResult->num_rows > 0) {
                                    while($check=$checkResult->fetch_assoc()){
                                        if($check['reason'] == 'Nil' ){
                                            echo "<script>var response=confirm('File already uploaded for this course');";
                                            echo "if(response){";
                                            echo "window.location.href = 'group.php' ;";
                                            echo "}</script>"  ;
                                            exit;
                                        }
                                        else{
                                            $update=1;
                                        }
                                        
                                    }
                                }

if (isset($_POST["submit"])) {
    
    $targetDirectory = "uploads/"; // Directory uploaded files are stored
    $file_count = count($_FILES['file']['name']);
    $j=0;
for ($i=0;$i<$file_count;$i++){
    $fileInfo = pathinfo($_FILES["file"]["name"][$i]); // Get file info as an array
    $fileType = $fileInfo['extension']; // Extract the file extension
    $fileSize = $_FILES["file"]["size"][$i];
    $flag=0;
    // Define allowed file formats and size range
    $allowedFormats = array("pdf", "jpg", "jpeg");
    $minSize = 100000; // 100 KB
    $maxSize = 300000; // 300 KB

    if (in_array($fileType, $allowedFormats) && $fileSize>=$minSize && $fileSize<=$maxSize) {
        $j+=1;
        $fileName = $id."-".$course;
        if(!empty($i)){
            $fileName.=$j. ".". $fileType;
        }
        else{
            $fileName.= ".".$fileType;
        }
        $targetFilePath = $targetDirectory . $fileName;

        if (move_uploaded_file($_FILES["file"]["tmp_name"][$i], $targetFilePath)) {
            $sql="INSERT INTO `certify`(`id`, `file`, `course`, `subdate`, `v1date`, `v2date`, `reason`) VALUES ('$id','$targetDirectory$fileName','$coursename-$j','$date','0','0','Nil')";
            
            
            if($update==1){                     
                $sql="UPDATE `certify` SET `file`='$targetDirectory$fileName',`subdate`='$date',`v1date`='0',`v2date`='0',`reason`='Nil' WHERE `id`='$id' AND `course`='$coursename'";
            }
            
                   
            
            if ($conn->query($sql)===TRUE) {
                $sql1="UPDATE `users` SET `certify`='submitted' WHERE `id`='".$id."'";
                if($conn->query($sql1)===TRUE){
                    $flag=1;
                    
                    //echo "file uploaded";
                }               
              

        } else {
            echo "<script>var response=confirm('Error uploading the file - $fileInfo.');";
            echo "if(response){";
            echo "window.location.href = 'group.php' ;";
            echo "}</script>"  ;
            //echo "file not uploaded";
            
        }
    } else {
        echo "<script>var response=confirm('Invalid file format or size. Allowed formats: pdf, jpg, jpeg. Size range: 100KB - 300KB.');";
        echo "if(response){";
        echo "window.location.href = 'group.php' ;";
        echo "}</script>"  ;
        //echo "invalid format";
    }
    }
}
    if($flag==1){
        echo "<script>var response=confirm('File uploaded successfully!!');";
        echo "if(response){";
        echo "window.location.href = 'group.php' ;";
        echo "}</script>"  ;
    }
}

?>