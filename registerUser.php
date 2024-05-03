<?php
include 'koneksi.php';

if(isset($_POST['register'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $confirmPass = $_POST['confirm_password'];

    // Periksa username sudah ada dalam database
    $checkSql = "SELECT * FROM user WHERE username='$user'";
    $checkResult = mysqli_query($conn, $checkSql);

    if(mysqli_num_rows($checkResult) > 0){
        // Username sudah digunakan
        echo "<script>alert('Username sudah digunakan, silakan pilih username yang lain.');</script>";
    } else {
        // Periksa password dan konfirmasi password cocok
        if($pass != $confirmPass){
            // Password tidak cocok
            echo "<script>alert('Password dan konfirmasi password tidak cocok.');</script>";
        } else {
            // Hash password sebelum disimpan ke database
            $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

            // Simpan username dan password yang di-hash ke dalam database
            $insertSql = "INSERT INTO user (username, password) VALUES ('$user', '$hashedPass')";
            if(mysqli_query($conn, $insertSql)){
                // Register berhasil
                echo "<script>alert('Register berhasil!');</script>";
                header("location: index.php?page=loginUser");
            } else {
                // kesalahan register
                echo "<script>alert('Terjadi kesalahan saat melakukan register.');</script>";
            }
        }
    }
}
?>

<form class="row g-3 needs-validation" novalidate action="" method="post">
    <div class="col-12">
        <label for="yourUsername" class="form-label">Username</label>
        <div class="input-group has-validation">
            <input type="text" name="username" class="form-control" id="yourUsername" required>
            <div class="invalid-feedback">Please enter your username.</div>
        </div>
    </div>

    <div class="col-12">
        <label for="yourPassword" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="yourPassword" required>
        <div class="invalid-feedback">Please enter your password!</div>
    </div>

    <div class="col-12">
        <label for="confirmPassword" class="form-label">Confirm Password</label>
        <input type="password" name="confirm_password" class="form-control" id="confirmPassword" required>
        <div class="invalid-feedback">Please confirm your password!</div>
    </div>

    <div class="col-12">
        <button class="btn btn-primary w-100" type="submit" name="register">Register</button>
    </div>
</form>
