<?php
session_start();
include "connect.php";

$degree = $_POST['degree'];
$year = $_POST['year'];
$dept = $_POST['dept'];
$student= $_POST['student'];

$query;
if($_SESSION["deg"]=='1003'){
    $query="SELECT id,year,degree,dept FROM `users` WHERE faculty='".$_SESSION["id"]."' AND certify!='verified'";
}
else if($_SESSION["deg"]=='1004'){
    $query="SELECT id,year,degree,dept FROM `users` WHERE verifier='".$_SESSION["id"]."' AND certify!='verified'";
}
else if($_SESSION["deg"]=='1005'){
    $query="SELECT id,year,degree,dept FROM `users` WHERE certify='submitted'";
}
if ($student == "1") {
    $query .= " AND id LIKE '%98%'";
}
else if ($student == "2") {
    $query .= " AND id LIKE '%99%'";
}


if ($degree != "Select one") {
    $query .= " AND `degree` = '$degree'";
}

if ($year != "Select one") {
    $query .= " AND year = '$year'";
}

if ($dept != "Select one") {
    $query .= " AND dept = '$dept'";
}


$result = $conn->query($query);


$tableHTML = "<table border='2px' solid black' id='datatable'>";
$tableHTML .= "<tr>";
$tableHTML .= "<th>ID</th>";
$tableHTML .= "<th>Year</th>";
$tableHTML .= "<th>Degree</th>";
$tableHTML .= "<th>Department</th>";
$tableHTML .= "<th>Certificate</th>";
$tableHTML .= "</tr>";

while ($row = $result->fetch_assoc()) {
    $tableHTML .= "<tr>";
    foreach ($row as $data) {
        $tableHTML .= "<td>" . $data . "</td>";
        
    }
    $tableHTML .= "<td><a href='certificate.php?id=" . $row['id'] . "'>Click here</a></tr>";
    $tableHTML .= "</tr>";
}

$tableHTML .= "</table>";


echo $tableHTML;


$conn->close();
?>
