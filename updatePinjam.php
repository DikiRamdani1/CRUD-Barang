<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("location: login.php?msg=belum login");
} elseif ($_SESSION["role"] != "admin") {
    header("location: login.php?msg=belum login");
}

require_once("database.php");
$id = $_POST['id'];
$tglPinjam = $_POST['tglPinjam'];
$tglKembali = $_POST['tglKembali'];
$identitas = $_POST['noIdentitas'];
$kode = $_POST['kodeBrg'];
$jmlPinjam = $_POST['jumlah'];
$dataBarang = DataSearchBarang("kode_brg", $kode);
foreach ($dataBarang as $data) {
    $jumlah = (integer) $jmlPinjam - $data['jumlah'];
    updateJumlah("barang", $kode, $jumlah);
}
$sql2=updatePinjam("peminjaman", $id, $tglPinjam, $tglKembali, $identitas, $kode, $jmlPinjam);

if ($sql2) {
    header("location:listPeminjamanBrg2.php");
}
    
?>