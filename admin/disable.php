<?php
session_start();
if (!isset($_SESSION["logged_in"])) {
    header("location: login.php");
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'project');
$job_id = $_GET["id"];
$sql = "SELECT `status` FROM `jobs` WHERE `id`='{$job_id}';";
$conn->query($sql);

if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $status = $row['status'];
    }
}

if ($status == 1) {
    $reverse = 0;
} else {
    $reverse = 1;
}

$disable_sql = "UPDATE `jobs` SET `status` = '{$reverse}' WHERE `jobs`.`id` = {$job_id}";
if ($conn->query($disable_sql) === TRUE) {
    echo "OK" . "<br>" . $disable_sql;
    header("location: index.php");
} else {
    echo "ERROR";
}
