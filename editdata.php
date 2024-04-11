<?php session_start(); ?>
<!DOCTYPE html>
<head>
    <style>
        button{
            border-radius:5px;
            border-color: black;
            border-style: groove;
        }
        </style>
    <link rel="stylesheet" type="text/css" href="Site.css">
    <link rel="stylesheet" type="text/css" href="loader.css">
    <link rel="icon" type="image/x-icon" href="Kare/KARELogo.jpg">
    <title>
        KARE - Edit
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
                <a class="citems" href="datafeed.php">&nbsp;&nbsp;HOME</a>
            </div>
            <br>
            
            <div class="content-items">
                <a class="citems" href="search.php">&nbsp;&nbsp;SEARCH</a>
            </div>
            <br>

            <div class="content-items">
                <a class="citems" href="editdata.php">&nbsp;&nbsp;EDIT</a>
            </div>
            

            <a class="citems" href="report.php" style="color: #551A8B">
            <div class="content-items">
                &nbsp;&nbsp;REPORT
            </div></a>

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
        <div class="mainitems" id="mainitems" style="background-color: rgb(111, 143, 175,50%); height:400px; text-align:center; border-color:rgb(0, 0, 139); border-style:groove;">
        <p style="font-size:x-large; font-weight:700"> 
           Edit the existing details here by using the input.
        </p>
        <hr color=black>
        <div class="maincontent" id="maincontent" style="display:flex">
            <div class="mainitems" id="mainitems" style="flex:1; overflow-y:auto; color:white;">
            <button id='statusbutton' name='status' style='background-color:aqua;' onclick="status()">Status</button>
            <button id='rollbutton' name='roll' onclick="roll()">Roll</button>
            <button id='updatebutton' name='update' onclick="update()">Update</button>
            <button id='deletebutton' name='delete' onclick="del()">Delete</button>
            <br>&nbsp;
            <span id='statusdata' name='statusdata' style="text-align:left">
            <form action="editstatusdata.php" method="post" enctype="multipart/form-data">
            No. Of Users: 
            <select id='usersno' name='usersno'>
                <option>Select any</option>
                <option value="1">One</option>
                <option value="2">More than one</option>
            </select>
            <input type='text' id='userno' name='userno' placeholder="Enter the number"><br><br>
            Status change to: 
            <select id='tostatus' name='tostatus'>
                <option>Select any</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select><br><br>
            Users Id: <textarea id='userid' name='userid'rows="4" cols="20" placeholder="Enter the ids"></textarea><br><br>
            <center>
                <input type='submit' value='Submit' style='background-color:darkblue;color:white; height:30px; width:75px; border-radius:10px;'>
            </center>
            </form>
            </span>

            <span id='rolldata' name='rolldata' style="text-align:left;display:none">
            <form action="editrolldata.php" method="post" enctype="multipart/form-data">
            No. Of Users: 
            <select id='usersno' name='usersno'>
                <option>Select any</option>
                <option value="1">One</option>
                <option value="2">More than one</option>
            </select>
            <input type='text' id='userno' name='userno' placeholder="Enter the number"><br><br>
            Roll change to: 
            <select id='toroll' name='toroll'>
                <option>Select any</option>
                <option value="1003">Faculty</option>
                <option value="1004">Verifier</option>
                <option value="1005">Admin</option>
            </select><br><br>
            
            Users Id: <textarea id='userid' name='userid'rows="4" cols="20" placeholder="Enter the ids"></textarea><br><br>
            <center>
                <input type='submit' value='Submit' style='background-color:darkblue;color:white; height:30px; width:75px; border-radius:10px;'>
            </center>
            
            </form>  
            </span>

            <span id='updatedata' name='updatedata' style="text-align:left;display:none">
            <form action="updatedata.php" method="post" enctype="multipart/form-data">
            No. Of Users: 
            <select id='usersno' name='usersno'>
                <option>Select any</option>
                <option value="1">One</option>
                <option value="2">More than one</option>
            </select>
            <input type='text' id='userno' name='userno' placeholder="Enter the number"><br><br>
            Users Id: <textarea id='userid' name='userid'rows="4" cols="20" placeholder="Enter the ids"></textarea><br><br>
            Fields:
            <select id='field' name='field'>
                <option>Select any</option>
                <option value="faculty">Faculty</option>
                <option value="verifier">Verifier</option>
            </select>
            <input type='text' id='fieldname' name='fieldname' placeholder="Enter the name"><br><br>
            <center>
                <input type='submit' value='Submit' style='background-color:darkblue;color:white; height:30px; width:75px; border-radius:10px;'>
            </center>
                  
            </form>
            </span>

            <span id='deletedata' name='deletedata' style="display:none;text-align:left">
            <form action="deletedata.php" method="post" enctype="multipart/form-data">
            No. Of Users: 
            <select id='usersno' name='usersno'>
                <option>Select any</option>
                <option value="1">One</option>
                <option value="2">More than one</option>
            </select>
            <input type='text' id='userno' name='userno' placeholder="Enter the number"><br><br>
            
            Users Id: <textarea id='userid' name='userid'rows="4" cols="20" placeholder="Enter the ids"></textarea><br><br>
            <center>
                <input type='submit' value='Submit' style='background-color:darkblue;color:white; height:30px; width:75px; border-radius:10px;'>
            </center>
             
            </form>
            </span>
                
            </div>
            <div class="mainitems" id="mainitems" style="flex:1; overflow-y:auto; text-align:left">
            <br>
            
                Please follow the following while entering the data:<br>
                    <ol>
                        <li>If there are more than one users, enter the number in the textbox.</li><br>
                        <li>Use comma (,) for entering more than one user id</li><br>
                        <li>To cancel the entered data, please refresh the page.</li><br>
                        <li>Enter the user id in this format - 'userid@klu.ac.in'</li>
                        
                    </ol>
                </div>
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
        
        function status(){
            document.getElementById("statusdata").style.display="block";
            document.getElementById("rolldata").style.display="none";
            document.getElementById("updatedata").style.display="none";
            document.getElementById("deletedata").style.display="none";
            document.getElementById("statusbutton").style.backgroundColor="aqua";
            document.getElementById("updatebutton").style.backgroundColor="white";
            document.getElementById("rollbutton").style.backgroundColor="white";
            document.getElementById("deletebutton").style.backgroundColor="white";
        }
        
        function roll(){
            document.getElementById("statusdata").style.display="none";
            document.getElementById("rolldata").style.display="block";
            document.getElementById("updatedata").style.display="none";
            document.getElementById("deletedata").style.display="none";
            document.getElementById("statusbutton").style.backgroundColor="white";
            document.getElementById("updatebutton").style.backgroundColor="white";
            document.getElementById("rollbutton").style.backgroundColor="aqua";
            document.getElementById("deletebutton").style.backgroundColor="white";
        }

        function update(){
            document.getElementById("statusdata").style.display="none";
            document.getElementById("rolldata").style.display="none";
            document.getElementById("updatedata").style.display="block";
            document.getElementById("deletedata").style.display="none";
            document.getElementById("statusbutton").style.backgroundColor="white";
            document.getElementById("updatebutton").style.backgroundColor="aqua";
            document.getElementById("rollbutton").style.backgroundColor="white";
            document.getElementById("deletebutton").style.backgroundColor="white";
        }

        function del(){
            document.getElementById("statusdata").style.display="none";
            document.getElementById("rolldata").style.display="none";
            document.getElementById("updatedata").style.display="none";
            document.getElementById("deletedata").style.display="block";
            document.getElementById("statusbutton").style.backgroundColor="white";
            document.getElementById("updatebutton").style.backgroundColor="white";
            document.getElementById("rollbutton").style.backgroundColor="white";
            document.getElementById("deletebutton").style.backgroundColor="aqua";
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