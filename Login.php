<?php
include_once "koneksi.php";
$data = json_decode(file_get_contents('php://input'), true);

$username = $data['username'];
$password = $data['password'];

if ($data['username'] != "") {
    $sql = $koneksi->query("SELECT * FROM `user` where username = '$username' && password = '$password'");
    if ($sql->num_rows == 0) {
        echo json_encode('Wrong Details');
    } else {
        echo json_encode('ok');
    }
} else {
    echo json_encode('try again');
}
