<?php
include_once "koneksi.php";
$data = $_POST;
$file = $_FILES;

// die(json_encode($data['username']));
$username = $data['username'];
$sql = $koneksi->query("SELECT id_user,nama_lengkap,alamat,no_telp FROM user where username = '$username'");


if ($sql->num_rows == 0) {
    echo json_encode("Masukkan username yang benar");
} else {
    $row = mysqli_fetch_array($sql);

    $id_user = $row['id_user'];
    $nama_lengkap = $row['nama_lengkap'];
    $alamat = $row['alamat'];
    $no_telp = $row['no_telp'];


    $nama_makanan = $data['nama_makanan'];
    $deskripsi_makanan = $data['deskripsi_makanan'];
    $stok_harian = $data['stok_harian'];
    $harga_satuan = $data['harga_satuan'];

    $folderUpload = "Upload/img";

    if (!file_exists($folderUpload)) {
        mkdir($folderUpload, 777, true);
    }
    $nama_foto = "DANUS" . "-" . time() . ".jpeg";
    $foto_makanan = 'http://tubespam.awesomeproject.id/Upload/img/'.$nama_foto;

    if (move_uploaded_file($file['photo']['tmp_name'], $folderUpload . "/" . $nama_foto)) {
        $sql = "INSERT INTO `makanan`(`id_user`, `nama_makanan`, `deskripsi_makanan`, `foto_makanan`, `stok_harian`, `harga_satuan`, `nama_lengkap`, `alamat`, `no_telp`) VALUES ('$id_user','$nama_makanan','$deskripsi_makanan','$foto_makanan','$stok_harian','$harga_satuan','$nama_lengkap','$alamat','$no_telp')";
        $info = array();
        $info['sql'] = $sql;
        if (mysqli_query($koneksi, $sql)) {
            $info = "Makanan berhasil ditambahkan";
        } else {
            $info = mysqli_error($koneksi);
        }

        mysqli_close($koneksi);
        echo json_encode($info);
    }
    else{
        mysqli_close($koneksi);
        echo json_encode("Ada kesalahan,silahkan coba lagi");
    }
}
