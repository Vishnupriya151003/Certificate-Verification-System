<?php 
session_start(); 
$studid='';
if(isset($_GET['id'])){
    $studid=$_GET['id'];
}

?>
<!DOCTYPE html>
<head>
    <style>
        .click{
            color:  rgb(0, 0, 111);
        }
        #certify_yes:hover{
            background-color: green;
            color:black;
        }
        #certify_no:hover{
            background-color: red;
            color:black;
        }
        table{ 
            border-collapse: collapse; 
            border: 1px solid black; 
        } 
        th,td { 
            border: 1px solid black; 
            width:150px;
            text-align:center;
        } 
    </style>
    <link rel="stylesheet" type="text/css" href="Site.css">
    <link rel="stylesheet" type="text/css" href="loader.css">
    <link rel="icon" type="image/x-icon" href="Kare/KARELogo.jpg">
    <title>
        KARE - Certificate
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
            <?php
            if($_SESSION["deg"]=='1005'){
            ?>   
            <div class="content-items">
                <a class="citems" href="datafeed.php">&nbsp;&nbsp;DATAFEED</a>
            </div>
            
            <a class="citems" href="editdata.php" style="color: #551A8B">
            <div class="content-items">
                &nbsp;&nbsp;EDIT
            </div></a>
            
            <a class="citems" href="report.php" style="color: #551A8B">
            <div class="content-items">
                &nbsp;&nbsp;REPORT
            </div></a>
            <?php 
            }
            ?>
            <div class="content-items">
                <a class="citems" href="search.php">&nbsp;&nbsp;DETAILS</a>
            </div>
            
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
        <div class="mainitems" id="mainitems" style="background-color: rgb(111, 143, 175,50%); height:400px; border-color:rgb(0, 0, 139); border-style:groove">
        <p style="font-size:x-large;  text-align:center;font-weight:700"> 
            Student <?php echo $studid; ?> - details:
            <hr color=black>
        </p>
        <div id="studentList" style=" padding:10px; height:250px; overflow-y:auto;"> 
        <?php 
        if($_SESSION["deg"]=="1005"){
            echo "F.V  indicates the verification of the faculty advisor of the particular student. Similarly, V.V  indicates the verification of the second stage verifier of the particular student.<br>&nbsp;";
        }
        include "connect.php";
        $query="SELECT `name`,  `year`, `degree`, `dept` FROM `users` WHERE id='$studid'";
        $result=$conn->query($query);
        $query1="SELECT * FROM `certify` WHERE `id`='$studid' AND `reason`='Nil' ";
        if($_SESSION["deg"]=="1003"){
            $query1.="AND `v1date`='0'";
        }
        else if($_SESSION["deg"]=="1004"){
            $query1.="AND `v2date`='0'";
        }
        $_SESSION['studid']=$studid;
        $result1=$conn->query($query1);
        
        echo "<table id='datatable'>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Name</th>";
        echo "<th>Year</th>";
        echo "<th>Degree</th>";
        echo "<th>Department</th>";
        echo "<th>Course</th>";
        echo "<th>Certificate</th>";
        echo "<th>Sub. Date</th>";
        if($_SESSION["deg"]!="1005"){
        echo "<th colspan=2>Verified</th>";}
        else{
        echo "<th>F.V</th>";
        echo "<th>V.V</th>";
        }
        echo "</tr>";
        echo "<tr>";
        $course=[];$i=0;
        while($row=$result->fetch_assoc()){
            while($row1=$result1->fetch_assoc()){
            echo "<form action='verify_yes.php' method='post' enctype='multipart/form-data'>";
            echo "<td> $studid </td>";
            echo "<td> ".$row['name']." </td>";
            echo "<td> ".$row['year']." </td>";
            echo "<td> ".$row['degree']." </td>";
            echo "<td> ".$row['dept']." </td>";
            echo "<td><input id='course' name='course' style='background-color:transparent; border:none' readonly value='".$row1['course']."' ></input> </td>";
            echo "<td><a class='click' href=".$row1['file']." download='$studid-".$row1['course'].".jpg'> Click here to view</a> </td>";
            echo "<td> ".$row1['subdate']." </td>";
            if($_SESSION["deg"]!="1005"){
            echo "<td><input type='submit' name='Yes' id='certify_yes' value='Yes'></input></td>
            <td><input type='button' name='No' value='No' id='certify_no' onclick='notverified()'></input></td>";
            echo "</form>";
            $course[$i]=$row1['course'];
            $i+=1;  
            }
            else{
                if(!empty($row1['v1date']) AND !empty($row1['v2date']) AND $row1['v1date']!='0' AND $row1['v2date']!='0'){
                echo "<td> ".$row1['v1date']." </td>";
                echo "<td> ".$row1['v1date']." </td>";
                }
                else{
                    if(empty($row1['v1date']) OR $row1['v1date']=='0'){
                        echo "<td> Not verified </td>";
                    }
                    if(empty($row1['v2date']) OR $row1['v2date']=='0'){
                        echo "<td> Not verified </td>";
                    }
                }
            }
            echo "</tr>";   
        }
         
        }
        
        echo "</table>";
    
        ?>
        <span id="reasonspan" style="display:none">
        <br><form action="verify_no.php" method="post" enctype="multipart/form-data">
            <b>Describe the reason why the certificate is not verified within 100 words.</b><br><br>
            Course: <select name='course' id='course'>
                <option>Select Any One</option>
                <?php foreach($course as $value){ ?>
                <option value="<?php echo $value; ?>"><?php echo $value; }?></option>
            </select><br><br>
            Reason: <textarea id="reason" name="reason" rows="2" cols="50" style="background-color:skyblue"></textarea>
            <input type="submit" value="Submit"></input>
    </form>
    </span>
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
        

        function notverified(){
            
            document.getElementById("reasonspan").style.display= "block";
           
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