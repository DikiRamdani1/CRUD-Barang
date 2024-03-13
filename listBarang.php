<?php
require_once("database.php");

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    if ($search != "") {
        $dataBarang = DataSearchBarang("nama_brg",$search);
    } else {
        $dataBarang = DataBarang();
    }
} else {
    $dataBarang = DataBarang();
}

if (isset($_POST["submitEdit"])) {
    $id = $_POST["id"];
    $jumlahBrg = $_POST["jumlahBrg"];
    $idBtn = $_POST["edit"];
    $data = Editdata("barang", $id);
} elseif (isset($_POST["submit"])) {
    $kode = $_POST['kodeBrg'];
    $nama = $_POST['namaBrg'];
    $kategori = $_POST['kategori'];
    $merk = $_POST['merk'];
    $jumlah = $_POST['jumlah'];
    TambahDataBrg($kode, $nama, $kategori, $merk, $jumlah);
    header('location: listBarang.php');
} elseif (isset($_POST['submitPinjam'])) {
    $jmlBrg = (integer) $_POST['jmlBrg'];
    $_SESSION['jmlBrg'] = $jmlBrg;
    $tglPinjam = $_POST['tglPinjam'];
    $tglKembali = $_POST['tglKembali'];
    $noIdentitas = $_POST['noIdentitas'];
    $kode = $_POST['kodeBrg'];
    $jmlPinjam = $_POST['jumlah'];
    $jumlah = (integer) $jmlBrg - $jmlPinjam;
    
    if ($jumlah < 0) {
        if ($jmlBrg === 0) {
            echo '<div id="closePinjam" style="width: 100%; height: 100vh; display: flex; justify-content: center; align-items: center; position: absolute; background: rgba(0, 0, 0, 0.8); z-index: 100;">
            <div class="card text-center" style="width: 18rem;">
            <div class="card-body">
            <p class="card-text">Barang sudah habis</p>
            <button class="btn btn-primary" id="btnClosePinjam">Close</button>
            </div>
            </div>
            </div>';
        } else {
            echo '<div id="closePinjam" style="width: 100%; height: 100vh; display: flex; justify-content: center; align-items: center; position: absolute; background: rgba(0, 0, 0, 0.8); z-index: 100;">
            <div class="card text-center" style="width: 18rem;">
            <div class="card-body">
            <p class="card-text">Jumlah terlalu banyak</p>
            <button class="btn btn-primary" id="btnClosePinjam">Close</button>
            </div>
            </div>
            </div>';
        }
    } else {
        TambahDataPinjam($tglPinjam, $tglKembali, $noIdentitas, $kode, $jmlPinjam);
        updateJumlah("barang", $kode, $jumlah);
        header('location: listBarang.php');
    }
} else {
    null;
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

    <title>Admin</title>
</head>

<body>
    <?php
    session_start();
    if ($_SESSION['status'] != "login") {
        header("location: login.php?msg=belum login");
    } elseif ($_SESSION["role"] != "admin") {
        header("location: login.php?msg=belum login");
    }
    ?>
    <style>
        input {
            background-color: white;
        }
    </style>
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
                    href='index.php?identitas=$_SESSION[no_identitas]'>Dasboard</a>"; ?>
            </div>
            <div class="mt-4">
                <h4 class="text-light">List</h4>
            </div>
            <div class="mt-3 d-flex align-items-center">
                <i class='bx bx-user' style="font-size: 28px; color: white;"></i>
                <?= "<a class='mt-1 text-decoration-none' style='color: rgba(255, 255, 255, 0.9);''
                    href='listUser.php?identitas=$_SESSION[no_identitas]'>User</a>"; ?>
            </div>
            <div class="mt-3 d-flex align-items-center">
                <i class='bx bx-briefcase-alt-2' style="font-size: 28px; color: rgba(255, 255, 255, 0.8);"></i>
                <?= "<a class='mt-1 text-decoration-none' style='color: rgba(255, 255, 255, 0.9);''
                    href='listBarang.php?identitas=$_SESSION[no_identitas]'>Barang</a>"; ?>
            </div>
            <div class="mt-3 d-flex align-items-center">
                <i class='bx bx-notepad' style="font-size: 28px; color: rgba(255, 255, 255, 0.8);"></i>
                <?= "<a class='mt-1 text-decoration-none' style='color: rgba(255, 255, 255, 0.9);''
                    href='listPeminjamanBrg2.php?identitas=$_SESSION[no_identitas]'>Pinjam</a>"; ?>
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
                    <div class="w-100 d-flex justify-content-between align-items-center">
                        <form class="w-75" action="" method="post">
                            <input type="text" class="w-100 p-1 rounded-pill border-0" value="" name="search"
                                placeholder="Search Barang">
                        </form>
                        <button type="button" name="edit" value="<?= $data['id']; ?>" class='btn btn-primary'
                            data-toggle='modal' data-target='#staticBackdrop2' style="width: 120px;">add Barang</button>
                    </div>
                    <table class="table table-dark w-100 mt-3" id="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Barang</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Merk</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col" class="text-center">Action</th>
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
                                    <td class="d-flex justify-content-around">
                                        <form class="" action="" method="post">
                                            <input type="hidden" value="<?= $data['id']; ?>" name="id">
                                            <input type="hidden" value="<?= $data['jumlah']; ?>" name="jumlahBrg" id="jumlahBarang">
                                            <button type="button" name="edit" id="edit" value="<?= $data['id']; ?>"
                                                class='btn btn-primary' data-toggle='modal'
                                                data-target='#staticBackdrop'>Edit</button>
                                            <button type="button" name="delete" id="delete" value="<?= $data['id']; ?>"
                                                class='btn btn-danger' data-toggle='modal'
                                                data-target='#staticBackdropDelete'>Delete</button>
                                            <button type="button" name="pinjam" id="pinjam"
                                                value="<?= $data['kode_brg']; ?>" class='btn btn-success'
                                                data-toggle='modal' data-target='#staticBackdropPinjam'
                                                style="width: 120px;">Pinjam</button>
                                        </form>
                                        <div class="modal fade" id="staticBackdropDelete" data-backdrop="static"
                                            data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                            aria-hidden="true">
                                            <div class="w-100 h-100 d-flex justify-content-center align-items-center">
                                                <div class="modal-dialog col-3">
                                                    <div class="modal-content bg-dark" style="position: relative;">
                                                        <div
                                                            class="modal-body d-flex flex-column justify-content-center align-items-center">
                                                            <h6 class="text-white mt-3">Apakah anda yakin?</h6>
                                                            <div class="w-100 mt-4 d-flex justify-content-around">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <form action="delete.php" method="post">
                                                                    <input type="hidden" name="idDelete" id="deleteId">
                                                                    <button type="submit" class="btn btn-primary"
                                                                        name="submitDelete">Oke</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-dark">
                            <div class="modal-header">
                                <h5 class="modal-title text-white" id="staticBackdropLabel">Edit</h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="update.php" method="post">
                                <div class="modal-body">
                                    <input type="hidden" name="id" id="id">
                                    <div class="form-group mt-4">
                                        <input type="text" class="form-control col-7 bg-dark text-white"
                                            placeholder="Masukan Kode Barang" name="kodeBrg">
                                    </div>
                                    <div class="form-group mt-4">
                                        <input type="text" class="form-control col-7 bg-dark text-white"
                                            placeholder="Masukan Nama Barang" name="namaBrg">
                                    </div>
                                    <div class="form-group mt-4">
                                        <input type="text" class="form-control col-7 bg-dark text-white"
                                            placeholder="Masukan Kategori" name="kategori">
                                    </div>
                                    <div class="form-group mt-4">
                                        <input type="text" class="form-control col-7 bg-dark text-white"
                                            placeholder="Masukan Merk" name="merk">
                                    </div>
                                    <div class="form-group mt-4">
                                        <input type="number" class="form-control col-7 bg-dark text-white"
                                            placeholder="Masukan Jumlah" name="jumlah">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="submitEdit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="staticBackdrop2" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-dark">
                            <div class="modal-header">
                                <h5 class="modal-title text-white" id="staticBackdropLabel">Add Barang</h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post">
                                <div class="modal-body">
                                    <input type="hidden" name="id">
                                    <div class="form-group mt-4">
                                        <input type="text" class="form-control col-7 bg-dark text-white"
                                            placeholder="Masukan Kode Barang" name="kodeBrg">
                                    </div>
                                    <div class="form-group mt-4">
                                        <input type="text" class="form-control col-7 bg-dark text-white"
                                            placeholder="Masukan Nama Barang" name="namaBrg">
                                    </div>
                                    <div class="form-group mt-4">
                                        <input type="text" class="form-control col-7 bg-dark text-white"
                                            placeholder="Masukan Kategori" name="kategori">
                                    </div>
                                    <div class="form-group mt-4">
                                        <input type="text" class="form-control col-7 bg-dark text-white"
                                            placeholder="Masukan Merk" name="merk">
                                    </div>
                                    <div class="form-group mt-4">
                                        <input type="number" class="form-control col-7 bg-dark text-white"
                                            placeholder="Masukan Jumlah" name="jumlah">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="staticBackdropPinjam" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-dark">
                            <div class="modal-header">
                                <h5 class="modal-title text-white" id="staticBackdropLabel">Pinjam</h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post">
                                <div class="modal-body">
                                    <input type="hidden" name="idBrg" id="idBrg">
                                    <input type="hidden" name="jmlBrg" id="jmlBrg">
                                    <div class="form-group mt-4">
                                        <input type="date" class="form-control col-7 bg-dark text-white"
                                            placeholder="Masukan Tanggal Pinjam" name="tglPinjam">
                                    </div>
                                    <div class="form-group mt-4">
                                        <input type="date" class="form-control col-7 bg-dark text-white"
                                            placeholder="Masukan Tanggal Kembali" name="tglKembali">
                                    </div>
                                    <div class="form-group mt-4">
                                        <input type="text" class="form-control col-7 bg-dark text-white"
                                            placeholder="Masukan No Identitas" name="noIdentitas">
                                    </div>
                                    <div class="form-group mt-4">
                                        <input type="hidden" class="form-control col-7 bg-dark text-white"
                                            placeholder="Masukan Kode Barang" name="kodeBrg" id="kodeBrg">
                                    </div>
                                    <div class="form-group mt-4">
                                        <input type="number" class="form-control col-7 bg-dark text-white"
                                            placeholder="Masukan Jumlah" name="jumlah">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="submitPinjam">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const btnEdit = document.getElementsByName("edit")
        const btnDelete = document.getElementsByName("delete")
        const btnPinjam = document.getElementsByName("pinjam")
        const idInput = document.getElementById("id")
        const jmlBrgInput = document.getElementById("jmlBrg")
        const idDelete = document.getElementById("deleteId")
        const kodeBrg = document.getElementById("kodeBrg")
        const ClosePinjam = document.getElementById("closePinjam")
        const btnClose = document.getElementById("btnClosePinjam")
        const jmlBrg = document.getElementsByName("jumlahBrg")


        console.log(ClosePinjam)

                
        for (let i = 0; i < btnEdit.length; i++) {
            btnEdit[i].addEventListener("click", () => {
                handleBtn(i, btnEdit, idInput)
            })
        }
        
        for (let i = 0; i < btnDelete.length; i++) {
            btnDelete[i].addEventListener("click", () => {
                handleBtn(i, btnDelete, idDelete)
            })
        }
        
        for (let i = 0; i < btnPinjam.length; i++) {
            btnPinjam[i].addEventListener("click", () => {
                handleBtn(i, btnPinjam, kodeBrg)
                handleBtn(i, jmlBrg, jmlBrgInput)
            })
        }

        const handleBtn = async (i, element1, valueInput) => {
            const btnValue = await element1[i].value
            valueInput.value = btnValue
            console.log(valueInput.value)
        }

        btnClose.addEventListener("click", async() => {
            ClosePinjam.style.background = "transparent"
            ClosePinjam.style.transition = "0.4s"
            await new Promise((resolve) => setTimeout(resolve, 100))
            ClosePinjam.style.zIndex = "-100"
            console.log("klalkdasl")
        })

    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>
</body>

</html>