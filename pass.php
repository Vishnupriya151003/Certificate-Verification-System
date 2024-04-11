<?php
            $conn=new mysqli("localhost","KARE","Kare@626126","kare");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }
            else{
                echo "Connection success";
            }
            if(isset($_POST['submit'])){ 
                $uid=$_POST['id'];
                $upass=$_POST['pass'];
                echo $uid.$upass;
                if($uid!='' && $upass!=''){
                    $query = "UPDATE `login` SET `password`='$upass' WHERE `userid`='".$uid."';";
                    if ($conn->query($query) === TRUE) {
                        echo "Record updated successfully";
                        header("Location:signin.html");
                        
                      } else {
                        echo "Error: " . $query . "<br>" . $conn->error;
                      }
                }
                else{
                    echo "<p>Updation Failed <br/> Some Fields are Blank....!!</p>";
                    }
                    }
                    
            
?>