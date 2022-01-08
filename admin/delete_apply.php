<?php
session_start();
if (!isset($_SESSION["logged_in"])) {
    header("location: login.php");
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'project');
$apply_id = $_GET["id"];
$sql = "DELETE FROM apply WHERE id = '" . $apply_id . "'";
$conn->query($sql);
header("location: applies.php?id={$apply_id}");
