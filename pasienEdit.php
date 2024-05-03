<?php
    include 'koneksi.php';
    $id=$_GET['id'];
    
    $sql="select * from pasien where id='$id'";
    $hasil=$conn->query($sql);

    while($row=$hasil->fetch_assoc()){
        $nama=$row['nama'];
        $alamat=$row['alamat'];
        $noHp=$row['no_hp'];
    }
?>

<h5 class="card-title">Form Edit Pasien</h5>
<form action="pasienUpdate.php" class="row g-3" method="post" enctype="multipart/form-data">
    <div class="col-12">
        <label for="id" class="form-label">ID</label>
        <input type="text" class="form-control" id="id" name="id" value="<?=$id;?>" readonly>
    </div>
    <div class="col-12">
        <label for="tnama" class="form-label">Nama Barang</label>
        <input type="text" class="form-control" id="tnama" name="newNama" value="<?=$nama;?>">
    </div>
    <div class="col-12">
        <label for="talamat" class="form-label">Alamat</label>
        <input type="text" class="form-control" id="talamat" name="newAlamat" value="<?=$alamat;?>">
    </div>
    <div class="col-12">
        <label for="tHp" class="form-label">No Hp</label>
        <input type="text" class="form-control" id="tHp" name="newHp" value="<?=$noHp;?>">
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary" value="Update">Update</button>
    </div>
</form>