<!DOCTYPE html>
<head>
    <link rel="icon" type="image/x-icon" href="Kare/KARELogo.jpg">
    <link rel="stylesheet" type="text/css" href="Site.css">
    <link rel="stylesheet" type="text/css" href="loader.css">
    <link rel="stylesheet" type="text/css" href="Site2.css">
    <link rel="stylesheet" type="text/css" href="Site1.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>
    KARE
</title>
</head>
<body onload="myFunction()" style="margin:0;">

    <div class="loader" id="loader" ></div>
    
     
    <div id="header" class="headnav" style="display:none; width:99%;">
        
        <div id="header" class="header">
           
            <div class="logobar" id="logobar">
               
            <img src="Kare/KARELogo.png" style="width:300px;margin-left:5%;" >
            </div>
        </div>
        <div class="regno">
            <?php session_start();
            echo $_SESSION['id'];
        
            ?>
            <br>
        </div>
        <br>
        <br>
        
    </div>
    <br>
    <div id="marq" style="display:none; width:auto; background-color:rgb(255,255,255,50%); transition:0.5s ">
    <marquee behaviour="scroll">
    <p style="font-size:larger; color:red; font-weight:700; text-align: center;">Only enter the starred ones. Please enter the data carefully. Once submitted the data can't be edited again.</p>
    </marquee>
    </div>
    <br>
    <form action="add.php" method="post">
        <div class="signup" id="main" style="display:none; transition:0.5s;">
            <br>
            <p style="font-family: catamaran; font-size: 28px; color:white; text-align: center;">Please register your details correctly</p>
            <hr style="background-color: aliceblue;">
            
            <div class="container">
            <div class="row">
            <div class="col-md-1">
                        <label>ID</label>
                    </div>
                    <div class="col-md-2">
                        <input type="text" id="id" name="id"
                        value="<?php 
                               echo $_SESSION['email'];
                               
                               ?>"
                        readonly>
                        
                    </div>
                <div class="row">
                <div class="col-md-1">
                        <label>Name</label>
                    </div>
                    <div class="col-md-2">
                        <input type="text" id="name" name="name"
                        value="<?php
                               echo $_SESSION['name'];
                               
                               ?>"
                        readonly>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                        <label>Year of Study<b style="color:brown; font-size:larger">*</b></label>
                    </div>
                    <div class="col-md-2">
                        <input type="text" id="year" name="year">
                    </div>
                </div>
                
                
                <div class="row">
                    <div class="col-md-1">
                        <label>Degree<b style="color:brown; font-size:larger">*</b></label>
                    </div>
                    <div class="col-md-2">
                        <input type="text" id="degree" name="degree">
                    </div>
                    
                </div>
                
                <div class="row">
                    <div class="col-md-1">
                        <label>Department<b style="color:brown; font-size:larger">*</b></label>
                    </div>
                    <div class="col-md-2">
                        <input type="text" id="dept" name="dept">
                    </div>
                </div>
                  
                       
            </div>
            <br>
            <div style="text-align: center; ">
                <button name="submit" id="submit" class="submit">&nbsp;&nbsp;Submit&nbsp;&nbsp;</button>
                
                <button><a href="signin.php" style="text-decoration: none; color:white;">&nbsp;&nbsp;Cancel&nbsp;&nbsp;</a></button>
            </div>
           <br>
            
        </div>
        <br>
        </div>
        
    </form>
    
    
    <script>
        var myVar;
        
        function myFunction() {
          myVar = setTimeout(showPage, 1000);
          
        }

        
        function showPage() {
          document.getElementById("loader").style.display = "none";
          
          document.getElementById("header").style.display = "block";
          document.getElementById("main").style.display = "block";
          document.getElementById("marq").style.display = "block";
          document.getElementById("footer").style.display = "block";
        }
       
        
    </script>
</body>
</html>