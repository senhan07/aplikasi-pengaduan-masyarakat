<?php
session_start();
include '../conn/koneksi.php';

if(isset($_POST['tanggapi'])){
    $tgl = date('Y-m-d');
    $id_pengaduan = $_POST['id_pengaduan'];
    $tanggapan = $_POST['tanggapan'];
    $bukti = $_FILES['bukti']['name'];
    $source = $_FILES['bukti']['tmp_name'];
    $folder = './../img/';
    $listeks = array('jpg', 'png', 'jpeg');
    $pecah = explode('.', $bukti);
    $eks = $pecah['1'];
    $size = $_FILES['bukti']['size'];
    $namabukti = date('dmYis') . $bukti;

    if($bukti != ""){
        if(in_array($eks, $listeks)){
            if($size <= 1000000){
                move_uploaded_file($source, $folder.$namabukti);
                $query = mysqli_query($koneksi, "INSERT INTO tanggapan VALUES (NULL, '$id_pengaduan', '$tgl', '$tanggapan', '$namabukti', '".$_SESSION['data']['id_petugas']."')");
                if($query){
                    $update = mysqli_query($koneksi, "UPDATE pengaduan SET status='selesai' WHERE id_pengaduan='$id_pengaduan'");
                    if($update){
                        echo json_encode(['status' => 'success', 'message' => 'Tanggapan Terkirim']);
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui status pengaduan']);
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan tanggapan']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Ukuran Gambar Tidak Lebih Dari 100KB']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Format File Tidak Di Dukung']);
        }
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO tanggapan VALUES (NULL, '$id_pengaduan', '$tgl', '$tanggapan', 'noImage.png', '".$_SESSION['data']['id_petugas']."')");
        if($query){
            $update = mysqli_query($koneksi, "UPDATE pengaduan SET status='selesai' WHERE id_pengaduan='$id_pengaduan'");
            if($update){
                echo json_encode(['status' => 'success', 'message' => 'Tanggapan Terkirim']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui status pengaduan']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan tanggapan']);
        }
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Tidak ada data yang dikirim']);
}
?>
