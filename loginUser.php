<?php
    include 'koneksi.php';

    if(isset($_POST['Login'])){
        $user = $_POST['username'];
        $pass = $_POST['password'];
    
        // Periksa login
        $sql = "SELECT * FROM user WHERE username='$user'";
        $result = mysqli_query($conn, $sql);
        if($result->num_rows > 0){
            $row = mysqli_fetch_assoc($result);
            $hashedPass = $row['password'];
    
            // Periksa password cocok dengan yang di-hash
            if(password_verify($pass, $hashedPass)){
                // Password cocok
                session_start();
                $_SESSION['username'] = $row['username'];
                header("location:index.php");
            } else {
                // Password tidak cocok
                echo "<script>alert('Username atau password salah.');</script>";
                header("location: index.php?page=loginUser");
            }
        } else {
            // Username tidak ditemukan di database, beri pesan kesalahan
            echo "<script>alert('Username atau password salah.');</script>";
            header("location: index.php?page=loginUser");
        }
    } else {
        ?>
        <div class="container pt-5">
        <section class="section register mt-5 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">            

                <div class="card mb-3">

                    <div class="card-body">

                    <div class="pt-4 pb-2">
                        <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                        <p class="text-center small">Enter your username & password to login</p>
                    </div>

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
                        <button class="btn btn-primary w-100" type="submit" name="Login">Login</button>
                        </div>
                    </form>

                    </div>
                </div>

                <div class="credits">
                    Belum punya akun. <a href="index.php?page=registerUser">Daftar</a>
                </div>

                </div>
            </div>
            </div>

        </section>

        </div>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
    </html>
    <?php
    }
    ?>