<?php
session_start();
if (!isset($_SESSION["logged_in"])) {
    header("location: login.php");
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'project');
$job_id = $_GET["id"];
$sql = "DELETE FROM jobs WHERE id = '" . $job_id . "'";
$conn->query($sql);
header("location: index.php");
