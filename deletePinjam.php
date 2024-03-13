<?php
require_once("database.php");
if (isset($_POST["submitDelete"])) {
    $id = $_POST['idDelete'];
    $kode = $_POST['kodeInput'];
    $jmlInput = $_POST['jmlInput'];
    $dataBarang = DataSearchBarang("kode_brg", $kode);
    foreach ($dataBarang as $data) {
        $jumlah = $jmlInput + $data['jumlah'];
        updateJumlah("barang", $kode, $jumlah);
    }
    $sql = Delete("peminjaman", $id);
    if ($sql) {
        header("location:listPeminjamanBrg2.php");
    } else {
        echo "Hapus Gagal";
    }
}

?>