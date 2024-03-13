<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("location: login.php?msg=belum login");
} elseif ($_SESSION["role"] != "admin") {
    header("location: login.php?msg=belum login");
}
require_once("database.php");
$id = $_POST['id'];
$identitas = $_POST['noIdentitas'];
$nama = $_POST['nama'];
$status = $_POST['status'];
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

$sql2=updateUser("user", $id, $identitas, $nama, $status, $username, $password, $role);
if ($sql2) {
    header("location:listUser.php");
}
    
?>