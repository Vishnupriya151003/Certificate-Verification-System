
<!DOCTYPE html>
<head>
    <link rel="icon" type="image/x-icon" href="Kare/KARELogo.jpeg">
    <link rel="stylesheet" type="text/css" href="Site1.css">
    <link rel="stylesheet" type="text/css" href="loader.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<title>
     KARE - Login
</title>
</head>
<?php
  session_start();

  include "google/gc_config.php";
  include "connect.php";
  $flag=0;
  if(isset($_GET["code"])){
    $token=$client->fetchAccessTokenWithAuthCode($_GET["code"]);
    $client->setAccessToken($token["access_token"]);
    
    $obj=new Google_Service_Oauth2($client);
    $data=$obj->userinfo->get();
    
    if(!empty($data->email)&&!empty($data->name)){
      
      //if you want to register user details, place mysql insert query here
      $_SESSION["email"]=$data->email;
      $_SESSION["name"]=$data->givenName;
	    $_SESSION["id"]=explode("@",$data->email)[0];
      $email=$_SESSION["email"];
      if(!empty($data['picture']))
      {
        $_SESSION['image'] = $data['picture'];
      } 
      $query = "select * from signin where userid='".$email."'";
      $result=$conn->query($query);
      $sql = '';
      if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
          $query = "SELECT username FROM signin WHERE userid='".$email."' AND username is NULL";
          $resultSelect = $conn->query($query);
          if($row["roll"]=='1002' || $row["roll"]=='1001'){
            $_SESSION["deg"]=$row["roll"];
            if ($resultSelect->num_rows > 0) {
            $sql = "UPDATE signin SET `username`='".$_SESSION["name"]."' WHERE `userid`='".$email."' AND username IS NULL";
            if ($conn->query($sql) === TRUE) {
              header("Location: edit.php");
            }}
            else{
            header("Location: group.php");
            }
          }
          else if($row["roll"]=='1004' || $row["roll"]=='1003'){
            if ($resultSelect->num_rows > 0) {
            $sql = "UPDATE signin SET `username`='".$_SESSION["name"]."' WHERE `userid`='".$email."' AND username=''";
            if ($conn->query($sql) === TRUE) {
              header("Location: search.php");
            }}
            header("Location: search.php");
          }
          else if($row["roll"]=='1005'){
            header("Location: datafeed.php");
          }
        }
      }
          else{
?>
<script>
  alert("Oops! Can't log you in. Contact the faculty advisor or administrator");
  </script>

  <?php 
    }
  }
}

  ?>
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


            <form id="userlogin" name="userlogin" method="post" action="login.php">
            
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
                <button>&nbsp;&nbsp;Sign In&nbsp;&nbsp;</button>&nbsp;&nbsp;
                <button><a href='change.php' style="text-decoration: none; color:white">&nbsp;&nbsp;Change Password&nbsp;&nbsp;</a></button>&nbsp;&nbsp;
                
                
                
            </div>
            </form>
           
            
            <p style="font-family: catamaran; font-size: 20px; color:white; text-align: center; font-weight: 600;">
              ________________OR________________ 
            </p>
            
            <div class="g-signin2" data-onsuccess="onSignIn" >
                <center>
                <a href="<?php echo $client->createAuthUrl(); ?>" class='btn btn-danger' style="text-decoration:none">
                <button class="google">
                    <svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" viewBox="0 0 256 262">
                    <path fill="#4285F4" d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027"></path>
                    <path fill="#34A853" d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1"></path>
                    <path fill="#FBBC05" d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782"></path>
                    <path fill="#EB4335" d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251"></path>
                  </svg>
                  Login With Google
                  </button></a>
                  </center>
                  <br>
            </div>
            
            <br>
    </div>
    <div id="footer" height=40px style="transition:2s;;display:none;width:100%;border-style:none; position:absolute; bottom:10px; margin-left:-10px;">
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
          document.getElementById("header").style.display = "block";
          document.getElementById("signup").style.display = "block";
          document.getElementById("footer").style.display = "block";
        }

        
        </script>
   
</body>
</html>