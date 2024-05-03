<?php
include "koneksi.php";

$id = $_POST['id'];
$nama = $_POST['newNama'];
$alamat = $_POST['newAlamat'];
$noHp = $_POST['newHp'];

$sql = "UPDATE dokter SET nama='$nama', alamat='$alamat', no_hp='$noHp' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    $conn->close();
    echo("<script>alert(Data tersimpan)</script>");
    header("Location: index.php?page=dokter");
} else {
    $conn->close();
    echo "Gagal melakukan perubahan data: " . $conn->error;
}
?>
