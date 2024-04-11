<?php 
session_start(); 
$id=$_SESSION['id'];
include "connect.php";
  $degree=[];
  $year= [];
  $dept=[];
  $deg=$_SESSION["deg"];
  if($deg=='1003'){
    $query = "select * from `users` where faculty='".$id."' and certify='submitted'";
}
  else if($deg=='1004'){
    $query = "select * from `users` where verifier='".$id."' and certify='submitted'";
  }
  else if($deg=='1005'){
    $query = "select * from `users` where certify='submitted'";
  }
  $result=$conn->query($query);
  while($row=$result->fetch_assoc()){

    $degree[]=$row['degree'];
    $year[]=$row['year'];
    $dept[]=$row['dept'];
  }
  
  $degree=array_unique($degree);
  $year=array_unique($year);
  $dept=array_unique($dept);
  

?>
<!DOCTYPE html>
<head>
    <style>
        .search{
            margin-left:200px; 
            border-style:groove; 
            cursor: pointer;
            background-color: rgb(0, 0, 111,70%);
            color:white;
            border-radius: 5px;
            height:30px;
            padding:5px;
        }
        a{
            color:#110753;
        }
        .search:hover{
            background-color: #6BB6CD;
            color:black;
        }
        table{ 
            border-collapse: collapse; 
            border: 1px solid black; 
        } 
        th,td { 
            border: 1px solid black; 
            width:200px;
            align-items: center;
        } 
    </style>
    <link rel="stylesheet" type="text/css" href="Site.css">
    <link rel="stylesheet" type="text/css" href="loader.css">
    <link rel="icon" type="image/x-icon" href="Kare/KARELogo.jpg">
    <title>
        KARE - Search
    </title>
 </head>
<body onload="myFunction()">

    <div class="loader" id="loader" ></div>
    
    <div id="navbar" class="Nav" style="display:none;">
        <div id="close" class="close">
            
           
           
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

            <br>
            <a href="" class="name" style="text-decoration:none">
            <?php
            echo $_SESSION['name'];
            
            ?>
            </a>
            <br><br>
            <form id="filtersearch" action="" method="post" enctype="multipart/form-data">
            <div class="content-items" style="font-size:large; padding:5px;">
            &nbsp;Degree:
                <select id="degree" name="degree" onchange="">
                <option>Select one</option>
                    <?php
                    foreach ($degree as $value) {
                        
                       
                          ?>        
                                    <option value="<?php echo $value; ?>"><?php echo $value;?></option>
                                    <?php } ?> 
                                </select>
            </div><br>
            <div class="content-items" style="font-size:large; padding:5px;">
            &nbsp;Year:
                <select id="year" name="year">
                <option>Select one</option>
                <?php
                    foreach ($year as $value) {
                        
                       
                        ?>        
                                  <option value="<?php echo $value; ?>"><?php echo $value;?></option>
                                  <?php } ?>
                                </select>
                
            </div><br>
            <div class="content-items" style="font-size:large; padding:5px;">
            &nbsp;Department:
                <select id="dept" name="dept">
                    <option>Select one</option>
                    <?php
                   foreach ($dept as $value) {
                        
                       
                    ?>        
                              <option value="<?php echo $value; ?>"><?php echo $value;?></option>
                              <?php } ?>
                                </select>
                </select>
            </div><br>
            
            <div class="content-items" style="font-size:large; padding:5px;">
            &nbsp;Student:
                <select id="student" name="student">
                    <option>Select one</option>
                    <option value="1">Lateral </option>
                    <option value="2">Regular </option>
                    
                </select>
                
            </div>
           
            

                    </form>
            <a class="citems" href="logout.php" style="color: #551A8B" onclick="return confirm('Are you sure you want to logout?')">
            <div class="content-items">
                &nbsp;&nbsp;LOGOUT
            </div></a>
            <br>
            <script>
function updateTable() {

    var degree = document.getElementById("degree").value;
    var year = document.getElementById("year").value;
    var dept = document.getElementById("dept").value;
    var student = document.getElementById("student").value;

    // AJAX request
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            
            document.getElementById("studentList").innerHTML = xhr.responseText;
        }
    };
    

    var url = "updateTable.php";
    var params = "degree=" + degree + "&year=" + year + "&dept=" + dept + "&student=" + student;
    
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(params);
}

document.getElementById("degree").addEventListener("change", updateTable);
document.getElementById("year").addEventListener("change", updateTable);
document.getElementById("dept").addEventListener("change", updateTable);
document.getElementById("student").addEventListener("change", updateTable);
</script>

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
    <div class="mainitems" id="mainitems" style="position:absolute;background-color: rgb(111, 143, 175); border-color:rgb(0, 0, 139); border-style:groove; width:65%">
            <h2>Student's List</h2>
            <hr color=black>
    
            <div style="width:90%; padding:10px; ">
              
                <input type="text" id="search" size="50" placeholder="Search for student's list"></input>
                <input type="submit" id="searchbutton" onclick="searchStudent()" style="width:100px;height:30px; background-color:#110753; border-radius:6px; color:aliceblue; cursor:pointer" value="Search"></input>
        
            </div>
            <hr color=black>
            <div id="studentList" style=" padding:10px; height:250px; overflow-y:auto;"> 
            
            <?php 
            include "connect.php";
            $query;
            
            if($_SESSION["deg"]=='1003'){
                $query="SELECT id,year,degree,dept FROM `users` WHERE faculty='".$_SESSION["id"]."' AND certify!='verified' AND status='Active'";
            }
            else if($_SESSION["deg"]=='1004'){
                $query="SELECT id,year,degree,dept FROM `users` WHERE verifier='".$_SESSION["id"]."' AND certify!='verified' AND status='Active'";
            }
            else if($_SESSION["deg"]=='1005'){
                $query="SELECT id,year,degree,dept FROM `users` WHERE certify='submitted' AND status='Active'";
            }
            $result = $conn->query($query);
            $datatable=[];
            while($row=$result->fetch_assoc()){
                $datatable[]=$row;
            }
            
            echo "<table border=2px solid black; id='datatable'>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Year</th>";
            echo "<th>Degree</th>";
            echo "<th>Department</th>";
            echo "<th>Certificate</th>";
            echo "</tr>";
            $i=0;
            foreach ($datatable as $value) {
                echo "<tr>";
                foreach($value as $datas){
                    echo "<td>";
                    echo $datas."</td>";
                }
                echo "<td><a href='certificate.php?id=".$datatable[$i]['id']."'>Click here</a></td>";  
                echo "</tr>";
                $i+=1;
            }
            
            
            echo "</table>";
            ?>
            
            </div>
            
        </div>       
        <script>
    function searchStudent() {
        var userId = document.getElementById("search").value;

        // Make an AJAX request to fetch the student data based on the searched ID
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Update the studentList div with the fetched data
                document.getElementById("studentList").innerHTML = xhr.responseText;
            }
        };
        
        // Replace 'your_search_script.php' with the actual script handling the search on the server-side
        xhr.open("GET", "searchData.php?id=" + userId, true);
        xhr.send();
    }
</script>


                
    </div>
    <div id="footer" height=40px style="transition:2s;;display:none;width:100%;border-style:none; position:absolute; bottom:10px; margin-left:-10px;">
    <?php
    require("footer.html");
    ?>
    </div>
    <script>
        var myVar;
        document.getElementById("searchbutton").addEventListener("click", search);

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