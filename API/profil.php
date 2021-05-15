<?php
include_once "koneksi.php";
$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'];
$sql = $koneksi->query("SELECT * FROM `user` where username = '$username'");

if ($sql->num_rows != 0) {
    while ($row = mysqli_fetch_array($sql)) {
        if($row['jenis_kelamin'] == 0){
            $jk = "Laki-Laki";
        }
        else{
            $jk="perempuan";
        }
        $hasil[] = array(
            'id_user' => $row['id_user'],
            'nama_lengkap' => $row['nama_lengkap'],
            'username' => $row['username'],
            'password' => $row['password'],
            'email' => $row['email'],
            'alamat' => $row['alamat'],
            
            'jenis_kelamin' => $jk,
            'no_telp' => $row['no_telp'],
        );
    }
}
$data['result'] = $hasil;
echo (json_encode($data));
