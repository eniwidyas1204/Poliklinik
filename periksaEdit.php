<?php
    include 'koneksi.php';
    $id = $_GET['id'];
    
    $sql = "SELECT * FROM periksa WHERE id='$id'";
    $hasil = $conn->query($sql);

    if ($hasil->num_rows > 0) {
        $row = $hasil->fetch_assoc();
        $idDokter = $row['id_dokter'];
        $idPasien = $row['id_pasien'];
        $tglPeriksa = $row['tgl_periksa'];
        $catatan = $row['catatan'];
        $obat = $row['obat'];
    } else {
        echo "Data tidak ditemukan.";
        exit();
    }

    $dokterSql = "SELECT * FROM dokter";
    $dokterResult = $conn->query($dokterSql);

    $pasienSql = "SELECT * FROM pasien";
    $pasienResult = $conn->query($pasienSql);
?>

<h5 class="card-title">Form Edit Periksa</h5>
<form action="periksaUpdate.php" class="row g-3" method="post">
    <div class="col-12">
        <label for="id" class="form-label">ID</label>
        <input type="text" class="form-control" id="id" name="id" value="<?=$id;?>" readonly>
    </div>
    <div class="col-12">
        <label for="dokter" class="form-label">Dokter</label>
        <select class="form-select" id="dokter" name="dokter">
            <?php 
            while($dokterRow = $dokterResult->fetch_assoc()) {
                $selected = ($dokterRow['id'] == $idDokter) ? "selected" : "";
                echo "<option value='".$dokterRow['id']."' ".$selected.">".$dokterRow['nama']."</option>";
            }
            ?>
        </select>
    </div>
    <div class="col-12">
        <label for="pasien" class="form-label">Pasien</label>
        <select class="form-select" id="pasien" name="pasien">
            <?php 
            while($pasienRow = $pasienResult->fetch_assoc()) {
                $selected = ($pasienRow['id'] == $idPasien) ? "selected" : "";
                echo "<option value='".$pasienRow['id']."' ".$selected.">".$pasienRow['nama']."</option>";
            }
            ?>
        </select>
    </div>
    <div class="col-12">
        <label for="tgl_periksa" class="form-label">Tanggal Periksa</label>
        <input type="datetime-local" class="form-control" id="tgl_periksa" name="tgl" value="<?=$tglPeriksa;?>">
    </div>
    <div class="col-12">
        <label for="catatan" class="form-label">Catatan</label>
        <input type="text" class="form-control" id="catatan" name="catatan" value="<?=$catatan;?>">
    </div>
    <div class="col-12">
        <label for="obat" class="form-label">Obat</label>
        <input type="text" class="form-control" id="obat" name="obat" value="<?=$obat;?>">
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary" value="Update">Update</button>
    </div>
</form>
