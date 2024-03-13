<?php
require_once('database.php');
session_start();
$_SESSION['status'] = "";
if ($_SESSION['status'] == "login") {
    header("location:index.php");
} else {
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (Login($_POST['username'], $_POST['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['status'] = "login";
            if ($_SESSION['role'] == "admin") {
                header("location:index.php?identitas=$_SESSION[no_identitas]");
            } else {
                header("location:member.php?identitas=$_SESSION[no_identitas]");
            }
        } else {
            header("location:login.php?msg=gagal");
        }
    } elseif (isset($_POST["submitRegister"])) {
        $nama = $_POST["nama"];
        $noIdentitas = $_POST["noIdentitas"];
        $statusUser = $_POST["status2"];
        $regUser = $_POST["username2"];
        $regPass = $_POST["password2"];
        $role = $_POST["role"];
        TambahDataUser($noIdentitas, $nama, $statusUser, $regUser, $regPass, $role);
    } else {
        null;
    }
}

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

    <title>Login</title>
</head>

<body>
    <style>
        .card {
            border-radius: 50px;
            background-color: black;
            position: absolute;
            overflow: hidden;
        }

        .card:nth-child(1) {
            z-index: 1;
        }
    </style>
    <div class="w-100 vh-100 d-flex justify-content-center align-items-center"
        style="background: url('images/pexels-hristo-fidanov-1252890.jpg'); background-repeat: no-repeat; background-size: cover; position: relative;">
        <form class="col-4 h-75" action="" method="post">

            <div class="card w-100 h-100 border border-dark d-flex flex-column align-items-center" id="login">
                <h1 class="text-light mt-3 pb-4">Login</h1>
                <input class="w-75 h-auto mt-5 p-2 rounded-pill border-0" type="text" placeholder="Masukan Username"
                    name="username">
                <input class="w-75 mt-4 p-2 rounded-pill border-0" type="password" placeholder="Masukan Password"
                    name="password">
                <button class="w-75 mt-4 p-2 rounded border border-dark bg-primary text-dark font-weight-bold"
                    name="submit">Login</button>
                <button type="button"
                    class="w-75 mt-4 p-2 rounded border border-dark bg-success text-dark font-weight-bold"
                    id="btnRegister">Register</button>
            </div>
            <div class="card w-100 h-100 border border-dark d-flex flex-column align-items-center" id="register">
                <h1 class="text-light mt-3 pb-4">Register</h1>
                <input class="w-75 h-auto mt-2 p-2 rounded-pill border-0" type="text" placeholder="Masukan Nama Lengkap"
                    name="nama">
                <input class="w-75 mt-4 p-2 rounded-pill border-0" type="text" placeholder="Masukan No identitas"
                    name="noIdentitas">
                <select class="w-75 mt-4 p-2 rounded-pill border-0" name="status2" id="">
                    <option value="admin">Pelajar</option>
                    <option value="member">Pekerja</option>
                    <option value="member">Kuli</option>
                    <option value="member">Dokter</option>
                    <option value="member">Rahasia</option>
                </select>
                <button type="button"
                    class="w-75 mt-4 p-2 rounded border border-dark bg-primary text-dark font-weight-bold"
                    id="next">Next</button>
                <button type="button"
                    class="w-75 mt-4 p-2 rounded border border-dark bg-danger text-dark font-weight-bold"
                    id="back">Back</button>
            </div>
            <div class="card w-100 h-100 border border-dark d-flex flex-column align-items-center" id="register2">
                <h1 class="text-light mt-3 pb-4">Register</h1>
                <input class="w-75 h-auto mt-2 p-2 rounded-pill border-0" type="text" placeholder="Masukan Username"
                    name="username2">
                <input class="w-75 mt-4 p-2 rounded-pill border-0" type="password" placeholder="Masukan Password"
                    name="password2">
                <select class="w-75 mt-4 p-2 rounded-pill border-0" name="role" id="">
                    <option value="admin">Admin</option>
                    <option value="member">Member</option>
                </select>
                <button class="w-75 mt-4 p-2 rounded border border-dark bg-primary text-dark font-weight-bold"
                    name="submitRegister">Submit</button>
                <button type="button"
                    class="w-75 mt-4 p-2 rounded border border-dark bg-danger text-dark font-weight-bold"
                    id="back2">Back</button>
            </div>
        </form>
    </div>
    <script>
        const login = document.getElementById("login")
        const register = document.getElementById("register")
        const register2 = document.getElementById("register2")
        const btnRegister = document.getElementById("btnRegister")
        const next = document.getElementById("next")
        const back = document.getElementById("back")
        const back2 = document.getElementById("back2")

        const styleLoad = (load, card) => {
            load.style.width = "100%"
            load.style.height = "100%"
            load.style.position = "absolute"
            load.style.top = "0"
            load.style.left = "0"
            load.style.backgroundColor = "transparent"
            load.style.transition = "0.4s"
            card.append(load)
        }

        btnRegister.addEventListener("click", async () => {
            const load = document.createElement("div")
            styleLoad(load, login)

            await new Promise((resolve) => setTimeout(resolve, 200))
            load.style.background = "white"
            await new Promise((resolve) => setTimeout(resolve, 1000))
            register.style.zIndex = "10"
            styleLoad(load, register)

            await new Promise((resolve) => setTimeout(resolve, 100))
            load.style.backgroundColor = "transparent"
            await new Promise((resolve) => setTimeout(resolve, 10))
            load.remove()
        })

        back.addEventListener("click", async () => {
            const load = document.createElement("div")
            styleLoad(load, register)

            await new Promise((resolve) => setTimeout(resolve, 200))
            load.style.background = "white"
            await new Promise((resolve) => setTimeout(resolve, 1000))
            register.style.zIndex = "0"
            styleLoad(load, login)

            await new Promise((resolve) => setTimeout(resolve, 100))
            load.style.backgroundColor = "transparent"
            await new Promise((resolve) => setTimeout(resolve, 100))
            load.remove()
        })

        next.addEventListener("click", async () => {
            const load = document.createElement("div")
            styleLoad(load, register)

            await new Promise((resolve) => setTimeout(resolve, 200))
            load.style.background = "white"
            await new Promise((resolve) => setTimeout(resolve, 1000))
            register2.style.zIndex = "10"
            styleLoad(load, register2)

            await new Promise((resolve) => setTimeout(resolve, 100))
            load.style.backgroundColor = "transparent"
            await new Promise((resolve) => setTimeout(resolve, 100))
            load.remove()
        })

        back2.addEventListener("click", async () => {
            const load = document.createElement("div")
            styleLoad(load, register2)

            await new Promise((resolve) => setTimeout(resolve, 200))
            load.style.background = "white"
            await new Promise((resolve) => setTimeout(resolve, 1000))
            register2.style.zIndex = "0"
            register.style.zIndex = "10"
            styleLoad(load, register)

            await new Promise((resolve) => setTimeout(resolve, 100))
            load.style.backgroundColor = "transparent"
            await new Promise((resolve) => setTimeout(resolve, 100))
            load.remove()
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