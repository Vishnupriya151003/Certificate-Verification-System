<?php session_start(); ?>
<!DOCTYPE html>
<head>
    
    <link rel="stylesheet" type="text/css" href="Site.css">
    <link rel="stylesheet" type="text/css" href="loader.css">
    <link rel="icon" type="image/x-icon" href="Kare/KARELogo.jpg">
    <title>
        KARE - Certificate Status
    </title>
 </head>
<body onload="myFunction()" >
    
    <div class="loader" id="loader" ></div>
    
    <div id="navbar" class="Nav" style="display:none;">
        <div id="close" class="close">
            <br>
            
           
        </div>
        <br>
        <div id="content" class="content">
            <br>
            <img src="<?php
    if(isset($_SESSION['image']) && !empty($_SESSION['image'])) {
        echo $_SESSION['image'];
    } else {
        echo 'Icons/user.png';
    }?>" width="100px;" style="border-radius:100%">

            <br><br>
            <a href="" class="name" style="text-decoration:none">
            <?php 
            echo $_SESSION['name'];
            
            ?>
            </a>
            <br>
            <br>
               
            <div class="content-items">
                <a class="citems" href="group.php">&nbsp;&nbsp;HOME</a>
            </div>
            <br>
            
            <a class="citems" href="logout.php" style="color: #551A8B" onclick="return confirm('Are you sure you want to logout?')">
            <div class="content-items">
                &nbsp;&nbsp;LOGOUT
            </div></a>
            
            <br>
        </div>
    </div>
     
    <div id="header" class="headnav" style="display:none;">
        
        <div id="header" class="header">
            <div class="navbar">
                
            </div>
            <div class="logobar" id="logobar">
               
            <img src="Kare/KARELogo.png" class="logo"  >
            </div>
        </div>
        <div class="regno">
            <label style="color:black; font-weight:600">
            <?php
            echo $_SESSION['email'];
            
            ?>
            </label>
            <br>
        </div>
        <br>
        <br>
        
    </div>
    <br>
    
    <div class="main" id="main" style="display:none;">
        <br>
        <div class="mainitems" id="mainitems" style="background-color: rgb(111, 143, 175,50%); height:400px; text-align:center; border-color:rgb(0, 0, 139); border-style:groove;overflow-y:auto;">
        <p style="font-size:x-large; font-weight:700; font-style:underline;"> 
            CERTIFICATE UPLOAD DETAILS:
        </p>
        <hr color=black>
        <div class="mainitems" id="mainitems" style="background-color:rgb(255,255,255,25%);height:280px;text-align:left;">
        <u>List of uploaded certificates and its status:</u><br>
        <ol>
            <?php
            include 'connect.php';
            $query;
            $group=[];
            if($_SESSION["deg"]=='1001'){
                $query="SELECT DISTINCT(name) FROM `group` ";
            }
            else if($_SESSION["deg"]=='1002'){
                $query="SELECT DISTINCT(name) FROM `group` WHERE `groupid`>1";
            }
            $result=$conn->query($query);
            while($row=$result->fetch_row()){
                $group[]=$row;
            }
            
            $stu_group=[];
            $sql="SELECT * FROM `certify` WHERE `id`='".$_SESSION['email']."'";
            $result1=$conn->query($sql);
    
            while($row1=$result1->fetch_assoc()){
                if(empty($row1['v1date']) AND $row1['reason']!='Nil'){
                    echo "<li>".$row1['course']." - Not verified because of <b>".$row1['reason']."</b>&nbsp;<a class='click' href=".$row1['file']." download='". $row1['course'].".jpg'>Click here to view</a></li>";
                }
                else if(empty($row1['v2date']) AND $row1['reason']!='Nil'){
                    echo "<li>".$row1['course']." - First stage verified. Second stage not verified because of <b>".$row1['reason']."</b>&nbsp;<a class='click' href=".$row1['file']." download='". $row1['course'].".jpg'>Click here to view</a></li>";
                }
                else if(empty($row1['v1date']) AND empty($row1['v2date']) AND $row1['reason']=='Nil'){
                    echo "<li>".$row1['course']." - Submitted on ".$row1['subdate']." but not verified yet.&nbsp;<a class='click' href=".$row1['file']." download='". $row1['course'].".jpg'>Click here to view</a></li> ";
                }
                else if(empty($row['v2date'])){
                    echo "<li>".$row1['course']." - First stage verified on ".$row1['v1date']."&nbsp;<a class='click' href=".$row1['file']." download='". $row1['course'].".jpg'>Click here to view</a></li>";
                    echo "<li>".$row1['course']." - Second stage of verification yet to be done&nbsp;<a class='click' href=".$row1['file']." download='". $row1['course'].".jpg'>Click here to view</a></li>";
                }
                else{
                    echo "<li>".$row1['course']." - First stage verified on ".$row1['v1date']."&nbsp;<a class='click' href=".$row1['file']." download='". $row1['course'].".jpg'>Click here to view</a></li>";
                    echo "<li>".$row1['course']." - Second stage verified on ".$row1['v2date']."&nbsp;<a class='click' href=".$row1['file']." download='". $row1['course'].".jpg'>Click here to view</a></li>";
                }
                $stu_group[]=$row1['course'];               

            }
            
            $group1=[];
            for($i=0;$i<=3;$i++){
                $group1[$i]=$group[$i][0];
            }
            $course=[];
            $course=array_diff($group1, $stu_group);
        
            ?>

        </ol><u>
        List of courses for which the certificate is not uploaded yet:</u><br>
        <ol>
            <?php

            foreach ($course as $value){
                echo "<li>".$value."</li>";
            }
            ?>
        </ol>
            </div></a>
            
        
            
            
            
            
        </div>
    
        
         </div>
    
    </div>
    

        <div id="footer" height=40px style="transition:2s;margin-bottom:0px;padding-bottom:0px;min-width:1000px;display:none;width:100%; margin-left:4px;border-style:none;bottom:-20px; position:relative;">
    <?php
    require("footer.html");
    ?>
    </div>
    <script>
        var myVar;
        
        function myFunction() {
          
          myVar = setTimeout(showPage, 1000);
          
        }

        
        
        function showPage() {
          document.getElementById("loader").style.display = "none";
          document.getElementById("navbar").style.display = "block";
          document.getElementById("header").style.display = "block";
          document.getElementById("main").style.display = "block";
          document.getElementById("footer").style.display = "block";
        }

        function opennav()
        {
            document.getElementById("navbar").style.width="24%";
            document.getElementById("navbar").style.padding="0px 10px";
            document.getElementById("header").style.marginLeft="25%";
            document.getElementById("main").style.marginLeft="27%";
            document.getElementById("footer").style.width="99.5%";

            
        }

               
        opennav();

    </script>
    

    
   
</body>
</html>