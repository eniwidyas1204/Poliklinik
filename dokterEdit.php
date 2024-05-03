<?php
    include 'koneksi.php';
    $id=$_GET['id'];
    
    $sql="select * from dokter where id='$id'";
    $hasil=$conn->query($sql);

    while($row=$hasil->fetch_assoc()){
        $nama=$row['nama'];
        $alamat=$row['alamat'];
        $noHp=$row['no_hp'];
    }
?>

<h5 class="card-title">Form Edit Dokter</h5>
<form action="dokterUpdate.php" class="row g-3" method="post" enctype="multipart/form-data">
    <div class="col-12">
        <label for="id" class="form-label">ID</label>
        <input type="text" class="form-control" id="id" name="id" value="<?=$id;?>" readonly>
    </div>
    <div class="col-12">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="newNama" value="<?=$nama;?>">
    </div>
    <div class="col-12">
        <label for="alamat" class="form-label">Alamat</label>
        <input type="text" class="form-control" id="alamat" name="newAlamat" value="<?=$alamat;?>">
    </div>
    <div class="col-12">
        <label for="nohp" class="form-label">No Hp</label>
        <input type="text" class="form-control" id="nohp" name="newHp" value="<?=$noHp;?>">
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary" value="Update">Update</button>
    </div>
</form>