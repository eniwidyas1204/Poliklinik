<?php
include "koneksi.php";

$id_periksa = $_POST['id'];
$dokter = $_POST['dokter'];
$pasien = $_POST['pasien'];
$tgl = $_POST['tgl'];
$catatan = $_POST['catatan'];
$obat = $_POST['obat'];

$sql = "UPDATE periksa SET id_dokter='$dokter', id_pasien='$pasien', tgl_periksa='$tgl', catatan='$catatan', obat='$obat' WHERE id='$id_periksa'";

echo "Query SQL: $sql";

if ($conn->query($sql) === TRUE) {
    $conn->close();
    echo("<script>alert(Data tersimpan)</script>");
    header("Location: index.php?page=periksa");
} else {
    $conn->close();
    echo "<script>alert(Gagal melakukan perubahan data: " . $conn->error . ")</script>";
}
?>
