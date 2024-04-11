<?php session_start(); ?>
<!DOCTYPE html>
<head>
    
    <link rel="stylesheet" type="text/css" href="Site.css">
    <link rel="stylesheet" type="text/css" href="loader.css">
    <link rel="icon" type="image/x-icon" href="Kare/KARELogo.jpg">
    <title>
        KARE - Groups
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
            <?php
    if(isset($_SESSION['image']) && !empty($_SESSION['image'])) {
        echo "<img src='".$_SESSION['image']."'width='100px'; style='border-radius:100%'>";
    } else {
        echo "<img src='Icons/user.png' width='100px'; style='border-radius:100%'>";

    }?> 

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
            <a class="citems" href="certify_status.php" style="color: #551A8B" >
            <div class="content-items">
                &nbsp;&nbsp;CERTIFICATE STATUS
            </div></a><br>
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
            echo $_SESSION['id'];
            
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
        <div class="mainitems" id="mainitems" style="background-color: rgb(111, 143, 175,50%); height:400px; text-align:center; border-color:rgb(0, 0, 139); border-style:groove">
        <p style="font-size:x-large; font-weight:700"> 
            Click on any one of the group to upload your certificate and do the same.
        </p>&nbsp;
        
        <?php
            
            
            $degree=$_SESSION["deg"]; 
                
                if ($degree == '1001'){
                    $i=3;
                }
                else{
                    $i=2;
                }
                
                for ($x=1;$x<=$i;$x++){
                    
        ?>
               
            
        <div class="mainitems" id="mainitems" style="text-align:left">
            <a href="details.php?group=<?php echo $x; ?>" style="text-decoration: none;">
            <div class="maincontent" style="display:left" style=" height:auto">
                
                <b style="padding:15px; font-size:large; margin-top:2px">GROUP - <?php echo $x;  ?> CERTIFICTATE UPLOAD SECTION</b>
                <img src="Icons/next.png" width="50px" style="float:right; margin-top: -6px;">
                
            </div></a>
            
            <br>
            
            
            
            
        </div>
        <br>
        <?php 
         }
                    
        ?>
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