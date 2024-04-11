<?php session_start(); 
$_SESSION['flag']=''; ?>
<!DOCTYPE html>
<head>
    <style>
        .download{
            color:black;
            
        }

        .download:hover{
            color:darkblue;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="Site.css">
    <link rel="stylesheet" type="text/css" href="loader.css">
    <link rel="icon" type="image/x-icon" href="Kare/KARELogo.jpg">
    <title>
        KARE - Datafeed
    </title>
    

 </head>
<body onload="myFunction()">

    <div class="loader" id="loader" ></div>
    
    <div id="navbar" class="Nav" style="display:none; height:100%;">
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
            <a href="edit.php" class="name" style="text-decoration:none">
            <?php
            echo $_SESSION['name'];
            ?>
            </a>
            <br>
            <br>
               
           
            <br>
            <div class="content-items">
                <a class="citems" href="datafeed.php">&nbsp;&nbsp;HOME</a>
            </div>
            <br>
            
            <div class="content-items">
                <a class="citems" href="search.php">&nbsp;&nbsp;SEARCH</a>
            </div>
            <a class="citems" href="editdata.php" style="color: #551A8B">
            <div class="content-items">
                &nbsp;&nbsp;EDIT
            </div></a>
            
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
    
    <div class="main" id="main" style="display:none">
        <br>
        
        <div class="mainitems" id="mainitems" style="background-color: rgb(111, 143, 175,50%);  border-color:rgb(0, 0, 139); border-style:groove">
        <p style="font-size:x-large; font-weight:600"> 
            Please upload your data using the Excel sheet link provided below. Before proceeding, ensure that the following details are included:
        </p>
        <ol>
            <li> Full name of the student or faculty member.</li>
            <li> ID number of the student or faculty member.</li>
            <li> Status of the student or faculty member.</li>
            <li> Faculty member of the students.</li>
            <li> Please choose any one of the options below and upload the relevant file. </li>
            <li> Please use the template given below and feed the data for both students and faculty.</li>
        </ol>
        <a href="template.xlsx" class="download">Click here to download the Template</a>
        <br>
        <div>
  <br>
    <form action="data.php" method="post" enctype="multipart/form-data">
      <label for="file" style="font-weight: bold; color: black; font-size: 16px; text-decoration: underline;">Select Excel File to Upload:</label>
      <br>
      <div >
<br>
      <b>File Type:</b> &nbsp;&nbsp;<select id="file-type" name="file-type" class="file-type-select" onchange="toggleFileNameInput()">
                <option value="Select One">Select One</option>
                <?php
                include "connect.php";
                $sqlquery="SELECT DISTINCT(rollname) FROM rolls";           
                $reslt=$conn->query($sqlquery);
                    while($row1=$reslt->fetch_row()){
                        $i=0;
                          ?>        
                                    <option value="<?php echo $row1[$i]; ?>"><?php echo $row1[$i];$i+=1;?></option>
                                    <?php } ?> 
                                </select>
          &nbsp;&nbsp;<input type="file" id="file" name="file" style="padding: 10px; background-color: rgba(0,0,0, 0.3); color: white; border: 2px solid rgba(0,0,0); cursor: pointer; border-radius: 5px; flex: 1;">
          <input type="submit" name="excelfile" value="Upload" style="padding: 10px; background-color: black; color: white; border: none; cursor: pointer; border-radius: 5px;">
             
      </div>
  </form>
  
</div>

        </div>
    </div>
    <div id="footer" height=40px style="transition:2s;;display:none;width:99.5%;border-style:none; position:absolute; bottom:10px; margin-left:-10px;">
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
            
        }

        function closenav()
        {
            
            document.getElementById("navbar").style.width="0";
            document.getElementById("navbar").style.padding="0px";
            document.getElementById("header").style.marginLeft="-8px";
            document.getElementById("main").style.marginLeft="0%";
                      
        }
        
        opennav();

    </script>
    
   
</body>
</html>