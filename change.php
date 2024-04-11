<!DOCTYPE html>
<head>
    <link rel="icon" type="image/x-icon" href="Kare/KARELogo.jpg">
    <link rel="stylesheet" type="text/css" href="Site1.css">
    <link rel="stylesheet" type="text/css" href="loader.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<title>
     KARE - Login
</title>
</head>
<body onload="myFunction()" style="margin:0;">
    
    <div id="loader" class="loader"></div>
    <br>
    <div id="header" style="display:none" >
        <a href="#"><img src="Kare/KARELogo1.png" class="logo"> </a>
    </div>
    <br>
    <br>
    
    <div class="signup" id="signup" style="display:none">
            <br>
            <p style="font-family: catamaran; font-size: 28px; color:white; text-align: center;">Please log in with your credentials</p>
            <hr style="background-color: aliceblue;">
            <br>

           
            <form id="userlogin" name="userlogin" method="post" action="pass.php">
            
                <div class="container">
                <div class="row">
                    <div class="col-md-1">
                        <label>User ID</label>
                    </div>
                    <div class="col-md-2">
                        <input type="text" id="id" name="id" placeholder="Enter your user ID">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                        <label>Password</label>
                    </div>
                    <div class="col-md-2" >
                        <div >
                        
                        </div>
                        <input class="pass" type="password" id="pass" name="pass"  placeholder="Enter your password" >
                    </div>
                </div>
                
                <br>               
            </div>
            <br>
            <div style="text-align: center; ">
                <button id="submit" name="submit">&nbsp;&nbsp;Change&nbsp;&nbsp;</button>&nbsp;&nbsp;
                <button><a href='signup.php' style="text-decoration: none; color:white">&nbsp;&nbsp;Sign Up&nbsp;&nbsp;</a></button>&nbsp;&nbsp;
                
            </div>
            </form>
         <br>
            
            
           
    </div>
    <iframe id="footer" src="footer.html" width=100% height=60px style="transition:2s;display:none;border-style:none; position:absolute; bottom:0px; "></iframe>
    </iframe>
    
    <script>

        var myVar;
        
        function myFunction() {
          myVar = setTimeout(showPage, 1000);
        }
        
        function showPage() {
          document.getElementById("loader").style.display = "none";
          document.getElementById("header").style.display = "block";
          document.getElementById("signup").style.display = "block";
          document.getElementById("footer").style.display = "block";
        }

        
        </script>
   
</body>
</html>