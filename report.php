<?php session_start(); ?>
<!DOCTYPE html>
<head>
    
    <link rel="stylesheet" type="text/css" href="Site.css">
    <link rel="stylesheet" type="text/css" href="loader.css">
    <link rel="icon" type="image/x-icon" href="Kare/KARELogo.jpg">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>
        KARE - Report
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
    
    <div class="main" id="main" style="display:none;">
        <br>
        
        <div class="mainitems" id="mainitems" style="background-color: rgb(111, 143, 175,50%); height:400px; text-align:center; border-color:rgb(0, 0, 139); border-style:groove;">
        <p style="font-size:x-large; font-weight:700"> 
           Report showcasing the certificate verification application
        </p>
        <hr color=black>
        <div class="maincontent" id="maincontent" style="display:flex">
            <div class="mainitems" id="mainitems" style="flex:1; overflow-y:auto; color:white; height:250px; text-align:left">
            <u>DETAILS</u>
            <?php
            include 'connect.php';
            $roll=['1001','1002','1003','1004','1005'];
            $query1="SELECT COUNT(DISTINCT id) FROM certify";
            $query2="SELECT COUNT(id) FROM users";
            $query3="SELECT COUNT(DISTINCT id) FROM certify WHERE v1date!='' AND v1date!='0'";
            $query4="SELECT COUNT(DISTINCT id) FROM certify WHERE v2date!='' AND v2date!='0'";
        
            $result1=$conn->query($query1);
            $result2=$conn->query($query2);
            $result3=$conn->query($query3);
            $result4=$conn->query($query4);
            $certify;$users;$verify1;$verify2;
            while($row1=$result1->fetch_assoc()){
                $certify=$row1["COUNT(DISTINCT id)"];
            }     
            while($row2=$result2->fetch_assoc()){
                $users=$row2["COUNT(id)"];
            } 
            while($row3=$result3->fetch_assoc()){
                $verify1=$row3["COUNT(DISTINCT id)"];
            } 
            while($row4=$result4->fetch_assoc()){
                $verify2=$row4["COUNT(DISTINCT id)"];
            } 
            $i=0;$rollcount=[];
            foreach($roll as $value){
                $query="SELECT COUNT(userid) FROM signin WHERE roll=";
                $query.="'$value'";
                
                $result=$conn->query($query);
                while($row=$result->fetch_assoc()){
                    $rollcount[$i]=$row['COUNT(userid)'];
                }
                unset($result);
                unset($row);
                $i+=1;
            }
            $users=$users-$certify;
            $data=[$certify,$users,$verify1,$verify2];
            $labels=['Submitted','Not Submitted','Phase-I Ver.','Phase-II Ver.'];
            ?>
            <ul>
                <li>Engineering student's count - <?php echo $rollcount[0]; ?></li>
                <li>Arts Student's count - <?php echo $rollcount[1]; ?></li>
                <li>Faculty's count - <?php echo $rollcount[2]; ?></li>
                <li>Verifer's count - <?php echo $rollcount[3]; ?></li>
                <li>Admin's count - <?php echo $rollcount[4]; ?></li>
                <li>No.of students submitted - <?php echo $certify; ?></li>
                <li>No. of students not submitted - <?php echo $users; ?></li>
                <li>Phase - I verification count - <?php echo $verify1; ?></li>
                <li>Phase - II verification count - <?php echo $verify2; ?></li>
            </ul>
            </div>
            <div class="mainitems" id="mainitems" style="flex:1; overflow-y:auto; color:white;">
            <canvas id="myBarChart" width="300" height="200"></canvas>
            <script>
            var ctx = document.getElementById('myBarChart').getContext('2d');
            var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Data in Bar Graph',
                    data: <?php echo json_encode($data); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Color of bars
                    borderColor: 'rgba(75, 192, 192, 1)', // Border color of bars
                    borderWidth: 1 // Border width of bars
                }]
            },
            options: {
                scales: {
                    x: {
                        ticks: {
                            color: 'white' // Set the label color to blue
                    }
                },
                    y: {
                     beginAtZero: true,
                     ticks: {
                        color: 'white' // Set the font color to red
                    }
                }
            },
            plugins: {
            legend: {
                labels: {
                    color: 'white' // Set the legend label color to green
                }
            }
        }
    }
});
</script>

            </div>
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