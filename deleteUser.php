<?php
require_once("database.php");
if (isset($_POST["submitDelete"])) {
    $id = $_POST['idDelete'];
    $sql = Delete("user", $id);
    if ($sql) {
        header("location:listUser.php");
    } else {
        echo "Hapus Gagal";
    }
}

?>