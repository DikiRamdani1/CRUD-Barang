<?php
require_once("database.php");
if (isset($_POST["submitDelete"])) {
    $id = $_POST['idDelete'];
    $sql = Delete("barang", $id);
    if ($sql) {
        header("location:listBarang.php");
    } else {
        echo "Hapus Gagal";
    }
}

?>