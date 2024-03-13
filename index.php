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

<body style="background: url('images/pexels-hristo-fidanov-1252890.jpg'); background-repeat: no-repeat; background-size: cover;">
    <?php
    session_start();
    if ($_SESSION['status'] != "login") {
        header("location: login.php?msg=belum login");
    } elseif ($_SESSION["role"] != "admin") {
        header("location: login.php?msg=belum login");
    }

    ?>
    <div class="w-100 vh-100 d-flex justify-content-end">
        <div style="position: absolute; top: 2%; right: 1%; z-index: 100;">
            <button class="rounded bg-danger px-3">
                <a href="logout.php" class="text-decoration-none text-dark">Logout</a>
            </button>
        </div>
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
        <div class="col-10 mt-3 d-flex flex-column align-items-center">
            <div class="w-50 mt-5 p-2 text-center bg-dark" style="box-shadow: 0 0 20px black;">
                <h1 style="color: rgba(255,255,255,0.8);">Selamat Datang</h1>
                <h6 class="mt-4 font-weight-normal" style="color: rgba(255,255,255,0.8); font-size: 18px;">BarangKu
                    menyediakan berbagai macam-macam barang untuk dipinjamkan.
                    orang tua, orang dewasa, dan anak-anak boleh meminjam barang.</h6>
            </div>
            <div class="w-100 mt-5 d-flex justify-content-around">
                <div class="p-3 bg-dark" style="box-shadow: 0 0 20px black;">
                    <div class="border-primary" style="width: 220px; height: 300px; border: 4px solid;">
                        <img style="object-fit: cover; width: 100%; height: 100%;"
                            src="images/Alexander McQueen's Tread Slick Sneaker Line Spotlighted in Nature.jpg" alt="">
                    </div>
                </div>
                <div class="p-3 bg-dark" style="box-shadow: 0 0 20px black;">
                    <div class="border-primary" style="width: 220px; height: 300px; border: 4px solid;">
                        <img style="object-fit: cover; width: 100%; height: 100%;" src="images/guitar aesthetic.jpg"
                            alt="">
                    </div>
                </div>
                <div class="p-3 bg-dark" style="box-shadow: 0 0 20px black;">
                    <div class="border-primary" style="width: 220px; height: 300px; border: 4px solid;">
                        <img style="object-fit: cover; width: 100%; height: 100%;"
                            src="images/THE FRANKIE SHOP Maesa pleated woven wide-leg cargo pants (1).jpg" alt="">
                    </div>
                </div>
                <div class="p-3 bg-dark" style="box-shadow: 0 0 20px black;">
                    <div class="border-primary" style="width: 220px; height: 300px; border: 4px solid;">
                        <img style="object-fit: cover; width: 100%; height: 100%;"
                            src="images/Week of September 16, 2019 - Sight Unseen.jpg" alt="">
                    </div>
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