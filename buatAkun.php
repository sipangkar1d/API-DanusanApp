<?php
include_once "koneksi.php";
$data = json_decode(file_get_contents('php://input'), true);

$username = $data['username'];
$nama_lengkap = $data['nama_lengkap'];
$email = $data['email'];
$alamat = $data['alamat'];
$jenis_kelamin = $data['jenis_kelamin'];
$no_telp = $data['no_telp'];
$password = $data['password'];

$sql = "insert into user(username, password,email, nama_lengkap, alamat, jenis_kelamin, no_telp) values ('$username', '$password' ,'$email', '$nama_lengkap', '$alamat', '$jenis_kelamin', '$no_telp')";

$info = array();
$info['sql'] = $sql;
if (mysqli_query($koneksi, $sql)) {
	$info['success'] = 1;
	$info['detail'] = 'success';
} else {
	$info['success'] = 0;
	$info['detail'] = mysqli_error($koneksi);
}

mysqli_close($koneksi);
echo json_encode($info);
