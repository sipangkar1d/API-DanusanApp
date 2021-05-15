<?php
include_once "koneksi.php";
$data = json_decode(file_get_contents('php://input'), true);

$username = $data['username'];
$newpassword = $data['password'];

$sql = "update user set password='$newpassword' where username='$username'";

if ($koneksi->query($sql)) {
    echo json_encode("Berhasil");
} else {
    echo json_encode("gagal" . $koneksi->error);
}

$koneksi->close();
