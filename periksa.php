<?php
include 'koneksi.php';

if(isset($_SESSION['username'])) {
    if(isset($_POST['submit'])) {
        $dokter = $_POST['dokter'];
        $pasien = $_POST['pasien'];
        $tgl = $_POST['tgl'];
        $catatan = $_POST['catatan'];
        $obat = $_POST['obat'];
        
        $sql = "INSERT INTO periksa (id_dokter, id_pasien, tgl_periksa, catatan, obat) VALUES ('$dokter', '$pasien', '$tgl', '$catatan', '$obat')";
        $hasil = $conn->query($sql);
        
        if($hasil) {
            echo "<script>alert(Data periksa berhasil ditambahkan.)";
            header("Location: index.php?page=periksa");
            exit();
        } else {
            echo "Terjadi kesalahan. Data periksa gagal ditambahkan.";
        }
    }
     
    if(isset($_POST['hapus'])) {
        $id_periksa = $_POST['id_periksa'];
        
        $deleteSql = "DELETE FROM periksa WHERE id = $id_periksa";
        $delete = $conn->query($deleteSql);
        
        header("Location: index.php?page=periksa");
        exit();
    }
    ?>

    <form action="" method="POST">
    <div class="mb-3">
        <label for="nama" class="form-label fw-bold">Pasien</label>
        <select class="form-select" name="pasien">
            <option selected>Pasien</option>
            <?php 
				$pasienSql = "SELECT * FROM pasien";
                $pasienShow = $conn->query($pasienSql);
				while($row = $pasienShow->fetch_assoc()){
					?>
					<option value="<?php echo $row['id'] ?>"><?php echo $row['nama'] ?></option>
					<?php
				}
				?>	
        </select>
    </div>
    <div class="mb-3">
        <label for="nama" class="form-label fw-bold">Dokter</label>
        <select class="form-select" name="dokter">
            <option selected>Dokter</option>
            <?php 
				$dokterSql = "SELECT * FROM dokter";
                $dokterShow = $conn->query($dokterSql);
				while($row = $dokterShow->fetch_assoc()){
					?>
					<option value="<?php echo $row['id'] ?>"><?php echo $row['nama'] ?></option>
					<?php
				}
				?>	
        </select>
    </div>
    <div class="mb-3">
        <label for="no_hp" class="form-label fw-bold">Tanggal Periksa</label>
        <input type="datetime-local" class="form-control" id="tgl" name="tgl" placeholder="Tanggal">
    </div>
    <div class="mb-3">
        <label for="no_hp" class="form-label fw-bold">Catatan</label>
        <input type="text" class="form-control" id="no_hp" name="catatan" placeholder="Catatan">
    </div>
    <div class="mb-3">
        <label for="no_hp" class="form-label fw-bold">Obat</label>
        <input type="text" class="form-control" id="no_hp" name="obat" placeholder="Obat">
    </div>
    <button class="btn btn-primary px-5 rounded-pill" type="submit" name="submit">Simpan</button>
    </form>

    <?php
    $showSql = "SELECT periksa.*, pasien.nama AS nama_pasien, dokter.nama AS nama_dokter FROM periksa 
                LEFT JOIN pasien ON periksa.id_pasien = pasien.id 
                LEFT JOIN dokter ON periksa.id_dokter = dokter.id";
    $showHasil = $conn->query($showSql);
    if ($showHasil->num_rows > 0) {
        $no = 1;
    ?>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Pasien</th>
                    <th scope="col">Dokter</th>
                    <th scope="col">Tanggal Periksa</th>
                    <th scope="col">Catatan</th>
                    <th scope="col">Obat</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $showHasil->fetch_assoc()) {
                ?>
                    <tr>
                        <th scope="row"><?php echo $no ?></th>
                        <td><?php echo $row['nama_pasien'] ?></td>
                        <td><?php echo $row['nama_dokter'] ?></td>
                        <td><?php echo $row['tgl_periksa'] ?></td>
                        <td><?php echo $row['catatan'] ?></td>
                        <td><?php echo $row['obat'] ?></td>
                        <td>
                            <a href="index.php?page=periksaEdit&id=<?php echo $row["id"] ?>" class="btn btn-success btn-sm rounded-pill px-3">Ubah</a>
                            <form action="" method="POST" style="display: inline-block">
                                <input type="hidden" name="id_periksa" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3" name="hapus">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
    <?php
    } else {
        echo "Tidak Ada Data";
    }
} else {
    header("location: index.php?page=loginUser");
}
?>
