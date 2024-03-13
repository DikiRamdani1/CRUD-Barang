<?php
require_once("database.php");

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    if ($search != "") {
        $dataBarang = DataSearchBarang("nama_brg", $search);
    } else {
        $dataBarang = DataBarang();
    }
} else {
    $dataBarang = DataBarang();
}
$number = 0
    ?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <title>Member</title>
</head>

<body>
    <?php
    session_start();
    if ($_SESSION['status'] != "login") {
        header("location: login.php?msg=belum login");
    } elseif ($_SESSION["role"] != "member") {
        header("location: login.php?msg=belum login");
    }

    ?>
    <div class="w-100 vh-100"
        style="background: url('images/pexels-hristo-fidanov-1252890.jpg'); background-repeat: no-repeat; background-size: cover; position: fixed;">
    </div>
    <div class="w-100 vh-100 d-flex justify-content-end">
        <div class="col-2 h-100 d-flex flex-column bg-dark"
            style="position: fixed; top: 0; left: 0; box-shadow: 1px 0 10px black;">
            <div class="mt-3 d-flex align-items-center">
                <img src="logo.png" alt="" width="75px">
                <h4 class="text-light">BarangKu</h4>
            </div>
            <div class="mt-5 d-flex align-items-center">
                <i class='bx bx-home' style="font-size: 28px; color: rgba(255, 255, 255, 0.8);"></i>
                <?= "<a class='mt-1 text-decoration-none' style='color: rgba(255, 255, 255, 0.9);''
                    href='member.php?identitas=$_SESSION[no_identitas]'>Dasboard</a>"; ?>
            </div>
            <div class="mt-4">
                <h4 class="text-light">List</h4>
            </div>
            <div class="mt-3 d-flex align-items-center">
                <i class='bx bx-briefcase-alt-2' style="font-size: 28px; color: rgba(255, 255, 255, 0.8);"></i>
                <?= "<a class='mt-1 text-decoration-none' style='color: rgba(255, 255, 255, 0.9);''
                    href='listBarangMember.php?identitas=$_SESSION[no_identitas]'>Barang</a>"; ?>
            </div>
            <div class="mt-3 d-flex align-items-center">
                <i class='bx bx-notepad' style="font-size: 28px; color: rgba(255, 255, 255, 0.8);"></i>
                <?= "<a class='mt-1 text-decoration-none' style='color: rgba(255, 255, 255, 0.9);''
                    href='listPeminjamanBrg.php?identitas=$_SESSION[no_identitas]'>Pinjam</a>"; ?>
            </div>
        </div>
        <div class="col-10 d-flex flex-column">
            <div class="w-100 d-flex flex-column">
                <div class="mt-3 p-2 d-flex justify-content-between align-items-center bg-dark"
                    style="box-shadow: 0 0 8px black;">
                    <h1 class="text-light">List Barang</h1>
                    <a href="logout.php" class="text-decoration-none text-dark"> <button
                            class="rounded bg-danger px-3">Logout</button>
                    </a>
                </div>
                <div class="p-2 mt-3 bg-dark" style="box-shadow: 0 0 8px black;">
                    <form class="w-100" action="" method="post">
                        <input type="text" class="w-100 p-1 rounded-pill border-0" value="" name="search"
                            placeholder="Search Barang">
                    </form>
                    <table class="table table-dark w-100 mt-3" id="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Kategory</th>
                                <th scope="col">Merk</th>
                                <th scope="col">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataBarang as $data): ?>
                                <?php $number++ ?>
                                <tr>
                                    <td scope="row">
                                        <?= $number; ?>
                                    </td>
                                    <td scope="row">
                                        <?= $data['kode_brg']; ?>
                                    </td>
                                    <td scope="row">
                                        <?= $data['nama_brg']; ?>
                                    </td>
                                    <td scope="row">
                                        <?= $data['kategori']; ?>
                                    </td>
                                    <td scope="row">
                                        <?= $data['merk']; ?>
                                    </td>
                                    <td scope="row">
                                        <?= $data['jumlah'] <= 0 ? "Habis" : $data['jumlah'];?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>
</body>

</html>