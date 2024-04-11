<?php
session_start();
include "connect.php";

// Get the searched user ID from the request
$searchedUserId = $_GET["id"];
if(empty($searchedUserId)){
    echo "Please type in search bar to search something or refresh the page.";
    exit;
}
// Add proper validation or sanitization for $searchedUserId

// Modify the SQL query to filter results based on the searched ID
$query;
if(!empty($searchedUserId)){
    if($_SESSION['deg']=='1003'){
    $query = "SELECT id, year, degree, dept FROM `users` WHERE id = '$searchedUserId' AND status='Active' AND certify!='verified' AND faculty='".$_SESSION["id"]."'";
    }
    else if($_SESSION['deg']=='1004'){
        $query = "SELECT id, year, degree, dept FROM `users` WHERE id = '$searchedUserId' AND status='Active' AND certify!='verified' AND verifier='".$_SESSION["id"]."'";
    }
    else if($_SESSION['deg']=='1005'){
        $query = "SELECT id, year, degree, dept FROM `users` WHERE id = '$searchedUserId' AND status='Active'";
    }
}

$result = $conn->query($query);

// Fetch the results and update the table
$datatable = [];
while ($row = $result->fetch_assoc()) {
    $datatable[] = $row;
}
if(!empty($datatable)){
echo "<table border=2px solid black; id='datatable'>";
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Year</th>";
echo "<th>Degree</th>";
echo "<th>Department</th>";
echo "<th>Certificate</th>";
echo "</tr>";

foreach ($datatable as $value) {
    echo "<tr>";
    foreach ($value as $datas) {
        echo "<td>";
        echo $datas . "</td>";
    }
    echo "<td><a href='certificate.php?id=" . $datatable[0]['id'] . "'>Click here</a></tr>";
    echo "</tr>";
}

echo "</table>";}

else{
    echo "No such data available. Reload the page to see all the data.";
}
?>
