<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("location: login.php?msg=belum login");
} elseif ($_SESSION["role"] != "admin") {
    header("location: login.php?msg=belum login");
}

require_once("database.php");
$id = $_POST['id'];
$kode = $_POST['kodeBrg'];
$nama = $_POST['namaBrg'];
$kategori = $_POST['kategori'];
$merk = $_POST['merk'];
$jumlah = $_POST['jumlah'];

$sql2 = update("barang", $id, $kode, $nama, $kategori, $merk, $jumlah);
if ($sql2) {
    header("location:listBarang.php");
}

?>