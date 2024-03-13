<?php
$nameServer = "localhost";
$username = "root";
$password = "";
$dbName = "peminjaman_barang";

$conn = mysqli_connect($nameServer, $username, $password, $dbName);

function Login($username, $password) {
    global $conn; 
    $uname = $username;
    $upass = $password;		
    $hasil = mysqli_query($conn,"select * from user where username='$uname' and password='$upass';");
    $cek = mysqli_num_rows($hasil);
    if($cek > 0 ){
        $query = mysqli_fetch_array($hasil);
        $_SESSION['no_identitas'] = $query['no_identitas'];
        $_SESSION['username'] = $query['username'];
        $_SESSION['role'] = $query['role'];
        return true;		
    }
    else {
        return false;
    }	
}
function DataUser() {
    global $conn;
    $hasil=mysqli_query($conn,"SELECT * FROM user;");
    $rows=[];
    while($row = mysqli_fetch_assoc($hasil))
    {
        $rows[] = $row;
    }
    return $rows;

}
function DataSearchUser($search) {
    global $conn;
    $hasil=mysqli_query($conn,"SELECT * FROM user WHERE nama = '$search';");
    $rows=[];
    while($row = mysqli_fetch_assoc($hasil))
    {
        $rows[] = $row;
    }
    return $rows;

}
function DataBarang() {
    global $conn;
    $hasil=mysqli_query($conn,"SELECT * FROM barang;");
    $rows=[];
    while($row = mysqli_fetch_assoc($hasil))
    {
        $rows[] = $row;
    }
    return $rows;

}
function DataSearchBarang($field, $search) {
    global $conn;
    $hasil=mysqli_query($conn,"SELECT * FROM barang WHERE $field = '$search';");
    $rows=[];
    while($row = mysqli_fetch_assoc($hasil))
    {
        $rows[] = $row;
    }
    return $rows;

}


function DataPeminjaman() {
    global $conn;
    $hasil=mysqli_query($conn,"SELECT * FROM peminjaman;");
    $query = mysqli_fetch_array($hasil);
    $rows=[];
    while($row = mysqli_fetch_assoc($hasil))
    {
        $rows[] = $row;
    }  
    return $rows;
}   
function DataPinjamUser($identitas) {
    global $conn;
    $hasil=mysqli_query($conn,"SELECT * FROM peminjaman WHERE no_identitas = '$identitas';");

    $rows=[];
    while($row = mysqli_fetch_assoc($hasil))
    {
        $rows[] = $row;
    }  
    return $rows;
}   

function TambahDataBrg($kode, $nama, $kategori, $merk, $jumlah) {
    global $conn;
    $hasil=mysqli_query($conn,"INSERT INTO barang VALUES (null, '$kode','$nama','$kategori','$merk','$jumlah');");

}
function TambahDataUser($kode, $nama, $statusUser, $username, $password, $role) {
    global $conn;
    $hasil=mysqli_query($conn,"INSERT INTO user VALUES (null, '$kode','$nama','$statusUser','$username','$password', '$role');");

}
function TambahDataPinjam($tglPinjam, $tglKembali, $noIdentitas, $kode, $jumlah) {
    global $conn;
    $hasil=mysqli_query($conn,"INSERT INTO peminjaman VALUES (null, '$tglPinjam', '$tglKembali', '$noIdentitas', '$kode', '$jumlah', 'individu', 'baru', '1');");

}

function Editdata($tablename,$id) {
    global $conn;
    $hasil=mysqli_query($conn,"SELECT * FROM $tablename where id='$id';");
    return $hasil;
}

function update($table, $id, $kode, $nama, $kategori, $merk, $jumlah) {
    global $conn;
    $sql = "UPDATE $table SET kode_brg = '$kode', nama_brg = '$nama', kategori = '$kategori', merk = '$merk', jumlah = '$jumlah' WHERE id = '$id';";
    $hasil=mysqli_query($conn,$sql);
    return $hasil;
}
function updateJumlah($table, $kode, $jumlah) {
    global $conn;
    $sql = "UPDATE $table SET jumlah = '$jumlah' WHERE kode_brg = '$kode';";
    $hasil=mysqli_query($conn,$sql);
    return $hasil;
}
function updateUser($table, $id, $identitas, $nama, $status, $username, $password, $role) {
    global $conn;
    $sql = "update $table set no_identitas = '$identitas', nama = '$nama', status = '$status', username = '$username', password = '$password', role = '$role' WHERE id = '$id';";
    $hasil=mysqli_query($conn,$sql);
    return $hasil;
}
function updatePinjam($table, $id, $tglPinjam, $tglKembali, $identitas,$kode, $jumlah) {
    global $conn;
    $sql = "update $table set tgl_pinjam = '$tglPinjam', tgl_kembali = '$tglKembali', no_identitas = '$identitas', kode_brg = '$kode', jumlah = '$jumlah', keperluan = 'individu', status = 'baru', id_login= '1' where id = '$id';";
    $hasil=mysqli_query($conn,$sql);
    return $hasil;
}

function Delete($tablename, $id) {
    global $conn;
    $hasil=mysqli_query($conn,"DELETE FROM $tablename where id='$id';");
    return $hasil;
}

?>