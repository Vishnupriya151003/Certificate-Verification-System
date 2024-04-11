<?php session_start();?>
<!DOCTYPE html>
<head>
<link rel="icon" type="image/x-icon" href="Kare/KARELogo.jpg">
    <link rel="stylesheet" type="text/css" href="Site.css">
    <link rel="stylesheet" type="text/css" href="loader.css">
    <link rel="stylesheet" type="text/css" href="Site2.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>
    KARE
</title>
</head>
<body onload="myFunction()" >

<div class="loader" id="loader" ></div>
    <div id="navbar" class="Nav" style="display:none">
        <div id="close" class="close">
            <br>
           
           
        </div>
        <br>
        <div id="content" class="content" >
            <br>
            <img src="<?php
    if(isset($_SESSION['image']) && !empty($_SESSION['image'])) {
        echo $_SESSION['image'];
    } else {
        echo 'Icons/user.png';
    }?>" width="100px;" style="border-radius:100%">

            <br><br><label class="name">
            <?php
            echo $_SESSION['name'];
            
            ?>
            </label>
            <br>
            
            <a class="citems" href="group.php">  
            <div class="content-items">
                &nbsp;&nbsp;HOME
            </div></a>
            
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
        <a class="citems" href="details.php?group=<?php echo $x ?>">
            <div class="content-items">
                &nbsp;&nbsp;GROUP - <?php echo $x; ?>
            </div>
            </a>
            
            <?php
                }
            ?>
            <a class="citems" href="certify_status.php" style="color: #551A8B" >
            <div class="content-items">
                &nbsp;&nbsp;CERTIFICATE STATUS
            </div></a>
            <a class="citems" href="logout.php" style="color: #551A8B" onclick="return confirm('Are you sure you want to logout?')">
            <div class="content-items">
                &nbsp;&nbsp;LOGOUT
            </div></a>
            <br>
        </div>
    </div>
     
    <div id="header" class="headnav" style="display:none">
        
        <div id="header" class="header">
            <div class="navbar">
                
            </div>
            <div class="logobar" id="logobar">
               
            <img src="Kare/KARELogo.png" class="logo"  >
            </div>
        </div>
        <div class="regno"><label style="color: black; font-weight:600px">
            <?php
            echo $_SESSION['id'];
            $id=$_SESSION['id'];
            ?>
            </label>
            <br>
        </div>
        <br>
        <br>
        
    </div>
    <br>
    
    <div class="grp" id="main" style="display:none" >
        
        <div class="grpitems" id="mainitems" style="background-color: rgb(111, 143, 175,50%);border-color:rgb(0, 0, 139); 
    border-style:groove; height:auto">
            
            <div class="grpcontent" style="display:left">
                <br>
                <b style="color:rgb(25, 25, 112);padding:15px; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">GROUP - <b id="number"></b> CERTIFICTATE UPLOAD SECTION</b>
                    
                 
                <div class="main" >
                <p style="color:black; font-size:large; font-weight:500;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select any one of the courses given inside the both skill set and upload the certificate.If there are more than one certificate to upload, please upload it all at once. Select all the certificates and upload it. Make sure that the certificate is clearly visible and is in the .jpg or .jpeg or .pdf format. Submitting files in other format is not allowed and the file size should be within the given range (100KB - 250KB)
                 </p>
                <?php
                   include "connect.php";
                    if (isset($_GET['group'])) { 
                        $group='';  
                        $group = $_GET['group'];   
                        
                       $sql="SELECT DISTINCT(name) FROM `group` WHERE groupid='".$group."'";           
                        $result=$conn->query($sql);  
                        
                        if($degree=='1001'){
                            $name='';
                            while($row=$result->fetch_row()){
                                $name=$row[0];
                                
                                 ?>
                                           
                           

                
                
            <div class="mainitems" id="mainitems" style="text-align:left; width:auto">
            
            <div class="maincontent" style="display:left" style=" height:auto">

            <img src="Icons/next.png" id="next" width="50px" style="float:left; margin-top: -6px;">
                <b class="subnavbtn" style="padding:15px; font-size:large; margin-top:2px"><?php echo $row[0]; ?> </b>
                <div class="submenu" id="submenu" style=" margin-left:50px;">
                <div style="color:skyblue; font-size:large; font-weight:500;"><br>
                Select only one of the options and upload the file
                            </div>
                <form action="upload.php" method="post" enctype="multipart/form-data">          
                <select id="file-type" name="file-type" class="file-type-select" onchange="toggleFileNameInput()">
                
                <?php
                $sqlquery="SELECT DISTINCT(sect) FROM `group` WHERE name='".$name."'";           
                $reslt=$conn->query($sqlquery);
                    while($row1=$reslt->fetch_row()){
                        $i=0;
                          ?>        
                                    <option value="<?php echo $row1[$i]; ?>"><?php echo $row1[$i];$i+=1;?></option>
                                    <?php } ?> 
                                </select>
                                
                                <input type="file" id="fileToUpload" name="file[]" class="file-input" required multiple>
                                <input type="text" id="file-name" name="file-name" class="file-name-input" placeholder="Enter file name" style="display: none;">
                                
                                
                                <input type="submit" value="Upload" name="submit" class="upload-button">
                                <button class="upload-button" style="display:none"></button>
                                
                            </div>
                </form>
            </div>
        </div>
              
    </div>
    <?php
                            }               
                       
        }   
    
    else{
        $group+=1;
    
        $sql1="SELECT DISTINCT(name) FROM `group` WHERE groupid='".$group."'";             
                        $result1=$conn->query($sql1);                
                       
                            $name1='';
                            while($row1=$result1->fetch_row()){
                                
        ?> 
                            <div class="mainitems" id="mainitems" style="text-align:left; width:auto">
            
            <div class="maincontent" style="display:left" style=" height:auto">
            
            <img src="Icons/next.png" id="next" width="50px" style="float:left; margin-top: -6px;">
                <b class="subnavbtn" style="padding:15px; font-size:large; margin-top:2px"><?php $name1=$row1[0]; echo $name1; }?> </b>
                <div class="submenu" id="submenu" style=" margin-left:50px;">
                <div style="color:black; font-size:large; font-weight:500;"><br>
                Select only one of the options and upload the file
                            </div>
                <form action="upload.php" method="post" enctype="multipart/form-data">          
                <select id="file-type" name="file-type" class="file-type-select" onchange="toggleFileNameInput()">
                <?php
                $sql1="SELECT DISTINCT(sect) FROM group WHERE name='".$name1."'";
                $result=$conn->query($sql1);
                $i=0;
                if($i==0){
                while($row1=$result->fetch_row()){
                      ?>        
                                <option value="<?php echo $row1[0]; ?>"><?php echo $row1[0];?></option>
                                <?php } } ?> 
                </select>
                                
                                <input type="file" id="fileToUpload" name="file[]" class="file-input" required multiple>
                                <input type="text" id="file-name" name="file-name" class="file-name-input" placeholder="Enter file name" style="display: none;">

                                
                                <input type="submit" value="Upload" name="submit" class="upload-button">
                               
                            </div>
                </form>
            </div>
        </div>
        <br>      
    </div>
           </div>
        </div>
    </div>
    <?php }}
    
    
    ?>
    <br>
    
    </div>
    <script>

        const urlParams = new URLSearchParams(window.location.search);
        const param1 = urlParams.get('group');

        var myVar;
        
        function myFunction() {
          
          myVar = setTimeout(showPage, 1000);
          
        }

        if(param1!=null){
            const result=document.getElementById('number');
            result.textContent = `${param1}`;
            console.log(param1);
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