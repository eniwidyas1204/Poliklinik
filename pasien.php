<?php
include 'koneksi.php';

if(isset($_SESSION['username'])) {
    if(isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $no_hp = $_POST['no_hp'];
        
        $sql = "INSERT INTO pasien (nama, alamat, no_hp) VALUES ('$nama', '$alamat', '$no_hp')";
        $hasil = $conn->query($sql);
        
        if($hasil) {
            echo "<script>alert(Data berhasil ditambahkan.)";
            header("Location: index.php?page=pasien");
            exit();
        } else {
            echo "Terjadi kesalahan. Data pasien gagal ditambahkan.";
        }
    }
     
    if(isset($_POST['hapus'])) {
        $id_pasien = $_POST['id_pasien'];
        
        $deleteSql = "DELETE FROM pasien WHERE id = $id_pasien";
        $delete = $conn->query($deleteSql);
        
        header("Location: index.php?page=pasien");
        exit();
    }
    ?>

    <form action="" method="POST">
    <div class="mb-3">
        <label for="nama" class="form-label fw-bold">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
    </div>
    <div class="mb-3">
        <label for="alamat" class="form-label fw-bold">Alamat</label>
        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat">
    </div>
    <div class="mb-3">
        <label for="no_hp" class="form-label fw-bold">No HP</label>
        <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="No HP">
    </div>
    <button class="btn btn-primary px-5 rounded-pill" type="submit" name="submit">Simpan</button>
    </form>

    <?php

    $showSql = "SELECT * FROM pasien";
    $showHasil = $conn->query($showSql);
    if($showHasil->num_rows > 0){
        $no = 1;
        ?>
        <table class="table mt-3">
        <thead>
            <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Alamat</th>
            <th scope="col">No Hp</th>
            <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while($row = $showHasil->fetch_assoc()){
        ?>
            <tr>
            <th scope="row"><?php echo $no ?></th>
            <td><?php echo $row['nama']?></td>
            <td><?php echo $row['alamat']?></td>
            <td><?php echo $row['no_hp']?></td>
            <td>
                <a href="index.php?page=pasienEdit&id=<?php echo $row["id"]?>" class="btn btn-success btn-sm rounded-pill px-3">Ubah</a>
                <form action="" method="POST" style="display: inline-block">
                    <input type="hidden" name="id_pasien" value="<?php echo $row['id']; ?>">
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
